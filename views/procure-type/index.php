<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProcureTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Procure Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="procure-type-index">

    <p>
        <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Procure Type', ['create'], ['class' => 'btn btn-raised btn-success']) ?>
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

            'name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
