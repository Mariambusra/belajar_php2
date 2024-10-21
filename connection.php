<?php
// beberapa variable yang penting ada di connection
    $hostname = 'localhost';
    $user = 'root';
    $password = '';
    $db_name = 'db_warga';

    // Global variable connection
    $connection = mysqli_connect($hostname, $user, $password, $db_name);

    // var_dump($connection);

    

    // Mengambil data (Fetching)
    // mysqli_fetch_row()  Ini yang biasa dipakai, Dipelajari (ini munculnya di view page source 0,1,2,3,dst)
    // mysqli_fetch_assoc()                                   (ini yang muncul di view page source kaya nama2 kolom sesuai mysql)

    // mysqli_fetch_array()  Kemungkinan data double
    // mysqli_fetch_object()  Ini yang biasa dipakai
    

    // include sama require lebih ke
    function myquery($query){
        global $connection;
        $res = mysqli_query($connection, $query);
        $returns = [];
        
        while( $data = mysqli_fetch_assoc($res) ){
            $returns[] = $data;
        }

        return $returns;
    }

?>