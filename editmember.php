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
    $adi = $_POST['name'];
    $soyadi = $_POST['surname'];
    $mail = $_POST['mail'];
    $yil = $_POST['birthyear'];
    $cinsiyet = $_POST['gender'];

    if(!$adi || !$soyadi || !$mail || !$yil || !$cinsiyet || !$id){
        die("Lütfen bütün bilgileri giriniz...");
    }

    try{
        $query = "UPDATE members SET name= ?, surname = ?, mail = ?, birthyear= ?, gender= ? WHERE id = ?";
        $edit = $conn->prepare($query);
        $edit->execute([$adi,$soyadi,$mail,$yil,$cinsiyet,$id]);
        
         
    }
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
    if($edit) {
        echo "Güncellediniz. 2 saniye sonra yönlendirileceksiniz.";
        header( "refresh:2;url=members.php" );
    }else {
        echo "Bir hata oluştu, 10 saniye sonra yönlendirileceksiniz.";
        header( "refresh:10;url=members.php" );
    }
?>