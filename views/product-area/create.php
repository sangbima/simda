<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProductArea */

$this->title = 'Tambah Bidang Barang';
$this->params['breadcrumbs'][] = ['label' => 'Bidang Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container product-area-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
