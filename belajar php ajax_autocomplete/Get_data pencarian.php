<?php
    include     'koneksi.php';  

    $nama_siswa = '%'.htmlspecialchars($_POST['nama_siswa']).'%';
    
    $i = 1;
    $query = "SELECT * FROM `tabel_pendaftaran_siswa` WHERE `nama_siswa` LIKE ? ORDER BY `nama_siswa` ASC LIMIT 10";
    $pendaftaran = $db1->prepare($query);
    $pendaftaran->bind_param("s",$nama_siswa);
    $pendaftaran->execute();
    $res1 = $pendaftaran->get_result();
    while ($row = $res1->fetch_assoc()) {
        $data[$i]['id'] = $row['id'];
        $data[$i]['nama_siswa'] = $row['nama_siswa'];
        $data[$i]['alamat'] = $row['alamat'];
        $data[$i]['gambar'] = $row['gambar'];

        $i++;
    }

    $out = array_values($data);
    echo json_encode($out);
?>
