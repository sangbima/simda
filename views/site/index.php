<?php

/* @var $this yii\web\View */

$this->title = 'Dashboard';
?>
<div class="site-index">

    <div class="row">
        <div class="col-md-2">
            <div class="panel panel-primary">
                <div class="panel-heading panel-heading-complementary "><strong>KIB A</strong><i class="glyphicon glyphicon-tree-deciduous pull-right"></i></div>
                <div class="panel-body">
                    <?= $countKiba ? $countKiba : 0 ?>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="panel panel-primary">
                <div class="panel-heading"><strong>KIB B</strong><i class="glyphicon glyphicon-cog pull-right"></i></div>
                <div class="panel-body">
                    <?= $countKibb ? $countKibb : 0 ?>
                </div>
            </div>
        </div>
        <div class="col-md-2">
           <div class="panel panel-warning">
                <div class="panel-heading"><strong>KIB C</strong><i class="fa fa-car pull-right"></i></div>
                <div class="panel-body">
                    <?= $countKibc ? $countKibc : 0 ?>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="panel panel-success">
                <div class="panel-heading"><strong>KIB D</strong><i class="glyphicon glyphicon-road pull-right"></i></div>
                <div class="panel-body">
                    <?= $countKibd ? $countKibd : 0 ?>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="panel panel-danger">
                <div class="panel-heading"><strong>KIB E</strong><i class="glyphicon glyphicon-book pull-right"></i></div>
                <div class="panel-body">
                    <?= $countKibe ? $countKibe : 0 ?>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="panel panel-info">
                <div class="panel-heading"><strong>KIB F</strong><i class="glyphicon glyphicon-equalizer pull-right"></i></div>
                <div class="panel-body">
                    <?= $countKibf ? $countKibf : 0 ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>PENGUMUMAN !!!</strong><i class="glyphicon glyphicon-bullhorn pull-right"></i></div>
                <div class="panel-body">
                    <div class="list-group">
                    <?php foreach($announcements as $announcement) {?>
                      <div class="list-group-item">
                        <div class="row-action-primary">
                            <i class="glyphicon glyphicon-folder-close"></i>
                        </div>
                        <div class="row-content">
                            <div class="least-content"><?= date('d-m-Y', strtotime($announcement->publish_start)) ?></div>
                            <h4 class="list-group-item-heading"><?= $announcement->title ?></h4>
                            <p class="list-group-item-text"><?= $announcement->content ?></p>
                        </div>
                      </div>
                      <div class="list-group-separator"></div>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>REKAPITULASI DATA MASTER LOKASI</strong><i class="glyphicon glyphicon-map-marker pull-right"></i></div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <td>Provinsi</td>
                            <td><?= $countProvince ? $countProvince : 0 ?></td>
                        </tr>
                        <tr>
                            <td>Kabupaten/Kota</td>
                            <td><?= $countKabupatenkota ? $countKabupatenkota : 0 ?></td>
                        </tr>
                        <tr>
                            <td>Kecamatan</td>
                            <td><?= $countKecamatan ? $countKecamatan : 0 ?></td>
                        </tr>
                        <tr>
                            <td>Kelurahan/Desa</td>
                            <td><?= $countDesakelurahan ? $countDesakelurahan : 0 ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>REKAPITULASI DATA MASTER ORGANISASI</strong><i class="glyphicon glyphicon-tasks pull-right"></i></div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <td>Bidang Pemerintahan</td>
                            <td><?= $countGovMain ? $countGovMain : 0?></td>
                        </tr>
                        <tr>
                            <td>Pengguna Barang</td>
                            <td><?= $countGovUser ? $countGovUser : 0 ?></td>
                        </tr>
                        <tr>
                            <td>Kuasa Pengguna</td>
                            <td><?= $countGovPrivilege ? $countGovPrivilege : 0 ?></td>
                        </tr>
                       <tr>
                            <td>Unit Pengguna</td>
                            <td><?= $countGovPrivilege ? $countGovPrivilege : 0 ?></td>
                        </tr>
                        <tr>
                            <td>Operator</td>
                            <td><?= $countUser ? $countUser : 0 ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>REKAPITULASI DATA MASTER BARANG</strong><i class="glyphicon glyphicon-list-alt pull-right"></i></div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <td>Golongan Barang</td>
                            <td><?= $countProductType ? $countProductType : 0 ?></td>
                        </tr>
                        <tr>
                            <td>Bidang Barang</td>
                            <td><?= $countProductArea ? $countProductArea : 0 ?></td>
                        </tr>
                        <tr>
                            <td>Kelompok Barang</td>
                            <td><?= $countProductGroup ? $countProductGroup : 0 ?></td>
                        </tr>
                        <tr>
                            <td>Sub Kelompok Barang</td>
                            <td><?= $countProductGroupSub1 ? $countProductGroupSub1 : 0 ?></td>
                        </tr>
                        <tr>
                            <td>Sub-Sub Kelompok Barang</td>
                            <td><?= $countProductGroupSub2 ? $countProductGroupSub2 : 0 ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>REKAPITULASI ENTRI DATA</strong><i class="glyphicon glyphicon-hdd pull-right"></i></div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <td>Total Data</td>
                            <td>100</td>
                        </tr>
                        <tr>
                            <td>Tahun Ini</td>
                            <td>100</td>
                        </tr>
                        <tr>
                            <td>Bulan Ini</td>
                            <td>100</td>
                        </tr>
                        <tr>
                            <td>Minggu Ini</td>
                            <td>100</td>
                        </tr>
                        <tr>
                            <td>Hari Ini</td>
                            <td>100</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
