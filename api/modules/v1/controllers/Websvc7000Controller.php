<?php

namespace api\modules\v1\controllers;

use \yii\rest\Controller;

class Websvc7000Controller extends Controller
{

  protected function verbs()
  {

    return [
      'login' => ['POST','OPTIONS'],
    ];

  }

  public function behaviors()
  {
    $behaviors = parent::behaviors();

    $behaviors['corsFilter'] = [
        'class' => \yii\filters\Cors::className(),
        'cors' => [
            'Origin' => ['*'],
            'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
            'Access-Control-Request-Headers' => ['*'],
            'Access-Control-Allow-Credentials' => true,
            'Access-Control-Max-Age' => 86400,
        ],
    ];

    return $behaviors;
  }

  protected function generateAuthKey()
  {
    return Yii::$app->security->generateRandomString();
  }

  public function actionLogin()
  {
    $request = Yii::$app->request;
    $username = $request->post('username');
    $password = $request->post('password');

    $response = [];

    if(empty($username) || empty($password)) {
      $response = [
        'token' => ''
      ];
    } else {
      $model = \app\models\User::findByUsername($username);
      // var_dump($model);die();
      if(!empty($model)) {
        if($model->validatePassword($password)) {

          $model->auth_key = $this->generateAuthKey();
          if($model->save(false)) {
            $response = [
              'token' => $model->auth_key,
              'user' => [
                  'id' => $model->id,
                  'username' => $model->username,
                  'nama' => $model->name,
                  'level' => 'operator'
              ]
            ];
          } else {
            $response = [
              'token' => ''
            ];
          }
        } else {
          $response = [
            'token' => ''
          ];
        }
      } else {
        $response = [
          'token' => ''
        ];
      }
    }

    return $response;

  }

}
