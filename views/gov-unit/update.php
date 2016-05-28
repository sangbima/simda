<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GovUnit */

$this->title = 'Ubah Unit Pengguna: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Unit Pengguna', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="container gov-unit-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
