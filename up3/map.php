<?php
session_start();
require '../function.php';

if(!isset($_SESSION["login"]) ) {
    header("Location: ../index.php");
    exit;
}

$up3 = ($_SESSION["up3"]);
$_SESSION["up3"] = $up3;

// OPTION KAB/KOTA
$kab_kota = query("SELECT DISTINCT kab_kota FROM master WHERE up3 LIKE '$up3'");
$j_kab_kota = intval(query("SELECT COUNT(DISTINCT kab_kota) FROM master WHERE up3 LIKE '$up3'")[0]["COUNT(DISTINCT kab_kota)"]);

$kecamatan = query("SELECT DISTINCT kecamatan FROM master WHERE up3 LIKE '$up3'");
$j_kecamatan = intval(query("SELECT COUNT(DISTINCT kecamatan) FROM master WHERE up3 LIKE '$up3'")[0]["COUNT(DISTINCT kecamatan)"]);

// OPTION ALAMAT
$desa = query("SELECT DISTINCT desa FROM master WHERE up3 LIKE '$up3'");
$j_desa = intval(query("SELECT COUNT(DISTINCT desa) FROM master WHERE up3 LIKE '$up3'")[0]["COUNT(DISTINCT desa)"]);

// OPTION KLASIFIKASI
$klasifikasi = query("SELECT DISTINCT klasifikasi FROM master WHERE up3 LIKE '$up3'");
$j_klasifikasi = intval(query("SELECT COUNT(DISTINCT klasifikasi) FROM master WHERE up3 LIKE '$up3'")[0]["COUNT(DISTINCT klasifikasi)"]);

