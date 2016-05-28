<?php

namespace app\controllers;

use Yii;
use app\models\BatchKibc;
use app\models\BatchKibcSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use yii\helpers\Json;

/**
 * BatchKibcController implements the CRUD actions for BatchKibc model.
 */
class BatchKibcController extends Controller
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
     * Lists all BatchKibc models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BatchKibcSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BatchKibc model.
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
     * Creates a new BatchKibc model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BatchKibc();

        if ($model->load(Yii::$app->request->post())) {

            $model->procure_date = $model->procure_date ? date('Y-m-d', strtotime($model->procure_date)) : null;
            $model->document_date = $model->document_date ? date('Y-m-d', strtotime($model->document_date)) : null;

            $modelGovUnit = \app\models\GovUnit::findOne($model->gov_unit_id);
            $modelProductGroupSub2 = \app\models\ProductGroupSub2::findOne($model->product_group_sub2_id);

            if(isset($modelGovUnit->code_acc) && isset($modelProductGroupSub2->code_acc)) {
                $model->code_main = $modelGovUnit->code_acc . '.' . $modelProductGroupSub2->code_acc;
                $model->code_start_num = $this->autoNumber($model->code_main);
                $model->benefit_year = $modelProductGroupSub2->benefit_year;
            }

            if($model->validate()) {
                if($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                $model->code_asset = $model->code_main . '-' . $model->code_start_num;
                $model->procure_year = date('Y', strtotime($model->procure_date));
                $model->procure_date = $model->procure_date ? date('d-m-Y', strtotime($model->procure_date)) : null;
                $model->document_date = $model->document_date ? date('d-m-Y', strtotime($model->document_date)) : null;
                return $this->render('create', [
                    'model' => $model,
                ]);
            }

        } else {
            $model->semester = 1;
            $model->excomp = 0;
            $model->condition = "BAIK";
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BatchKibc model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $model->procure_date = $model->procure_date ? date('Y-m-d', strtotime($model->procure_date)) : null;
            $model->document_date = $model->document_date ? date('Y-m-d', strtotime($model->document_date)) : null;

            $modelGovUnit = \app\models\GovUnit::findOne($model->gov_unit_id);
            $modelProductGroupSub2 = \app\models\ProductGroupSub2::findOne($model->product_group_sub2_id);

            if(isset($modelGovUnit->code_acc) && isset($modelProductGroupSub2->code_acc)) {
                $model->code_main = $modelGovUnit->code_acc . '.' . $modelProductGroupSub2->code_acc;
                $model->benefit_year = $modelProductGroupSub2->benefit_year;
            }

            if($model->validate()) {
                if($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                $model->code_asset = $model->code_main . '-' . $model->code_start_num;
                $model->procure_year = date('Y', strtotime($model->procure_date));
                $model->procure_date = $model->procure_date ? date('d-m-Y', strtotime($model->procure_date)) : null;
                $model->document_date = $model->document_date ? date('d-m-Y', strtotime($model->document_date)) : null;
                return $this->render('update', [
                    'model' => $model,
                ]);
            }

        } else {
            $model->procure_date = $model->procure_date ? date('d-m-Y', strtotime($model->procure_date)) : null;
            $model->document_date = $model->document_date ? date('d-m-Y', strtotime($model->document_date)) : null;
            $model->procure_year = date('Y', strtotime($model->procure_date));
            $model->code_asset = $model->code_main . '-' . $model->code_start_num;
            $modelProductGroupSub2 = \app\models\ProductGroupSub2::find()->where(['id' => $model->product_group_sub2_id])->one();
            $model->benefit_year = $modelProductGroupSub2->benefit_year;
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BatchKibc model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionGetBenefitYear($id)
    {
        $modelProductGroupSub2 = \app\models\ProductGroupSub2::find()->where(['id' => $id])->one();
        
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return [
            'modelproductgroupsub2' => $modelProductGroupSub2,
        ];
    }

    public function actionGetCodeMain($id)
    {
        $ids = explode('-', $id);
        $idGovPrivilege = $ids[0];
        $idProductGroupSub2 = end($ids);
        $modelGovUnit = \app\models\GovUnit::findOne($idGovPrivilege);
        $modelProductGroupSub2 = \app\models\ProductGroupSub2::findOne($idProductGroupSub2);

        $code_main = $modelGovUnit->code_acc . '.' . $modelProductGroupSub2->code_acc;
        $newNumber = $this->autoNumber($code_main);

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return [
            'codeasset' => $code_main . '-' . $newNumber,
        ];
    }

    protected function autoNumber($code_main)
    {
        $newCode = null;

        $model = BatchKibc::find()->where(['code_main' => $code_main])->orderBy(['code_start_num' => SORT_DESC])->one();
        if ($model) {
            $oldNumber = $model->code_start_num + $model->quantity;

            if(empty($oldNumber)) {
                $newCode = 1;    
            } else {
                $newCode = $oldNumber;
            }
        }
        return $newCode == null ? '1' : $newCode;
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

    public function actionListroom()
    {
        $out = [];
        if(isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if($parents != null) {
                $gov_unit_id = $parents[0];

                $data = self::getRoom($gov_unit_id);
                echo Json::encode(['output'=>$data['out'], 'selected'=>'']);

                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    /**
     * Finds the BatchKibc model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BatchKibc the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BatchKibc::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
