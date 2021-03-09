<?php

session_start();
$userid = isset($_GET['userid']) ? $_GET['userid'] : die('ERROR: Record ID not found.');
if(!isset($_SESSION['user'])) {
    header( "refresh:0;url=main.php" );
    die;
} else {
    if($_SESSION['user']['admin'] == 1){

    } else if($_SESSION['user']['id'] == $userid)
    {
        
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

$orderid = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

$sql = "SELECT * FROM orders WHERE order_id = $orderid ";
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
            <th colspan="9"><h2>Sipariş Detayı</h2></th>
        </tr>
        <tr>
            <th colspan="9"><button id="book-add" type="button" onclick="location.href = 'orders.php';">Geri Dön</button></th>
        </tr>
        <tr>
            <th>Id</th>
            <th>Book Title</th>
            <th>Author</th>
            <th>Publisher</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Picture</th>
        </tr>
        <?php
            foreach($result as $key => $row) {
                $sql = "SELECT * FROM books WHERE id = {$row['product_id']}";
                $stmt = $conn->query($sql);

                $result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($result2 as $key2 => $row2) {


                    echo '<tr>';
                    echo '<td>'.$row2['id'].'</td>';
                    echo '<td>'.$row2['book_title'].'</td>';
                    echo '<td>'.$row2['author'].'</td>';
                    echo '<td>'.$row2['publisher'].'</td>';
                    echo '<td>'.$row['quantity'].'</td>';
                    echo '<td>'.$row2['price'].'</td>';
                    echo '<td><div class="book-picture-xs-container"><img src="'.$row2['picture'].'" /></div></td>';
                    echo '</tr>';

                }

            }
        
        ?>
    </table>
</div>
</body>
</html>
