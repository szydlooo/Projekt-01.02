<?php
class Post {
    private int $ID;
    private string $filename;
    private string $timestamp;
    
    function __construct(int $i, string $f, string $t)
    {
        $this->ID = $i;
        $this->filename = $f;
        $this->timestamp = $t;
    }

    static function getLast() : Post {
        global $db;
        $query = $db -> prepare("SELECT * FROM post ORDER BY timestamp DESC LIMIT 1");
        $query -> execute();
        $result  = $query -> get_result();
        $row = $result -> fetch_assoc();
        $p = new Post($row['ID'], $row['FileName'], $row['TimeStamp']);
        return $p;
    }

    static function upload(string $tempFileName) {
        $targetDir = "img/";
        $imgInfo = getimagesize($tempFileName);
        if(!is_array($imgInfo)) {
            die("BŁĄD: Przekazany plik nie jest obrazem!");
        }
        $randomNumber = rand(10000, 99999) . hrtime(true);
        $hash = hash("sha256", $randomNumber);
        $newFileName = $targetDir . $hash . ".webp";
        if(file_exists($newFileName)) {
            die("BŁĄD: Podany plik już istnieje!");
        }
        $imageString = file_get_contents($tempFileName);
    }
}

?>