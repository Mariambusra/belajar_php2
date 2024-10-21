<?php
require 'connection.php';

// Jika terdapat 'action' dan 'id' maka akan melakukan sesuatu
    if(isset ($_GET['action']) && isset($_GET['id'])){
        $action = $_GET['action'];
        $id = $_GET['id'];

        switch($action){
            case 'delete':
                delete_data($id);
                break;
            case 'edit':
                echo "";
                break;
            default:
                echo "Aksi tidak di definisikan!";
        }
    }else{
        echo "Aksi dan ID tidak di definisikan!";
    } 

    function delete_data($id){
        global $connection;
        $res = mysqli_query($connection, "DELETE FROM tb_person WHERE id = " . $id);
        
        if($res){
            // Jika true
            header("Location: index.php?messages=Berhasil dihapus");
            exit();
        }else{
            // Jika false
            header("Location: index.php?message=Gagal dihapus");
            exit();
        }
    }

    function update($data){
        global $connection;

    $id = $data['id_person'];
    $nama = $connection->real_escape_string($data ['txt_nama']);
    $ktp = $data ['txt_ktp'];
    $alamat = $data ['select_alamat'];
    $tanggal = $data ['txt_tanggal'];

     // memformat tanggal
    $tanggal_baru = new DateTime($tanggal);
    $formatted_tanggal = $tanggal_baru->format ('Y-m-d');

    $query = "UPDATE tb_person SET 
    nama = '$nama',
    ktp = '$ktp',
    alamat = $alamat,
    tgl_daftar = '$formatted_tanggal'
    WHERE id = $id
    ";

    mysqli_query($connection, $query);
    return mysqli_affected_rows($connection);

    }
?>