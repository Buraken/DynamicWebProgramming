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
  (5, 'Hamlet', 'William Shakespeare', 'William Shakespeare (1564-1616): Oyunları ve şiirlerinde insanlık durumlarını dile getiriş gücüyle yaklaşık 400 yıldır bütün dünya okur ve seyircilerini etkilemeyi sürdüren efsanevi yazar, Hamlet’de aşk, akrabalık ve iktidar ilişkileri ile intikam arzusun', 'Trajedi', 12, 'hamlet.jpeg', 1, 'Türkiye İş Bankası Kültür Yayınları'),
  (6, 'Çizgili Pijamalı Çocuk', 'John Boyne', 'Bu kitabı okumaya başladığınızda, kendinizi Bruno adında dokuz yaşında bir çocukla yolculuğa çıkmış bulacaksınız (ama bu kitap dokuz yaşındakiler için değil, her yaş grubunun okuması gereken bir kitap). Ve er geç kendinizi Bruno ile birlikte bir tel örgüd', 'Tarihi Drama', 30, 'cizgili-pijamali-cocuk.jpeg', 1, 'Tudem Yayınları'),
  (7, 'Kuyucaklı Yusuf', 'Sabahattin Ali', 'İlk Basımı 1937 yılında “Yeni Kitapçı” tarafından basılan roman, Sabahattin Ali’nin roman türünde ilk eseridir. Öykü yazarı olan Ali’nin bu eseri MEB Ortaöğretim 100 Temel Eser Listesinde yer almaktadır.  YKY tarafından ilk olarak 1999 yılında basılan rom', 'Roman', 9, 'kuyucakli-yusuf.jpeg', 1, 'Yapı Kredi Yayınları'),
  (8, 'Sırça Köşk', 'Sabahattin Ali', '1947 yılında yayımlanan Sabahattin Ali’nin birkaç kısa öyküsünden ve “büyüklere masallar” şeklinde tabir edilebilecek masallarından oluşan Sırça Köşk, dönemin devlet yönetimine ve düzenine eleştirel bir bakış sunmaktadır. Kitap, bir dönem yasaklı kitaplar', 'Öykü', 8, 'sirca-kosk.jpeg', 1, 'Yapı Kredi Yayınları'),
  (9, 'Kızıl', 'Stefan Zweig', 'Zweig gençlik dönemi yapıtlarından Kızıl’da öğrenim için Viyana’ya giden genç bir tıp öğrencisinin büyük kentin gerçekliğine uyum sağlama ve yetişkinliğe adım atma sürecini anlatır. Kendini birdenbire ailesinden uzakta soğuk bir odada yapyalnız bulan bu “', 'Roman', 7.1, 'kizil.jpeg', 1, 'Türkiye İş Bankası Kültür Yayınları'),
  (10, 'Mecburiyet', 'Stefan Zweig', 'Savaş karşıtı görüşleriyle tanınan Zweig I. Dünya Savaşı boyunca bu görüşlerini yaymayı kendine misyon edinmişti. Avrupalı ve “dünya vatandaşı” kimliğine büyük değer veren yazar, yapıtlarında savaşın yıkıma uğrattığı “eski dünya”nın değerlerinin kayboluşu', 'Tarihi Kurgu', 6, 'mecburiyet.jpeg', 1, 'Türkiye İş Bankası Kültür Yayınları'),
  (11, 'Sefiller Cilt:1', 'Victor Hugo', 'Hugo, Sefiller adlı dev romanının önsözünü şöyle bitirir: \"Yeryüzünde yoksulluk ve bilgisizliğin egemenliği sürdükçe, böylesi kitaplar gereksiz sayılmayabilir.\" Yurdunun çıkarları adına siyasal kavgalardan hiç çekinmedi. Bu yüzden de tam yirmi yıl sürgünd', 'Epik', 24.07, 'sefiller1.jpeg', 1, 'Türkiye İş Bankası Kültür Yayınları'),
  (12, 'Altıncı Koğuş', 'Anton Pavloviç Çehov', 'Çehov bir taşra kasabasındaki akıl hastanesinde geçen bu novellasında, eğitimli bir hasta olan İvan Dmitriç ile Doktor Andrey Yefimıç arasındaki felsefi çatışmaya odaklanır. İvan Dmitriç maruz kaldıkları adaletsizliğe, içinde yaşamaya zorlandıkları berbat', 'Kurgu', 7, 'altinci-kogus.jpeg', 1, 'Türkiye İş Bankası Kültür Yayınları'),
  (13, 'Othello', 'William Shakespeare', 'Shakespeare, Othello’da her çağda geçerli olan trajik bir durumu, saf dürüstlüğün, yalan ve düzen dünyasına yenilişini, yazgıların birbirinden ayrılıp birbiriyle karşılaştığı labirentler içinde aktarır.', 'Trajedi', 13, 'othello.jpeg', 1, 'Türkiye İş Bankası Kültür Yayınları'),
  (14, 'Suç ve Ceza', 'Fyodor Dostoyevski', ' \"Eski\" öğrenci Raskolnikov, \"kiracıdan\" kiraladığı daracık odasında beş parasız günler geçirmektedir. Modern zamanların, çağdaş bilimin ve edebiyatın bu yaratıcı, akıllı genci, toplumun gerici bir canavara dönüşmüş karanlık avucunda ezilip un ufak mı ola', 'Psikolojik Kurgu', 20, 'suc-ve-ceza.jpeg', 1, 'Türkiye İş Bankası Kültür Yayınları');";
  
  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $sql = "INSERT INTO `members` (`id`, `name`, `surname`, `mail`, `password`, `birthyear`, `gender`, `admin`) VALUES
  (1, 'Ali Hasan', 'Albay', 'a@hotmail.com', '1234', 1999, 'Erkek', 0),
  (2, 'Burak', 'Eken', 'burakeken@hotmail.com', '12345', 1996, 'Erkek', 1),
  (7, 'admin', 'admin', 'admin', 'admin', 2019, 'Erkek', 1),
  (10, 'Esra', 'Ay', 'esra', '12345', 1999, 'Kadın', 0);";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
  header( "refresh:2;url=main.php" );
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
  header( "refresh:2;url=main.php" );
}


?>