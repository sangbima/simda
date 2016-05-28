<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProductGroupSub2 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sub-Sub Kelompok Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-group-sub2-view">

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
                'attribute'=>'product_group_sub1_id',
                'value'=>$model->productGroupSub1->name,
            ],
           'code_acc',
            'name',
            'benefit_year',
            'shrink_percent',
        ],
    ]) ?>

</div>
