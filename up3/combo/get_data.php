<?php
    session_start();
    require '../../function.php';

    $up3 = ($_SESSION["up3"]);

    $p_kab_kota = $_POST['kab_kota'];
    $p_kecamatan = $_POST['kecamatan'];
    $p_desa = $_POST['desa'];
    $p_klasifikasi = $_POST['klasifikasi'];
    $p_id_pel = $_POST['id_pel'];

    // $p_kab_kota = "BANDA ACEH";
    // $p_kecamatan = "";
    // $p_desa = "MULIA";
    // $p_klasifikasi = "";
    // $p_id_pel = "";

    $data = query("SELECT * FROM master WHERE kab_kota LIKE '%$p_kab_kota%' AND kecamatan LIKE '%$p_kecamatan%' AND desa LIKE '%$p_desa%' AND klasifikasi LIKE '%$p_klasifikasi%' AND id_pel LIKE '%$p_id_pel%' AND up3 LIKE '%$up3%'");
    $j_data = count($data);

    // var_dump($data);

    echo(json_encode($data));
    

?>