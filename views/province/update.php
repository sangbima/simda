<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Province */

$this->title = 'Ubah Provinsi: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Provinsi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="container province-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
