<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Kecamatan */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Kecamatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kecamatan-view">

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
                'attribtute' => 'kabupatenkota_id',
                'label' => 'Provinsi',
                'value' => $model->kabupatenkota->province->name,
            ],
            [
                'attribtute' => 'kabupatenkota_id',
                'label' => 'Kabupaten/Kota',
                'value' => $model->kabupatenkota->name,
            ],
            'code',
            'name',
        ],
    ]) ?>

</div>
