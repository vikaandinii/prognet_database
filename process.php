<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Input Nilai</title>
    <!-- Memuat file CSS eksternal -->
    <link rel="stylesheet" href="style.css">
    <!-- Memuat font Google -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>

<div class="result-container">
    <?php
    if (isset($_POST['submit'])) {
        // Koneksi ke database
        $servername = "localhost";
        $username = "root";  // Username MySQL 
        $password = "";      // MySQL
        $dbname = "nilai_mahasiswa";  // Nama database 

        // Membuat koneksi
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Mengecek koneksi
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Ambil data dari form
        $nama = $_POST['nama'];
        $nim = $_POST['nim'];
        $nilai = $_POST['nilai'];

        // Fungsi untuk mengkonversi nilai angka ke nilai huruf
        function konversiNilaiHuruf($nilai) {
             if ($nilai >= 80) {
                return "A";
            } elseif ($nilai >= 71) {
                return "B+";
            } elseif ($nilai >= 65) {
                return "B";
            } elseif ($nilai >= 60) {
                return "C+";
            } elseif ($nilai >= 55) {
                return "C";
            } elseif ($nilai >= 50) {
                return "D+";
            } elseif ($nilai >= 40) {
                return "D";
            } else {
                return "E";
            }
        }

        $nilai_huruf = konversiNilaiHuruf($nilai);

        // Menyimpan data ke database
        $sql = "INSERT INTO nilai (nama, nim, nilai_angka, nilai_huruf)
                VALUES ('$nama', '$nim', '$nilai', '$nilai_huruf')";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='result'>";
            echo "<h3>Hasil:</h3>";
            echo "<p>Nama: <strong>" . $nama . "</strong></p>";
            echo "<p>NIM: <strong>" . $nim . "</strong></p>";
            echo "<p>Nilai Angka: <strong>" . $nilai . "</strong></p>";
            echo "<p>Nilai Huruf: <strong>" . $nilai_huruf . "</strong></p>";
            // echo "<p>Data berhasil disimpan ke database.</p>";
            echo "<a href='index.html' class='back-button'>Kembali</a>";
            echo "</div>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }

        // Tutup koneksi
        $conn->close();
    }
    ?>
</div>

</body>
</html>
