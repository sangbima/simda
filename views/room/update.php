<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Room */

$this->title = 'Ubah Setup Ruangan: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Setup Ruangan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="container room-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
