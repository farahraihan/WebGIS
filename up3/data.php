<?php
session_start();
require '../function.php';

if(!isset($_SESSION["login"]) ) {
    header("Location: ../index.php");
    exit;
}

$up3 = ($_SESSION["up3"]);

// KONFIGURASI FILTER
$p_kab_kota = "";
$p_kecamatan = "";
$p_desa = "";
$p_klasifikasi = "";
$p_id_pel = "";
$data = "";
$t_data = 0;
if(isset($_POST['filter-button'])) {
    $p_kab_kota = $_POST['kab_kota'];
    $p_kecamatan = $_POST['kecamatan'];
    $p_desa = $_POST['desa'];
    $p_klasifikasi = $_POST['klasifikasi'];
    $p_id_pel = $_POST['id_pel'];

    $data = query("SELECT * FROM master WHERE up3 LIKE '%$up3%' AND kab_kota LIKE '%$p_kab_kota%' AND kecamatan LIKE '%$p_kecamatan%' AND desa LIKE '%$p_desa%' AND klasifikasi LIKE '%$p_klasifikasi%' AND id_pel LIKE '%$p_id_pel%'");
    $t_data = intval(count($data));

}

// OPTION KAB/KOTA
$kab_kota = query("SELECT DISTINCT kab_kota FROM master WHERE up3 LIKE '%$up3%'");
$j_kab_kota = intval(query("SELECT COUNT(DISTINCT kab_kota) FROM master WHERE up3 LIKE '%$up3%'")[0]["COUNT(DISTINCT kab_kota)"]);

// OPTION KECAMATAN
$kecamatan = query("SELECT DISTINCT kecamatan FROM master WHERE up3 LIKE '%$up3%'");
$j_kecamatan = intval(query("SELECT COUNT(DISTINCT kecamatan) FROM master WHERE up3 LIKE '%$up3%'")[0]["COUNT(DISTINCT kecamatan)"]);

// OPTION ALAMAT
$desa = query("SELECT DISTINCT desa FROM master WHERE up3 LIKE '%$up3%'");
$j_desa = intval(query("SELECT COUNT(DISTINCT desa) FROM master WHERE up3 LIKE '%$up3%'")[0]["COUNT(DISTINCT desa)"]);

// OPTION KLASIFIKASI
$klasifikasi = query("SELECT DISTINCT klasifikasi FROM master WHERE up3 LIKE '%$up3%'");
$j_klasifikasi = intval(query("SELECT COUNT(DISTINCT klasifikasi) FROM master WHERE up3 LIKE '%$up3%'")[0]["COUNT(DISTINCT klasifikasi)"]);

// OPTION IDPEL
$id_pel = query("SELECT DISTINCT id_pel FROM master WHERE up3 LIKE '%$up3%'");
$j_id_pel = intval(query("SELECT COUNT(DISTINCT id_pel) FROM master WHERE up3 LIKE '%$up3%'")[0]["COUNT(DISTINCT id_pel)"]);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" conte nt="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap.min.css">

    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <link rel="stylesheet" href="../style/style3.css">

