<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Desakelurahan */

$this->title = 'Ubah Desa/Kelurahan: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Desa/Kelurahan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="container desakelurahan-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
