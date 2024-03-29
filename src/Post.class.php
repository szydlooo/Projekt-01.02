<?php
class Post {
    private int $ID;
    private string $FileName;
    private string $TimeStamp;
    private string $Tytuł;
    private int $userId;
    private string $authorName;
    private int $likeCount;
    
    function __construct(int $i, string $f, string $t, string $Y, int $userId, $like)
    {
        $this->ID = $i;
        $this->FileName = $f;
        $this->TimeStamp = $t;
        $this->Tytuł =$Y;
        $this->userId = $userId;
        global $db;
        $this->authorName = User::getNameById($this->userId);
        $this->likeCount = $like;
    }
    public function getId() : int {
        return $this->ID;
    }
    public function getFilename() : string {
        return $this->FileName;
    }
    public function getTimestamp() : string {
        return $this->TimeStamp;
    }
    public function getTytuł() : string{
        return $this->Tytuł;
    }
    public function getAuthorName() : string {
        return $this->authorName;
    }
    public function getLikeCount() : int {
        return $this->likeCount;
    }

    //funkcja zwraca ostatnio dodany obrazek
    static function getLast() : Post {
        //odwołuję się do bazy danych
        global $db;
        //Przygotuj kwerendę do bazy danych
        $query = $db->prepare("SELECT * FROM post ORDER BY timestamp DESC LIMIT 1");
        //wykonaj kwerendę
        $query->execute();
        //pobierz wynik
        $result = $query->get_result();
        //przetwarzanie na tablicę asocjacyjną - bez pętli bo będzie tylko jeden
        $row = $result->fetch_assoc();
        //tworzenie obiektu
        $p = new Post($row['id'], $row['filename'], $row['timestamp'], $row['tytuł'], $row['userId'], $row['liked']);
        //zwracanie obiektu
        return $p; 
    }
    //funkcja zwraca jedna stronę obrazków
    static function getPage(int $pageNumber = 1, int $postsPerPage = 10) : array {
        //połączenie z bazą
        global $db;
        //kwerenda
        $query = $db->prepare("SELECT * FROM post WHERE removed = 0 ORDER BY timestamp DESC LIMIT ? OFFSET ?");
        //oblicz przesunięcie - numer strony * ilość zdjęć na stronie
        $offset = ($pageNumber-1)*$postsPerPage;
        //podstaw do kwerendy
        $query->bind_param('ii', $postsPerPage, $offset);
        //wywołaj kwerendę
        $query->execute();
        //odbierz wyniki
        $result = $query->get_result();
        //stwórz tablicę na obiekty
        $postsArray = array();
        //pobieraj wiersz po wierszu jako tablicę asocjacyjną indeksowaną nazwami kolumn z mysql
        while($row = $result->fetch_assoc()) {
            $post = new Post($row['ID'],$row['FileName'],$row['TimeStamp'],$row['Tytuł'], $row['userId'], $row['liked']);
            array_push($postsArray, $post);
        }
        return $postsArray;
    }
    static function upload(string $tempFileName, string $Tytuł, int $userId) {
        //deklarujemy folder do którego będą zaczytywane obrazy
        $targetDir = "img/";
        //sprawdź czy mamy do czynienia z obrazem
        $imgInfo = getimagesize($tempFileName);
        //jeżeli $imgInfo nie jest tablicą to nie jest to obraz
        if(!is_array($imgInfo)) {
            die("BŁĄD: Przekazany plik nie jest obrazem!");
        }
        //generujemy losową liczbę w formie
        //5 losowych cyfr + znacznik czasu z dokładnością do ms
        $randomNumber = rand(10000, 99999) . hrtime(true);
        //wygeneruj hash - nową nazwę pliku
        $hash = hash("sha256", $randomNumber);
        //tworzymy docelowy url pliku graficznego na serwerze
        $newFileName = $targetDir . $hash . ".webp";
        //sprawdź czy plik przypadkiem już nie istnieje
        if(file_exists($newFileName)) {
            die("BŁĄD: Podany plik już istnieje!");
        }
        //zaczytujemy cały obraz z folderu tymczasowego do stringa
        $imageString = file_get_contents($tempFileName);
        //generujemy obraz jako obiekt klasy GDImage
        //@ przed nazwa funkcji powoduje zignorowanie ostrzeżeń
        $gdImage = @imagecreatefromstring($imageString);
        //zapisujemy w formacie webp
        imagewebp($gdImage, $newFileName);
        //użyj globalnego połączenia
        global $db;
        //stwórz kwerendę
        $query = $db->prepare("INSERT INTO post VALUES(NULL, ?, ?, ?,?, 0,0)");
        //przygotuj znacznik czasu dla bazy danych
        $dbTimestamp = date("Y-m-d H:i:s");
        //zapisz dane do bazy
        $query->bind_param("sssi", $dbTimestamp, $newFileName, $Tytuł, $userId);
        if(!$query->execute())
            die("Błąd zapisu do bazy danych");
    }
    public static function remove($id) : bool {
        global $db;
        $query = $db->prepare("UPDATE post SET removed = 1 WHERE id = ?");
        $query->bind_param("i", $id);
        return $query->execute();
    }
}

?>
