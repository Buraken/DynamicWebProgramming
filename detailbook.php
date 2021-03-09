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
            font: normal 18px Arial, sans-serif;
         }
    </style>
</head>
<body>
    <div class="form-container">
    <form action="?" method="POST" >
        Kitap Adı:  <label><?php echo $kitapadi;?></label>
        Yazar:  <label><?php echo $yazar;?></label></p>
        Yayın Evi:  <label><?php echo $yayinevi;?></label>
        Açıklama:  <label><?php echo $aciklama;?></label>
        Kategori:  <label><?php echo $kategori;?></label>
        Fiyat:  <label><?php echo $fiyat;?> tl</label>
        Resim:  <label><?php echo $resim;?></label>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
    </form>
    <button type="button" onclick="location.href = 'admin.php';">Geri Dön</button>
    </div>
</body>

</html>