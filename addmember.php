<?php

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
$adi = $_POST['ad'];
$soyadi = $_POST['soyad'];
$yil = $_POST['yil'];
$cinsiyet = $_POST['cinsiyet'];
$admin = 0;

if(!$eposta || !$sifre || !$adi || !$soyadi || !$yil || !$cinsiyet){
    die("please");
}

try{
    $ekle = $conn->prepare("INSERT INTO members SET name = ?, surname = ?, mail = ? ,password = ?, birthyear = ?, gender = ?, admin = ?");
    $ekle->execute([$adi,$soyadi,$eposta,$sifre,$yil,$cinsiyet,$admin]);
}
catch(PDOException $e){
    echo "Connection Failed".$e->getMessage();
}

if($ekle) {
    echo "Üye eklendi. 2 saniye sonra yönlendirileceksiniz.";
    header( "refresh:2;url=members.php" );
}else {
    echo "Bir hata oluştu, 10 saniye sonra yönlendirileceksiniz.";
    header( "refresh:10;url=members.php" );
}
?>