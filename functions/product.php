<?php
function getRandomProducts($pdo, $limit = 4) {
    try {
        // Query om random producten op te halen
        $query = "SELECT productID, image, description, price, title 
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