<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Announcement */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Pengumuman', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="announcement-view">

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
        
            'publish_start:date',
            'publish_end:date',
            'title',
            'content:ntext',
            
        ],
    ]) ?>

</div>
