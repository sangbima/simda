<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "batch_kiba".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 * @property integer $gov_unit_id
 * @property integer $product_group_sub2_id
 * @property string $code_main
 * @property integer $code_start_num
 * @property integer $province_id
 * @property integer $kabupatenkota_id
 * @property integer $kecamatan_id
 * @property integer $desakelurahan_id
 * @property string $address
 * @property string $procure_date
 * @property integer $procure_type_id
 * @property string $document_no
 * @property integer $excomp
 * @property string $asset_recipient
 * @property string $price_base
 * @property string $price_capital
 * @property string $price_total
 * @property string $semester
 * @property string $description
 * @property string $land_status
 * @property integer $certificate_status
 * @property string $certificate_no
 * @property string $certificate_date
 * @property string $usage
 * @property string $size
 * @property string $size_unit
 *
 * @property Desakelurahan $desakelurahan
 * @property GovUnit $govUnit
 * @property Kabupatenkota $kabupatenkota
 * @property Kecamatan $kecamatan
 * @property ProcureType $procureType
 * @property ProductGroupSub2 $productGroupSub2
 * @property Province $province
 */
class BatchKiba extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'batch_kiba';
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
            [['created_at', 'updated_at', 'procure_date', 'certificate_date'], 'safe'],
            [['user_id', 'gov_unit_id', 'product_group_sub2_id', 'code_start_num', 'province_id', 'kabupatenkota_id', 'kecamatan_id', 'desakelurahan_id', 'procure_type_id', 'excomp', 'certificate_status'], 'integer'],
            [['gov_unit_id', 'product_group_sub2_id', 'code_main', 'code_start_num', 'province_id', 'kabupatenkota_id', 'procure_date', 'procure_type_id', 'document_no', 'price_base', 'price_total', 'land_status', 'size'], 'required'],
            [['price_base', 'price_capital', 'price_total', 'size'], 'number'],
            [['semester', 'description'], 'string'],
            [['code_main', 'asset_recipient', 'certificate_no', 'size_unit'], 'string', 'max' => 45],
            [['address'], 'string', 'max' => 500],
            [['document_no', 'land_status'], 'string', 'max' => 100],
            [['usage'], 'string', 'max' => 200],
            [['desakelurahan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Desakelurahan::className(), 'targetAttribute' => ['desakelurahan_id' => 'id']],
            [['gov_unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => GovUnit::className(), 'targetAttribute' => ['gov_unit_id' => 'id']],
            [['kabupatenkota_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kabupatenkota::className(), 'targetAttribute' => ['kabupatenkota_id' => 'id']],
            [['kecamatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kecamatan::className(), 'targetAttribute' => ['kecamatan_id' => 'id']],
            [['procure_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProcureType::className(), 'targetAttribute' => ['procure_type_id' => 'id']],
            [['product_group_sub2_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductGroupSub2::className(), 'targetAttribute' => ['product_group_sub2_id' => 'id']],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Province::className(), 'targetAttribute' => ['province_id' => 'id']],
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
            'gov_unit_id' => 'Gov Unit ID',
            'product_group_sub2_id' => 'Product Group Sub2 ID',
            'code_main' => 'Code Main',
            'code_start_num' => 'Code Start Num',
            'province_id' => 'Province ID',
            'kabupatenkota_id' => 'Kabupatenkota ID',
            'kecamatan_id' => 'Kecamatan ID',
            'desakelurahan_id' => 'Desakelurahan ID',
            'address' => 'Address',
            'procure_date' => 'Procure Date',
            'procure_type_id' => 'Procure Type ID',
            'document_no' => 'Document No',
            'excomp' => 'Excomp',
            'asset_recipient' => 'Asset Recipient',
            'price_base' => 'Price Base',
            'price_capital' => 'Price Capital',
            'price_total' => 'Price Total',
            'semester' => 'Semester',
            'description' => 'Description',
            'land_status' => 'Land Status',
            'certificate_status' => 'Certificate Status',
            'certificate_no' => 'Certificate No',
            'certificate_date' => 'Certificate Date',
            'usage' => 'Usage',
            'size' => 'Size',
            'size_unit' => 'Size Unit',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDesakelurahan()
    {
        return $this->hasOne(Desakelurahan::className(), ['id' => 'desakelurahan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGovUnit()
    {
        return $this->hasOne(GovUnit::className(), ['id' => 'gov_unit_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKabupatenkota()
    {
        return $this->hasOne(Kabupatenkota::className(), ['id' => 'kabupatenkota_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKecamatan()
    {
        return $this->hasOne(Kecamatan::className(), ['id' => 'kecamatan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcureType()
    {
        return $this->hasOne(ProcureType::className(), ['id' => 'procure_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductGroupSub2()
    {
        return $this->hasOne(ProductGroupSub2::className(), ['id' => 'product_group_sub2_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvince()
    {
        return $this->hasOne(Province::className(), ['id' => 'province_id']);
    }
}
