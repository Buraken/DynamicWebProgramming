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
    
    $sifre = $_POST['password'];
    $adi = $_POST['ad'];
    $soyadi = $_POST['soyad'];
    $yil = $_POST['yil'];
    $cinsiyet = $_POST['cinsiyet'];

    if(!$sifre){
        $sifre = $_SESSION['user']['password'];
    }
    if(!$adi){
        $adi = $_SESSION['user']['name'];
    }
    if(!$soyadi){
        $soyadi = $_SESSION['user']['surname'];
    }
    if(!$yil){
        $yil = $_SESSION['user']['birthyear'];
    }
    if(!$cinsiyet){
        $cinsiyet = $_SESSION['user']['gender'];
    }

    $edit = $conn->prepare("UPDATE members SET name = ?, surname = ?,password = ?, birthyear = ?, gender = ?, admin = ? WHERE id= ?");
    $edit->execute([$adi,$soyadi,$sifre,$yil,$cinsiyet,$_SESSION['user']['admin'],$_SESSION['user']['id']]);

    if ($edit) {
        echo "Record updated successfully";
        $user = $conn->query("SELECT * FROM members WHERE id = {$_SESSION['user']['id']}")->fetch();
        $_SESSION['user'] = $user;
        header("location:main.php");
        
    } else {
        echo "Error updating record: " . $conn->error;
    }
    
    

    
?>