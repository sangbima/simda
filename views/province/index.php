<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProvinceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Provinsi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="province-index">

    <p>
        <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Provinsi', ['create'], ['class' => 'btn btn-raised btn-success']) ?>
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
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function($url, $model) {
                        return Html::a('<i class="glyphicon glyphicon-eye-open"></i>', $url, ['class' => 'btn-xs', 'role' => 'button']);
                    },
                    'update' => function($url, $model) {
                        return Html::a('<i class="glyphicon glyphicon-pencil"></i>', $url, ['class' => 'btn-xs', 'role' => 'button']);
                    },
                    'delete' => function($url, $model){
                        return Html::a(
                            '<span class="glyphicon glyphicon-trash"></span>', $url, [
                              'class' => 'btn-xs',
                              'data-method' => 'post',
                              'data-confirm' => 'Are you sure you want to delete this item?',
                              'role' => 'button'
                            ]
                        );
                    }
                ]
            ],
        ],
    ]); ?>
</div>
