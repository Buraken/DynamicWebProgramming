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

        $query = "SELECT * FROM members WHERE id = ?";
        $edit = $conn->prepare( $query );
        $edit->execute([$id]);

        $row = $edit->fetch(PDO::FETCH_ASSOC);

        $adi = $row['name'];
        $soyadi = $row['surname'];
        $mail = $row['mail'];
        $yil = $row['birthyear'];
        $cinsiyet = $row['gender'];
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
	        height: 450px;
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
    <form action="editmember.php" method="POST" >
        <label>Ad??:</label>  <input class="login-box" type="text" name="name" placeholder="<?php echo $adi;?>">
        <label>Soyad??:</label>  <input class="login-box" type="text" name="surname" placeholder="<?php echo $soyadi;?>">
        <label>Mail:</label>  <input class="login-box" type="text" name="mail" placeholder="<?php echo $mail;?>">
        <label>Do??um Y??l??:</label>  <input class="login-box" type="text" name="birthyear" placeholder="<?php echo $yil;?>">
        <label>Cinsiyet:</label>  <input class="login-box" type="text" name="gender" placeholder="<?php echo $cinsiyet;?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" id="edit" name="edit" value="G??ncelle">
    </form>
    </div>
        <div class="cancel-container"><button id="cancel" type="button" onclick="location.href = 'members.php';">??ptal</button></div>
    </div>
    
</body>

</html>