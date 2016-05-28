<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BatchKibb */

$this->title = 'Ubah KIB B: ' . $model->code_main . '-' .$model->code_start_num;
$this->params['breadcrumbs'][] = ['label' => 'Peralatan Dan Mesin', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->code_main . '-' .$model->code_start_num, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="container batch-kibb-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
