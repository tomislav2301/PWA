<?php
date_default_timezone_set('Europe/Paris');

include 'connect.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $picture = $_FILES['pphoto']['name'];
  $title = $_POST['title'];
  $content = $_POST['content'];
  $category = $_POST['category'];
  $date = date('d.m.Y.');

  if (isset($_POST['archive'])) {
    $archive = 1;
  } else {
    $archive = 0;
  }

  $target_dir = $picture;
  move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir);

  $query = "INSERT INTO Vijesti (datum, naslov, tekst, slika, kategorija, arhiva)
            VALUES ('$date', '$title', '$content', '$picture', '$category', '$archive')";

  $result = mysqli_query($dbc, $query) or die('Error querying database.');

}
?>

<!DOCTYPE html>
<html>
<head>
<title>Newsweek</title>
<link rel="stylesheet" type="text/css" href="style.css">
  <script>
    function validateForm() {
      var title = document.forms["myForm"]["title"].value;
      var content = document.forms["myForm"]["content"].value;
      var pphoto = document.forms["myForm"]["pphoto"].value;
      var category = document.forms["myForm"]["category"].value;

      if (title.length < 5 || title.length > 30) {
        document.getElementById("title").style.borderColor = "red";
        return false;
      }

      if (content.trim() === "") {
        document.getElementById("content").style.borderColor = "red";
        return false;
      }

      if (pphoto === "") {
        document.getElementById("pphoto").style.borderColor = "red";
        return false;
      }

      if (category === "") {
        document.getElementById("category").style.borderColor = "red";
        return false;
      }
    }
  </script>
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

  <form name="myForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
    <div class="form-item">
      <label for="title">Naslov vijesti</label>
      <div class="form-field">
        <input type="text" name="title" id="title" class="form-field-textual">
      </div>
    </div>
    <div class="form-item">
      <label for="content">Sadržaj vijesti</label>
      <div class="form-field">
        <textarea name="content" id="content" cols="30" rows="10" class="form-field-textual"></textarea>
      </div>
    </div>
    <div class="form-item">
      <label for="pphoto">Slika:</label>
      <div class="form-field">
        <input type="file" accept="image/jpg" class="input-text" name="pphoto" id="pphoto" />
      </div>
    </div>
    <div class="form-item">
      <label for="category">Kategorija vijesti</label>
      <div class="form-field">
        <select name="category" id="category" class="form-field-textual">
          <option value="">Odaberi kategoriju</option>
          <option value="U.S.">U.S.</option>
          <option value="World">World</option>
        </select>
      </div>
    </div>
    <div class="form-item">
      <label>Spremiti u arhivu:</label>
      <div class="form-field">
        <input type="checkbox" name="archive">
      </div>
    </div>
    <div class="form-item">
      <button type="reset" value="Poništi">Poništi</button>
      <button type="submit" value="Prihvati">Prihvati</button>
    </div>
  </form>

  <hr>
  <footer>
  @ 2024 NEWSWEEK<p class="fut">Tomislav Vrhovski</p>
  </footer>
  <hr class="hrr">
</body>
</html>
