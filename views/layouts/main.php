<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
// use kartik\nav\NavX;
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
<header>
    <?php
    if(\Yii::$app->user->isGuest){
        $menuItemsRight[] = ['label'=> '<i class="glyphicon glyphicon-log-in"></i> Login', 'url'=> ['/site/login']];
    } else {
        $menuItems[] = [
        'label' => '<i class="glyphicon glyphicon-th-list"></i> Dashboard', 'url' => ['/site/index'],
        'template' => '<a href="{url}" class="href_class">{label}</a>',
        ];
      $menuItems[] = [
        'label' => '<i class="glyphicon glyphicon-cloud"></i> Cloudbox', 'url' => ['#'],
        'template' => '<a href="{url}" class="href_class">{label}</a>',
        ];
      $menuItems[] = ['label' => '<i class="glyphicon glyphicon-search"></i> Telusuri Aset', 'url' => ['#']];
      $menuItems[] = [
        'label' => '<i class="glyphicon glyphicon-credit-card"></i> Transaksi', 'url' => ['#'],
        'items' => [
            ['label' => 'Mutasi Tambah', 'url' => ['mutasi/index']],
            ['label' => 'Setup Ruangan', 'url' => ['room/index']],
            ['label' => 'KIR', 'url' => ['#']],
            ['label' => 'Mutasi Pindah', 'url' => ['#']],
            ['label' => 'Mutasi Hapus', 'url' => ['#']],
            ['label' => 'Kapitalisasi', 'url' => ['#']],
            ['label' => 'Operator', 'url' => ['#']],
            ['label' => 'Pengumuman', 'url' => ['announcement/index']],
          ]
        ];
      $menuItems[] = [
        'label' => '<i class="glyphicon glyphicon-stats"></i> Laporan', 'url' => ['#'],
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
        'label' => '<i class="glyphicon glyphicon-tasks"></i> Master Organisasi', 'url' => ['#'],
        'items' => [
            ['label' => 'Bidang Pemerintahan', 'url' => ['gov-main/index']],
            ['label' => 'Pengguna Barang', 'url' => ['gov-user/index']],
            ['label' => 'Kuasa Pengguna', 'url' => ['gov-privilege/index']],
            ['label' => 'Unit Pengguna', 'url' => ['gov-unit/index']],
          ]
        ];
        $menuItems[] = [
        'label' => '<i class="glyphicon glyphicon-map-marker"></i> Master Lokasi', 'url' => ['#'],
        'items' => [
            ['label' => 'Provinsi', 'url' => ['province/index']],
            ['label' => 'Kabupaten - Kota', 'url' => ['kabupatenkota/index']],
            ['label' => 'Kecamatan', 'url' => ['kecamatan/index']],
            ['label' => 'Desa - Kelurahan', 'url' => ['desakelurahan/index']],
          ]
        ];
        $menuItems[] = [
        'label' => '<i class="glyphicon glyphicon-briefcase"></i> Master Barang', 'url' => ['#'],
        'items' => [
            ['label' => 'Golongan Barang', 'url' => ['product-type/index']],
            ['label' => 'Bidang Barang', 'url' => ['product-area/index']],
            ['label' => 'Kelompok Barang', 'url' => ['product-group/index']],
            ['label' => 'Sub Kelompok Barang', 'url' => ['product-group-sub1/index']],
            ['label' => 'Sub-Sub Kelompok Barang', 'url' => ['product-group-sub2/index']],
            ['label' => 'Asal Perolehan', 'url' => ['procure-type/index']],
          ]
        ];

        $menuItemsRight[] = [
            // 'label' => '<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>'.Yii::$app->user->identity->username.'', 'url' => ['#'],
          'label' => '<i class="glyphicon glyphicon-user"></i> '.Yii::$app->user->identity->username.'', 'url' => ['#'],
            'items' => [
              ['label' => '<i class="fa fa-user"></i> Profile', 'url' => ['#']],
              ['label' => '<i class="fa fa-gear"></i>  Settings', 'url' => ['#']],

              '<li>'
                  . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                  . Html::submitButton('<i class="glyphicon glyphicon-log-out"></i> Logout', ['class' => 'btn btn-raised btn-danger'])
                  . Html::endform() .
              '</li>',
            ],
        ];
    }

    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'innerContainerOptions' => ['class'=>'container-fluid'],
        'brandOptions' => ['class' => 'navbar-brand'],
        'options' => [
            'class' => 'navbar navbar-invers',
        ],
    ]);
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'encodeLabels' => false,
        'items' => $menuItems,
        'activateParents'=>true,
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => $menuItemsRight,
    ]);
    NavBar::end();

?>
</header>
<main>
    <div class="container-fluid">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</main>
<footer class="footer">
    <div class="container-fluid">
        <p class="pull-left">&copy; <?=Yii::$app->name?> <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
