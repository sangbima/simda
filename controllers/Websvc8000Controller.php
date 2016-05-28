<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\filters\auth\QueryParamAuth;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;

/**
* List/Daftar: Lokasi, Petani, Lahan, Varietas, Produksi
*/
class Websvc8000Controller extends \yii\rest\Controller
{

  protected function verbs()
  {

    return [
      'list-announcement' => ['GET','OPTIONS'],
      'options' => ['OPTIONS'],
    ];

  }

  /**
   * @inheritdoc
   */
  public function behaviors()
  {
      $behaviors = parent::behaviors();

      $behaviors['authenticator'] = [
          // 'class' => QueryParamAuth::className(),
          'class' => \app\components\CustomAuth::className(),
          'tokenParam' => 'X-Auth-Token',
          'except' => ['options']
      ];

      $behaviors['corsFilter'] = [
          'class' => \yii\filters\Cors::className(),
          'cors' => [
              'Origin' => ['*'],
              'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
              'Access-Control-Request-Headers' => ['*'],
              'Access-Control-Allow-Credentials' => true,
              //'Access-Control-Max-Age' => 86400,
          ]
      ];

      return $behaviors;
  }

  public function actions()
  {
      return [
          'options' => [
              'class'             => 'yii\rest\OptionsAction',
              'collectionOptions' => ['OPTIONS'],
              'resourceOptions'   => ['OPTIONS'],
          ],
      ];
  }


  public function actionOptions()
  {
    \Yii::$app->getResponse()->getHeaders()->set('Allow', 'OPTIONS');
  }

  /**
  * Daftar Pengumuman
  * Method GET
  * Request -
  * return judul, isi, publish_start, publish_end
  */
  public function actionListAnnouncement()
  {
    $model = \app\models\Announcement::find()->select('id, title, content, publish_start, publish_end')
            ->orderBy([
              'created_at' => SORT_ASC
            ])
            ->all();

    return $model;
  }
}