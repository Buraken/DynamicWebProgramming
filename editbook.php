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
    $id = $_POST['id'];
    $kitapadi = $_POST['book_title'];
    $yazar = $_POST['author'];
    $yayinevi = $_POST['publisher'];
    $aciklama = $_POST['description'];
    $kategori = $_POST['category'];
    $fiyat = $_POST['price'];
    $resim = $_POST['picture'];

    if(!$kitapadi || !$yazar || !$yayinevi || !$aciklama || !$kategori || !$fiyat || !$resim){
        die("Lütfen bütün bilgileri giriniz...");
    }

    try{
        $query = "UPDATE books SET book_title= ?, author = ?, publisher = ?, description= ?, category= ?, price= ?, picture = ? WHERE id = ?";
        $edit = $conn->prepare($query);
        $edit->execute([$kitapadi,$yazar,$yayinevi,$aciklama,$kategori,$fiyat,$resim,$id]);
        
         
    }
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
    if($edit) {
        echo "Güncellediniz. 2 saniye sonra yönlendirileceksiniz.";
        header( "refresh:2;url=admin.php" );
    }else {
        echo "Bir hata oluştu, 10 saniye sonra yönlendirileceksiniz.";
        header( "refresh:10;url=admin.php" );
    }
?>