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

$ulp = ($_SESSION["ulp"]);

$data = query("SELECT * FROM master WHERE ulp LIKE '$ulp'");
// total titik pju
$t_titik = count($data);

// total watt
$t_watt = query("SELECT SUM(daya_sedir_watt) FROM master  WHERE ulp LIKE '$ulp'");
$t_watt = $t_watt[0]["SUM(daya_sedir_watt)"];

// total va
$t_va = query("SELECT SUM(daya_sedir_va) FROM master  WHERE ulp LIKE '$ulp'");
$t_va = $t_va[0]["SUM(daya_sedir_va)"];

// total meterisasi
$t_meterisasi = COUNT(query("SELECT * FROM master WHERE klasifikasi = 'meterisasi'  AND ulp LIKE '$ulp'"));
// total tersebar
$t_tersebar = COUNT(query("SELECT * FROM master WHERE klasifikasi = 'tersebar' AND ulp LIKE '$ulp'"));
// total swadaya
$t_swadaya = COUNT(query("SELECT * FROM master WHERE klasifikasi = 'swadaya' AND ulp LIKE '$ulp'"));

// watt meterisasi
$w_meterisasi = query("SELECT SUM(daya_sedir_watt) FROM master WHERE klasifikasi = 'meterisasi' AND ulp LIKE '$ulp'");
$w_meterisasi = $w_meterisasi[0]["SUM(daya_sedir_watt)"];
// watt tersebar
$w_tersebar = query("SELECT SUM(daya_sedir_watt) FROM master WHERE klasifikasi = 'tersebar' AND ulp LIKE '$ulp'");
$w_tersebar = $w_tersebar[0]["SUM(daya_sedir_watt)"];
// watt swadaya
$w_swadaya = query("SELECT SUM(daya_sedir_watt) FROM master WHERE klasifikasi = 'swadaya' AND ulp LIKE '$ulp'");
$w_swadaya = $w_swadaya[0]["SUM(daya_sedir_watt)"];

// va meterisasi
$v_meterisasi = query("SELECT SUM(daya_sedir_va) FROM master WHERE klasifikasi = 'meterisasi' AND ulp LIKE '$ulp'");
$v_meterisasi = $v_meterisasi[0]["SUM(daya_sedir_va)"];
// va tersebar
$v_tersebar = query("SELECT SUM(daya_sedir_va) FROM master WHERE klasifikasi = 'tersebar' AND ulp LIKE '$ulp'");
$v_tersebar = $v_tersebar[0]["SUM(daya_sedir_va)"];
// va swadaya
$v_swadaya = query("SELECT SUM(daya_sedir_va) FROM master WHERE klasifikasi = 'swadaya' AND ulp LIKE '$ulp'");
$v_swadaya = $v_swadaya[0]["SUM(daya_sedir_va)"];

// total normal
$t_normal = COUNT(query("SELECT * FROM master WHERE kondisi = 'normal' AND ulp LIKE '$ulp'"));
// total nyala
$t_nyala = COUNT(query("SELECT * FROM master WHERE kondisi LIKE '%nyala%' AND ulp LIKE '$ulp'"));
// total rusak
$t_rusak = COUNT(query("SELECT * FROM master WHERE kondisi = 'rusak' AND ulp LIKE '$ulp'"));

