<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BatchKibf */

$this->title = 'Tambah KIB F: Konstruksi Dalam Pengerjaan';
$this->params['breadcrumbs'][] = ['label' => 'Konstruksi Dalam Pengerjaan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container batch-kibf-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
