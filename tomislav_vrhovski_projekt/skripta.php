<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST['title'];
  $about = $_POST['about'];
  $content = $_POST['content'];
  $category = $_POST['category'];
  $date = date('d.m.Y.');

  if (isset($_POST['archive'])) {
    $archive = 1;
  } else {
    $archive = 0;
  }

  $picture = $_FILES['pphoto']['name'];
  $target_dir = $picture;
  move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir);
} else {
  header("Location: index.php");
  exit();
}
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
    <p class="breadcrumbs">L'Obs > <?php echo $category; ?></p>
    <h2 class="page-title"><?php echo $title; ?></h2>
    <div class="red">
      <div class="picture-container">
        <img src="<?php echo $target_dir; ?>" alt="Article Image">
      </div>
      <div class="text-container">
        <p class="content-text"><?php echo $about; ?></p>
      </div>
    </div>
    <div class="kutija">
      <p class="kutija_tekst">Publie le <?php echo $date; ?></p>
    </div>
    <div class="multi-line-text">
      <?php echo $content; ?>
    </div>
  </div>

  <hr>
  <footer>
  @ 2024 NEWSWEEK<p class="fut">Tomislav Vrhovski</p>
  </footer>
  <hr class="hrr">
</body>
</html>
