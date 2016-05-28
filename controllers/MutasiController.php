<?php

namespace app\controllers;

use yii\data\ActiveDataProvider;

class MutasiController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $queryKiba = \app\models\BatchKiba::find();
        $queryKiba->limit(3);
        $dataProviderKiba = new ActiveDataProvider([
            'query' => $queryKiba,
            'pagination' => false,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ]
        ]);

        $queryKibb = \app\models\BatchKibb::find();
        $queryKibb->limit(3);
        $dataProviderKibb = new ActiveDataProvider([
            'query' => $queryKibb,
            'pagination' => false,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ]
        ]);

        $queryKibc = \app\models\BatchKibc::find();
        $queryKibc->limit(3);
        $dataProviderKibc = new ActiveDataProvider([
            'query' => $queryKibc,
            'pagination' => false,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ]
        ]);

        $queryKibd = \app\models\BatchKibd::find();
        $queryKibd->limit(3);
        $dataProviderKibd = new ActiveDataProvider([
            'query' => $queryKibd,
            'pagination' => false,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ]
        ]);

        $queryKibe = \app\models\BatchKibe::find();
        $queryKibe->limit(3);
        $dataProviderKibe = new ActiveDataProvider([
            'query' => $queryKibe,
            'pagination' => false,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ]
        ]);

        $queryKibf = \app\models\BatchKibf::find();
        $queryKibf->limit(3);
        $dataProviderKibf = new ActiveDataProvider([
            'query' => $queryKibf,
            'pagination' => false,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ]
        ]);

        return $this->render('index', [
            'dataProviderKiba' => $dataProviderKiba,
            'dataProviderKibb' => $dataProviderKibb,
            'dataProviderKibc' => $dataProviderKibc,
            'dataProviderKibd' => $dataProviderKibd,
            'dataProviderKibe' => $dataProviderKibe,
            'dataProviderKibf' => $dataProviderKibf,
        ]);
    }

}
