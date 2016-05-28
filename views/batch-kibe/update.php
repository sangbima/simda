<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BatchKibe */

$this->title = 'Ubah KIB E: ' . $model->code_main . '-' .$model->code_start_num;
$this->params['breadcrumbs'][] = ['label' => 'Aset Tetap Lainnya', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->code_main . '-' .$model->code_start_num, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="container batch-kibe-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
