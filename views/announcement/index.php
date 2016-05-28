<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnnouncementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengumuman';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="announcement-index">

    <p>
        <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Pengumuman', ['create'], ['class' => 'btn btn-raised btn-success']) ?>
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

            // 'id',
            // 'created_at',
            // 'updated_at',
            // 'user_id',
            'title',
            // 'content:ntext',
            'publish_start:date',
            'publish_end:date',
            
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
