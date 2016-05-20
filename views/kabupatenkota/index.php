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

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="material-icons">add</i> Kabupaten Kota', ['create'], ['class' => 'btn btn-raised btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'province_id',
                'label' => 'Provinsi',
                'value' => 'province.name'
            ],
            'code',
            'name',
            'type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
