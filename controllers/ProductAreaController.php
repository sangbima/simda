<?php

namespace app\controllers;

use Yii;
use app\models\ProductArea;
use app\models\ProductAreaSearch;
use app\models\ProductType;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ProductAreaController implements the CRUD actions for ProductArea model.
 */
class ProductAreaController extends Controller
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
     * Lists all ProductArea models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductAreaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductArea model.
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
     * Creates a new ProductArea model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductArea();

        if ($model->load(Yii::$app->request->post())) {
            $codeProductType = ProductType::findOne($model->product_type_id);
            $model->code_acc = $codeProductType->code_acc . '.' . $model->code;
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
     * Updates an existing ProductArea model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $codeProductType = ProductType::findOne($model->product_type_id);
            $model->code_acc = $codeProductType->code_acc . '.' . $model->code;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ProductArea model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionGetCodeProductType($id)
    {
        $number = $this->autoNumber($id);

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return [
            'nextnumber' => $number,
        ];
    }

    protected function autoNumber($id)
    {
        $model = ProductArea::find()->select('code')->where(['product_type_id' => $id])->orderBy(['code' => SORT_DESC])->one();
        // kode = 00.00
        if(empty($model->code)) {
            $newCode = sprintf("%02d", 0 + 1);    
        } else {
            $newCode = sprintf("%02d", $model->code + 1);
        }
        
        return $newCode;
    }

    /**
     * Finds the ProductArea model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductArea the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductArea::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
