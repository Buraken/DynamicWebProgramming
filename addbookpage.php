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


?>
<html>
    <head>
    <style>
        body{
            background-color: #DDEFEF;
        }
        .form-container {
	        width: 500px;
	        height: 505px;
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
        .add-box {
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
                <form action="addBook.php" method="POST" >
                    <label>Kitap Adı:</label>  <input class="add-box" type="text" name="kitapadi">
                    <label>Yazar:</label>  <input class="add-box" type="text" name="yazar">
                    <label>Yayınevi:</label>  <input class="add-box" type="text" name="yayinevi">
                    <label>Açıklama:</label>  <input class="add-box" type="text" name="aciklama">
                    <label>Kategori:</label>  <input class="add-box" type="text" name="kategori">
                    <label>Fiyat:</label>  <input class="add-box" type="text" name="fiyat">
                    <label>Resim:</label>  <input class="add-box" type="text" name="resim">
                    <input id="edit" type="submit" name="kitapekle" value="Kitap Ekle">
                </form>
            </div>
            <div class="cancel-container"><button id="cancel" type="button" onclick="location.href = 'admin.php';">İptal</button></div>
        </div>
    </body>
</html>