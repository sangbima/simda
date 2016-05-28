<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;

/* @var $this yii\web\View */
/* @var $model app\models\GovUnit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gov-unit-form">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-plus"></i> Unit Pengguna</div>
                <div class="panel-body">
                
                    <?php $form = ActiveForm::begin(); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                                echo $form->field($model, 'gov_main_id')->widget(Select2::classname(), [
                                    'data' => $model->govMainList,
                                    'options' => ['placeholder' => 'Select ...', 'id' => 'gov_main_id'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]);
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?php
                                echo $form->field($model, 'gov_user_id')->widget(DepDrop::classname(), [
                                    'type'=>DepDrop::TYPE_SELECT2,
                                    'data'=>$model->govUserList,
                                    'options' => ['id'=> 'gov_user_id', 'placeholder'=>'Select ...'],
                                    'select2Options'=>[
                                        'pluginOptions'=>[
                                            'allowClear'=>true,
                                        ],
                                    ],
                                    'pluginOptions'=>[
                                        'depends'=>['gov_main_id'],
                                        'url'=>Url::to(['/gov-unit/list-gov-user']),
                                    ]
                                ]);
                            ?>
                        </div>
                        <div class="col-md-6">
                            <?php
                                echo $form->field($model, 'gov_privilege_id')->widget(DepDrop::classname(), [
                                    'type'=>DepDrop::TYPE_SELECT2,
                                    'data'=>$model->govPrivilegeList,
                                    'options' => ['id'=> 'gov_privilege_id', 'placeholder'=>'Select ...'],
                                    'select2Options'=>[
                                        'pluginOptions'=>[
                                            'allowClear'=>true,
                                        ],
                                        'pluginEvents' => [
                                          'change' => 'function() {
                                                $.get("' . Url::to(['get-code-gov-unit', 'id'=>'']). '" + $(this).val(), function(data) {
                                                    $("#govunit-code").val(data.nextnumber);
                                                });
                                            }'
                                        ],
                                    ],
                                    'pluginOptions'=>[
                                        'depends'=>['gov_user_id'],
                                        'url'=>Url::to(['/gov-unit/list-gov-privilege']),
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
                        <div class="col-md-12">
                            <?= $form->field($model, 'address')->textArea(['row' => 6]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'postal_code')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
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
                                          'url'=>Url::to(['/gov-unit/listkotakab']),
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
                                        'url'=>Url::to(['/gov-unit/listkecamatan']),
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
                                          'url'=>Url::to(['/gov-unit/listdesakelurahan']),
                                      ]
                                ]);
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($model, 'pic_name')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'pic_nip')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'pic_title')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($model, 'keeper_name')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'keeper_nip')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'keeper_title')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'longitude')->textInput(['maxlength' => true]) ?>
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
