<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;

/* @var $this yii\web\View */
/* @var $model app\models\ProductGroupSub2 */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-group-sub2-form">
    <div class="product-group-sub1-form">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-plus"></i> Sub-Sub Kelompok Barang</div>
                    <div class="panel-body">

                        <?php $form = ActiveForm::begin(); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <?php
                                    echo $form->field($model, 'product_type_id')->widget(Select2::classname(),[
                                        'data' => $model->productTypeList,
                                        'options' => ['placeholder' => 'Select...', 'id'=>'product_type_id'],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ]);
                                ?>
                            </div>
                            <div class="col-md-6">
                                <?php
                                    echo $form->field($model, 'product_area_id')->widget(DepDrop::classname(), [
                                        'type' => DepDrop::TYPE_SELECT2,
                                        'data' => $model->productAreaList,
                                        'options'=>['id'=>'product_area_id', 'placeholder'=>'Select...'],
                                        'select2Options'=>[
                                            'pluginOptions' => ['allowClear' => true],
                                        ],
                                        'pluginOptions'=>[
                                            'depends'=>['product_type_id'],
                                            'url'=>Url::to(['/product-group-sub2/list-product-area']),

                                        ]
                                    ]);
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <?php
                                    echo $form->field($model, 'product_group_id')->widget(DepDrop::classname(), [
                                        'type' => DepDrop::TYPE_SELECT2,
                                        'data' => $model->productGroupList,
                                        'options'=>['id'=>'product_group_id', 'placeholder'=>'Select...'],
                                        'select2Options'=>[
                                            'pluginOptions' => ['allowClear' => true],
                                        ],
                                        'pluginOptions'=>[
                                            'depends'=>['product_area_id'],
                                            'url'=>Url::to(['/product-group-sub2/list-product-group']),

                                        ]
                                    ]);
                                ?>
                            </div>
                            <div class="col-md-6">
                                <?php
                                    echo $form->field($model, 'product_group_sub1_id')->widget(DepDrop::classname(), [
                                        'type' => DepDrop::TYPE_SELECT2,
                                        'data' => $model->productGroupSub1List,
                                        'options'=>['id'=>'product_group_sub1_id', 'placeholder'=>'Select...'],
                                        'select2Options'=>[
                                            'pluginOptions' => ['allowClear' => true],
                                            'pluginEvents' => [
                                              'change' => 'function() {
                                                    $.get("' . Url::to(['get-code-product-group-sub1', 'id'=>'']). '" + $(this).val(), function(data) {
                                                        $("#productgroupsub2-code").val(data.nextnumber);
                                                    })
                                                }'
                                            ],
                                        ],
                                        'pluginOptions'=>[
                                            'depends'=>['product_group_id'],
                                            'url'=>Url::to(['/product-group-sub2/list-product-group-sub1']),

                                        ]
                                    ]);
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-9">
                                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <?= $form->field($model, 'benefit_year')->textInput() ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($model, 'shrink_percent')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                        <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan' : '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Ubah', ['class' => $model->isNewRecord ? 'btn btn-raised btn-success' : 'btn btn-raised btn-primary']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