// total request
$t_request = COUNT(query("SELECT * FROM request WHERE ulp LIKE '$ulp'"));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap.min.css">

    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <link rel="stylesheet" href="../style/style1.css">

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

        <div class="content">
            <div class="row r1">
                <div class="total">
                    <div class="row-total">
                        <div class="col-total logo">
                            <img src="../image/g3.png">
                        </div>
                        <div class="col-total text">
                            <p>Total Titik</p>
                            <h1><?= $t_titik; ?></h1>
                        </div>
                    </div>
                    <div class="row-total">
                        <div class="col-total logo">
                            <img src="../image/g1.png">
                        </div>
                        <div class="col-total text">
                            <p>Total Watt</p>
                            <h1><?= $t_watt; ?></h1>
                        </div>
                    </div>
                    <div class="row-total">
                        <div class="col-total logo">
                            <img src="../image/g2.png">
                        </div>
                        <div class="col-total text">
                            <p>Total VA</p>
                            <h1><?= $t_va; ?></h1>
                        </div>
                    </div>
                </div>
                <div class="chart1">
                    <h3>Total Titik</h3>
                    <canvas id="chart1" width="250" height="250"></canvas>
                </div>
                <div class="chart2">
                    <h3>Total Watt</h3>
                    <canvas id="chart2" width="250" height="250"></canvas>
                </div>
                <div class="chart3">
                    <h3>Total VA</h3>
                    <canvas id="chart3" width="250" height="250"></canvas>
                </div>
            </div>
            <div class="row r2">
                <div class="chart4">
                    <h3>Jumlah PJU / Kondisi</h3>
                    <canvas id="chart4" width="300" height="200"></canvas>
                </div>
                <div class="chart5">
                    <h3>Jumlah Request</h3>
                    <canvas id="chart5" width="300" height="200"></canvas>
                </div>
            </div>
            <div class="row r3">
                <h3>Jumlah Titik PJU / Kecamatan</h3>
            </div>
            <div class="row r4">
                <div class="col-table">
                    <table>
                        <tr>
                            <th>No</th>
                            <th>Kecamatan</th>
                            <th>Meterisasi</th>
                            <th>Swadaya</th>
                            <th>Tersebar</th>
                            <th>Total Titik</th>
                            <th>Aksi</th>
                        </tr>

                        <?php
                            // Hitung jumlah kecamtan
                            $temp = 0;
                            $j_temp_kecamatan = intval(query("SELECT COUNT(DISTINCT kecamatan) FROM master WHERE ulp LIKE '$ulp'")[0]["COUNT(DISTINCT kecamatan)"]);
                            $temp = $temp + $j_temp_kecamatan;
                            
                            $temp2 = $temp - 1;
                            $no = 0;
                        ?>


                        <?php
                            // Hitung jumlah kecamatan
                            $kecamatan_all = query("SELECT DISTINCT kecamatan FROM master WHERE ulp LIKE '$ulp'");
                            $j_kecamatan = intval(query("SELECT COUNT(DISTINCT kecamatan) FROM master WHERE ulp LIKE '$ulp'")[0]["COUNT(DISTINCT kecamatan)"]);
                                ?>
                                <?php for($x=0; $x<$j_kecamatan; $x++): ?>
                                    <?php $kecamatan = $kecamatan_all[$x]["kecamatan"];?>
                                    <?php
                                        $j_meterisasi = COUNT(query("SELECT * FROM master WHERE kecamatan LIKE '$kecamatan' AND ulp LIKE '$ulp' AND klasifikasi = 'meterisasi'"));
                                        $j_swadaya = COUNT(query("SELECT * FROM master WHERE kecamatan LIKE '$kecamatan' AND ulp LIKE '$ulp' AND klasifikasi = 'swadaya'"));
                                        $j_tersebar = COUNT(query("SELECT * FROM master WHERE kecamatan LIKE '$kecamatan' AND ulp LIKE '$ulp' AND klasifikasi = 'tersebar'"));
                                        $total_titik = $j_meterisasi + $j_swadaya + $j_tersebar;
                                    ?>
                                    <tr>
                                        <td><?php echo ($no + $temp - $temp2); ?></td>
                                        <td><?php echo $kecamatan; ?></td>
                                        <td><?php echo $j_meterisasi; ?></td>
                                        <td><?php echo $j_swadaya; ?></td>
                                        <td><?php echo $j_tersebar; ?></td>
                                        <td><?php echo $total_titik; ?></td>
                                        <td>
                                            <form action="show_map.php" method="post">
                                                <button type="submit" name="show" class="btn_map">Show in Map</button>
                                                <input type="hidden" name="kecamatan" value="<?php echo $kecamatan; ?>">
                                                <input type="hidden" name="ulp" value="<?php echo $ulp; ?>">
                                            </form>
                                        </td>
                                    </tr>
                                    <?php $temp2= $temp2-1 ;?>
                                <?php endfor; ?>

                        <tr>
                            <th>-</th>
                            <th>TOTAL</th>
                            <th><?= $t_meterisasi; ?></th>
                            <th><?= $t_swadaya; ?></th>
                            <th><?= $t_tersebar; ?></th>
                            <th><?= $t_titik; ?></th>
                            <th>-</th>
                        </tr>
                    </table>  
                </div>
            </div>
        </div>

    </div>

    <!-- CHART -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.min.js" integrity="sha512-R/QOHLpV1Ggq22vfDAWYOaMd5RopHrJNMxi8/lJu8Oihwi4Ho4BRFeiMiCefn9rasajKjnx9/fTQ/xkWnkDACg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>

        // data table
        $(document).ready(function () {
            $('#example').DataTable();
        });

        // chart total titik 
        const ctx1 = document.getElementById('chart1');

        new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['Meterisasi', 'Tersebar', 'Swadaya'],
            datasets: [{
                label: 'Jumlah Titik',
                barPercentage: 1,
                data: [<?= $t_meterisasi; ?>, <?= $t_tersebar; ?>, <?= $t_swadaya; ?>],
                backgroundColor: [
                'rgba(255, 99, 132, 0.5)',              
                'rgba(255, 205, 86, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                ],
                borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 205, 86)',
                'rgb(153, 102, 255)',
                ],
                borderWidth: 1
            }]
        },
        plugins: [ChartDataLabels],
        options: {
            plugins: {
                legend: {
                    display: false,
                },
                datalabels: {
                    anchor: 'end',
                    align: 'bottom',
                },
                decimation: {
                    enabled: true,
                },
            },
            
            scales: {
            y: {
                beginAtZero: true

            }
            }
        },
        });


        // chart total watt 
        const ctx2 = document.getElementById('chart2');

        new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['Meterisasi', 'Tersebar', 'Swadaya'],
            datasets: [{
                label: 'Jumlah Watt',
                barPercentage: 1,
                data: [<?= $w_meterisasi; ?>, <?= $w_tersebar; ?>, <?= $w_swadaya; ?>],
                backgroundColor: [
                'rgba(255, 99, 132, 0.5)',              
                'rgba(255, 205, 86, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                ],
                borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 205, 86)',
                'rgb(153, 102, 255)',
                ],
                borderWidth: 1
            }]
        },
        plugins: [ChartDataLabels],
        options: {
            plugins: {
                legend: {
                    display: false,
                },
                datalabels: {
                    anchor: 'end',
                    align: 'bottom',
                },
                decimation: {
                    enabled: true,
                },
            },
            
            scales: {
            y: {
                beginAtZero: true

            }
            }
        }
        });


        // chart total va
        const ctx3 = document.getElementById('chart3');

        new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: ['Meterisasi', 'Tersebar', 'Swadaya'],
            datasets: [{
                label: 'Jumlah VA',
                barPercentage: 1,
                data: [<?= $v_meterisasi; ?>, <?= $v_tersebar; ?>, <?= $v_swadaya; ?>],
                backgroundColor: [
                'rgba(255, 99, 132, 0.5)',              
                'rgba(255, 205, 86, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                ],
                borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 205, 86)',
                'rgb(153, 102, 255)',
                ],
                borderWidth: 1
            }]
        },
        plugins: [ChartDataLabels],
        options: {
            plugins: {
                legend: {
                    display: false,
                },
                datalabels: {
                    anchor: 'end',
                    align: 'bottom',
                },
                decimation: {
                    enabled: true,
                },
            },
            
            scales: {
            y: {
                beginAtZero: true

            }
            }
        }
        });

        // chart pju per kondisi
        const ctx4 = document.getElementById('chart4');

        new Chart(ctx4, {
        type: 'pie',
        data: {
            labels: [
                'Normal',
                'Nyala 24 Jam',
                'Rusak'
            ],
            datasets: [{
                label: 'Jumlah Titik',
                data: [<?= $t_normal; ?>, <?= $t_nyala; ?>, <?= $t_rusak; ?>],
                backgroundColor: [
                'rgba(255, 159, 64, 0.4)',
                'rgba(75, 192, 192, 0.4)',
                'rgb(255, 99, 132, 0.4)',
                ],
                borderColor: [
                'rgba(255, 159, 64)',
                'rgba(75, 192, 192)',
                'rgb(255, 99, 132)',
                ],
                borderWidth: 1,
                hoverOffset: 4,
            }],
        },
        plugins: [ChartDataLabels],
        });

        // chart request
        const ctx5 = document.getElementById('chart5');

        new Chart(ctx5, {
        type: 'doughnut',
        data: {
            labels: [
                'Pending',
                'Selesai'
            ],
            datasets: [{
                label: 'Jumlah Titik',
                data: [<?= $t_request; ?>, 1],
                backgroundColor: [
                'rgba(255, 99, 132, 0.4)',
                'rgba(153, 102, 255, 0.4)',
                ],
                borderColor: [
                'rgba(255, 99, 132)',
                'rgba(153, 102, 255)',
                ],
                borderWidth: 1,
                hoverOffset: 4,
            }],
        },
        plugins: [ChartDataLabels],
        });



    </script>

</body>
</html>