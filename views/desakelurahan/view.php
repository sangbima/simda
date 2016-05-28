<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Desakelurahan */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Desa/Kelurahan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="desakelurahan-view">

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
                'attribute'=>'kecamatan_id',
                'label'=>'Provinsi',
                'value'=>$model->kecamatan->kabupatenkota->province->name,
            ],
            [
                'attribute'=>'kecamatan_id',
                'label'=>'Kabupaten/Kota',
                'value'=>$model->kecamatan->kabupatenkota->name,
            ],
            [
                'attribute'=>'kecamatan_id',
                'label'=>'Kecamatan',
                'value'=>$model->kecamatan->name,
            ],
            'code',
            'name',
            'type',
        ],
    ]) ?>

</div>
