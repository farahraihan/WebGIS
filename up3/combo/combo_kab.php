<?php
    session_start();
    require '../../function.php';
    $up3 = ($_SESSION["up3"]);
    $id = $_POST['id'];
    $modul = $_POST['modul'];

    if($modul=='Kecamatan'){
        $query = query("SELECT DISTINCT kecamatan FROM master WHERE kab_kota LIKE '%$id%' AND up3 LIKE '%$up3%'");
        $j_query = intval(count($query));
        $kecamatan = '<option value="">Semua</option>';
        $x=0;
        while($x<$j_query){
        $kecamatan.='<option value="'.$query[$x]['kecamatan'].'">'.$query[$x]['kecamatan'].'</option>';

        $x=$x+1;
        }

        echo $kecamatan;
    }

    if($modul=='Desa'){
        $query = query("SELECT DISTINCT desa FROM master WHERE kab_kota LIKE '%$id%' AND up3 LIKE '%$up3%'");
        $j_query = intval(count($query));
        $desa = '<option value="">Semua</option>';
        $x=0;
        while($x<$j_query){
        $desa.='<option value="'.$query[$x]['desa'].'">'.$query[$x]['desa'].'</option>';

        $x=$x+1;
        }

        echo $desa;
    }

    if($modul=='Klasifikasi'){
        $query = query("SELECT DISTINCT klasifikasi FROM master WHERE kab_kota LIKE '%$id%' AND up3 LIKE '%$up3%'");
        $j_query = intval(count($query));
        $klasifikasi = '<option value="">Semua</option>';
        $x=0;
        while($x<$j_query){
        $klasifikasi.='<option value="'.$query[$x]['klasifikasi'].'">'.$query[$x]['klasifikasi'].'</option>';

        $x=$x+1;
        }

        echo $klasifikasi;
    }

    if($modul=='Idpel'){
        $query = query("SELECT DISTINCT id_pel FROM master WHERE kab_kota LIKE '%$id%' AND up3 LIKE '%$up3%'");
        $j_query = intval(count($query));
        $id_pel = '<option value="">Semua</option>';
        $x=0;
        while($x<$j_query){
        $id_pel.='<option value="'.$query[$x]['id_pel'].'">'.$query[$x]['id_pel'].'</option>';

        $x=$x+1;
        }

        echo $id_pel;
    }

?> 
