<?php
session_start();
require '../function.php';

$level = $_SESSION["level"];
if( !isset($_SESSION["login"])) {
    if($level!=="5"){
        header("Location: ../index.php");
        exit;
    }
}

$ulp = ($_SESSION["ulp"]);

$data = query("SELECT * FROM request WHERE ulp LIKE '$ulp'");
$t_data = intval(count($data));

if(isset($_POST["approve"])){
    $no_item = $_POST["no_item"];
    $no_request = $_POST["no_request"];
    $petugas = $_POST["petugas"];
    $tgl = date("Y-m-d h:i:s");
    $status = "1";

    $approve = update("UPDATE request SET status='$status', petugas_approval_pln='$petugas', tgl_approval_pln='$tgl' WHERE no_request='$no_request'");
}

if(isset($_POST["reject"])){
    $no_item = $_POST["no_item"];
    $no_request = $_POST["no_request"];
    $petugas = $_POST["petugas"];
    $tgl = date("Y-m-d h:i:s");
    $status = "2";

    $approve = update("UPDATE request SET status='$status', petugas_approval_pln='$petugas', tgl_approval_pln='$tgl' WHERE no_request='$no_request'");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" conte nt="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approval</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <link rel="stylesheet" href="../style/style2.css">

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
                <a href="tambah_data.php">
                    <i class="fa-solid fa-square-plus fa-3x"></i>
                </a>
                <a class="tambah_data" href="tambah_data.php">Tambah Data</a>
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
                            <th>Aksi</th>
                            <th>Status</th>
                            <th>Detail</th>
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
                            <td>
                                <?php if($row["status"]==0): ?>
                                    <button type="button" class="approve" data-toggle="modal" data-target="#modal_approve<?= $row["no_item"] ?>">Approve</button>
                                    <button type="button" class="reject" data-toggle="modal" data-target="#modal_reject<?= $row["no_item"] ?>">Reject</button>
                                <?php else: ?>
                                    <button class="approve2">Approve</button>
                                    <button class="reject2">Reject</button>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($row["status"]==0): ?>
                                    <p class="status_approve" style="border: 1px solid rgba(255, 166, 0, 0.6); background-color: rgba(255, 255, 0, 0.2);">Belum Approve</p>
                                <?php elseif($row["status"]==1): ?>
                                    <p class="status_approve" style="border: 1px solid rgba(61, 235, 61, 0.4); background-color: rgba(61, 235, 61, 0.2);">Sudah Approve</p>
                                <?php elseif($row["status"]==2): ?>
                                    <p class="status_approve" style="border: 1px solid rgba(255, 0, 0, 0.5); background-color: rgba(255, 0, 0, 0.2);">Rejected PLN</p>
                                <?php endif; ?>
                            </td>
                            <td>
                                <button type="button" class="btn button-modal" data-toggle="modal" data-target="#modal_detail<?= $row["no_item"] ?>">i</button>
                                <input type="hidden" name="iddata" value="<?= $row["no_item"] ?>">
                            </td>
                        </tr>

                        <!-- Modal Approve-->
                        <div class="modal fade approve_modal" id="modal_approve<?= $row["no_item"] ?>"  role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Approve Request</h4>
                                </div>
                                <form method="post">
                                <div class="modal-body">
                                    <input type="text" name="no_item" value="<?= $row["no_item"] ?>" placeholder="No Item">
                                    <input type="text" name="no_request" value="<?= $row["no_request"] ?>" placeholder="No Request">
                                    <input type="text" name="petugas" placeholder="Nama Petugas">
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="button_approve" name="approve">Approve</button>
                                </div>
                                </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Reject-->
                        <div class="modal fade reject_modal" id="modal_reject<?= $row["no_item"] ?>"  role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Reject Request</h4>
                                </div>
                                <form method="post">
                                <div class="modal-body">
                                    <input type="text" name="no_item" value="<?= $row["no_item"] ?>" placeholder="No Item">
                                    <input type="text" name="no_request" value="<?= $row["no_request"] ?>" placeholder="No Request">
                                    <input type="text" name="petugas" placeholder="Nama Petugas">
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="button_reject" name="reject">Reject</button>
                                </div>
                                </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Detail-->
                        <div class="modal fade detail_modal" id="modal_detail<?= $row["no_item"] ?>" role="dialog">
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
                                                No Request<br> 
                                                Id Pel<br>
                                                Tgl Survey<br>
                                                Petugas Survey<br>
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
                                                Tgl Approval<br>
                                                Petugas Approval<br>
                                        </div>
                                        <div class="item2">
                                                : <?= $row["no_item"]; ?><br> 
                                                : <?= $row["no_request"]; ?><br>
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
                                                : <?= $row["tgl_approval_pln"]; ?><br>
                                                : <?= $row["petugas_approval_pln"]; ?><br>
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
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>

</body>
</html>