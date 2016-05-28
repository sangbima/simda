<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "product_type".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 * @property string $code
 * @property string $name
 * @property string $code_acc
 *
 * @property ProductArea[] $productAreas
 */
class ProductType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_type';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
                'value' => function(){ return date('Y-m-d H:i:s'); /* MySql DATETIME */},
            ],
            'autouserid' => [
                'class' => BlameableBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['user_id'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['user_id'], 'integer'],
            [['code', 'name', 'code_acc'], 'required'],
            [['code', 'code_acc'], 'string', 'max' => 45],
            [['name'], 'string', 'max' => 200],
            [['code_acc'], 'unique'],
            [['code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
            'code' => 'Kode',
            'name' => 'Nama Rekening',
            'code_acc' => 'Kode Rekening',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductAreas()
    {
        return $this->hasMany(ProductArea::className(), ['product_type_id' => 'id']);
    }

    public function getProductTypeList()
    {
        $datas = ProductType::find()->asArray()->all();

        $dataAll = array();
        foreach ($datas as $key => $value) {
            $dataAll[$key] = ['id' => $value['id'], 'name' => $value['code_acc'] .' - '.$value['name']];
        }

        return $datas ? ArrayHelper::map($dataAll, 'id', 'name') : [];
    }
}
