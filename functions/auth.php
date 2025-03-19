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
        $query = "SELECT * FROM users_netFootballGear 
                 WHERE email = :identifier 
                 OR username = :identifier";
        
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':identifier', $identifier);
        $stmt->execute();
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            // Start sessie en sla gebruikersgegevens op
            $_SESSION['user_id'] = $user['userID'];
            $_SESSION['username'] = $user['username'];
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