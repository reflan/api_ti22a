<?php 
    include "../connection.php";

    // post di sini
    $npm       = $_POST['text_npm'];
    $nama      = $_POST['text_nama'];
    $alamat    = $_POST['text_alamat'];
    

    // isi query untuk cek data mahasiswa by npm
    $sql1 = "SELECT * FROM mahasiswa WHERE npm = '$npm'";

    $check = $connect->query($sql1);
    $reason = "";
    $success = true;

    if($check->num_rows > 0){
        $success = false;
        $reason = "npm sudah ada";
    }else{
        // query untuk insert data
        $sql2 = "
        INSERT INTO 
            mahasiswa
        SET 
            npm = '$npm'
            ,nama = '$nama'
            ,alamat = '$alamat'
        ";
        
        $result = $connect->query($sql2);

        if(!$result){
            $success = false;
            $reason = "Gagal add Mahasiswa";
        }
    }

    echo json_encode(array(
        "success" => $success,
        "reason" =>$reason,
));
