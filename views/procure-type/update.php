<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProcureType */

$this->title = 'Update Procure Type: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Procure Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="container procure-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
