<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detail_kibb".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 * @property string $latitude
 * @property string $longitude
 * @property integer $batch_kibb_id
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
 * @property string $condition
 * @property integer $quantity
 * @property string $price_base
 * @property string $price_capital
 * @property string $price_total
 * @property string $semester
 * @property integer $room_id
 * @property string $description
 * @property string $police_no
 * @property string $expired_date
 * @property string $legal_no
 * @property string $merk
 * @property string $type
 * @property string $assembly_year
 * @property string $engine_no
 * @property string $chassis_no
 * @property string $material
 *
 * @property BatchKibb $batchKibb
 * @property Desakelurahan $desakelurahan
 * @property GovUnit $govUnit
 * @property Kabupatenkota $kabupatenkota
 * @property Kecamatan $kecamatan
 * @property ProcureType $procureType
 * @property ProductGroupSub2 $productGroupSub2
 * @property Province $province
 * @property Room $room
 */
class DetailKibb extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'detail_kibb';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'procure_date', 'expired_date', 'assembly_year'], 'safe'],
            [['user_id', 'batch_kibb_id', 'gov_unit_id', 'product_group_sub2_id', 'province_id', 'kabupatenkota_id', 'kecamatan_id', 'desakelurahan_id', 'procure_type_id', 'excomp', 'quantity', 'room_id'], 'integer'],
            [['latitude', 'longitude', 'price_base', 'price_capital', 'price_total'], 'number'],
            [['batch_kibb_id', 'gov_unit_id', 'product_group_sub2_id', 'code_asset', 'province_id', 'kabupatenkota_id', 'procure_date', 'procure_type_id', 'procure_doc', 'condition', 'price_base', 'price_total', 'police_no', 'legal_no', 'merk', 'chassis_no'], 'required'],
            [['condition', 'semester', 'description'], 'string'],
            [['code_asset', 'procure_doc', 'police_no', 'legal_no', 'merk', 'engine_no', 'chassis_no', 'material'], 'string', 'max' => 100],
            [['address'], 'string', 'max' => 500],
            [['asset_recipient'], 'string', 'max' => 45],
            [['type'], 'string', 'max' => 200],
            [['code_asset'], 'unique'],
            [['batch_kibb_id'], 'exist', 'skipOnError' => true, 'targetClass' => BatchKibb::className(), 'targetAttribute' => ['batch_kibb_id' => 'id']],
            [['desakelurahan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Desakelurahan::className(), 'targetAttribute' => ['desakelurahan_id' => 'id']],
            [['gov_unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => GovUnit::className(), 'targetAttribute' => ['gov_unit_id' => 'id']],
            [['kabupatenkota_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kabupatenkota::className(), 'targetAttribute' => ['kabupatenkota_id' => 'id']],
            [['kecamatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kecamatan::className(), 'targetAttribute' => ['kecamatan_id' => 'id']],
            [['procure_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProcureType::className(), 'targetAttribute' => ['procure_type_id' => 'id']],
            [['product_group_sub2_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductGroupSub2::className(), 'targetAttribute' => ['product_group_sub2_id' => 'id']],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Province::className(), 'targetAttribute' => ['province_id' => 'id']],
            [['room_id'], 'exist', 'skipOnError' => true, 'targetClass' => Room::className(), 'targetAttribute' => ['room_id' => 'id']],
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
            'batch_kibb_id' => 'Batch Kibb ID',
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
            'condition' => 'Condition',
            'quantity' => 'Quantity',
            'price_base' => 'Price Base',
            'price_capital' => 'Price Capital',
            'price_total' => 'Price Total',
            'semester' => 'Semester',
            'room_id' => 'Room ID',
            'description' => 'Description',
            'police_no' => 'Police No',
            'expired_date' => 'Expired Date',
            'legal_no' => 'Legal No',
            'merk' => 'Merk',
            'type' => 'Type',
            'assembly_year' => 'Assembly Year',
            'engine_no' => 'Engine No',
            'chassis_no' => 'Chassis No',
            'material' => 'Material',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchKibb()
    {
        return $this->hasOne(BatchKibb::className(), ['id' => 'batch_kibb_id']);
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
    public function getRoom()
    {
        return $this->hasOne(Room::className(), ['id' => 'room_id']);
    }
}
