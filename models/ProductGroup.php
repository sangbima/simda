<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "product_group".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 * @property integer $product_area_id
 * @property string $code
 * @property string $name
 * @property string $code_acc
 *
 * @property ProductArea $productArea
 * @property ProductGroupSub1[] $productGroupSub1s
 */
class ProductGroup extends \yii\db\ActiveRecord
{
    public $product_type_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_group';
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
            [['user_id', 'product_area_id'], 'integer'],
            [['product_area_id', 'code', 'name', 'code_acc', 'product_type_id'], 'required'],
            [['code', 'code_acc'], 'string', 'max' => 45],
            [['name'], 'string', 'max' => 200],
            [['code_acc'], 'unique'],
            [['product_area_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductArea::className(), 'targetAttribute' => ['product_area_id' => 'id']],
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
            'product_area_id' => 'Bidang Barang',
            'product_type_id' => 'Golongan Barang',
            'code' => 'Kode',
            'name' => 'Nama Rekening',
            'code_acc' => 'Kode Rekening',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductArea()
    {
        return $this->hasOne(ProductArea::className(), ['id' => 'product_area_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductGroupSub1s()
    {
        return $this->hasMany(ProductGroupSub1::className(), ['product_group_id' => 'id']);
    }

    public function getProductAreaList()
    {
        $datas = \app\models\ProductArea::find()->asArray()->all();

        $dataAll = array();
        foreach ($datas as $key => $value) {
            $dataAll[$key] = ['id' => $value['id'], 'name' => $value['code_acc'] .' - '.$value['name']];
        }

        return $datas ? ArrayHelper::map($dataAll, 'id', 'name') : [];
    }

    public function getProductTypeList()
    {
        $datas = \app\models\ProductType::find()->asArray()->all();

        $dataAll = array();
        foreach ($datas as $key => $value) {
            $dataAll[$key] = ['id' => $value['id'], 'name' => $value['code_acc'] .' - '.$value['name']];
        }

        return $datas ? ArrayHelper::map($dataAll, 'id', 'name') : [];
    }
}
