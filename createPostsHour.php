<?php
try {
    // חיבור למסד הנתונים עם PDO
    $pdo = new PDO("mysql:host=localhost;dbname=inmange", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // שאילתת SQL ליצירת טבלה חדשה
    $createTableSQL = "
        CREATE TABLE IF NOT EXISTS posts_count (
            post_date DATE,
            post_hour INT,
            post_count INT
        );
    ";
    $pdo->exec($createTableSQL);

    // שאילתת SQL לספירת הפוסטים לפי תאריך ושעה
    $countPostsSQL = "
        INSERT INTO posts_count (post_date, post_hour, post_count)
        SELECT DATE(timestamp_column) as post_date, HOUR(timestamp_column) as post_hour, COUNT(*) as post_count
        FROM posts
        GROUP BY post_date, post_hour;
    ";
    $pdo->exec($countPostsSQL);

    echo "Records inserted successfully";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// סגירת חיבור למסד הנתונים
$pdo = null;
?>
