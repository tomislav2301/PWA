<?php
include 'connect.php';
define('UPLPATH', '');


if (isset($_GET['category'])) {
  $category = $_GET['category'];
} else {

  $category = 'U.S.';
}


$query = "SELECT * FROM vijesti WHERE arhiva = 0 AND kategorija = '$category'";
$result = mysqli_query($dbc, $query);
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

  <section>
    <h2 class="section-title"><?php echo $category; ?></h2>
    <div class="row">
      <?php
      $i = 1;
      while ($row = mysqli_fetch_array($result)) {
        echo '<a href="clanak.php?id=' . $row['id'] . '" class="box-link">';
        echo '<div class="box">';
        echo '<img src="' . UPLPATH . $row['slika'] . '" alt="Article ' . $i . '">';
        echo '<div class="article-content">';
        echo '<p class="mnaslov">' . $row['naslov'] . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</a>';
        $i++;
      }
      ?>
    </div>
  </section>

  <hr>
  <footer>
    @ 2024 NEWSWEEK<p class="fut">Tomislav Vrhovski</p>
  </footer>
  <hr class="hrr">
</body>
</html>
