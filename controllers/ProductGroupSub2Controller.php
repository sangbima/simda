<?php

namespace app\controllers;

use Yii;
use app\models\ProductGroupSub2;
use app\models\ProductGroupSub2Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;

/**
 * ProductGroupSub2Controller implements the CRUD actions for ProductGroupSub2 model.
 */
class ProductGroupSub2Controller extends Controller
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
     * Lists all ProductGroupSub2 models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductGroupSub2Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductGroupSub2 model.
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
     * Creates a new ProductGroupSub2 model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductGroupSub2();

        if ($model->load(Yii::$app->request->post())) {
            $codeProductGroupSub1 = \app\models\ProductGroupSub1::findOne($model->product_group_sub1_id);
            $model->code_acc = $codeProductGroupSub1->code_acc . '.' . $model->code;
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ProductGroupSub2 model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $codeProductGroupSub1 = \app\models\ProductGroupSub1::findOne($model->product_group_sub1_id);
            $model->code_acc = $codeProductGroupSub1->code_acc . '.' . $model->code;
            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $modelProductGroupSub1 = \app\models\ProductGroupSub1::findOne($model->product_group_sub1_id);
            $modelProductGroup = \app\models\ProductGroup::findOne($modelProductGroupSub1->product_group_id);
            $modelProductArea = \app\models\ProductArea::findOne($modelProductGroup->product_area_id);
            $modelProductType = \app\models\ProductType::findOne($modelProductArea->product_type_id);
            $model->product_type_id = $modelProductType->id;
            $model->product_area_id = $modelProductArea->id;
            $model->product_group_id = $modelProductGroup->id;

            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ProductGroupSub2 model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionGetCodeProductGroupSub1($id)
    {
        $number = $this->autoNumber($id);

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return [
            'nextnumber' => $number,
        ];
    }

    protected function autoNumber($id)
    {
        $model = ProductGroupSub2::find()->select('code')->where(['product_group_sub1_id' => $id])->orderBy(['code' => SORT_DESC])->one();
        // kode = 00.00
        if(empty($model->code)) {
            $newCode = sprintf("%02d", 0 + 1);    
        } else {
            $newCode = sprintf("%02d", $model->code + 1);
        }
        
        return $newCode;
    }

    public function actionListProductArea()
    {
        $out = [];
        if(isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if($parents != null) {
                $product_type_id = $parents[0];

                $data = self::getProductArea($product_type_id);
                echo Json::encode(['output'=>$data['out'], 'selected'=>'']);

                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function getProductArea($product_type_id)
    {
        $datas = \app\models\ProductArea::find()->where(['product_type_id' => $product_type_id])->all();

        $dataAll = array();
        foreach ($datas as $key => $value) {
            $dataAll[$key] = ['id' => $value['id'], 'name' => $value['code_acc'] .' - '.$value['name']];
        }

        $mapping['out'] = $dataAll;
        return $mapping;
    }

    public function actionListProductGroup()
    {
        $out = [];
        if(isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if($parents != null) {
                $product_area_id = $parents[0];

                $data = self::getProductGroup($product_area_id);
                echo Json::encode(['output'=>$data['out'], 'selected'=>'']);

                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function getProductGroup($product_area_id)
    {
        $datas = \app\models\ProductGroup::find()->where(['product_area_id' => $product_area_id])->all();

        $dataAll = array();
        foreach ($datas as $key => $value) {
            $dataAll[$key] = ['id' => $value['id'], 'name' => $value['code_acc'] .' - '.$value['name']];
        }

        $mapping['out'] = $dataAll;

        return $mapping;
    }

    public function actionListProductGroupSub1()
    {
        $out = [];
        if(isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if($parents != null) {
                $product_group_id = end($parents);

                $data = self::getProductGroupSub1($product_group_id);
                echo Json::encode(['output'=>$data['out'], 'selected'=>'']);

                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function getProductGroupSub1($product_group_id)
    {
        $datas = \app\models\ProductGroupSub1::find()->where(['product_group_id' => $product_group_id])->all();

        $dataAll = array();
        foreach ($datas as $key => $value) {
            $dataAll[$key] = ['id' => $value['id'], 'name' => $value['code_acc'] .' - '.$value['name']];
        }

        $mapping['out'] = $dataAll;
        
        return $mapping;
    }

    /**
     * Finds the ProductGroupSub2 model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductGroupSub2 the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductGroupSub2::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
