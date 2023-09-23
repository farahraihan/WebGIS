<?php

    session_start();
    require '../function.php';

    $level = $_SESSION["level"];
    if( !isset($_SESSION["login"])) {
        if($level!=="6"){
            header("Location: ../index.php");
            exit;
        }
    }


    $kecamatan = $_POST["kecamatan"];
    $ulp = $_POST["ulp"];
    $kecamatan2 = ucwords(strtolower($kecamatan));


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
    <!-- Leaflet's JS -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
    <link rel="stylesheet" href="../style/style7.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="text">
                <p><?php echo $kecamatan2; ?></p>
            </div>
            <div class="back">
                <a href="index.php">Kembali</a>
            </div>
        </div>
        <div class="body">
            <div class="map" id="map"></div>
        </div>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>

    <script>

        //MAP 
        var map = L.map('map').setView([3.9949619,96.5810327], 7);

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


    var kecamatan = <?php echo json_encode(strval($kecamatan)) ?>;
    var ulp = <?php echo json_encode(strval($ulp)) ?>;

    var swadayaMarker = [];
    var meterisasiMarker = [];
    var tersebarMarker = [];

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


    // get data from database
    $.ajax({
        url: "combo/show_map.php",
        type: "POST",
        data: {
            modul: 'Map',
            kecamatan:kecamatan,
            ulp:ulp
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

       
    </script>

</body>
</html>