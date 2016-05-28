<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BatchKiba */

$this->title = 'Tambah KIB A: Tanah';
$this->params['breadcrumbs'][] = ['label' => 'Tanah', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container batch-kiba-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
