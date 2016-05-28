<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KecamatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kecamatan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kecamatan-index">

    <p>
        <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Kecamatan', ['create'], ['class' => 'btn btn-raised btn-success']) ?>
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
            [
                'attribute' => 'kabupatenkota_id',
                'label' => 'Kabupaten/Kota',
                'value' => 'kabupatenkota.name',
            ],
            [
                'attribute' => 'kabupatenkota_id',
                'label' => 'Provinsi',
                'value' => 'kabupatenkota.province.name'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