</head>
<body>
    
    <div class="container1">
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Header -->
            <div class="header">
                <h2>SIMP</h2>
            </div>
            <!-- Gambar / Icon -->
            <div class="icon">
                <img src="../image/data.svg" alt="dashboard_profile" id="dashboard_profile" >
            </div>

            <!-- Item List -->
            <!-- Dashboard -->
                <a href="index.php">
                    <div class="dashboard">
                        <i class="fa-solid fa-gauge fa-2x"></i>
                        <span class="item">Dashboard</span>
                    </div>
                </a>
                <a href="approval.php">
                    <div class="approval">
                        <i class="fa-solid fa-share-from-square fa-2x"></i>
                        <span class="item">Approval</span>
                    </div>
                </a>
                <a href="map.php">
                    <div class="map">
                        <i class="fa-solid fa-map-location-dot fa-2x"></i>
                        <span class="item">Map</span>
                    </div>
                </a>
                <a href="data.php">
                    <div class="data">
                        <i class="fa-solid fa-database fa-2x"></i>
                        <span class="item">Data</span>
                    </div>
                </a>
                <a href="account.php">
                    <div class="account">
                        <i class="fa-solid fa-user-gear fa-2x"></i>
                        <span class="item">Account</span>
                    </div>
                </a>

            
            <!-- Sidebar Footer -->
            <div class="footer">
                <a href="../logout.php">Log Out</a>
            </div>
        </div>

        <!-- Main Area /Content -->
        <div class="content">
            <div class="menu">
                <div class="filter">
                    <form action="data.php" method="POST">
                        <label for="kab_kota">Kab/Kota :</label><br>
                        <select id="kab_kota" name="kab_kota">
                                <option value="">Semua</option>
                                <?php $x = 0; ?>
                                <?php while ($x < $j_kab_kota) : ?>
                                <option value="<?=$kab_kota[$x]['kab_kota']?>"><?=$kab_kota[$x]['kab_kota']?></option>
                                <?php $x++; ?>
                                <?php endwhile; ?>
                        </select><br>
                        <label for="kecamatan">Kecamatan :</label><br>
                        <select id="kecamatan" name="kecamatan">
                                <option value="">Semua</option>
                                <?php $x = 0; ?>
                                <?php while ($x < $j_kecamatan) : ?>
                                <option value="<?=$kecamatan[$x]['kecamatan']?>"><?=$kecamatan[$x]['kecamatan']?></option>
                                <?php $x++; ?>
                                <?php endwhile; ?>
                        </select><br>
                        <label for="desa">Desa :</label><br>
                        <select id="desa" name="desa">
                                <option value="">Semua</option>
                                <?php $x = 0; ?>
                                <?php while ($x < $j_desa) : ?>
                                <option value="<?=$desa[$x]['desa']?>"><?=$desa[$x]['desa']?></option>
                                <?php $x++; ?>
                                <?php endwhile; ?>
                        </select><br>
                        <label for="klasifikasi">Klasifikasi</label><br>
                        <select id="klasifikasi" name="klasifikasi">
                                <option value="">Semua</option>
                                <?php $x = 0; ?>
                                <?php while ($x < $j_klasifikasi) : ?>
                                <option value="<?=$klasifikasi[$x]['klasifikasi']?>"><?=$klasifikasi[$x]['klasifikasi']?></option>
                                <?php $x++; ?>
                                <?php endwhile; ?>
                        </select><br>
                        <label for="id_pel">Id Pel</label><br>
                                <select id="id_pel" name="id_pel">
                                <option value="">Semua</option>
                                <?php $x = 0; ?>
                                <?php while ($x < $j_id_pel) : ?>
                                <option value="<?=$id_pel[$x]['id_pel']?>"><?=$id_pel[$x]['id_pel']?></option>
                                <?php $x++; ?>
                                <?php endwhile; ?>
                        </select><br>
                        <input type="submit" value="Filter" name="filter-button" class="filter-button">
                    </form>
                </div>
            </div>
            <div class="container">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Item</th>
                            <th>Tipe</th>
                            <th>Watt</th>
                            <th>Klasifikasi</th>
                            <th>Desa</th>
                            <th>Kecamatan</th>
                            <th>Kab/Kota</th>
                            <th>Lat</th>
                            <th>Long</th>
                            <th>Info</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i=0; $i<$t_data; $i++): ?>
                        <?php $row=$data[$i]; ?>
                        <tr>
                            <td><?= $i+1 ; ?></td>
                            <td><?= $row["no_item"]; ?></td>
                            <td><?= $row["tipe"]; ?></td>
                            <td><?= $row["watt"]; ?></td>
                            <td><?= $row["klasifikasi"]; ?></td>
                            <td><?= $row["desa"]; ?></td>
                            <td><?= $row["kecamatan"]; ?></td>
                            <td><?= $row["kab_kota"]; ?></td>
                            <td><?= $row["latitudey"]; ?></td>
                            <td><?= $row["longitudex"]; ?></td>
                            <td>
                                <button type="button" class="btn button-modal" data-toggle="modal" data-target="#myModal<?= $row["no_item"] ?>">i</button>
                                <input type="hidden" name="iddata" value="<?= $row["no_item"] ?>">
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="myModal<?= $row["no_item"] ?>" role="dialog">
                            <div class="modal-dialog modal-lg">
                            
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Detail Data</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-image">
                                        <img src="<?= $row["link_foto"]; ?>" height="50" width="50">
                                    </div>
                                    <div class="modal-text">
                                        <div class="item1">
                                                No Item<br> 
                                                Id Pel<br>
                                                Tgl Survey<br>
                                                Petugas<br>
                                                ULP<br>
                                                Desa<br>
                                                Kecamatan<br>
                                                Kab/Kota<br>
                                                Klasifikasi<br>
                                                Tipe<br>
                                                Watt<br>
                                                Fkali<br>
                                                Daya SE Dir (Kelompok)<br>
                                                Daya SE Dir (Watt)<br>
                                                Daya SE Dir (va)<br>
                                                Gol SE Dir<br>
                                                Cosphi<br>
                                                Kondisi<br>
                                                Lattitude<br>
                                                Longitude<br>
                                                No Gardu<br>
                                                Keterangan<br>
                                        </div>
                                        <div class="item2">
                                                : <?= $row["no_item"]; ?><br> 
                                                : <?= $row["id_pel"]; ?><br> 
                                                : <?= $row["tanggaljam_survey"]; ?><br> 
                                                : <?= $row["petugas_survey"]; ?><br> 
                                                : <?= $row["ulp"]; ?><br> 
                                                : <?= $row["desa"]; ?><br> 
                                                : <?= $row["kecamatan"]; ?><br> 
                                                : <?= $row["kab_kota"]; ?><br> 
                                                : <?= $row["klasifikasi"]; ?><br> 
                                                : <?= $row["tipe"]; ?><br> 
                                                : <?= $row["watt"]; ?><br> 
                                                : <?= $row["fkali"]; ?><br> 
                                                : <?= $row["daya_sedir_kelompok"]; ?><br> 
                                                : <?= $row["daya_sedir_watt"]; ?><br> 
                                                : <?= $row["daya_sedir_va"]; ?><br> 
                                                : <?= $row["gol_sedir"]; ?><br> 
                                                : <?= $row["cosphi"]; ?><br> 
                                                : <?= $row["kondisi"]; ?><br> 
                                                : <?= $row["latitudey"]; ?><br> 
                                                : <?= $row["longitudex"]; ?><br> 
                                                : <?= $row["no_gardu"]; ?><br> 
                                                : <?= $row["keterangan"]; ?><br> 
                                        </div>
                                    </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                            
                            </div>
                        </div>

                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
    <!-- Data Tables -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
    
    <script>

        // data table
        $(document).ready(function() {
            var table = $('#example').DataTable( {
                buttons: [ 'copy', 'excel', 'print']
            } );
        
            table.buttons().container()
                .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
        } );

        // menu filter
        $(document).ready(function(){
            // onclick kab/kota
            $("#kab_kota").on('change', function(){
                var kab_kota = $("#kab_kota").val();
                $.ajax({
                    url: "combo/combo_kab.php",
                    type: "POST",
                    data: {
                        modul: 'Kecamatan',
                        id:kab_kota
                    },
                    success: function(respond){
                        $("#kecamatan").html(respond);
                    },
                    error: function(){
                        alert("Gagal mengambil data");
                    }
                })

                $.ajax({
                    url: "combo/combo_kab.php",
                    type: "POST",
                    data: {
                        modul: 'Desa',
                        id:kab_kota
                    },
                    success: function(respond){
                        $("#desa").html(respond);
                    },
                    error: function(){
                        alert("Gagal mengambil data");
                    }
                })

                $.ajax({
                    url: "combo/combo_kab.php",
                    type: "POST",
                    data: {
                        modul: 'Klasifikasi',
                        id:kab_kota
                    },
                    success: function(respond){
                        $("#klasifikasi").html(respond);
                    },
                    error: function(){
                        alert("Gagal mengambil data");
                    }
                })

                $.ajax({
                    url: "combo/combo_kab.php",
                    type: "POST",
                    data: {
                        modul: 'Idpel',
                        id:kab_kota
                    },
                    success: function(respond){
                        $("#id_pel").html(respond);
                    },
                    error: function(){
                        alert("Gagal mengambil data");
                    }
                })
            });

            // onclick kecamatan
            $("#kecamatan").on('change', function(){
                var kecamatan = $("#kecamatan").val();
                $.ajax({
                    url: "combo/combo_kecamatan.php",
                    type: "POST",
                    data: {
                        modul: 'Desa',
                        id:kecamatan
                    },
                    success: function(respond){
                        $("#desa").html(respond);
                    },
                    error: function(){
                        alert("Gagal mengambil data");
                    }
                })

                $.ajax({
                    url: "combo/combo_kecamatan.php",
                    type: "POST",
                    data: {
                        modul: 'Klasifikasi',
                        id:kecamatan
                    },
                    success: function(respond){
                        $("#klasifikasi").html(respond);
                    },
                    error: function(){
                        alert("Gagal mengambil data");
                    }
                })

                $.ajax({
                    url: "combo/combo_kecamatan.php",
                    type: "POST",
                    data: {
                        modul: 'Idpel',
                        id:kecamatan
                    },
                    success: function(respond){
                        $("#id_pel").html(respond);
                    },
                    error: function(){
                        alert("Gagal mengambil data");
                    }
                })
            });

            $("#desa").on('change', function(){
                var desa = $("#desa").val();
                $.ajax({
                    url: "combo/combo_desa.php",
                    type: "POST",
                    data: {
                        modul: 'Klasifikasi',
                        id:desa
                    },
                    success: function(respond){
                        $("#klasifikasi").html(respond);
                    },
                    error: function(){
                        alert("Gagal mengambil data");
                    }
                })

                $.ajax({
                    url: "combo/combo_desa.php",
                    type: "POST",
                    data: {
                        modul: 'Idpel',
                        id:desa
                    },
                    success: function(respond){
                        $("#id_pel").html(respond);
                    },
                    error: function(){
                        alert("Gagal mengambil data");
                    }
                })
            });

            $("#klasifikasi").on('change', function(){
                var klasifikasi = $("#klasifikasi").val();
                $.ajax({
                    url: "combo/combo_klasifikasi.php",
                    type: "POST",
                    data: {
                        modul: 'Idpel',
                        id:klasifikasi
                    },
                    success: function(respond){
                        $("#id_pel").html(respond);
                    },
                    error: function(){
                        alert("Gagal mengambil data");
                    }
                })
            });

        });

    </script>

</body>
</html>