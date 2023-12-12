
<?php
// URL של התמונה
$imageUrl = "C:\Users\user\Desktop\PHP\assets\avatar.jpg";

// שם קובץ בו ישמרו התמונה על השרת
$localFileName = "avatar.jpg";

// שולף את תוכן התמונה מה-URL
$imageContent = file_get_contents($imageUrl);

// שומר את התמונה על השרת
file_put_contents($localFileName, $imageContent);

echo "התמונה נשמרה בהצלחה בקובץ: $localFileName";
?>
