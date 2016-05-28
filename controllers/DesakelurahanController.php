<?php

namespace app\controllers;

use Yii;
use app\models\Desakelurahan;
use app\models\DesakelurahanSearch;
use app\models\Kecamatan;
use app\models\Kabupatenkota;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

/**
 * DesakelurahanController implements the CRUD actions for Desakelurahan model.
 */
class DesakelurahanController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Desakelurahan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DesakelurahanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Desakelurahan model.
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
     * Creates a new Desakelurahan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Desakelurahan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $model->type = "Desa";
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Desakelurahan model.
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
            $modelKecamatan = \app\models\Kecamatan::findOne($model->kecamatan_id);
            $modelKabupatenKota = \app\models\Kabupatenkota::findOne($modelKecamatan->kabupatenkota_id);
            $modelProvince = \app\models\Province::findOne($modelKabupatenKota->province_id);
            $model->kabupatenkota_id = $modelKabupatenKota->id;
            $model->province_id =  $modelProvince->id;
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Desakelurahan model.
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

    public function actionGetCodeKecamatan($id)
    {
        $kecamatanSelected = \app\models\Kecamatan::find()->where(['id' => $id])->one();
        
        $number = $this->autoNumber($id);

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return [
            'kecamatan' => $kecamatanSelected,
            'nextnumber' => $number,
        ];
    }

    protected function autoNumber($id)
    {
        $newCode = sprintf("%02d", 1); 

        if($id) {
            $model = Desakelurahan::find()->select('code')->where(['kecamatan_id' => $id])->orderBy(['code' => SORT_DESC])->one();
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
        }
      
        return $newCode;
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

    public function actionListkecamatan()
    {
      $out = [];
      if(isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];
        if($parents != null) {
          $kabupatenkota_id = $parents[0];
          
          $data = self::getKecamatan($kabupatenkota_id);
          echo Json::encode(['output'=>$data['out'], 'selected'=>'']);
          
          return;
        }
      }
      echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function getKecamatan($kabupatenkota_id)
    {
      $mapping['out'] = Kecamatan::find()->where(['kabupatenkota_id' => $kabupatenkota_id])->all();
      // $mapping['selected'] = ['id' => 1];
      
      return $mapping;
    }


    /**
     * Finds the Desakelurahan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Desakelurahan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Desakelurahan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
