<?php
function getRandomProducts($pdo, $limit = 4) {
    try {
        // Query om random producten op te halen
        $query = "SELECT productID, image, description, price, title, product_name 
                 FROM products 
                 ORDER BY RAND() 
                 LIMIT :limit";

        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Log de error (in een productieomgeving)
        error_log("Error fetching random products: " . $e->getMessage());
        return false;
    }
}

function getProductById($pdo, $productId) {
    try {
        $query = "SELECT productID, image, description, price, title, product_name 
                 FROM products 
                 WHERE productID = :productId";
        
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':productId', $productId, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error fetching product details: " . $e->getMessage());
        return false;
    }
}

function searchProducts($pdo, $query) {
    try {
        // Bereid de zoekterm voor
        $searchTerm = '%' . str_replace(' ', '%', $query) . '%';
        
        // SQL query die zoekt naar gedeeltelijke overeenkomsten in titel en beschrijving
        $sql = "SELECT productID, image, description, price, title, product_name 
                FROM products 
                WHERE title LIKE :searchTerm 
                OR description LIKE :searchTerm";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':searchTerm', $searchTerm, PDO::PARAM_STR);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error searching products: " . $e->getMessage());
        return false;
    }
}

function getAllProducts($pdo) {
    try {
        $stmt = $pdo->query("SELECT productID, title, price, image, product_name FROM products");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error fetching products: " . $e->getMessage());
        return [];
    }
}