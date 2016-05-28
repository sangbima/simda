<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GovPrivilege */

$this->title = 'Tambah Kuasa Pengguna';
$this->params['breadcrumbs'][] = ['label' => 'Kuasa Pengguna', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gov-privilege-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
