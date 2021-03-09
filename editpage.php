<?php

    session_start();
    if(!isset($_SESSION['user'])) {
        header( "refresh:0;url=main.php" );
        die;
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
	        height: 376px;
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
                <form action="edit.php" method="POST" >
                    <label>Şifre:</label>  <input class="login-box" type="password" name="password">
                    <label>Adı:</label>  <input class="login-box" type="text" name="ad" placeholder="<?php echo $_SESSION['user']['name'];?>">
                    <label>Soyadı:</label>  <input class="login-box" type="text" name="soyad" placeholder="<?php echo $_SESSION['user']['surname'];?>">
                    <label>Doğum Yılı:</label>  <input class="login-box" type="text" name="yil" placeholder="<?php echo $_SESSION['user']['birthyear'];?>">
                    <label>Cinsiyet:</label>
                    <input type="radio" id="male" name="cinsiyet" value="Erkek">
                    <label for="male">Erkek</label>
                    <input type="radio" id="female" name="cinsiyet" value="Kadın">
                    <label for="female">Kadın</label>
                    <br>
                    <br>
                    <input id="edit" type="submit" name="edit" value="Bilgileri Değiştir">
                </form>
            </div>
            <div class="cancel-container"><button id="cancel" type="button" onclick="location.href = 'main.php';">Siteye Geri Dön</button></div>
        </div>
    </body>

</html>




