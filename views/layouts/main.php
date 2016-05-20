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
<header>
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
        ['label' => 'Province', 'url' => ['province/index']],
        ['label' => 'Kabupaten - Kota', 'url' => ['kabupatenkota/index']],
        ['label' => 'Kecamatan', 'url' => ['kecamatan/index']],
        ['label' => 'Kelurahan', 'url' => ['desakelurahan/index']],
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

    if(\Yii::$app->user->isGuest){
      $menuItemsRight[] = ['label'=> 'Login', 'url'=> ['/site/login']];
    } else {
        $menuItemsRight[] = [
            // 'label' => '<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>'.Yii::$app->user->identity->username.'', 'url' => ['#'],
          'label' => '<i class="material-icons">person</i> '.Yii::$app->user->identity->username.'', 'url' => ['#'],
            'items' => [
              ['label' => '<i class="fa fa-user"></i> Profile', 'url' => ['#']],
              ['label' => '<i class="fa fa-gear"></i>  Settings', 'url' => ['#']],

              '<li>'
                  . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                  . Html::submitButton('<i class="material-icons">remove_circle</i> Logout', ['class' => 'btn btn-raised btn-danger'])
                  . Html::endform() .
              '</li>',
            ],
        ];
    }
?>
<?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'innerContainerOptions' => ['class'=>'container-fluid'],
        'brandOptions' => ['class' => 'navbar-brand'],
        'options' => [
            'class' => 'navbar navbar-invers',
        ],
    ]);
    // echo Nav::widget([
    //     'options' => ['class' => 'navbar-nav navbar-left'],
    //     'encodeLabels' => false,
    //     'items' => [
    //         [
    //             'label' => '<i class="material-icons">view_headline</i>', 
    //             'linkOptions' => ['class' => 'sidebar-toggle', 'data-toggle' => 'offcanfas', 'role' => 'button'],
    //         ],
    //     ],
    // ]);
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
    <div class="container">
        <p class="pull-left">&copy; <?=Yii::$app->name?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
