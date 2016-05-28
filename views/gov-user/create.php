<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GovUser */

$this->title = 'Tambah Pengguna Barang';
$this->params['breadcrumbs'][] = ['label' => 'Pengguna Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gov-user-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
