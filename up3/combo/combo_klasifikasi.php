<?php
    session_start();
    require '../../function.php';

    $up3 = ($_SESSION["up3"]);
    $id = $_POST['id'];
    $modul = $_POST['modul'];

    if($modul=='Idpel'){
        $query = query("SELECT DISTINCT id_pel FROM master WHERE klasifikasi LIKE '%$id%' AND up3 LIKE '%$up3%'");
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