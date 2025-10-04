<?php
// Inisialisasi variabel
$nama = $email = $nim = $jurusan = $alasan = "";
$namaErr = $emailErr = $nimErr = $jurusanErr = $alasanErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valid = true;
    
    // **********************  1  **************************
    // Tangkap nilai nama dari form
    if (empty($_POST["nama"])) {
        $namaErr = "Nama harus diisi";
        $valid = false;
    } else {
        $nama = test_input($_POST["nama"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $nama)) {
            $namaErr = "Hanya huruf dan spasi yang diperbolehkan";
            $valid = false;
        }
    }

    // **********************  2  **************************
    // Tangkap nilai email dari form
    if (empty($_POST["email"])) {
        $emailErr = "Email harus diisi";
        $valid = false;
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Format email tidak valid";
            $valid = false;
        }
    }

    // **********************  3  **************************
    // Tangkap nilai NIM dari form
    if (empty($_POST["nim"])) {
        $nimErr = "NIM harus diisi";
        $valid = false;
    } else {
        $nim = test_input($_POST["nim"]);
        if (!preg_match("/^[0-9]*$/", $nim)) {
            $nimErr = "NIM hanya boleh berisi angka";
            $valid = false;
        }
    }

    // **********************  4  **************************
    // Tangkap nilai jurusan (dropdown)
    if (empty($_POST["jurusan"])) {
        $jurusanErr = "Jurusan harus dipilih";
        $valid = false;
    } else {
        $jurusan = test_input($_POST["jurusan"]);
    }

    // **********************  5  **************************
    // Tangkap nilai alasan (textarea)
    if (empty($_POST["alasan"])) {
        $alasanErr = "Alasan bergabung harus diisi";
        $valid = false;
    } else {
        $alasan = test_input($_POST["alasan"]);
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Pendaftaran Keanggotaan Lab - EAD Laboratory</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="form-container">
  <img src="EAD.png" alt="Logo EAD" class="logo">
  <h2>Form Pendaftaran Keanggotaan Lab - EAD Laboratory</h2>
  <form method="post" action="">
    <label>Nama:</label>
    <input type="text" name="nama" value="<?php echo $nama; ?>">
    <span class="error"><?php echo $namaErr; ?></span>

    <label>Email:</label>
    <input type="text" name="email" value="<?php echo $email; ?>">
    <span class="error"><?php echo $emailErr; ?></span>

    <label>NIM:</label>
    <input type="text" name="nim" value="<?php echo $nim; ?>">
    <span class="error"><?php echo $nimErr; ?></span>

    <label>Jurusan:</label>
    <select name="jurusan">
      <option value="">-- Pilih Jurusan --</option>
      <option value="Sistem Informasi" <?php if($jurusan == "Sistem Informasi") echo "selected"; ?>>Sistem Informasi</option>
      <option value="Informatika" <?php if($jurusan == "Informatika") echo "selected"; ?>>Informatika</option>
      <option value="Teknik Industri" <?php if($jurusan == "Teknik Industri") echo "selected"; ?>>Teknik Industri</option>
    </select>
    <span class="error"><?php echo $jurusanErr; ?></span>

    <label>Alasan Bergabung:</label>
    <textarea name="alasan"><?php echo $alasan; ?></textarea>
    <span class="error"><?php echo $alasanErr; ?></span>

    <button type="submit">Daftar</button>
  </form>

  <?php
  // **********************  6  **************************
  // Tampilkan hasil input dalam tabel + logo di atasnya jika semua valid
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($valid) && $valid) {
      echo '<div class="result-container">';
      echo '<img src="EAD.png" alt="Logo EAD" class="logo">';
      echo '<h3>Data Pendaftaran Berhasil!</h3>';
      echo '<table>';
      echo '<tr><th>Nama</th><td>' . $nama . '</td></tr>';
      echo '<tr><th>Email</th><td>' . $email . '</td></tr>';
      echo '<tr><th>NIM</th><td>' . $nim . '</td></tr>';
      echo '<tr><th>Jurusan</th><td>' . $jurusan . '</td></tr>';
      echo '<tr><th>Alasan Bergabung</th><td>' . $alasan . '</td></tr>';
      echo '</table>';
      echo '</div>';
  }
  ?>
</div>
</body>
</html>