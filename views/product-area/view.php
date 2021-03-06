<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProductArea */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Bidang Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-area-view">

    <p>
        <?= Html::a('<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-raised btn-primary']) ?>
        <?= Html::a('<i class="fa fa-trash" aria-hidden="true"></i> Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-raised btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'product_type_id',
                'value'=>$model->productType->name,
            ],
            'code',
            'name',
            'code_acc',
        ],
    ]) ?>

</div>
