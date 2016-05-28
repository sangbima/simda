<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
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
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $modelAnnouncement = \app\models\Announcement::find()->orderBy(['id' => SORT_DESC])->limit(2)->all();
        
        $countKiba = \app\models\BatchKiba::find()->sum('quantity');
        $countKibb = \app\models\BatchKibb::find()->sum('quantity');
        $countKibc = \app\models\BatchKibc::find()->sum('quantity');
        $countKibd = \app\models\BatchKibd::find()->sum('quantity');
        $countKibe = \app\models\BatchKibe::find()->sum('quantity');
        $countKibf = \app\models\BatchKibf::find()->sum('quantity');
        $countProvince = \app\models\Province::find()->count();
        $countKabupatenkota = \app\models\Kabupatenkota::find()->count();
        $countKecamatan = \app\models\Kecamatan::find()->count();
        $countDesakelurahan = \app\models\Desakelurahan::find()->count();
        $countGovMain = \app\models\GovMain::find()->count();
        $countGovUser = \app\models\GovUser::find()->count();
        $countGovPrivilege = \app\models\GovPrivilege::find()->count();
        $countUser = \app\models\User::find()->count();
        $countProductType = \app\models\ProductType::find()->count();
        $countProductArea = \app\models\ProductArea::find()->count();
        $countProductGroup = \app\models\ProductGroup::find()->count();
        $countProductGroupSub1 = \app\models\ProductGroupSub1::find()->count();
        $countProductGroupSub2 = \app\models\ProductGroupSub2::find()->count();

        return $this->render('index', [
            'announcements' => $modelAnnouncement,
            'countKiba' => $countKiba,
            'countKibb' => $countKibb,
            'countKibc' => $countKibc,
            'countKibd' => $countKibd,
            'countKibe' => $countKibe,
            'countKibf' => $countKibf,
            'countProvince' => $countProvince,
            'countKabupatenkota' => $countKabupatenkota,
            'countKecamatan' => $countKecamatan,
            'countDesakelurahan' => $countDesakelurahan,
            'countGovMain' => $countGovMain,
            'countGovUser' => $countGovUser,
            'countGovPrivilege' => $countGovPrivilege,
            'countUser' => $countUser,
            'countProductType' => $countProductType,
            'countProductArea' => $countProductArea,
            'countProductGroup' => $countProductGroup,
            'countProductGroupSub1' => $countProductGroupSub1,
            'countProductGroupSub2' => $countProductGroupSub2,
        ]);
    }

    public function actionLogin()
    {
        $this->layout = 'loginLayout';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
