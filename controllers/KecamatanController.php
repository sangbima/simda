<?php

namespace app\controllers;

use Yii;
use app\models\Kecamatan;
use app\models\KecamatanSearch;
use app\models\Kabupatenkota;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;

/**
 * KecamatanController implements the CRUD actions for Kecamatan model.
 */
class KecamatanController extends Controller
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
     * Lists all Kecamatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KecamatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Kecamatan model.
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
     * Creates a new Kecamatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Kecamatan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Kecamatan model.
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
            $modelKabupatenKota = \app\models\Kabupatenkota::findOne($model->kabupatenkota_id);
            $modelProvince = \app\models\Province::findOne($modelKabupatenKota->province_id);
            $model->province_id =  $modelProvince->id;
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Kecamatan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionGetKabupatenkota($province_id)
    {
        $kabkota = \app\models\Kabupatenkota::find()->where(['province_id' => $province_id])->all();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return [
          'kabupatenkota' => $kabkota,
        ];
    }

    public function actionGetCodeKotakab($id)
    {
        $kabupatenkotaSelected = \app\models\Kabupatenkota::find()->where(['id' => $id])->one();
        
        $number = $this->autoNumber($id);

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return [
            'kabupatenkota' => $kabupatenkotaSelected,
            'nextnumber' => $number,
        ];
    }

    protected function autoNumber($id)
    {
        $newCode = null;

        $model = Kecamatan::find()->select('code')->where(['kabupatenkota_id' => $id])->orderBy(['id' => SORT_DESC])->one();
        if ($model) {
        // kode = 00.00.00
        $oldCode = explode('.', $model->code);
        $code = end($oldCode);
        if(empty($model->code)) {
          $newCode = sprintf("%02d", 0 + 1);    
        } else {
          $newCode = sprintf("%02d", $code + 1);
        }
        }
        return $newCode == null ? '01' : $newCode;
    }

    public function actionListkotakab()
    {
      $out = [];
      if(isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];
        if($parents != null) {
          $province_id = $parents[0];
          
          $data = self::getKotakab($province_id);
          echo Json::encode(['output'=>$data['out'], 'selected'=>'']);
          
          return;
        }
      }
      echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function getKotakab($province_id)
    {
      $mapping['out'] = Kabupatenkota::find()->where(['province_id' => $province_id])->all();
      // $mapping['selected'] = ['id' => 1];
      
      return $mapping;
    }

    /**
     * Finds the Kecamatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Kecamatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kecamatan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
