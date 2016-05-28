<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BatchKibbSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="batch-kibb-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'created_at') ?>

    <?= $form->field($model, 'updated_at') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'latitude') ?>

    <?php // echo $form->field($model, 'longitude') ?>

    <?php // echo $form->field($model, 'gov_unit_id') ?>

    <?php // echo $form->field($model, 'product_group_sub2_id') ?>

    <?php // echo $form->field($model, 'code_main') ?>

    <?php // echo $form->field($model, 'code_start_num') ?>

    <?php // echo $form->field($model, 'province_id') ?>

    <?php // echo $form->field($model, 'kabupatenkota_id') ?>

    <?php // echo $form->field($model, 'kecamatan_id') ?>

    <?php // echo $form->field($model, 'desakelurahan_id') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'procure_date') ?>

    <?php // echo $form->field($model, 'procure_type_id') ?>

    <?php // echo $form->field($model, 'procure_doc') ?>

    <?php // echo $form->field($model, 'excomp') ?>

    <?php // echo $form->field($model, 'asset_recipient') ?>

    <?php // echo $form->field($model, 'condition') ?>

    <?php // echo $form->field($model, 'quantity') ?>

    <?php // echo $form->field($model, 'price_base') ?>

    <?php // echo $form->field($model, 'price_capital') ?>

    <?php // echo $form->field($model, 'price_total') ?>

    <?php // echo $form->field($model, 'semester') ?>

    <?php // echo $form->field($model, 'room_id') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'police_no') ?>

    <?php // echo $form->field($model, 'expired_date') ?>

    <?php // echo $form->field($model, 'legal_no') ?>

    <?php // echo $form->field($model, 'merk') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'assembly_year') ?>

    <?php // echo $form->field($model, 'engine_no') ?>

    <?php // echo $form->field($model, 'chassis_no') ?>

    <?php // echo $form->field($model, 'material') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
