<?php
session_start();
include 'connect.php';

// Putanja do direktorija sa slikama
define('UPLPATH', '');

$uspjesnaPrijava = false;
$prijavaPoslana = false;

// Provjera da li je korisnik došao s login forme
if (isset($_POST['prijava'])) {
    // Provjera da li korisnik postoji u bazi uz zaštitu od SQL injectiona
    $prijavaPoslana = true;
    $prijavaImeKorisnika = $_POST['username'];
    $prijavaLozinkaKorisnika = $_POST['lozinka'];
    $sql = "SELECT korisnicko_ime, lozinka, razina FROM korisnik WHERE korisnicko_ime = ?";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $prijavaImeKorisnika);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    }
    mysqli_stmt_bind_result($stmt, $imeKorisnika, $lozinkaKorisnika, $levelKorisnika);
    mysqli_stmt_fetch($stmt);

    // Provjera lozinke
    if (crypt($_POST['lozinka'], $lozinkaKorisnika) == $lozinkaKorisnika && mysqli_stmt_num_rows($stmt) > 0) {
        $uspjesnaPrijava = true;

        // Provjera da li je admin
        if ($levelKorisnika == 1) {
            $admin = true;
        } else {
            $admin = false;
        }

        // Postavljanje session varijabli
        $_SESSION['$username'] = $imeKorisnika;
        $_SESSION['$level'] = $levelKorisnika;
    } else {
        $uspjesnaPrijava = false;
    }
}

// Odjava korisnika
if (isset($_POST['odjava'])) {
    // Brisanje session varijabli
    session_unset();
    session_destroy();
}

// Brisanje i promjena arhiviranosti
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

    var isValid = true;

    if (title.length < 5 || title.length > 30) {
      document.forms["myForm"]["title"].style.borderColor = "red";
      isValid = false;
    }


    if (content.trim() === "") {
      document.forms["myForm"]["content"].style.borderColor = "red";
      isValid = false;
    }

    if (pphoto === "") {
      document.forms["myForm"]["pphoto"].style.borderColor = "red";
      isValid = false;
    }

    if (category === "") {
      document.forms["myForm"]["category"].style.borderColor = "red";
      isValid = false;
    }

    if (!isValid) {
      alert("Please fill in the required fields correctly.");
    }

    return isValid;
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

