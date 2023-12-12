<?php
// שם הקובץ
$fileName = 'C:\Users\user\Desktop\PHP\assets\users.text';

// קריאת תוכן הקובץ
$content = file_get_contents($fileName);

// בדיקת שגיאה
if ($content === false) {
    $error = error_get_last();
    echo "שגיאה: " . $error['message'];
} else {
    // המרת הנתונים מ-JSON למערך PHP
    $usersData = json_decode($content, true);

    // יצירת קשר לבסיס הנתונים
    $pdo = new PDO("mysql:host=localhost;dbname=inmange", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // הכנסת נתונים לטבלה
    foreach ($usersData as $user) {
        $insertUserQuery = "INSERT INTO Users (id, name, email) VALUES (:id, :name, :email)";
        $stmt = $pdo->prepare($insertUserQuery);
        
        $stmt->bindParam(':id', $user['id']);
        $stmt->bindParam(':name', $user['name']);
        $stmt->bindParam(':email', $user['email']);

        $stmt->execute();
    }

    echo "נתונים הוכנסו בהצלחה לטבלה.";
}
?>
