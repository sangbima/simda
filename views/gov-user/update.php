<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GovUser */

$this->title = 'Ubah Pengguna Barang: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Pengguna Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="gov-user-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
