<?php 
    
    try {
        // יצירת קשר לבסיס הנתונים
        $pdo = new PDO("mysql:host=localhost;dbname=inmange", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // יצירת טבלה
         $createUsersTable = "CREATE TABLE IF NOT EXISTS Users (
            id INT PRIMARY KEY,
            name VARCHAR(255),
            email VARCHAR(255),
            active BOOLEAN
         )";
         $pdo->exec($createUsersTable);

        //  יצירת טבלת פוסטים
         $createPostsTable = "CREATE TABLE IF NOT EXISTS Posts (
            id INT PRIMARY KEY,
            user_id INT,
            title VARCHAR(255),
            content TEXT,
            creation_date DATE,
            active BOOLEAN,
            FOREIGN KEY (user_id) REFERENCES Users(id)
        )";
        $pdo->exec($createPostsTable);

        echo 'Tables created seccessfully';

        


    } catch(Exception $e){
        die("Error:".$e->getMessage());
    }

?>


<!-- שליפת התמונה ושמירה בזכרון -->

<!-- 
// $imageUrl = "https://cdn2.vectorstock.com/i/1000x1000/23/81/default-avatar-profile-icon-vector-18942381.jpg";
// $imageContents = file_get_contents($imageUrl);
// file_put_contents("path/to/save/image.jpg", $imageContents);
// echo "Image saved successfully!"; -->
