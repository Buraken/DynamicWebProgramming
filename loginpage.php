<?php
    session_start();
    if(isset($_SESSION['user'])) {
        header( "refresh:0;url=main.php" );
        die;
    } 
?>
<html>
    <head>

    <style>

        body {
            background-color: #DDEFEF;
        }

        .form-container {
	        width: 500px;
	        height: 206px;
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

        #login {
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

        #login:hover {
            background: #DDEFEF;
        }

        .sign-in-container {
            max-width: 420px;
            position: absolute;
	        left: 0;
            right: 0;
            margin:auto;
        }

        .back-container {
            max-width: 420px;
            position: absolute;
	        left: 0;
            right: 0;
            margin:auto;
            margin-top: 40px;
        }

        #sign-in {
            font-family: 'Montserrat', Arial, Helvetica, sans-serif;
            width: 100%;
            background:#e6e600;
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

        #sign-in:hover {
            background: #ffff99 ;
        }

        #back {
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

        #back:hover {
            background: #ff8080 ;
        }
    </style>
    </head>
    <body>
        <div class="form-container">
            <div>
                <form action="login.php" method="POST" >
                    <label>E-posta:</label>  <input class="login-box" type="text" name="eposta">
                    <label>Şifreniz:</label>  <input class="login-box" type="password" name="password">
                    <input type="submit" id="login" name="giris" value="Giriş Yap">
                </form>
            </div>
            <div class="sign-in-container"><button id="sign-in" onclick="window.location.href = 'registerpage.php'">Kayıt Ol</button></div>
            <div class="back-container"><button id="back" onclick="window.location.href = 'main.php'">Siteye Geri Dön</button></div>
        </div>
    </body>
</html>