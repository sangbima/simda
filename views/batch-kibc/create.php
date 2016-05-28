<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BatchKibc */

$this->title = 'Tambah KIB C: Gedung Dan Bangunan';
$this->params['breadcrumbs'][] = ['label' => 'Gedung Dan Bangunan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container batch-kibc-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
