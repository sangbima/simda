<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProductType */

$this->title = 'Tambah Golongan Barang';
$this->params['breadcrumbs'][] = ['label' => 'Golongan Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container product-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
