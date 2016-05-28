<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BatchKibd */

$this->title = 'Ubah KIB D: ' . $model->code_main . '-' .$model->code_start_num;
$this->params['breadcrumbs'][] = ['label' => 'Jalan, Irigasi Dan Jaringan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->code_main . '-' .$model->code_start_num, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="container batch-kibd-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
