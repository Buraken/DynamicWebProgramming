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
    $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

    try{
        $query = "DELETE FROM books WHERE id = ?";
        $delete = $conn->prepare($query);
        $delete->execute([$id]); 
    }
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
    if($delete) {
        echo "Sildiniz. 2 saniye sonra yönlendirileceksiniz.";
        header( "refresh:2;url=admin.php" );
    }else {
        echo "Bir hata oluştu, 10 saniye sonra yönlendirileceksiniz.";
        header( "refresh:10;url=admin.php" );
    }
?>