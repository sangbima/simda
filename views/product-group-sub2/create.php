<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProductGroupSub2 */

$this->title = 'Tambah Sub-Sub Kelompok Barang';
$this->params['breadcrumbs'][] = ['label' => 'Sub-Sub Kelompok Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-group-sub2-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
