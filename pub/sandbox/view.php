<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$db = new mysqli('localhost', 'root', '', 'post');
$q = "SELECT * FROM post ORDER BY timestamp DESC";
$result = $db->query($q);
while($row = $result->fetch_assoc()){
    $hash = $row['FileName'];
    $url = "img/" . $hash . ".webp";
    echo "<img src=\"$url\">";
}
?>
</body>
</html>