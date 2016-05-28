<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;

/* @var $this yii\web\View */
/* @var $model app\models\Room */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="room-form">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-plus"></i> Setup Ruangan</div>
                <div class="panel-body">
                
                    <?php $form = ActiveForm::begin(); ?>
                    <div class="row">
                        <div class="col-md-6">
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
                                        'url'=>Url::to(['/room/list-gov-user']),
                                    ]
                                ]);
                            ?>
                        </div>
                    </div>
                    <div class="row">
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
                                    ],
                                    'pluginOptions'=>[
                                        'depends'=>['gov_user_id'],
                                        'url'=>Url::to(['/room/list-gov-privilege']),
                                    ]
                                ]);
                            ?>
                        </div>
                        <div class="col-md-6">
                            <?php
                                echo $form->field($model, 'gov_unit_id')->widget(DepDrop::classname(), [
                                    'type'=>DepDrop::TYPE_SELECT2,
                                    'data'=>$model->govUnitList,
                                    'options' => ['id'=> 'gov_unit_id', 'placeholder'=>'Select ...'],
                                    'select2Options'=>[
                                        'pluginOptions'=>[
                                            'allowClear'=>true,
                                        ],
                                        'pluginEvents' => [
                                          'change' => 'function() {
                                                $.get("' . Url::to(['get-code-room', 'id'=>'']). '" + $(this).val(), function(data) {
                                                    $("#room-code").val(data.nextnumber);
                                                });
                                            }'
                                        ],
                                    ],
                                    'pluginOptions'=>[
                                        'depends'=>['gov_privilege_id'],
                                        'url'=>Url::to(['/room/list-gov-unit']),
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
                    <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan' : '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Ubah', ['class' => $model->isNewRecord ? 'btn btn-raised btn-success' : 'btn btn-raised btn-primary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
