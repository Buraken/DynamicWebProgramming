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

        $query = "SELECT * FROM books WHERE id = ?";
        $edit = $conn->prepare( $query );
        $edit->execute([$id]);

        $row = $edit->fetch(PDO::FETCH_ASSOC);

        $kitapadi = $row['book_title'];
        $yazar = $row['author'];
        $yayinevi = $row['publisher'];
        $aciklama = $row['description'];
        $kategori = $row['category'];
        $fiyat = $row['price'];
        $resim = $row['picture'];
    }
     
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
?>

<html>
<head>
<style>
        body{
            background-color: #DDEFEF;
        }
        .form-container {
	        width: 500px;
	        height: 500px;
	        background-color: white;
	
	        position: absolute;
	        top:0;
	        bottom: 0;
	        left: 0;
	        right: 0;
  	
            margin: auto;
        }
        form { 
            max-width:420px; 
            margin:50px auto;
            margin-bottom: 13px;
            font: normal 18px Arial, sans-serif;
         }
        .login-box {
            color:black;
            font-family: Helvetica, Arial, sans-serif;
            /*font-weight:500;*/
            font-size: 15px;
            border-radius: 5px;
            line-height: 18px;
            background-color: transparent;
            border:2px solid #336B6B;
            /*transition: all 0.3s;*/
            padding: 10px;
            margin-bottom: 18px;
            width:75%;
            box-sizing: border-box;
            outline:0;
        }
        form label {
            color: #336B6B;
            width:80px;
            display: inline-block;
        }
        #edit{
            font-family: 'Montserrat', Arial, Helvetica, sans-serif;
            width: 100%;
            background:#336B6B;
            border-radius:5px;
            border:0;
            cursor:pointer;
            color:white;
            font-size:18px;
            padding-top:5px;
            padding-bottom:5px;
            transition: all 0.3s;
            margin-top:-4px;
            font-weight:700;
        }
        #edit:hover{
            background: #DDEFEF ;
        }
        .cancel-container{
            max-width: 420px;
            position: absolute;
	        left: 0;
	        right: 0;
  	
            margin: auto;
        }
        #cancel{
            font-family: 'Montserrat', Arial, Helvetica, sans-serif;
            width: 100%;
            background:#990000;
            border-radius:5px;
            border:0;
            cursor:pointer;
            color:white;
            font-size:18px;
            padding-top:5px;
            padding-bottom:5px;
            transition: all 0.3s;
            margin-top:-4px;
            font-weight:700;
        }
        #cancel:hover{
            background: #ff8080 ;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div>
    <form action="editbook.php" method="POST" >
        <label>Kitap Adı:</label>  <input class="login-box" type="text" name="book_title" placeholder="<?php echo $kitapadi;?>">
        <label>Yazar:</label>  <input class="login-box" type="text" name="author" placeholder="<?php echo $yazar;?>">
        <label> Yayın Evi:</label>  <input class="login-box" type="text" name="publisher" placeholder="<?php echo $yayinevi;?>">
        <label>Açıklama:</label>  <input class="login-box" type="text" name="description" placeholder="<?php echo $aciklama;?>">
        <label>Kategori:</label>  <input class="login-box" type="text" name="category" placeholder="<?php echo $kategori;?>">
        <label>Fiyat:</label>  <input class="login-box" type="text" name="price" placeholder="<?php echo $fiyat;?>">
        <label>Resim:</label>  <input class="login-box" type="text" name="picture" placeholder="<?php echo $resim;?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" id="edit" name="edit" value="Güncelle">
    </form>
    </div>
        <div class="cancel-container"><button id="cancel" type="button" onclick="location.href = 'admin.php';">İptal</button></div>
    </div>
    
</body>

</html>