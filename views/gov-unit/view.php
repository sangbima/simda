<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GovUnit */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Unit Pengguna', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gov-unit-view">

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
                'attribute'=>'gov_privilege_id',
                'value'=>$model->gov_privilege_id ? $model->govPrivilege->name : null,
            ],
            'code',
            'name',
            'code_acc',
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
            'postal_code',
            'phone',
            'pic_name',
            'pic_nip',
            'pic_title',
            'keeper_name',
            'keeper_nip',
            'keeper_title',
            'latitude',
            'longitude',
        ],
    ]) ?>

</div>
