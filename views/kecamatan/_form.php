<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\Province;
use app\models\Kabupatenkota;
use kartik\depdrop\DepDrop;
use yii\web\JsExpression;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Kecamatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kecamatan-form">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-plus"></i> Kecamatan</div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin(); ?>
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
                                        'pluginEvents' => [
                                          'change' => 'function() {
                                                $.get("' . Url::to(['get-code-kotakab', 'id'=>'']). '" + $(this).val(), function(data) {
                                                    $("#kecamatan-code").val(data.kabupatenkota.code + "." + data.nextnumber);
                                                })
                                            }'
                                        ],
                                    ],
                                    'pluginOptions'=>[
                                        'depends'=>['province_id'],
                                        'url'=>Url::to(['/kecamatan/listkotakab']),
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