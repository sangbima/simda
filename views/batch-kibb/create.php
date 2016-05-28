<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BatchKibb */

$this->title = 'Tambah KIB B: Peralatan Dan Mesin';
$this->params['breadcrumbs'][] = ['label' => 'Peralatan Dan Mesin', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container batch-kibb-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
