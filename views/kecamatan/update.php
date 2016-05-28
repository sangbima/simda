<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Kecamatan */

$this->title = 'Ubah Kecamatan: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Kecamatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="container kecamatan-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
