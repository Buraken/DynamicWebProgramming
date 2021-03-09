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

$kitapadi = $_POST['kitapadi'];
$yazar = $_POST['yazar'];
$yayinevi = $_POST['yayinevi'];
$aciklama = $_POST['aciklama'];
$kategori = $_POST['kategori'];
$fiyat = $_POST['fiyat'];
$resim = $_POST['resim'];

if(!$kitapadi || !$yazar || !$yayinevi || !$aciklama || !$kategori || !$fiyat || !$resim){
    die("please");
}

try{
    $ekle = $conn->prepare("INSERT INTO books SET book_title = ?, author = ?, description = ? ,category = ?, price = ?, picture = ?, publisher = ?");
    $ekle->execute([$kitapadi,$yazar,$aciklama,$kategori,$fiyat,$resim,$yayinevi]);
}
catch(PDOException $e){
    echo "Connection Failed".$e->getMessage();
}

if($ekle) {
    echo "Kitap eklendi. 2 saniye sonra yönlendirileceksiniz.";
    header( "refresh:2;url=admin.php" );
}else {
    echo "Bir hata oluştu, 10 saniye sonra yönlendirileceksiniz.";
    header( "refresh:10;url=admin.php" );
}
?>