<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductAreaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-area-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'created_at') ?>

    <?= $form->field($model, 'updated_at') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'product_type_id') ?>

    <?php // echo $form->field($model, 'code') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'code_acc') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
