<?php

namespace app\controllers;

use Yii;
use app\models\GovUser;
use app\models\GovUserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;


/**
 * GovUserController implements the CRUD actions for GovUser model.
 */
class GovUserController extends Controller
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
     * Lists all GovUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GovUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GovUser model.
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
     * Creates a new GovUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GovUser();

        if ($model->load(Yii::$app->request->post())) {
            $codeGovMain = \app\models\GovMain::findOne($model->gov_main_id);
            $model->code_acc = $codeGovMain->code_acc . '.' . $model->code;
            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing GovUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $codeGovMain = \app\models\GovMain::findOne($model->gov_main_id);
            $model->code_acc = $codeGovMain->code_acc . '.' . $model->code;
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing GovUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionGetCodeGovMain($id)
    {
        $number = $this->autoNumber($id);

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return [
            'nextnumber' => $number,
        ];
    }

    protected function autoNumber($id)
    {
        $newCode = null;
        
        if($id) {
            $model = GovUser::find()->select('code')->where(['gov_main_id' => $id])->orderBy(['code' => SORT_DESC])->one();
            // kode = 00.00
            if(empty($model->code)) {
                $newCode = sprintf("%02d", 0 + 1);    
            } else {
                $newCode = sprintf("%02d", $model->code + 1);
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
        $mapping['out'] = \app\models\Kabupatenkota::find()->where(['province_id' => $province_id])->all();
        
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
        $mapping['out'] = \app\models\Kecamatan::find()->where(['kabupatenkota_id' => $kabupatenkota_id])->all();

        return $mapping;
    }

    public function actionListdesakelurahan()
    {
        $out = [];
        if(isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if($parents != null) {
                $kecamatan_id = end($parents);

                $data = self::getDesaKelurahan($kecamatan_id);
                echo Json::encode(['output'=>$data['out'], 'selected'=>'']);

                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function getDesaKelurahan($kecamatan_id)
    {
        $mapping['out'] = \app\models\Desakelurahan::find()->where(['kecamatan_id' => $kecamatan_id])->all();

        return $mapping;
    }

    /**
     * Finds the GovUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GovUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GovUser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
