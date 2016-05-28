<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BatchKibd */

$this->title = $model->code_main . '-' .$model->code_start_num;
$this->params['breadcrumbs'][] = ['label' => 'Jalan, Irigasi Dan Jaringan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="batch-kibd-view">

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
                'attribute'=>'product_group_sub2_id',
                'value'=>$model->product_group_sub2_id ? $model->productGroupSub2->code_acc .' - '. $model->productGroupSub2->name : null,
            ],
            [
                'attribute'=>'gov_unit_id',
                'value'=>$model->gov_unit_id ? $model->govUnit->name : null,
            ],
            'code_main',
            'code_start_num',
            [
                'attribute'=>'code_asset',
                'value'=>$model->code_main . '-' .$model->code_start_num,
            ],
            'address',
            [
                'attribute'=>'province_id',
                'value'=>$model->province_id ? $model->province->name : null,
            ],
            [
                'attribute'=>'kabupatenkota_id',
                'value'=>$model->kabupatenkota_id ? $model->kabupatenkota->name : null,
            ],
            [
                'attribute'=>'kecamatan_id',
                'value'=>$model->kecamatan_id ? $model->kecamatan->name : null,
            ],
            [
                'attribute'=>'desakelurahan_id',
                'value'=>$model->desakelurahan_id ? $model->desakelurahan->name : null,
            ],
            'procure_date',
            [
                'attribute'=>'procure_type_id',
                'value'=>$model->procure_type_id ? $model->procureType->name : null,
            ],
            'procure_doc',
            'semester',
            [
                'attribute'=>'excomp',
                'value'=>$model->excomp == 1 ? "Ya" : "Tidak",
            ],
            'asset_recipient',
            'quantity',
            'price_base',
            'price_capital',
            'price_total',
            'description:ntext',
            'construction',
            'land_status',
            'length',
            'width',
            'size',
            'land_code_no',
            'document_no',
            'document_date',
        ],
    ]) ?>

</div>
