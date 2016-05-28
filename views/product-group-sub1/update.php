<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProductGroupSub1 */

$this->title = 'Ubah Sub Kelompok Barang: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sub Kelompok Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="container product-group-sub1-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
