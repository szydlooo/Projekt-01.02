<?php
require_once('./../src/config.php');
session_start();

use Steampixel\Route;
Route::add('/', function() {
    //strona wyświetlająca obrazki
    global $twig;
    //pobierz 10 najnowszych postów
    $postArray = Post::getPage();
    $twigData = array("postArray" => $postArray,
                        "pageTitle" => "Strona główna");
                        if(isset($_SESSION['user']))
                        $twigData['user'] = $_SESSION['user'];
                    $twig->display("index.html.twig", $twigData);
                });

Route::add('/upload', function() {
    //strona z formularzem do wgrywania obrazków
    global $twig;
    $twigData = array("pageTitle" => "Wgraj mema");
    //jeśli użytkownik jest zalogowany to przekaż go do twiga
    if(isset($_SESSION['user']))
        $twigData['user'] = $_SESSION['user'];
    $twig->display("upload.html.twig", $twigData);
});
Route::add('/upload', function() {
    global $twig;
    if(isset($_POST['submit']))  {
        Post::upload($_FILES['uploadedFile']['tmp_name'], $_POST['title'], $_POST['userId']);
    }
    //TODO: zmienić na ścieżkę względną
    header("Location: http://localhost/zadanie0102/pub");
}, 'post');
Route::add('/register', function() {
    global $twig;
    $twigData = array("pageTitle" => "Zarejestruj użytkownika");
    $twig->display("register.html.twig", $twigData);
});

Route::add('/register', function(){
    global $twig;
    if(isset($_POST['submit'])) {
        User::register($_POST['email'], $_POST['password']);
        header("Location: http://localhost/zadanie0102/pub");
    }
}, 'post');

Route::add('/login', function(){
    global $twig;
    $twigData = array("pageTitle" => "Zaloguj użytkownika");
    $twig->display("login.html.twig", $twigData);
});

Route::add('/login', function() {
    global $twig;
    if(isset($_POST['submit'])) {
        User::login($_POST['email'], $_POST['password']);
    }
    header("Location: http://localhost/zadanie0102/pub");

}, 'post');
Route::run('/zadanie0102/pub');
?>
