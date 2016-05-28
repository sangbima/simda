<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GovMain */

$this->title = 'Ubah Bidang Pemerintahan: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Bidang Pemerintahan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="container gov-main-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
