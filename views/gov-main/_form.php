<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GovMain */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gov-main-form">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-plus"></i> Bidang Pemerintahan</div>
                <div class="panel-body">
                
                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                    <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan' : '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Ubah', ['class' => $model->isNewRecord ? 'btn btn-raised btn-success' : 'btn btn-raised btn-primary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
