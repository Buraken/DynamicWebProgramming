<?php

    session_start();
    if(!isset($_SESSION['user'])) {
        header( "refresh:0;url=main.php" );
        die;
    } else {
        if($_SESSION['user']['admin'] == 1){

        }
        else{
            header( "refresh:0;url=main.php" );
            die;
        }
    }

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

    try {
        $admin = 0;
        $query = "UPDATE members SET admin= ? WHERE id = ?";
        $edit = $conn->prepare( $query );
        $edit->execute([$admin,$id]);
    }
     
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }

    if($edit) {
        echo "Adminlik Geri Alındı. 2 saniye sonra yönlendirileceksiniz.";
        header( "refresh:2;url=members.php" );
    }else {
        echo "Bir hata oluştu, 10 saniye sonra yönlendirileceksiniz.";
        header( "refresh:10;url=members.php" );
    }
?>