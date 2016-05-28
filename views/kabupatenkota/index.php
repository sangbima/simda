<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KabupatenkotaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kabupaten Kota';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kabupatenkota-index">

    <p>
        <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Kabupaten Kota', ['create'], ['class' => 'btn btn-raised btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'pager' => [
            'firstPageLabel' => '<span class="glyphicon glyphicon-fast-backward"></span>',
            'lastPageLabel' => '<span class="glyphicon glyphicon-fast-forward"></span>',
            'prevPageLabel' => '<span class="glyphicon glyphicon-chevron-left"></span>',
            'nextPageLabel' => '<span class="glyphicon glyphicon-chevron-right"></span>',
        ],
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'code',
            'name',
            'type',
            [
                'attribute' => 'province_id',
                'label' => 'Provinsi',
                'value' => 'province.name'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
