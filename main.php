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

    $sql = "SELECT * FROM books";
    $stmt = $conn->query($sql);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<html>
<head>
    <link rel="stylesheet" href="BurakEken150709017.css">
    
</head>
<script src="script.js"></script>
<body>
<div class="body">
    <div id="content">
        <div id="books">
            <div class="row">
                <?php
                    foreach($result as $key => $row) {
                        echo '<div class="card">';
                        echo '<div class="bookid" style="display: none;">'.$row['id'].'</div>';
                        echo '<div class="bookimage"><img src="'.$row['picture'].'" style="width:100%; height:%100;"></div>';
                        echo '<div class="bookname"><h2>'.$row['book_title'].'</h2></div>';
                        echo '<div class="authorname"><h3>'.$row['author'].'</h3></div>';
                        echo '<div><p class="price">'.$row['price'].' TL </p></div>';
                        echo '<div class="divbutton"><button class="addCart" type="button">Sepete Ekle</button></div>';
                        echo '</div>';
                    }
                ?>
            </div>

        </div>
        <div class="cart-template">
            <div style="text-align: center; "><h2>Sepetiniz</h2></p></div>
            <div><hr></div>
            <div class="headers">
            <div style="margin-left: 65px; float: left; min-width: 30px; "><b>Kitap</b></div>
            <div style="margin-left: 20px; float: left; min-width: 30px; "><b>Adet</b></div>
            <div style="margin-left: 20px; float: left; margin-block-end: 10px; "><b>Fiyat</b></div>
            <div><hr class="clear"></div>
            </div>
            <div class="basket"></div>
            <div><hr class="clear"></div>
            
            <div style="margin-left: 10px; float: left; min-width: 90px; float: left; "><b>Toplam Fiyat</b></div>
            <div class="cart-total"><label id="price" name="price">00.00</label></div>
            <div class="cart-purchase-button"><button class="purchase" type="button">Satın Al</button></div>
            <br>
            <form action="order.php" method="POST">
            <div class="purchase-area">
                <div><p>Adres:</p></div>
                <div><textarea class="address-area" id="address-area" name="address-area"></textarea></div>
                <div><input type="radio" id="havale" name="odeme-sekli" value="havale">
                    <label for="havale">Havale</label><br>
                    <input type="radio" id="kredi-karti" name="odeme-sekli" value="kredi-karti">
                    <label for="kredi-karti">Kredi Kartı</label><br>
                </div>
                <div style="display: none;"><input class="book_cart_total" type="text" name="book_cart_total" value=""></div>
                <div style="display: none;"><input class="book_cart_ds" type="text" name="book_cart_ds" value=""></div>
                <div style="display: none;"><input class="book-cart-quantity" type="text" name="book-cart-quantity" value=""></div>
                <div><div class="cart-purchase-button2"><input type="submit" class="purchase2" value="Satın Al"></div></div>
                
                </form>
            </div>

        </div>
         <div class="login-box">
            <?php 
                
                if(isset($_SESSION['user'])) {
                    echo "Hoşgeldin  {$_SESSION['user']['name']}"; 
                    echo '<form action="logout.php" method="post"><input id="button-login" type="submit" name="someAction" value="Çıkış" /></form>'; 
                    echo '<form action="editpage.php" method="post"><input id="button-edit" type="submit" name="someAction" value="Bilgileri Düzenle" /></form>';
                    echo '<form action="ordersofuser.php" method="post"><input id="button-edit" type="submit" name="someAction" value="Siparişlerim" /></form>';
                    if($_SESSION['user']['admin'] == 1){
                        echo '<div><button id="button-admin" onclick="window.location.href = `admin.php`">Admin Paneli</button></div>';
                    }
                } else {
                    echo '<form action="loginpage.php" method="post"><input id="button-login" type="submit" name="someAction" value="Giriş Yap" /></form>';
                }
                
            ?>
        </div>
    </div>
    <div class="footer"></div>
</div>
</body>
</html>



