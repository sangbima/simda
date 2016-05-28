<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BatchKibbSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'KIB B: Peralatan Dan Mesin';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="batch-kibb-index">

    <p>
        <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> KIB B: PERALATAN DAN MESIN', ['create'], ['class' => 'btn btn-raised btn-success']) ?>
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
            // 'longitude',
            // 'gov_unit_id',
            // 'product_group_sub2_id',
            // 'code_main',
            // 'code_start_num',
            // 'province_id',
            // 'kabupatenkota_id',
            // 'kecamatan_id',
            // 'desakelurahan_id',
            // 'address',
            'procure_date',
            // 'procure_type_id',
            // 'procure_doc',
            // 'excomp',
            // 'asset_recipient',
            // 'condition',
            'quantity',
            // 'price_base',
            // 'price_capital',
            'price_total',
            'semester',
            // 'room_id',
            // 'description:ntext',
            // 'police_no',
            // 'expired_date',
            // 'legal_no',
            // 'merk',
            // 'type',
            // 'assembly_year',
            // 'engine_no',
            // 'chassis_no',
            // 'material',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
