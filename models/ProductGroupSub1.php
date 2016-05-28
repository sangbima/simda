<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "product_group_sub1".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 * @property integer $product_group_id
 * @property string $code
 * @property string $name
 * @property string $code_acc
 *
 * @property ProductGroup $productGroup
 * @property ProductGroupSub2[] $productGroupSub2s
 */
class ProductGroupSub1 extends \yii\db\ActiveRecord
{
    public $product_type_id, $product_area_id;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_group_sub1';
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
            [['user_id', 'product_group_id'], 'integer'],
            [['product_group_id', 'code', 'name', 'code_acc', 'product_type_id', 'product_area_id'], 'required'],
            [['code', 'code_acc'], 'string', 'max' => 45],
            [['name'], 'string', 'max' => 200],
            [['code_acc'], 'unique'],
            [['product_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductGroup::className(), 'targetAttribute' => ['product_group_id' => 'id']],
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
            'product_group_id' => 'Kelompok Barang',
            'product_type_id' => 'Golongan Barang',
            'product_area_id' => 'Bidang Barang',
            'code' => 'Kode',
            'name' => 'Nama Rekening',
            'code_acc' => 'Kode Rekening',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductGroup()
    {
        return $this->hasOne(ProductGroup::className(), ['id' => 'product_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductGroupSub2s()
    {
        return $this->hasMany(ProductGroupSub2::className(), ['product_group_sub1_id' => 'id']);
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

    public function getProductAreaList()
    {
        $datas = \app\models\ProductArea::find()->asArray()->all();

        $dataAll = array();
        foreach ($datas as $key => $value) {
            $dataAll[$key] = ['id' => $value['id'], 'name' => $value['code_acc'] .' - '.$value['name']];
        }

        return $datas ? ArrayHelper::map($dataAll, 'id', 'name') : [];
    }

    public function getProductGroupList()
    {
        $datas = \app\models\ProductGroup::find()->asArray()->all();

        $dataAll = array();
        foreach ($datas as $key => $value) {
            $dataAll[$key] = ['id' => $value['id'], 'name' => $value['code_acc'] .' - '.$value['name']];
        }

        return $datas ? ArrayHelper::map($dataAll, 'id', 'name') : [];
    }
}
