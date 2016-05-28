<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GovPrivilege */

$this->title = 'Ubah Kuasa Pengguna: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Kuasa Pengguna', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="gov-privilege-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
