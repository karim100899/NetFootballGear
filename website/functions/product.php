<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

function getUniqueProductTypes($pdo) {
    try {
        $stmt = $pdo->prepare("SELECT DISTINCT title FROM products WHERE title IS NOT NULL");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    } catch (PDOException $e) {
        error_log("Error getting product types: " . $e->getMessage());
        return [];
    }
}

function getFilteredProducts($pdo, $filters = []) {
    try {
        $sql = "SELECT * FROM products WHERE 1=1";
        $params = [];

        // Add price filter if set
        if (isset($filters['min_price'])) {
            $sql .= " AND price >= :min_price";
            $params[':min_price'] = $filters['min_price'];
        }
        if (isset($filters['max_price'])) {
            $sql .= " AND price <= :max_price";
            $params[':max_price'] = $filters['max_price'];
        }

        // Add product type filter if set
        if (isset($filters['product_type']) && !empty($filters['product_type'])) {
            $sql .= " AND title IN (" . str_repeat('?,', count($filters['product_type']) - 1) . '?)';
            $params = array_merge($params, $filters['product_type']);
        }

        // Exclude specific product if set
        if (isset($filters['exclude_id'])) {
            $sql .= " AND productID != :exclude_id";
            $params[':exclude_id'] = $filters['exclude_id'];
        }

        // Limit results if specified
        if (isset($filters['limit'])) {
            $sql .= " LIMIT :limit";
            $params[':limit'] = (int)$filters['limit'];
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Log error and return empty array
        error_log("Error in getFilteredProducts: " . $e->getMessage());
        return [];
    }
}