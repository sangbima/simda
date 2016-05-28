<?php

namespace app\controllers;

use Yii;
use app\models\Room;
use app\models\RoomSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;

/**
 * RoomController implements the CRUD actions for Room model.
 */
class RoomController extends Controller
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
     * Lists all Room models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RoomSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Room model.
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
     * Creates a new Room model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Room();

        if ($model->load(Yii::$app->request->post())) {
            $codeGovUnit = \app\models\GovUnit::findOne($model->gov_unit_id);
            $model->code_acc = $codeGovUnit->code_acc . '.' . $model->code;
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
     * Updates an existing Room model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $codeGovUnit = \app\models\GovUnit::findOne($model->gov_unit_id);
            $model->code_acc = $codeGovUnit->code_acc . '.' . $model->code;
            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $modelGovUnit = \app\models\GovUnit::findOne($model->gov_unit_id);
            $modelGovPrivilege = \app\models\GovPrivilege::findOne($modelGovUnit->gov_privilege_id);
            $modelGovUser = \app\models\GovUser::findOne($modelGovPrivilege->gov_user_id);
            $modelGovMain = \app\models\GovMain::findOne($modelGovUser->gov_main_id);
            $model->gov_main_id = $modelGovMain->id;
            $model->gov_user_id = $modelGovUser->id;
            $model->gov_privilege_id = $modelGovPrivilege->id;
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Room model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionGetCodeRoom($id)
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
            $model = Room::find()->select('code')->where(['gov_unit_id' => $id])->orderBy(['code' => SORT_DESC])->one();
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
                $gov_user_id = $parents[0];

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

    public function actionListGovUnit()
    {
        $out = [];
        if(isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if($parents != null) {
                $gov_privilege_id = end($parents);

                $data = self::getGovUnit($gov_privilege_id);
                echo Json::encode(['output'=>$data['out'], 'selected'=>'']);

                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function getGovUnit($gov_privilege_id)
    {
        $datas = \app\models\GovUnit::find()->where(['gov_privilege_id' => $gov_privilege_id])->all();

        $dataAll = array();
        foreach ($datas as $key => $value) {
            $dataAll[$key] = ['id' => $value['id'], 'name' => $value['code_acc'] .' - '.$value['name']];
        }

        $mapping['out'] = $dataAll;

        return $mapping;
    }

    /**
     * Finds the Room model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Room the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Room::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
