<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BatchKibfSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'KIB F: Konstruksi Dalam Pengerjaan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="batch-kibf-index">

    <p>
        <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> KIB F: KONSTRUKSI DALAM PENGERJAAN', ['create'], ['class' => 'btn btn-raised btn-success']) ?>
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

            [
                'attribute'=>'product_group_sub2_id',
                'value'=>'productGroupSub2.code_acc',
            ],
            [
                'attribute'=>'gov_unit_id',
                'value'=>'govUnit.name',
            ],
            'quantity',
            'price_total',
            'procure_date', //Tampilin tahun perolehan
            'semester',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
