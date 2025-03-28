<?php
function registerUser($pdo, $username, $email, $password, $phonenumber = null) {
    try {
        $query = "INSERT INTO users_netFootballGear (username, email, password, phonenumber) 
                 VALUES (:username, :email, :password, :phonenumber)";
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $hashedPassword);
        $stmt->bindValue(':phonenumber', $phonenumber);
        
        return $stmt->execute();
    } catch (PDOException $e) {
        error_log("Registration error: " . $e->getMessage());
        return false;
    }
}

function loginUser($pdo, $identifier, $password) {
    try {
        // Check of de gebruiker inlogt met email of gebruikersnaam
        $query = "SELECT u.*, c.companyID 
                 FROM users_netFootballGear u 
                 LEFT JOIN company c ON u.userID = c.userID 
                 WHERE u.email = :identifier 
                 OR u.username = :identifier";
        
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':identifier', $identifier);
        $stmt->execute();
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            // Start sessie en sla gebruikersgegevens op
            $_SESSION['user_id'] = $user['userID'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['companyID'] ? 'seller' : 'user';
            if ($user['companyID']) {
                $_SESSION['company_id'] = $user['companyID'];
            }
            return true;
        }
        return false;
    } catch (PDOException $e) {
        error_log("Login error: " . $e->getMessage());
        return false;
    }
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function logout() {
    session_destroy();
    header('Location: login.php');
    exit;
}

// Nieuwe functie om te controleren of een gebruiker een gast is of ingelogd
function isGuest() {
    return !isset($_SESSION['user_id']);
}

function getUserById($pdo, $userId) {
    $stmt = $pdo->prepare("SELECT * FROM users_netFootballGear WHERE userID = ?");
    $stmt->execute([$userId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function createSellerAccount($pdo, $companyData) {
    try {
        // Generate a random password
        $password = bin2hex(random_bytes(8));
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Create user account
        $stmt = $pdo->prepare("INSERT INTO users_netFootballGear (email, password, username, phonenumber) VALUES (:email, :password, :username, :phone)");
        $stmt->execute([
            ':email' => $companyData['email'],
            ':password' => $hashedPassword,
            ':username' => $companyData['companyName'],
            ':phone' => $companyData['phone'] ?? ''
        ]);
        
        $userId = $pdo->lastInsertId();
        
        // Link user to company
        $stmt = $pdo->prepare("UPDATE company SET userID = :userId WHERE companyID = :companyId");
        $stmt->execute([
            ':userId' => $userId,
            ':companyId' => $companyData['companyID']
        ]);

        // Set session variables for automatic login
        $_SESSION['user_id'] = $userId;
        $_SESSION['username'] = $companyData['companyName'];
        $_SESSION['role'] = 'seller';
        $_SESSION['company_id'] = $companyData['companyID'];
        
        // Return credentials for email
        return [
            'email' => $companyData['email'],
            'password' => $password,
            'username' => $companyData['companyName']
        ];
    } catch (PDOException $e) {
        error_log("Error creating seller account: " . $e->getMessage());
        return false;
    }
}

function getSellerProducts($pdo, $companyId) {
    try {
        $stmt = $pdo->prepare("
            SELECT p.*, 
                   COUNT(DISTINCT oi.order_id) as total_sales,
                   SUM(oi.quantity) as total_quantity
            FROM products_netFootballGear p
            LEFT JOIN order_items_netFootballGear oi ON p.productID = oi.product_id
            WHERE p.company_id = :companyId
            GROUP BY p.productID
        ");
        $stmt->execute([':companyId' => $companyId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error getting seller products: " . $e->getMessage());
        return [];
    }
}

function getSellerOrders($pdo, $companyId) {
    try {
        $stmt = $pdo->prepare("
            SELECT o.orderID, o.order_date, o.total_amount, o.status,
                   oi.quantity, oi.price as item_price,
                   p.title, p.product_name,
                   COALESCE(u.username, 'Guest') as customer_name
            FROM orders_netFootballGear o
            JOIN order_items_netFootballGear oi ON o.orderID = oi.order_id
            JOIN products_netFootballGear p ON oi.product_id = p.productID
            LEFT JOIN users_netFootballGear u ON o.userID = u.userID
            WHERE p.company_id = :companyId
            ORDER BY o.order_date DESC
        ");
        $stmt->execute([':companyId' => $companyId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error getting seller orders: " . $e->getMessage());
        return [];
    }
}