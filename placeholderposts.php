<?php
// שם הקובץ
$fileName = 'C:\Users\user\Desktop\PHP\assets\posts.json';

// קריאת תוכן הקובץ
$content = file_get_contents($fileName);

// בדיקת שגיאה
if ($content === false) {
    $error = error_get_last();
    echo "שגיאה: " . $error['message'];
} else {
    // המרת הנתונים מ-JSON למערך PHP
    $postsData = json_decode($content, true);

    // יצירת קשר לבסיס הנתונים
    $pdo = new PDO("mysql:host=localhost;dbname=inmange", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // הכנסת נתונים לטבלה
    foreach ($postsData as $post) {
        $insertData = "INSERT INTO Posts 
            (id, user_id, title,content)
            VALUES (:id, :user_id, :title, :content)";
    
        $stmt = $pdo->prepare($insertData);
        $stmt->bindParam(':id', $post['id']);
        $stmt->bindParam(':user_id', $post['userId']);
        $stmt->bindParam(':title', $post['title']);
        $stmt->bindParam(':content', $post['body']);
        $stmt->execute();
    }
    

    echo "נתונים הוכנסו בהצלחה לטבלה.";
}
?>
