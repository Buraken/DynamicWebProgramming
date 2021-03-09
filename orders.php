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

// Create connection
try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "Connection Failed".$e->getMessage();
}

$sql = "SELECT * FROM order_info";
$stmt = $conn->query($sql);

$result = $stmt->fetchAll(PDO::FETCH_ASSOC); // returns all rows

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="adminstyle.css">
</head>

<body>
<div class="table-users">
    <table class="books-table">
        <tr>
            <th colspan="9"><h2>Sipariş Paneli</h2></th>
        </tr>
        <tr>
            <th colspan="2"><button id="book-add" type="button" onclick="location.href = 'main.php';">Geri Dön</button></th>
            <th colspan="2"><button id="book-add" type="button" onclick="location.href = 'admin.php';">Kitapları Görüntüle</button></th>
            <th colspan="4"></th>
        </tr>
        <tr>
            <th>Order Id</th>
            <th>User Id</th>
            <th>Order Status</th>
            <th>Payment Type</th>
            <th>Adress</th>
            <th>Price</th>
            <th></th>
        </tr>
        <?php
            foreach($result as $key => $row) {

                
                if($row['order_status'] == 1){
                    $orderStatus = "Siperiş İletildi";
                } else if($row['order_status'] == 2) {
                    $orderStatus = "Siperiş Kabul Edildi";
                } else if($row['order_status'] == 3) {
                    $orderStatus = "Siperiş Tamamlandı";
                } else {
                    $orderStatus = "Siperiş İptal Edildi";
                }
                echo '<tr>';
                echo '<td>'.$row['order_id'].'</td>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$orderStatus.'</td>';
                echo '<td>'.$row['payment_type'].'</td>';
                echo '<td>'.$row['address'].'</td>';
                echo '<td>'.$row['price'].'</td>';
                echo '<td>';
                echo '<button id="book-edit" onclick="window.location.href = `orderdetails.php?id='.$row['order_id'].'&userid='.$row['id'].'`";">Sipariş Detayı</button>';
                
                echo '</td></tr>';

            }
        
        ?>
    </table>
</div>
</body>
</html>