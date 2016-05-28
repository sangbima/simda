<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GovUserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gov-user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'created_at') ?>

    <?= $form->field($model, 'updated_at') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'gov_main_id') ?>

    <?php // echo $form->field($model, 'code') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'code_acc') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'province_id') ?>

    <?php // echo $form->field($model, 'kabupatenkota_id') ?>

    <?php // echo $form->field($model, 'kecamatan_id') ?>

    <?php // echo $form->field($model, 'desakelurahan_id') ?>

    <?php // echo $form->field($model, 'postal_code') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'pic_name') ?>

    <?php // echo $form->field($model, 'pic_nip') ?>

    <?php // echo $form->field($model, 'pic_title') ?>

    <?php // echo $form->field($model, 'keeper_name') ?>

    <?php // echo $form->field($model, 'keeper_nip') ?>

    <?php // echo $form->field($model, 'keeper_title') ?>

    <?php // echo $form->field($model, 'latitude') ?>

    <?php // echo $form->field($model, 'longitude') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
