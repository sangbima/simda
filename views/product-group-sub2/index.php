<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductGroupSub2Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sub-Sub Kelompok Barang';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-group-sub2-index">

    <p>
        <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Sub-Sub Kelompok Barang', ['create'], ['class' => 'btn btn-raised btn-success']) ?>
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

            'code_acc',
            'name',
            'benefit_year',
            'shrink_percent',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
