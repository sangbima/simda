<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Room */

$this->title = 'Setup Ruangan';
$this->params['breadcrumbs'][] = ['label' => 'Setup Ruangan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container room-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
