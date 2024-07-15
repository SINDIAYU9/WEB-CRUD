<?php
// Memanggil atau membutuhkan file function.php
require 'function.php';

// Jika dataSiswa diklik maka
if (isset($_POST['dataSiswa'])) {
    $output = '';

    // mengambil data siswa dari nim yang berasal dari dataSiswa
    $nim = $_POST['dataSiswa'];
    $sql = "SELECT * FROM siswa WHERE nim = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nim]);
    $result = $stmt->fetchAll();

    $output .= '<div class="table-responsive">
                    <table class="table table-bordered">';
    foreach ($result as $row) {
        $output .= '<tr align="center">
                        <td colspan="2"><img src="img/' . $row['gambar'] . '" width="25%"></td>
                    </tr>
                    <tr>
                        <th width="40%">NIM</th>
                        <td width="60%">' . $row['nim'] . '</td>
                    </tr>
                    <tr>
                        <th width="40%">Nama</th>
                        <td width="60%">' . $row['nama'] . '</td>
                    </tr>
                    <tr>
                        <th width="40%">Tempat dan Tanggal Lahir</th>
                        <td width="60%">' . $row['tmpt_Lahir'] . ', ' . date("d M Y", strtotime($row['tgl_Lahir'])) . '</td>
                    </tr>
                    <tr>
                        <th width="40%">Jenis Kelamin</th>
                        <td width="60%">' . $row['jekel'] . '</td>
                    </tr>
                    <tr>
                        <th width="40%">Jurusan</th>
                        <td width="60%">' . $row['jurusan'] . '</td>
                    </tr>
                    <tr>
                        <th width="40%">E-Mail</th>
                        <td width="60%">' . $row['email'] . '</td>
                    </tr>
                    <tr>
                        <th width="40%">Telepon</th>
                        <td width="60%">' . $row['telpon'] . '</td>
                    </tr>
                    <tr>
                        <th width="40%">Nama Ayah</th>
                        <td width="60%">' . $row['ayah'] . '</td>
                    </tr>
                    <tr>
                        <th width="40%">Nama Ibu</th>
                        <td width="60%">' . $row['ibu'] . '</td>
                    </tr>
                    <tr>
                        <th width="40%">NIK</th>
                        <td width="60%">' . $row['nik'] . '</td>
                    </tr>
                    <tr>
                        <th width="40%">Kelas</th>
                        <td width="60%">' . $row['kelas'] . '</td>
                    </tr>
                    <tr>
                        <th width="40%">Tahun Masuk</th>
                        <td width="60%">' . $row['tahun_masuk'] . '</td>
                    </tr>
                    <tr>
                        <th width="40%">Alamat</th>
                        <td width="60%">' . $row['alamat'] . '</td>
                    </tr>';
    }
    $output .= '</table></div>';
    // Tampilkan $output
    echo $output;
}
?>
