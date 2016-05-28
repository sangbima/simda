<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProductGroup */

$this->title = 'Ubah Kelompok Barang: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Kelompok Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="container product-group-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
