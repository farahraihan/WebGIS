<?php
    session_start();
    require '../../function.php';

    $level = $_SESSION["level"];
    if( !isset($_SESSION["login"])) {
        if($level!=="7"){
            header("Location: ../index.php");
            exit;
        }
    }

    $p_kecamatan = $_POST['kecamatan'];
    $p_ulp = $_POST['ulp'];

    $data = query("SELECT * FROM master WHERE kecamatan LIKE '%$p_kecamatan%' AND ulp LIKE '%$p_ulp%'");
    $j_data = count($data);

    // var_dump($data);

    echo(json_encode($data));
    
?>