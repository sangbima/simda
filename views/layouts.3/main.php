<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\SimdadAsset;

SimdadAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    $menuItems[] = [
    'label' => '<i class="material-icons">dashboard</i> Dashboard', 'url' => ['#'],
    'template' => '<a href="{url}" class="href_class">{label}</a>',
    ];
  $menuItems[] = [
    'label' => '<i class="material-icons">cloud</i> Cloudbox', 'url' => ['#'],
    'template' => '<a href="{url}" class="href_class">{label}</a>',
    ];
  $menuItems[] = ['label' => '<i class="material-icons">search</i> Telusuri Aset', 'url' => ['#']];
  $menuItems[] = [
    'label' => '<i class="material-icons">input</i> Transaksi', 'url' => ['#'],
    'items' => [
        ['label' => 'Mutasi Tambah', 'url' => ['#']],
        ['label' => 'Setup Ruangan', 'url' => ['#']],
        ['label' => 'KIR', 'url' => ['#']],
        ['label' => 'Mutasi Pindah', 'url' => ['#']],
        ['label' => 'Mutasi Hapus', 'url' => ['#']],
        ['label' => 'Kapitalisasi', 'url' => ['#']],
        ['label' => 'Operator', 'url' => ['#']],
      ]
    ];
  $menuItems[] = [
    'label' => '<i class="material-icons">poll</i> Laporan', 'url' => ['#'],
    'items' => [
        ['label' => 'Daftar Barang', 'url' => ['#']],
        ['label' => 'Daftar Pengguna', 'url' => ['#']],
        ['label' => 'Kartu Inventaris Barang', 'url' => ['#']],
        ['label' => 'Kartu Inventaris Ruangan', 'url' => ['#']],
        // '<li role="separator" class="divider"></li>',
        ['label' => 'Rekap Iventaris Barang', 'url' => ['#']],
        // '<li role="separator" class="divider"></li>',
        ['label' => 'Penyusutan Barang', 'url' => ['#']],
        ['label' => 'Mutasi Barang', 'url' => ['#']],
        ['label' => 'Kapitalisasi', 'url' => ['#']],
      ]
    ];
  $menuItems[] = [
    'label' => '<i class="material-icons">domain</i> Master Organisasi', 'url' => ['#'],
    'items' => [
        ['label' => 'Bidang Pemerintahan', 'url' => ['#']],
        ['label' => 'Pengguna Barang', 'url' => ['#']],
        ['label' => 'Kuasa Pengguna', 'url' => ['#']],
        ['label' => 'Unit Pengguna', 'url' => ['#']],
      ]
    ];
    $menuItems[] = [
    'label' => '<i class="material-icons">location_on</i> Master Lokasi', 'url' => ['#'],
    'items' => [
        ['label' => 'Kecamatan', 'url' => ['#']],
        ['label' => 'Kelurahan', 'url' => ['#']],
      ]
    ];
    $menuItems[] = [
    'label' => '<i class="material-icons">dvr</i> Master Barang', 'url' => ['#'],
    'items' => [
        ['label' => 'Golongan Barang', 'url' => ['#']],
        ['label' => 'Bidang Barang', 'url' => ['#']],
        ['label' => 'Kelompok Barang', 'url' => ['#']],
        ['label' => 'Sub Kelompok Barang', 'url' => ['#']],
        ['label' => 'Sub-Sub Kelompok Barang', 'url' => ['#']],
      ]
    ];
    
    NavBar::begin([
        'brandLabel' => '<span>SIM</span>DAD',
        'brandUrl' => Yii::$app->homeUrl,
        'innerContainerOptions' => ['class'=>'container-fluid'],
        'brandOptions' => ['class' => 'navbar-brand'],
        'options' => [
            'id' => 'myNavmenu',
            'class' => 'navmenu navmenu-default navmenu-fixed-left offcanvas',
        ],
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'encodeLabels' => false,
        'items' => $menuItems,
    ]);

    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
