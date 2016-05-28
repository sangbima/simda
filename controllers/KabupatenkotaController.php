<?php

namespace app\controllers;

use Yii;
use app\models\Kabupatenkota;
use app\models\KabupatenkotaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;

/**
 * KabupatenkotaController implements the CRUD actions for Kabupatenkota model.
 */
class KabupatenkotaController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Kabupatenkota models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KabupatenkotaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Kabupatenkota model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Kabupatenkota model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Kabupatenkota();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $model->type = 'Kabupaten';
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Kabupatenkota model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Kabupatenkota model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionGetCodeProvince($id)
    {
        $provinceSelected = \app\models\Province::findOne($id);
        $number = $this->autoNumber($id);

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return [
            'province' => $provinceSelected,
            'nextnumber' => $number,
        ];
    }

    protected function autoNumber($id)
    {
        $model = Kabupatenkota::find()->select('code')->where(['province_id' => $id])->orderBy(['id' => SORT_DESC])->one();
        // kode = 00.00
        
        if(empty($model->code)) {
            $newCode = sprintf("%02d", 0 + 1);    
        } else {
            $oldCode = explode('.', $model->code);
            $code = end($oldCode);
            $newCode = sprintf("%02d", $code + 1);
        }
        
        return $newCode;
    }

    // public function actionKabupatenkotaList($q = null, $id = null)
    // {
    //     \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    //     $out = ['results' => ['id' => '', 'text' => '']];
    //     if (!is_null($q)) {
    //         $query = new \yii\db\Query;
    //         $query->select('id, name AS text')
    //             ->from('kabupatenkota')
    //             ->where(['like', 'name', $q])
    //             ->limit(20);
    //         $command = $query->createCommand();
    //         $data = $command->queryAll();
    //         $out['results'] = array_values($data);
    //     }
    //     elseif ($id > 0) {
    //         $out['results'] = ['id' => $id, 'text' => Kabupatenkota::find($id)->name];
    //     }
    //     return $out;
    // }

    /**
     * Finds the Kabupatenkota model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Kabupatenkota the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kabupatenkota::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
