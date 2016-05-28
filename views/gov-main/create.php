<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GovMain */

$this->title = 'Tambah Bidang Pemerintahan';
$this->params['breadcrumbs'][] = ['label' => 'Bidang Pemerintahan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container gov-main-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
