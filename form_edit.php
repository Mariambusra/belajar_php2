<?php
$_GET['action'] = 'edit';
require 'function.php';

$id_person = $_GET['id'];

$data_person = myquery("SELECT * FROM tb_person WHERE id = $id_person");
// var_dump($data_person);

$data_alamat = myquery("SELECT * FROM tb_alamat");

if(isset($_POST['submit_update'])){
    // Kondisi return true atau false
    if(update($_POST) > 0){
        echo "<script> 
        alert('Data berhasil ditambahkan');
        document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script> 
        alert('Data gagal diubah');
        </script>";
    }
}





if(isset($_POST['submit_insert_warga'])){
    $nama = $_POST['txt_nama'];
    $ktp = $_POST['txt_ktp'];
    $alamat = $_POST['select_alamat'];
    $tanggal = $_POST['txt_tanggal'];

    // memformat tanggal
    $tanggal_baru = new DateTime($tanggal);
    $formatted_tanggal = $tanggal_baru->format ('Y-m-d');

    // Insert
    $query_insert = "INSERT INTO tb_person 
    VALUE ('', '$nama', '$ktp', '$alamat', '$formatted_tanggal') ";

    $res = mysqli_query($connection, $query_insert);

    if($res){
        header('Location: index.php');
        exit();
    }else{
        $err = "Data gagal di input";
    }
}

// var_dump($data_alamat);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form tambah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    
<div class="container">
    <div class="row">
        <div class="col-sm-12">

        <h3 class="mt-4 mb-2"> formulir Update</h3>
        <a href="./index.php" class="d-block mb-4">Kembali</a>

        <?php if(isset($err)): ?>
            <p> <?= $err; ?> </p>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">

            <form method= "POST">
                <input type="hidden" value="<?= $id_person ?>" name="id_person" />        
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="txt_nama" class="form-control" placeholder="Input nama warga" autocomplete="off" value="<?= $data_person[0]['nama'] ?>"/>
            </div>

            <div class="mb-3">
                <label>KTP</label>
                <input type="text" name="txt_ktp" class="form-control" placeholder="Input nomor KTP" autocomplete="off" value="<?= $data_person[0]['ktp'] ?>" />
            </div>

            <div class="mb-3">
            <label>Pilih alamat</label>
            <select class="form-select" name="select_alamat">
                <?php foreach($data_alamat as $option): ?>
                    <option value="<?= $option['id'] ?>"<?php echo ($data_person[0]['alamat'] === $option['id'] ? 'selected' : ''); ?>><?= $option['nomor_rumah'] ?></option>
                <?php endforeach; ?>
            </select>
            </div>

            <div class="mb-3"> 
                <label>Tanggal</label>
                <input type="date" name="txt_tanggal" class="form-control" autocomplete="off" value="<?= $data_person[0]['tgl_daftar'] ?>"/>
            </div>

            <div class="mb-3">
                <button class="btn btn-primary" name="submit_update">Simpan</button>
            </div>
            </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>