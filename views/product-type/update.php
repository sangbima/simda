<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProductType */

$this->title = 'Ubah Golongan Barang: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Golongan Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="container product-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
