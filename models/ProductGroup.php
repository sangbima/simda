<?php

namespace app\models;

use Yii;

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
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['user_id', 'product_area_id'], 'integer'],
            [['product_area_id', 'code', 'name', 'code_acc'], 'required'],
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
            'product_area_id' => 'Product Area ID',
            'code' => 'Code',
            'name' => 'Name',
            'code_acc' => 'Code Acc',
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
}
