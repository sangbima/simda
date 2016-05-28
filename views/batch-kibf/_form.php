<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
// use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use kartik\date\DatePicker;
use \yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\BatchKibf */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="batch-kibf-form">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">                
            <?php $form = ActiveForm::begin(); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading"><i class="fa fa-plus"></i> Mutasi Tambah KIB F: Konstruksi Dalam Pengerjaan</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'gov_unit_id')->widget(Select2::classname(), [
                                                'data' => $model->govUnitList,
                                                'options' => ['placeholder' => 'Select ...', 'id' => 'gov_unit_id'],
                                                'disabled' => !$model->isNewRecord,
                                                'pluginOptions' => [
                                                    'allowClear' => true
                                                ],
                                            ]);
                                        ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'product_group_sub2_id')->widget(Select2::classname(), [
                                                'data' => $model->allProductGroupSub2,
                                                'options' => ['placeholder' => 'Select ...', 'id' => 'product_group_sub2_id'],
                                                'disabled' => !$model->isNewRecord,
                                                'pluginEvents' => [
                                                    'change' => 'function() {
                                                        $.get("' . Url::to(['get-benefit-year', 'id'=>'']). '" + $(this).val(), function(data) {
                                                            $("#batchkibf-benefit_year").val(data.modelproductgroupsub2.benefit_year);
                                                        });
                                                        $.get("' . Url::to(['get-code-main', 'id'=>'']). '" + $("#gov_unit_id").val() +"-"+$(this).val(), function(data) {
                                                            $("#batchkibf-code_asset").val(data.codeasset);
                                                        });
                                                    }'
                                                ],
                                                'pluginOptions' => [
                                                    'allowClear' => true
                                                ],
                                            ]);
                                        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <?= $form->field($model, 'benefit_year')->textInput(['readonly' => 'readonly']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>           
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading"><i class="glyphicon glyphicon-align-justify"></i> Pencatatan Dokumen</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?= $form->field($model, 'code_asset')->textInput(['readonly' => 'readonly']) ?>

                                        <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php
                                            echo $form->field($model, 'province_id')->widget(Select2::classname(), [
                                                'data' => $model->provinceList,
                                                'options' => ['placeholder' => 'Select ...', 'id' => 'province_id'],
                                                'pluginOptions' => [
                                                    'allowClear' => true
                                                ],
                                            ]);
                                        ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?php
                                            echo $form->field($model, 'kabupatenkota_id')->widget(DepDrop::classname(), [
                                                'type'=>DepDrop::TYPE_SELECT2,
                                                'data'=>$model->allKabupatenKota,
                                                'options' => ['id'=> 'kabupatenkota_id', 'placeholder'=>'Select ...'],
                                                'select2Options'=>[
                                                  'pluginOptions'=>[
                                                    'allowClear'=>true,
                                                  ],
                                                ],
                                                'pluginOptions'=>[
                                                    'depends'=>['province_id'],
                                                    'url'=>Url::to(['/batch-kibf/listkotakab']),
                                                ]
                                            ]);
                                        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php
                                            echo $form->field($model, 'kecamatan_id')->widget(DepDrop::classname(), [
                                                'type'=>DepDrop::TYPE_SELECT2,
                                                'data'=>$model->allKecamatan,
                                                'options' => ['id'=> 'kecamatan_id', 'placeholder'=>'Select ...'],
                                                'select2Options'=>[
                                                  'pluginOptions'=>[
                                                    'allowClear'=>true,
                                                  ],
                                                ],
                                                'pluginOptions'=>[
                                                    'depends'=>['kabupatenkota_id'],
                                                    'url'=>Url::to(['/batch-kibf/listkecamatan']),
                                                ]
                                            ]);
                                        ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?php
                                          echo $form->field($model, 'desakelurahan_id')->widget(DepDrop::classname(), [
                                              'type'=>DepDrop::TYPE_SELECT2,
                                              'data'=>$model->allDesaKelurahan,
                                              'options' => ['id'=> 'desakelurahan_id', 'placeholder'=>'Select ...'],
                                              'select2Options'=>[
                                                'pluginOptions'=>[
                                                  'allowClear'=>true,
                                                ],
                                              ],
                                              'pluginOptions'=>[
                                                  'depends'=>['kecamatan_id'],
                                                  'url'=>Url::to(['/batch-kibf/listdesakelurahan']),
                                              ]
                                          ]);
                                        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'procure_date')->widget(DatePicker::classname(),[
                                            'options' => [
                                                'placeholder' => '...', 
                                                'onchange' => '
                                                    var date = $(this).val();
                                                    var sdate = date.split("-");
                                                    $("#batchkibf-procure_year").val(sdate[2]);
                                                '
                                            ],
                                            'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                            'pluginOptions' => [
                                                'autoclose' => true,
                                                'format' => 'dd-mm-yyyy'
                                            ]
                                        ]); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'procure_year')->textInput(['readonly' => 'readonly']) ?>
                                    </div>
                                </div>
                                <?php
                                    echo $form->field($model, 'procure_type_id')->widget(Select2::classname(), [
                                        'data' => $model->allProcureType,
                                        'options' => ['placeholder' => 'Select ...', 'id' => 'procure_type_id'],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ]);
                                ?>

                                <?= $form->field($model, 'procure_doc')->textInput(['maxlength' => true]) ?>

                                <?= $form->field($model, 'excomp')->inline()->radioList(array(1=>'Ya', 0=>'TIDAK'), [
                                    'class' => 'radio radio-primary'
                                ]); ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading"><i class="glyphicon glyphicon-check"></i> Informasi Tambahan</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <?= $form->field($model, 'asset_recipient')->textInput(['maxlength' => true]) ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <?= $form->field($model, 'quantity')->textInput(['maxlength' => true, 'readonly' => !$model->isNewRecord]) ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <?= $form->field($model, 'price_base')->textInput(['maxlength' => true]) ?>
                                    </div>
                                    <div class="col-md-4">
                                        <?= $form->field($model, 'price_capital')->textInput(['maxlength' => true]) ?>
                                    </div>
                                    <div class="col-md-4">
                                        <?= $form->field($model, 'price_total')->textInput(['maxlength' => true]) ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <?= $form->field($model, 'semester')->inline()->radioList(array(1=>'1', 2=>'2'), [
                                            'class' => 'radio radio-primary'
                                        ]); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan' : '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Ubah', ['class' => $model->isNewRecord ? 'btn btn-raised btn-success' : 'btn btn-raised btn-primary']) ?>
                </div>
                        
            <?php ActiveForm::end(); ?>
         </div>
    </div>
</div>