<?php
// Pokaži stranicu ukoliko je korisnik uspješno prijavljen i administrator je
if (($uspjesnaPrijava == true && $admin == true) || (isset($_SESSION['$username']) && $_SESSION['$level'] == 1)) {
  
  $query = "SELECT * FROM vijesti";
  $result = mysqli_query($dbc, $query);
  
  while ($row = mysqli_fetch_array($result)) {
    echo '<form name="myForm" action="" method="POST" >
      <div class="form-item">
        <label for="title">Naslov vjesti:</label>
        <div class="form-field">
          <input type="text" name="title" class="form-field-textual" value="'.htmlspecialchars($row['naslov']).'">
        </div>
      </div>
      <div class="form-item">
        <label for="content">Sadržaj vijesti:</label>
        <div class="form-field">
          <textarea name="content" id="content" cols="30" rows="10" class="formfield-textual">'.htmlspecialchars($row['tekst']).'</textarea>
        </div>
      </div>
      <div class="form-item">
        <label for="pphoto">Slika:</label>
        <div class="form-field">
          <input type="file" class="input-text" id="pphoto" name="pphoto"/>
          <br><img src="'.UPLPATH.htmlspecialchars($row['slika']).'" width="100px">
        </div>
      </div>
      <div class="form-item">
        <label for="category">Kategorija vijesti:</label>
        <div class="form-field">
          <select name="category" id="category" class="form-field-textual">
            <option value="U.S." '.($row['kategorija'] == "U.S." ? 'selected' : '').'>U.S.</option>
            <option value="World" '.($row['kategorija'] == "World" ? 'selected' : '').'>World</option>
          </select>
        </div>
      </div>
      <div class="form-item">
        <label>Spremiti u arhivu:</label>
        <div class="form-field">
          <input type="checkbox" name="archive" id="archive" '.($row['arhiva'] == 1 ? 'checked' : '').'/> Arhiviraj?
        </div>
      </div>
      <br>
      <div class="form-item">
        <input type="hidden" name="id" class="form-field-textual" value="'.$row['id'].'">
        <button type="reset" value="Poništi">Poništi</button>
        <button type="submit" name="update" value="Prihvati">Izmjeni</button>
        <button type="submit" name="delete" value="Izbriši">Izbriši</button>
      </div>
    </form>
    <br><hr class="hrr"><br><br>';
  }
  
  if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $query = "DELETE FROM vijesti WHERE id=$id";
    $result = mysqli_query($dbc, $query);
  }
  
  if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $archive = isset($_POST['archive']) ? 1 : 0;
  
    // Handle file upload
    if (!empty($_FILES['pphoto']['name'])) {
      $picture = $_FILES['pphoto']['name'];
      $target_dir = UPLPATH.$picture;
      move_uploaded_file($_FILES['pphoto']['tmp_name'], $target_dir);
    } else {
      // If no new picture is uploaded, retrieve the existing picture from the database
      $query = "SELECT slika FROM vijesti WHERE id=$id";
      $result = mysqli_query($dbc, $query);
      $row = mysqli_fetch_assoc($result);
      $picture = $row['slika'];
    }
  
    $query = "UPDATE vijesti SET naslov='$title', tekst='$content', slika='$picture', kategorija='$category', arhiva='$archive' WHERE id=$id";
    $result = mysqli_query($dbc, $query);
  }
  
  mysqli_close($dbc);

    ?>

    <!-- Odjava korisnika -->
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <button type="submit" name="odjava">Odjava</button>
    </form>

    <?php
} else if ($uspjesnaPrijava == true && $admin == false) {
    echo '<p>Bok ' . $imeKorisnika . '! Uspješno ste prijavljeni, ali niste administrator.</p>';

    // Omogući ponovni login
    ?>

    <!-- Forma za ponovni login -->
    <h2>Login</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="username">Korisničko ime:</label>
        <input type="text" id="username" name="username" required><br>
        <br>
        <label for="password">Lozinka:</label>
        <input type="password" id="password" name="lozinka" required><br>
        <br>
        <button type="submit" name="prijava">Prijava</button>
    </form>

    <?php
} else if (isset($_SESSION['$username']) && $_SESSION['$level'] == 0) {
    echo '<p>Bok ' . $_SESSION['$username'] . '! Uspješno ste prijavljeni, ali niste administrator.</p>';

    // Omogući ponovni login
    ?>

    <!-- Forma za ponovni login -->
    <h2>Login</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="username">Korisničko ime:</label>
        <input type="text" id="username" name="username" required><br>
        <br>
        <label for="password">Lozinka:</label>
        <input type="password" id="password" name="lozinka" required><br>
        <br>
        <button type="submit" name="prijava">Login</button>
    </form>

    <?php
} else if ($uspjesnaPrijava == false) {
    ?>

    <!-- Forma za prijavu -->
    <h2>Login</h2>
    <?php
    if (isset($uspjesnaPrijava) && !$uspjesnaPrijava && $prijavaPoslana) {
        echo '<p>Invalid username or password.</p>';
    }
    ?>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="username">Korisničko ime:</label>
        <input type="text" id="username" name="username" required><br>
        <br>
        <label for="password">Lozinka:</label>
        <input type="password" id="password" name="lozinka" required><br>
        <br>
        <button type="submit" name="prijava">Prijava</button>
    </form>

    <?php
}
?>

<hr>
  <footer>
  @ 2024 NEWSWEEK<p class="fut">Tomislav Vrhovski</p>
  </footer>
  <hr class="hrr">
</body>
</html>
