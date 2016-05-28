<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProductArea */

$this->title = 'Ubah Bidang Barang: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Bidang Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="container product-area-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
