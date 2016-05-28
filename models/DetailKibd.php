<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detail_kibd".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 * @property string $latitude
 * @property string $longitude
 * @property integer $batch_kibd_id
 * @property integer $gov_unit_id
 * @property integer $product_group_sub2_id
 * @property string $code_asset
 * @property integer $province_id
 * @property integer $kabupatenkota_id
 * @property integer $kecamatan_id
 * @property integer $desakelurahan_id
 * @property string $address
 * @property string $procure_date
 * @property integer $procure_type_id
 * @property string $procure_doc
 * @property integer $excomp
 * @property string $asset_recipient
 * @property integer $quantity
 * @property string $price_base
 * @property string $price_capital
 * @property string $price_total
 * @property string $semester
 * @property string $description
 * @property string $construction
 * @property string $land_status
 * @property string $length
 * @property string $width
 * @property string $size
 * @property string $land_code_no
 * @property string $document_no
 * @property string $document_date
 *
 * @property Desakelurahan $desakelurahan
 * @property GovUnit $govUnit
 * @property Kabupatenkota $kabupatenkota
 * @property Kecamatan $kecamatan
 * @property ProcureType $procureType
 * @property ProductGroupSub2 $productGroupSub2
 * @property Province $province
 * @property BatchKibd $batchKibd
 */
class DetailKibd extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'detail_kibd';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'procure_date', 'document_date'], 'safe'],
            [['user_id', 'batch_kibd_id', 'gov_unit_id', 'product_group_sub2_id', 'province_id', 'kabupatenkota_id', 'kecamatan_id', 'desakelurahan_id', 'procure_type_id', 'excomp', 'quantity'], 'integer'],
            [['latitude', 'longitude', 'price_base', 'price_capital', 'price_total', 'length', 'width', 'size'], 'number'],
            [['batch_kibd_id', 'gov_unit_id', 'product_group_sub2_id', 'code_asset', 'province_id', 'kabupatenkota_id', 'procure_date', 'procure_type_id', 'procure_doc', 'price_base', 'price_total', 'construction'], 'required'],
            [['semester', 'description', 'construction'], 'string'],
            [['code_asset', 'procure_doc', 'land_status', 'land_code_no', 'document_no'], 'string', 'max' => 100],
            [['address'], 'string', 'max' => 500],
            [['asset_recipient'], 'string', 'max' => 45],
            [['code_asset'], 'unique'],
            [['desakelurahan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Desakelurahan::className(), 'targetAttribute' => ['desakelurahan_id' => 'id']],
            [['gov_unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => GovUnit::className(), 'targetAttribute' => ['gov_unit_id' => 'id']],
            [['kabupatenkota_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kabupatenkota::className(), 'targetAttribute' => ['kabupatenkota_id' => 'id']],
            [['kecamatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kecamatan::className(), 'targetAttribute' => ['kecamatan_id' => 'id']],
            [['procure_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProcureType::className(), 'targetAttribute' => ['procure_type_id' => 'id']],
            [['product_group_sub2_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductGroupSub2::className(), 'targetAttribute' => ['product_group_sub2_id' => 'id']],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Province::className(), 'targetAttribute' => ['province_id' => 'id']],
            [['batch_kibd_id'], 'exist', 'skipOnError' => true, 'targetClass' => BatchKibd::className(), 'targetAttribute' => ['batch_kibd_id' => 'id']],
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
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'batch_kibd_id' => 'Batch Kibd ID',
            'gov_unit_id' => 'Gov Unit ID',
            'product_group_sub2_id' => 'Product Group Sub2 ID',
            'code_asset' => 'Code Asset',
            'province_id' => 'Province ID',
            'kabupatenkota_id' => 'Kabupatenkota ID',
            'kecamatan_id' => 'Kecamatan ID',
            'desakelurahan_id' => 'Desakelurahan ID',
            'address' => 'Address',
            'procure_date' => 'Procure Date',
            'procure_type_id' => 'Procure Type ID',
            'procure_doc' => 'Procure Doc',
            'excomp' => 'Excomp',
            'asset_recipient' => 'Asset Recipient',
            'quantity' => 'Quantity',
            'price_base' => 'Price Base',
            'price_capital' => 'Price Capital',
            'price_total' => 'Price Total',
            'semester' => 'Semester',
            'description' => 'Description',
            'construction' => 'Construction',
            'land_status' => 'Land Status',
            'length' => 'Length',
            'width' => 'Width',
            'size' => 'Size',
            'land_code_no' => 'Land Code No',
            'document_no' => 'Document No',
            'document_date' => 'Document Date',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchKibd()
    {
        return $this->hasOne(BatchKibd::className(), ['id' => 'batch_kibd_id']);
    }
}
