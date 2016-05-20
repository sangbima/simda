<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Desakelurahan */

$this->title = 'Create Desakelurahan';
$this->params['breadcrumbs'][] = ['label' => 'Desakelurahans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="desakelurahan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
