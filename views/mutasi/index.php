<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
?>
<div class="mutasi-index">
    <div class="row">
        <div class="col-md-2">
            <p class="text-center"><?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> KIB A', ['/batch-kiba/index'], ['class' => 'btn btn-raised btn-success', 'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title'=>'TANAH']) ?></p>
        </div>
        <div class="col-md-2">
            <p class="text-center"><?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> KIB B', ['/batch-kibb/index'], ['class' => 'btn btn-raised btn-success', 'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title'=>'PERALATAN DAN MESIN']) ?></p>
        </div>
        <div class="col-md-2">
            <p class="text-center"><?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> KIB C', ['/batch-kibc/index'], ['class' => 'btn btn-raised btn-success', 'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title'=>'GEDUNG DAN BANGUNAN']) ?></p>
        </div>
        <div class="col-md-2">
            <p class="text-center"><?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> KIB D', ['/batch-kibd/index'], ['class' => 'btn btn-raised btn-success', 'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title'=>'JALAN, IRIGASI DAN JARINGAN']) ?></p>
        </div>
        <div class="col-md-2">
            <p class="text-center"><?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> KIB E', ['/batch-kibe/index'], ['class' => 'btn btn-raised btn-success', 'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title'=>'ASEP TETAP LAINNYA']) ?></p>
        </div>
        <div class="col-md-2">
            <p class="text-center"><?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> KIB F', ['/batch-kibf/index'], ['class' => 'btn btn-raised btn-success', 'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title'=>'KONSTRUKSI DALAM PENGERJAAN']) ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">KIB A: Tanah</div>
                <div class="panel-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProviderKiba,
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
                            [
                                'attribute' => 'procure_date',
                                'label' => 'Thn. Perolehan',
                                'value' => function($d) {
                                    return \Yii::$app->formatter->asDatetime($d->procure_date, "php:Y");
                                }
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">KIB B: Tanah</div>
                <div class="panel-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProviderKibb,
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
                            [
                                'attribute' => 'procure_date',
                                'label' => 'Thn. Perolehan',
                                'value' => function($d) {
                                    return \Yii::$app->formatter->asDatetime($d->procure_date, "php:Y");
                                }
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">KIB C: Tanah</div>
                <div class="panel-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProviderKibc,
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
                            [
                                'attribute' => 'procure_date',
                                'label' => 'Thn. Perolehan',
                                'value' => function($d) {
                                    return \Yii::$app->formatter->asDatetime($d->procure_date, "php:Y");
                                }
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">KIB D: Tanah</div>
                <div class="panel-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProviderKibd,
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
                            [
                                'attribute' => 'procure_date',
                                'label' => 'Thn. Perolehan',
                                'value' => function($d) {
                                    return \Yii::$app->formatter->asDatetime($d->procure_date, "php:Y");
                                }
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">KIB E: Tanah</div>
                <div class="panel-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProviderKibe,
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
                            [
                                'attribute' => 'procure_date',
                                'label' => 'Thn. Perolehan',
                                'value' => function($d) {
                                    return \Yii::$app->formatter->asDatetime($d->procure_date, "php:Y");
                                }
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">KIB F: Tanah</div>
                <div class="panel-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProviderKibf,
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
                            [
                                'attribute' => 'procure_date',
                                'label' => 'Thn. Perolehan',
                                'value' => function($d) {
                                    return \Yii::$app->formatter->asDatetime($d->procure_date, "php:Y");
                                }
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerJs('
    $(function () {
        $("[data-toggle=\"tooltip\"]").tooltip()
    })
');
?>

