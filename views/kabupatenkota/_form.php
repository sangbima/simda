<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\Province;
use yii\web\JsExpression;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Kabupatenkota */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kabupatenkota-form">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-plus"></i> Kabupaten/Kota</div>
                <div class="panel-body">
                
                    <?php $form = ActiveForm::begin(); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                                echo $form->field($model, 'province_id')->widget(Select2::classname(), [
                                    'data' => $model->provinceList,
                                    'options' => ['placeholder' => 'Select ...'],
                                    'pluginEvents' => [
                                        'change' => 'function() {
                                            $.get("' . Url::to(['get-code-province', 'id'=>'']). '" + $(this).val(), function(data) {
                                                $("#kabupatenkota-code").val(data.province.code + "." + data.nextnumber);
                                            })
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
                            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-9">
                            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="row">
                       <div class="col-md-12">
                            <?= $form->field($model, 'type')->radioList(array('Kabupaten'=>'Kabupaten', 'Kota'=>'Kota'), [
                                'class' => 'radio radio-primary'
                            ]); ?>
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
