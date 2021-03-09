<?php
    session_start();
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "book_website";

    // Create connection
    try{
        $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "Connection Failed".$e->getMessage();
    }
    $bookids = $_POST['book_cart_ds'];
    $bookids = explode(',', $bookids);

    $bookquantities = $_POST['book-cart-quantity'];
    $bookquantities = explode(',', $bookquantities);


    $fiyat = $_POST['book_cart_total'];
    $adres = $_POST['address-area'];
    $odeme = $_POST['odeme-sekli'];
    $durum = 1;
    $id = $_SESSION['user']['id'];

    if(!$id || !$durum || !$odeme || !$adres || !$fiyat){
        die("Lütfen bütün bilgileri doldurunuz...");
    }

    try{
        $ekle = $conn->prepare("INSERT INTO order_info SET id = ?, order_status = ?, payment_type = ? ,address = ?, price = ?");
        $ekle->execute([$id,$durum,$odeme,$adres,$fiyat]);
    }
    catch(PDOException $e){
        echo "Connection Failed".$e->getMessage();
    }

    try{
        $orderid = $conn->prepare("SELECT order_id FROM order_info ORDER BY order_id DESC LIMIT 1");
        $orderid->execute();
        $result = $orderid->fetchAll(PDO::FETCH_ASSOC);
        $ekle2 = $conn->prepare("INSERT INTO orders SET product_id = ?, order_id = ?, quantity = ?");

        for($i = 0; $i < sizeof($bookids); $i++){
            $ekle2->execute([$bookids[$i],$result[0]['order_id'],$bookquantities[$i]]);
        }
    }
    catch(PDOException $e){
        echo "Connection Failed".$e->getMessage();
    }

    if($ekle) {
        echo "Siparişiniz alındı. 2 saniye sonra yönlendirileceksiniz.";
        header( "refresh:2;url=main.php" );
    }else {
        echo "Bir hata oluştu, 10 saniye sonra yönlendirileceksiniz.";
        header( "refresh:10;url=main.php" );
    }

?>

