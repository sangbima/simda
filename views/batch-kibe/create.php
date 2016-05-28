<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BatchKibe */

$this->title = 'Tambah KIB E: Aset Tetap Lainnya';
$this->params['breadcrumbs'][] = ['label' => 'Aset Tetap Lainnya', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container batch-kibe-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
