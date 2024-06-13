<?php
include 'connect.php';
define('UPLPATH', '');


if (isset($_GET['id'])) {
  $articleID = $_GET['id'];
} else {

  header("Location: index.php");
  exit();
}


$query = "SELECT * FROM vijesti WHERE id = '$articleID'";
$result = mysqli_query($dbc, $query);


if (mysqli_num_rows($result) == 0) {
  header("Location: index.php");
  exit();
}

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
<title>Newsweek</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header>
      <h1 class="title">Newsweek</h1>
      <div class="small-titles">
      <h2 class="small-title"><a href="index.php">Home</a></h2>
      <h2 class="small-title"><a href="kategorija.php?category=U.S.">U.S.</a></h2>
      <h2 class="small-title"><a href="kategorija.php?category=World">World</a></h2>
      <h2 class="small-title"><a href="administrator.php">Administracija</a></h2>
      <h2 class="small-title"><a href="unos.php">Unos</a></h2>
      <h2 class="small-title"><a href="registracija.php">Registracija</a></h2>
    </div>
    <hr>
  </header>
  <hr>

  <div class="page-section">
    <p class="section-title"><?php echo $row['kategorija']; ?></p>
    <h2 class="page-title"><?php echo $row['naslov']; ?></h2>
    <p class="breadcrumbs"><?php echo $row['datum']; ?></p>
    <div class="red">
      <div class="picture-container">
        <img src="<?php echo UPLPATH . $row['slika']; ?>" alt="Article Image">
      </div>
    </div>
    <p class="kategorytitle"><?php echo $row['kategorija']; ?></p>
    <div class="multi-line-text">
      <?php echo $row['tekst']; ?>
    </div>
  </div>

  <hr>
  <footer>
  @ 2024 NEWSWEEK<p class="fut">Tomislav Vrhovski</p>
  </footer>
  <hr class="hrr">
</body>
</html>
