<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Announcement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="announcement-form">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-plus"></i> Announcement</div>
                <div class="panel-body">
                
                    <?php $form = ActiveForm::begin(); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'publish_start')->widget(DatePicker::classname(),[
                                    'options' => ['placeholder' => '...'],
                                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                    'pluginOptions' => [
                                      'autoclose' => true,
                                      'format' => 'dd-mm-yyyy'
                                    ]
                            ]); ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'publish_end')->widget(DatePicker::classname(),[
                                    'options' => ['placeholder' => '...'],
                                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                    'pluginOptions' => [
                                      'autoclose' => true,
                                      'format' => 'dd-mm-yyyy'
                                    ]
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
