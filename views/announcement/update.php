<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Announcement */

$this->title = 'Ubah Pengumuman: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Pengumuman', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="container announcement-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
