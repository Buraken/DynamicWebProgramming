<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "book_website";

try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "Connection Failed".$e->getMessage();
}

$eposta = $_POST['eposta'];
$sifre = $_POST['password'];

if(!$eposta || !$sifre){
    die("Lütfen emailinizi ve şifrenizi giriniz...");
}

$user = $conn->query("SELECT * FROM members WHERE mail = '$eposta'  AND password = '$sifre'")->fetch();


if($user) {
    $_SESSION['user'] = $user;
    header("location:main.php");
}else {
    echo "Bir hata oluştu";
    header("location:loginpage.php");
}

?>