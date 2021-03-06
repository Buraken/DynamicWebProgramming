<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "book_website";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE $dbname";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}

$conn->close();

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE books (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `book_title` varchar(255) NOT NULL,
    `author` varchar(255) NOT NULL,
    `description` varchar(255) NOT NULL,
    `category` varchar(255) NOT NULL,
    `price` float NOT NULL,
    `picture` varchar(255) NOT NULL,
    `can_delete` tinyint(1) NOT NULL DEFAULT 1,
    `publisher` varchar(255) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($conn->query($sql) === TRUE) {
  echo "Table MyGuests created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

$sql = "CREATE TABLE `members` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` varchar(255) NOT NULL,
    `surname` varchar(255) NOT NULL,
    `mail` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `birthyear` int(4) NOT NULL,
    `gender` varchar(255) NOT NULL,
    `admin` tinyint(1) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($conn->query($sql) === TRUE) {
    echo "Table MyGuests created successfully";
  } else {
    echo "Error creating table: " . $conn->error;
  }

$sql = "CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($conn->query($sql) === TRUE) {
  echo "Table MyGuests created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

$sql = "CREATE TABLE `order_info` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id` int(11) NOT NULL,
  `order_status` int(11) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($conn->query($sql) === TRUE) {
  echo "Table MyGuests created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

  $sql = "INSERT INTO `books` (`id`, `book_title`, `author`, `description`, `category`, `price`, `picture`, `can_delete`, `publisher`) VALUES
  (5, 'Hamlet', 'William Shakespeare', 'William Shakespeare (1564-1616): Oyunlar?? ve ??iirlerinde insanl??k durumlar??n?? dile getiri?? g??c??yle yakla????k 400 y??ld??r b??t??n d??nya okur ve seyircilerini etkilemeyi s??rd??ren efsanevi yazar, Hamlet???de a??k, akrabal??k ve iktidar ili??kileri ile intikam arzusun', 'Trajedi', 12, 'hamlet.jpeg', 1, 'T??rkiye ???? Bankas?? K??lt??r Yay??nlar??'),
  (6, '??izgili Pijamal?? ??ocuk', 'John Boyne', 'Bu kitab?? okumaya ba??lad??????n??zda, kendinizi Bruno ad??nda dokuz ya????nda bir ??ocukla yolculu??a ????km???? bulacaks??n??z (ama bu kitap dokuz ya????ndakiler i??in de??il, her ya?? grubunun okumas?? gereken bir kitap). Ve er ge?? kendinizi Bruno ile birlikte bir tel ??rg??d', 'Tarihi Drama', 30, 'cizgili-pijamali-cocuk.jpeg', 1, 'Tudem Yay??nlar??'),
  (7, 'Kuyucakl?? Yusuf', 'Sabahattin Ali', '??lk Bas??m?? 1937 y??l??nda ???Yeni Kitap??????? taraf??ndan bas??lan roman, Sabahattin Ali???nin roman t??r??nde ilk eseridir. ??yk?? yazar?? olan Ali???nin bu eseri MEB Orta????retim 100 Temel Eser Listesinde yer almaktad??r.  YKY taraf??ndan ilk olarak 1999 y??l??nda bas??lan rom', 'Roman', 9, 'kuyucakli-yusuf.jpeg', 1, 'Yap?? Kredi Yay??nlar??'),
  (8, 'S??r??a K????k', 'Sabahattin Ali', '1947 y??l??nda yay??mlanan Sabahattin Ali???nin birka?? k??sa ??yk??s??nden ve ???b??y??klere masallar??? ??eklinde tabir edilebilecek masallar??ndan olu??an S??r??a K????k, d??nemin devlet y??netimine ve d??zenine ele??tirel bir bak???? sunmaktad??r. Kitap, bir d??nem yasakl?? kitaplar', '??yk??', 8, 'sirca-kosk.jpeg', 1, 'Yap?? Kredi Yay??nlar??'),
  (9, 'K??z??l', 'Stefan Zweig', 'Zweig gen??lik d??nemi yap??tlar??ndan K??z??l???da ????renim i??in Viyana???ya giden gen?? bir t??p ????rencisinin b??y??k kentin ger??ekli??ine uyum sa??lama ve yeti??kinli??e ad??m atma s??recini anlat??r. Kendini birdenbire ailesinden uzakta so??uk bir odada yapyaln??z bulan bu ???', 'Roman', 7.1, 'kizil.jpeg', 1, 'T??rkiye ???? Bankas?? K??lt??r Yay??nlar??'),
  (10, 'Mecburiyet', 'Stefan Zweig', 'Sava?? kar????t?? g??r????leriyle tan??nan Zweig I. D??nya Sava???? boyunca bu g??r????lerini yaymay?? kendine misyon edinmi??ti. Avrupal?? ve ???d??nya vatanda??????? kimli??ine b??y??k de??er veren yazar, yap??tlar??nda sava????n y??k??ma u??ratt?????? ???eski d??nya???n??n de??erlerinin kaybolu??u', 'Tarihi Kurgu', 6, 'mecburiyet.jpeg', 1, 'T??rkiye ???? Bankas?? K??lt??r Yay??nlar??'),
  (11, 'Sefiller Cilt:1', 'Victor Hugo', 'Hugo, Sefiller adl?? dev roman??n??n ??ns??z??n?? ????yle bitirir: \"Yery??z??nde yoksulluk ve bilgisizli??in egemenli??i s??rd??k??e, b??ylesi kitaplar gereksiz say??lmayabilir.\" Yurdunun ????karlar?? ad??na siyasal kavgalardan hi?? ??ekinmedi. Bu y??zden de tam yirmi y??l s??rg??nd', 'Epik', 24.07, 'sefiller1.jpeg', 1, 'T??rkiye ???? Bankas?? K??lt??r Yay??nlar??'),
  (12, 'Alt??nc?? Ko??u??', 'Anton Pavlovi?? ??ehov', '??ehov bir ta??ra kasabas??ndaki ak??l hastanesinde ge??en bu novellas??nda, e??itimli bir hasta olan ??van Dmitri?? ile Doktor Andrey Yefim???? aras??ndaki felsefi ??at????maya odaklan??r. ??van Dmitri?? maruz kald??klar?? adaletsizli??e, i??inde ya??amaya zorland??klar?? berbat', 'Kurgu', 7, 'altinci-kogus.jpeg', 1, 'T??rkiye ???? Bankas?? K??lt??r Yay??nlar??'),
  (13, 'Othello', 'William Shakespeare', 'Shakespeare, Othello???da her ??a??da ge??erli olan trajik bir durumu, saf d??r??stl??????n, yalan ve d??zen d??nyas??na yenili??ini, yazg??lar??n birbirinden ayr??l??p birbiriyle kar????la??t?????? labirentler i??inde aktar??r.', 'Trajedi', 13, 'othello.jpeg', 1, 'T??rkiye ???? Bankas?? K??lt??r Yay??nlar??'),
  (14, 'Su?? ve Ceza', 'Fyodor Dostoyevski', ' \"Eski\" ????renci Raskolnikov, \"kirac??dan\" kiralad?????? darac??k odas??nda be?? paras??z g??nler ge??irmektedir. Modern zamanlar??n, ??a??da?? bilimin ve edebiyat??n bu yarat??c??, ak??ll?? genci, toplumun gerici bir canavara d??n????m???? karanl??k avucunda ezilip un ufak m?? ola', 'Psikolojik Kurgu', 20, 'suc-ve-ceza.jpeg', 1, 'T??rkiye ???? Bankas?? K??lt??r Yay??nlar??');";
  
  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $sql = "INSERT INTO `members` (`id`, `name`, `surname`, `mail`, `password`, `birthyear`, `gender`, `admin`) VALUES
  (1, 'Ali Hasan', 'Albay', 'a@hotmail.com', '1234', 1999, 'Erkek', 0),
  (2, 'Burak', 'Eken', 'burakeken@hotmail.com', '12345', 1996, 'Erkek', 1),
  (7, 'admin', 'admin', 'admin', 'admin', 2019, 'Erkek', 1),
  (10, 'Esra', 'Ay', 'esra', '12345', 1999, 'Kad??n', 0);";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
  header( "refresh:2;url=main.php" );
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
  header( "refresh:2;url=main.php" );
}


?>