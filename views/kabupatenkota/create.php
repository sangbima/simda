<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Kabupatenkota */

$this->title = 'Tambah Kabupaten Kota';
$this->params['breadcrumbs'][] = ['label' => 'Kabupaten Kota', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kabupatenkota-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
