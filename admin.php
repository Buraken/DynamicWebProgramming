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

$sql = "SELECT * FROM books";
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
            <th colspan="9"><h2>Admin Paneli</h2></th>
        </tr>
        <tr>
            <th colspan="2"><button id="book-add" type="button" onclick="location.href = 'main.php';">Geri Dön</button></th>
            <th colspan="2"><button id="book-add" type="button" onclick="location.href = 'members.php';">Üyeleri Görüntüle</button></th>
            <th colspan="2"><button id="book-add" type="button" onclick="location.href = 'searchpage.php';">Arama Paneli</button></th>
            <th colspan="2"><button id="book-add" type="button" onclick="location.href = 'orders.php';">Sipariş Paneli</button></th>
            <th colspan="1"></th>
        </tr>
        <tr>
            <th>Id</th>
            <th>Book Title</th>
            <th>Author</th>
            <th>Publisher</th>
            <th>Description</th>
            <th>Category</th>
            <th>Price</th>
            <th>Picture</th>
            <th><button id="book-add" type="button" onclick="location.href = 'addbookpage.php';">Kitap Ekle</button></th>
        </tr>
        <?php
            foreach($result as $key => $row) {
                echo '<tr>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$row['book_title'].'</td>';
                echo '<td>'.$row['author'].'</td>';
                echo '<td>'.$row['publisher'].'</td>';
                echo '<td>'.$row['description'].'</td>';
                echo '<td>'.$row['category'].'</td>';
                echo '<td>'.$row['price'].'</td>';
                echo '<td><div class="book-picture-xs-container"><img src="'.$row['picture'].'" /></div></td>';
                echo '<td><button id="book-edit" onclick="window.location.href = `editbookpage.php?id='.$row['id'].'`";">Edit</button>
                     <button id="book-delete" onclick="window.location.href = `deletebook.php?id='.$row['id'].'`";">Delete</button></td>';
                echo '</tr>';

            }
        
        ?>
    </table>
</div>
</body>
</html>
