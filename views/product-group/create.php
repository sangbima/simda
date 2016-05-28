<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProductGroup */

$this->title = 'Tambah Kelompok Barang';
$this->params['breadcrumbs'][] = ['label' => 'Kelompok Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container product-group-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
