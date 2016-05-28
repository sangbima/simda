<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BatchKibd */

$this->title = 'Tambah KIB D: Jalan, Irigasi Dan Jaringan';
$this->params['breadcrumbs'][] = ['label' => 'Jalan, Irigasi Dan Jaringan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container batch-kibd-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