// OPTION IDPEL
$id_pel = query("SELECT DISTINCT id_pel FROM master WHERE up3 LIKE '$up3'");
$j_id_pel = intval(query("SELECT COUNT(DISTINCT id_pel) FROM master WHERE up3 LIKE '$up3'")[0]["COUNT(DISTINCT id_pel)"]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" conte nt="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
    <!-- Leaflet's JS -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <link rel="stylesheet" href="../style/style4.css">

</head>
<body>
    
    <div class="container">
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
                    <form action="map.php" method="POST">
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
                        <input type="submit" value="Show in Map" name="submit" class="submit" id="submit">
                    </form>
                </div>
            </div>
            <div class="main">
                <div id="map"></div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

    <script>

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

        //MAP 
        var map = L.map('map').setView([4.0420694,94.0055432], 7);

        //TILE LAYER
        var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        });
        osm.addTo(map);

        var googleStreets = L.tileLayer('http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}',{
            maxZoom: 20,
            subdomains:['mt0','mt1','mt2','mt3']
        });
        googleStreets.addTo(map);

        var googleSat = L.tileLayer('http://{s}.google.com/vt?lyrs=s&x={x}&y={y}&z={z}',{
            maxZoom: 20,
            subdomains:['mt0','mt1','mt2','mt3']
        });
        googleSat.addTo(map);

        //ICON
        var icon_meterisasi = L.icon({
            iconUrl: '../image/green_bulb_icon.png',
            iconSize: [30, 30],
            iconAnchor: [30, 30]
        })

        var icon_tersebar = L.icon({
            iconUrl: '../image/yellow_bulb_icon.png',
            iconSize: [30, 30],
            iconAnchor: [30, 30]
        })

        var icon_swadaya = L.icon({
            iconUrl: '../image/red_bulb_icon.png',
            iconSize: [30, 30],
            iconAnchor: [30, 30]
        })

        // CONTROL LAYERS
        var baseLayers = {
            'OpenStreetMap': osm,
            'Satellite' : googleSat,
            'Street' : googleStreets,
        };

        var layerControl = L.control.layers(baseLayers, null).addTo(map);
        var layerMeterisasi = L.layerGroup().addTo(map);
        var layerTersebar = L.layerGroup().addTo(map);
        var layerSwadaya = L.layerGroup().addTo(map);
        
        var swadayaMarker = [];
        var meterisasiMarker = [];
        var tersebarMarker = [];

        $(document).ready(function(){
            // onclick submit
            $("#submit").on('click', function(e){

                for(var i = 0; i < swadayaMarker.length; i++){
                    layerSwadaya.removeLayer(swadayaMarker[i]);
                }

                for(var i = 0; i < meterisasiMarker.length; i++){
                    layerMeterisasi.removeLayer(meterisasiMarker[i]);
                }

                for(var i = 0; i < tersebarMarker.length; i++){
                    layerTersebar.removeLayer(tersebarMarker[i]);
                }
                
                layerControl.removeLayer(layerMeterisasi);
                layerControl.removeLayer(layerTersebar);
                layerControl.removeLayer(layerSwadaya);

                var kab_kota = $("#kab_kota").val();
                var kecamatan = $("#kecamatan").val();
                var desa = $("#desa").val();
                var klasifikasi = $("#klasifikasi").val();
                var id_pel = $("#id_pel").val();

                // get data from database
                $.ajax({
                    url: "combo/get_data.php",
                    type: "POST",
                    data: {
                        modul: 'Map',
                        kab_kota:kab_kota,
                        kecamatan:kecamatan,
                        desa:desa,
                        klasifikasi:klasifikasi,
                        id_pel:id_pel
                    },
                    success: function(respond){
                        var result = JSON.parse(respond);
                        $.each(result, function(key,val){
                            // console.log(val.desa);
                            if(val.klasifikasi=="SWADAYA"){
                                swadaya = L.marker([val.latitudey,val.longitudex], {icon:icon_swadaya})
                                .bindPopup('No Item : '+val.no_item+'<br>' +
                                'Kab/Kota : '+val.kab_kota+'<br>' +
                                'Kecamatan : '+val.kecamatan+'<br>' +
                                'Desa : '+val.desa+'<br>' +
                                'Induk : '+val.induk+'<br>' +
                                'UP3 : '+val.up3+'<br>' +
                                'ULP : '+val.ulp+'<br>' +
                                'Klasifikasi : '+val.klasifikasi+'<br>' +
                                'Tipe : '+val.tipe+'<br>' +
                                'Watt : '+val.watt+'<br>' +
                                'Fkali : '+val.fkali+'<br>' +
                                'Daya SE Dir Kelompok : '+val.daya_sedir_kelompok+'<br>' +
                                'Daya SE Dir Watt : '+val.daya_sedir_watt+'<br>' +
                                'Cosphi : '+val.cosphi+'<br>' +
                                'Daya SE Dir VA : '+val.daya_sedir_va+'<br>' +
                                'Kondisi : '+val.kondisi+'<br>' +
                                'Latitudey : '+val.latitudey+'<br>' +
                                'Longitudex : '+val.longitudex+'<br>' +
                                'Gol SE Dir : '+val.gol_sedir+'<br>' +
                                'Id Pel : '+val.id_pel+'<br>' +
                                'Keterangan : '+val.keterangan+'<br>' +
                                'Petugas Survey : '+val.petugas_survey+'<br>' +
                                'Tanggal Jam Survey : '+val.tanggaljam_survey+'<br>' +
                                'No Gardu : '+val.no_gardu+'<br>' +
                                '' + '<img src="'+val.link_foto+'" width=150px height=200px></img>' +
                                '');
                                swadayaMarker.push(swadaya);
                                layerSwadaya.addLayer(swadaya);
                            }else if(val.klasifikasi=="METERISASI"){
                                meterisasi = L.marker([val.latitudey,val.longitudex], {icon:icon_meterisasi})
                                .bindPopup('No Item : '+val.no_item+'<br>' +
                                'Kab/Kota : '+val.kab_kota+'<br>' +
                                'Kecamatan : '+val.kecamatan+'<br>' +
                                'Desa : '+val.desa+'<br>' +
                                'Induk : '+val.induk+'<br>' +
                                'UP3 : '+val.up3+'<br>' +
                                'ULP : '+val.ulp+'<br>' +
                                'Klasifikasi : '+val.klasifikasi+'<br>' +
                                'Tipe : '+val.tipe+'<br>' +
                                'Watt : '+val.watt+'<br>' +
                                'Fkali : '+val.fkali+'<br>' +
                                'Daya SE Dir Kelompok : '+val.daya_sedir_kelompok+'<br>' +
                                'Daya SE Dir Watt : '+val.daya_sedir_watt+'<br>' +
                                'Cosphi : '+val.cosphi+'<br>' +
                                'Daya SE Dir VA : '+val.daya_sedir_va+'<br>' +
                                'Kondisi : '+val.kondisi+'<br>' +
                                'Latitudey : '+val.latitudey+'<br>' +
                                'Longitudex : '+val.longitudex+'<br>' +
                                'Gol SE Dir : '+val.gol_sedir+'<br>' +
                                'Id Pel : '+val.id_pel+'<br>' +
                                'Keterangan : '+val.keterangan+'<br>' +
                                'Petugas Survey : '+val.petugas_survey+'<br>' +
                                'Tanggal Jam Survey : '+val.tanggaljam_survey+'<br>' +
                                'No Gardu : '+val.no_gardu+'<br>' +
                                '' + '<img src="'+val.link_foto+'" width=150px height=200px></img>' +
                                '');
                                meterisasiMarker.push(meterisasi);
                                layerMeterisasi.addLayer(meterisasi);
                            }else if(val.klasifikasi=="TERSEBAR"){
                                tersebar = L.marker([val.latitudey,val.longitudex], {icon:icon_tersebar})
                                .bindPopup('No Item : '+val.no_item+'<br>' +
                                'Kab/Kota : '+val.kab_kota+'<br>' +
                                'Kecamatan : '+val.kecamatan+'<br>' +
                                'Desa : '+val.desa+'<br>' +
                                'Induk : '+val.induk+'<br>' +
                                'UP3 : '+val.up3+'<br>' +
                                'ULP : '+val.ulp+'<br>' +
                                'Klasifikasi : '+val.klasifikasi+'<br>' +
                                'Tipe : '+val.tipe+'<br>' +
                                'Watt : '+val.watt+'<br>' +
                                'Fkali : '+val.fkali+'<br>' +
                                'Daya SE Dir Kelompok : '+val.daya_sedir_kelompok+'<br>' +
                                'Daya SE Dir Watt : '+val.daya_sedir_watt+'<br>' +
                                'Cosphi : '+val.cosphi+'<br>' +
                                'Daya SE Dir VA : '+val.daya_sedir_va+'<br>' +
                                'Kondisi : '+val.kondisi+'<br>' +
                                'Latitudey : '+val.latitudey+'<br>' +
                                'Longitudex : '+val.longitudex+'<br>' +
                                'Gol SE Dir : '+val.gol_sedir+'<br>' +
                                'Id Pel : '+val.id_pel+'<br>' +
                                'Keterangan : '+val.keterangan+'<br>' +
                                'Petugas Survey : '+val.petugas_survey+'<br>' +
                                'Tanggal Jam Survey : '+val.tanggaljam_survey+'<br>' +
                                'No Gardu : '+val.no_gardu+'<br>' +
                                '' + '<img src="'+val.link_foto+'" width=150px height=200px></img>' +
                                '');
                                tersebarMarker.push(tersebar);
                                layerTersebar.addLayer(tersebar);
                            }

                        })
                        layerControl.addOverlay(layerSwadaya, "Swadaya");
                        layerControl.addOverlay(layerMeterisasi, "Meterisasi");
                        layerControl.addOverlay(layerTersebar, "Tersebar");
                    },
                    error: function(){
                        alert("Gagal mengambil data");
                    }
                })
                e.preventDefault();
            });
        });
       
       
               
    </script>

</body>
</html>