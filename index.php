<?php
require 'connection.php';
$data = myquery("SELECT p.id, p.nama, p.ktp, p.tgl_daftar, a.nomor_rumah 
FROM tb_person as p 
JOIN tb_alamat as a  
ON p.alamat = a.id");


// var_dump($data);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Bajuri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">


                <h3>Data Bajuri</h3>

                <a href="form_tambah.php">Tambah data</a>

                <?php if(isset($_GET['messages'])): ?>
                    <p color="red"><?= $_GET['messages']; ?></p>
                <?php endif; ?>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Aksi</th>
                            <th>Nama</th>
                            <th>KTP</th>
                            <th>Nomor rumah</th>
                            <th>Tanggal daftar</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $row): ?>
                        <tr>
                            <td>
                                <a href="form_edit.php?id=<?= $row['id'] ?>" class="btn btn-primary">Edit</a>
                                <a href="function.php?action=delete&id=<?= $row['id'] ?>" class="btn btn-outline-danger" onClick="return confirm('Yakin akan menghapus?')">Hapus</a>
                            </td>
                            <td><?= $row['nama'] ?></td>
                            <td><?= $row['ktp'] ?></td>
                            <td><?= $row['nomor_rumah'] ?></td>
                            <td><?= $row['tgl_daftar'] ?></td>

                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>