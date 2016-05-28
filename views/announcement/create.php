<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Announcement */

$this->title = 'Tambah Pengumuman';
$this->params['breadcrumbs'][] = ['label' => 'Pengumuman', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container announcement-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
