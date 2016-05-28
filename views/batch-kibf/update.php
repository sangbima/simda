<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BatchKibf */

$this->title = 'Ubah KIB F: ' . $model->code_main . '-' .$model->code_start_num;
$this->params['breadcrumbs'][] = ['label' => 'Konstruksi Dalam Pengerjaan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->code_main . '-' .$model->code_start_num, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="container batch-kibf-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
