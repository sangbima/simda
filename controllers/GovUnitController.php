<?php

namespace app\controllers;

use Yii;
use app\models\GovUnit;
use app\models\GovUnitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;

/**
 * GovUnitController implements the CRUD actions for GovUnit model.
 */
class GovUnitController extends Controller
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
     * Lists all GovUnit models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GovUnitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GovUnit model.
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
     * Creates a new GovUnit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GovUnit();

        if ($model->load(Yii::$app->request->post())) {
            $codeGovPrivilege = \app\models\GovPrivilege::findOne($model->gov_privilege_id);
            $model->code_acc = $codeGovPrivilege->code_acc . '.' . $model->code;
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
     * Updates an existing GovUnit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $codeGovPrivilege = \app\models\GovPrivilege::findOne($model->gov_privilege_id);
            $model->code_acc = $codeGovPrivilege->code_acc . '.' . $model->code;
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $modelGovPrivilege = \app\models\GovPrivilege::findOne($model->gov_privilege_id);
            $modelGovUser = \app\models\GovUser::findOne($modelGovPrivilege->gov_user_id);
            $modelGovMain = \app\models\GovMain::findOne($modelGovUser->gov_main_id);
            $model->gov_main_id = $modelGovMain->id;
            $model->gov_user_id = $modelGovUser->id;
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing GovUnit model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionGetCodeGovUnit($id)
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
            $model = GovUnit::find()->select('code')->where(['gov_privilege_id' => $id])->orderBy(['code' => SORT_DESC])->one();
            // kode = 00.00
            if(empty($model->code)) {
                $newCode = sprintf("%02d", 0 + 1);    
            } else {
                $newCode = sprintf("%02d", $model->code + 1);
            }
        }
        
        return $newCode;
    }

    public function actionListGovUser()
    {
        $out = [];
        if(isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if($parents != null) {
                $gov_main_id = $parents[0];

                $data = self::getGovUser($gov_main_id);
                echo Json::encode(['output'=>$data['out'], 'selected'=>'']);

                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function getGovUser($gov_main_id)
    {
        $datas = \app\models\GovUser::find()->where(['gov_main_id' => $gov_main_id])->all();

        $dataAll = array();
        foreach ($datas as $key => $value) {
            $dataAll[$key] = ['id' => $value['id'], 'name' => $value['code_acc'] .' - '.$value['name']];
        }

        $mapping['out'] = $dataAll;

        return $mapping;
    }

    public function actionListGovPrivilege()
    {
        $out = [];
        if(isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if($parents != null) {
                $gov_user_id = end($parents);

                $data = self::getGovPrivilege($gov_user_id);
                echo Json::encode(['output'=>$data['out'], 'selected'=>'']);

                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function getGovPrivilege($gov_user_id)
    {
        $datas = \app\models\GovPrivilege::find()->where(['gov_user_id' => $gov_user_id])->all();

        $dataAll = array();
        foreach ($datas as $key => $value) {
            $dataAll[$key] = ['id' => $value['id'], 'name' => $value['code_acc'] .' - '.$value['name']];
        }

        $mapping['out'] = $dataAll;

        return $mapping;
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
     * Finds the GovUnit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GovUnit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GovUnit::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
