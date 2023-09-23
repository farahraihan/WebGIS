<?php
    session_start();
    require '../../function.php';
    $ulp = ($_SESSION["ulp"]);
    $id = $_POST['id'];
    $modul = $_POST['modul'];

    if($modul=='Desa'){
        $query = query("SELECT DISTINCT desa FROM master WHERE kecamatan LIKE '%$id%' AND ulp LIKE '%$ulp%'");
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
        $query = query("SELECT DISTINCT klasifikasi FROM master WHERE kecamatan LIKE '%$id%' AND ulp LIKE '%$ulp%'");
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
        $query = query("SELECT DISTINCT id_pel FROM master WHERE kecamatan LIKE '%$id%' AND ulp LIKE '%$ulp%'");
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
