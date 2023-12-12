<?php

$array = ['a', 'b', 'a', 'c', 'b', 'a', 'd', 'e', 'a'];

// Count the occurrences of each character
$counts = array_count_values($array);

// Find the character with the highest count
$mostCommonCharacter = array_search(max($counts), $counts);

echo "The most common character is: " . $mostCommonCharacter;
?>



<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=your_database", "your_username", "your_password");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 


    // PostsPerHourTablשאילתת ליצירת טבלת 

    $createPostsPerHourTable = "CREATE TABLE IF NOT EXISTS PostsPerHour (
        post_hour DATETIME,
        post_count INT 
    )"; 


    $pdo->exec($createPostsPerHourTable);

    echo "Table PostsPerHour created successfully!";
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>