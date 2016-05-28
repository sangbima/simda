<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "product_group_sub2".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 * @property integer $product_group_sub1_id
 * @property string $code
 * @property string $name
 * @property string $code_acc
 * @property integer $benefit_year
 * @property string $shrink_percent
 *
 * @property BatchKiba[] $batchKibas
 * @property ProductGroupSub1 $productGroupSub1
 */
class ProductGroupSub2 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_group_sub2';
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
            [['user_id', 'product_group_sub1_id', 'benefit_year'], 'integer'],
            [['product_group_sub1_id', 'code', 'name', 'code_acc'], 'required'],
            [['shrink_percent'], 'number'],
            [['code', 'code_acc'], 'string', 'max' => 45],
            [['name'], 'string', 'max' => 200],
            [['code_acc'], 'unique'],
            [['product_group_sub1_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductGroupSub1::className(), 'targetAttribute' => ['product_group_sub1_id' => 'id']],
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
            'product_group_sub1_id' => 'Product Group Sub1 ID',
            'code' => 'Code',
            'name' => 'Name',
            'code_acc' => 'Code Acc',
            'benefit_year' => 'Benefit Year',
            'shrink_percent' => 'Shrink Percent',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchKibas()
    {
        return $this->hasMany(BatchKiba::className(), ['product_group_sub2_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductGroupSub1()
    {
        return $this->hasOne(ProductGroupSub1::className(), ['id' => 'product_group_sub1_id']);
    }
}
