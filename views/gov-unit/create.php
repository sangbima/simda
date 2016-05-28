<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GovUnit */

$this->title = 'Tambah Unit Pengguna';
$this->params['breadcrumbs'][] = ['label' => 'Unit Pengguna', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container gov-unit-create">

   <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
