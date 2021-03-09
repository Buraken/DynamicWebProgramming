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

$sql = "SELECT * FROM members";
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
            <th colspan="9"><h2>Üye Paneli</h2></th>
        </tr>
        <tr>
            <th colspan="2"><button id="book-add" type="button" onclick="location.href = 'main.php';">Geri Dön</button></th>
            <th colspan="2"><button id="book-add" type="button" onclick="location.href = 'admin.php';">Kitapları Görüntüle</button></th>
            <th colspan="4"></th>
        </tr>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Mail</th>
            <th>Birth Year</th>
            <th>Gender</th>
            <th>Admin</th>
            <th><button id="book-add" type="button" onclick="location.href = 'addmemberpage.php';">Üye Ekle</button></th>
        </tr>
        <?php
            foreach($result as $key => $row) {
                echo '<tr>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$row['name'].'</td>';
                echo '<td>'.$row['surname'].'</td>';
                echo '<td>'.$row['mail'].'</td>';
                echo '<td>'.$row['birthyear'].'</td>';
                echo '<td>'.$row['gender'].'</td>';
                echo '<td>'.$row['admin'].'</td>';
                echo '<td><button id="book-edit" onclick="window.location.href = `editmemberpage.php?id='.$row['id'].'`";">Edit</button>
                     <button id="book-delete" onclick="window.location.href = `deletemember.php?id='.$row['id'].'`";">Delete</button> ';
                if($row['admin'] == 0){
                    echo '<button id="make-admin" onclick="window.location.href = `makeadmin.php?id='.$row['id'].'`";">Make Admin</button>';
                } else {
                    echo '<button id="make-admin" onclick="window.location.href = `takebackadmin.php?id='.$row['id'].'`";">Take Back Admin</button>';
                }
                echo '</td></tr>';

            }
        
        ?>
    </table>
</div>
</body>
</html>