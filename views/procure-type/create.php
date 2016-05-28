<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProcureType */

$this->title = 'Create Procure Type';
$this->params['breadcrumbs'][] = ['label' => 'Procure Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container procure-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
