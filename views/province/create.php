<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Province */

$this->title = 'Tambah Provinsi';
$this->params['breadcrumbs'][] = ['label' => 'Provinsi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container province-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
