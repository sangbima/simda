<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProductGroupSub1 */

$this->title = 'Tambah Sub Kelompok Barang';
$this->params['breadcrumbs'][] = ['label' => 'Sub Kelompok Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container product-group-sub1-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
