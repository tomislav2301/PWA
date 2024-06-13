<?php
include 'connect.php';
define('UPLPATH', '');
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
  <hr class="hrr">

  <section>
    <h2 class="section-title">U.S.</h2>
    <div class="row">
      <?php
      $query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='U.S.' LIMIT 3";
      $result = mysqli_query($dbc, $query);
      $i = 1;
      while ($row = mysqli_fetch_array($result)) :
      ?>
        <a href="clanak.php?id=<?php echo $row['id']; ?>" class="box-link">
          <div class="box">
            <img src="<?php echo UPLPATH . $row['slika']; ?>" alt="Article <?php echo $i; ?>">
            <div class="article-content">
              <p class="mnaslov"><?php echo $row['naslov']; ?></p>
            </div>
          </div>
        </a>
      <?php
        $i++;
      endwhile;
      ?>
    </div>
  </section>

      <hr  class="hrr">

  <section>
    <h2 class="section-title">World</h2>
    <div class="row">
      <?php
      $query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='World' LIMIT 3";
      $result = mysqli_query($dbc, $query);
      $i = 1;
      while ($row = mysqli_fetch_array($result)) :
      ?>
        <a href="clanak.php?id=<?php echo $row['id']; ?>" class="box-link">
          <div class="box">
            <img src="<?php echo UPLPATH . $row['slika']; ?>" alt="Article <?php echo $i; ?>">
            <div class="article-content">
            <p class="mnaslov"><?php echo $row['naslov']; ?></p>
            </div>
          </div>
        </a>
      <?php
        $i++;
      endwhile;
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
