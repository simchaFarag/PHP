<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Posts</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .profile-image {
            width: 50px;
            height: 50px;
        }
    </style>
</head>
<body>

<?php
$host = "localhost";
$dbname = "inmange";
$user = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=localhost;dbname=inmange", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // שאילתה SQL
    $sql = "SELECT Users.id AS user_id,
                   Users.name AS user_name,
                   Users.email AS user_email,
                   Users.active AS user_active,
                  'C:/Users/user/Desktop/PHP/assets/avatar.jpg' AS user_profile_image,  -- נתיב לתמונה קבוע, יש להחליף בנתיב המתאים
                   Posts.id AS post_id,
                   Posts.title AS post_title,
                   Posts.content AS post_content,
                   Posts.creation_date AS post_creation_date,
                   Posts.active AS post_active
            FROM Users
            INNER JOIN Posts ON Users.id = Posts.user_id
            WHERE Users.active = TRUE";

    $stmt = $pdo->query($sql);

    // הדפסת התוצאות בטבלה
    echo "<table>";
    echo "<tr>
            <th>User ID</th>
            <th>User Name</th>
            <th>User Email</th>
            <th>Post ID</th>
            <th>Post Title</th>
            <th>Post Content</th>
            <th>Post Creation Date</th>
            <th>User Profile Image</th>
          </tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>" . $row["user_id"] . "</td>
                <td>" . $row["user_name"] . "</td>
                <td>" . $row["user_email"] . "</td>
                <td>" . $row["post_id"] . "</td>
                <td>" . $row["post_title"] . "</td>
                <td>" . $row["post_content"] . "</td>
                <td>" . $row["post_creation_date"] . "</td>
                <td><img src='" . $row["user_profile_image"] . "' alt='Profile Image' class='profile-image'></td>
              </tr>";
    }

    echo "</table>";

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// סגירת חיבור
$pdo = null;
?>

</body>
</html>
