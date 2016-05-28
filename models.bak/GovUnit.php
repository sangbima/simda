<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "gov_unit".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 * @property integer $gov_privilege_id
 * @property string $code
 * @property string $name
 * @property string $code_acc
 * @property string $address
 * @property integer $province_id
 * @property integer $kabupatenkota_id
 * @property integer $kecamatan_id
 * @property integer $desakelurahan_id
 * @property string $postal_code
 * @property string $phone
 * @property string $pic_name
 * @property string $pic_nip
 * @property string $pic_title
 * @property string $keeper_name
 * @property string $keeper_nip
 * @property string $keeper_title
 * @property string $latitude
 * @property string $longitude
 *
 * @property BatchKiba[] $batchKibas
 * @property Desakelurahan $desakelurahan
 * @property GovPrivilege $govPrivilege
 * @property Kabupatenkota $kabupatenkota
 * @property Kecamatan $kecamatan
 * @property Province $province
 * @property Room[] $rooms
 */
class GovUnit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gov_unit';
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
            [['user_id', 'gov_privilege_id', 'province_id', 'kabupatenkota_id', 'kecamatan_id', 'desakelurahan_id'], 'integer'],
            [['gov_privilege_id', 'code', 'name', 'code_acc'], 'required'],
            [['latitude', 'longitude'], 'number'],
            [['code', 'code_acc', 'phone'], 'string', 'max' => 45],
            [['name', 'address'], 'string', 'max' => 200],
            [['postal_code'], 'string', 'max' => 10],
            [['pic_name', 'pic_nip', 'pic_title', 'keeper_name', 'keeper_nip', 'keeper_title'], 'string', 'max' => 100],
            [['code_acc'], 'unique'],
            [['desakelurahan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Desakelurahan::className(), 'targetAttribute' => ['desakelurahan_id' => 'id']],
            [['gov_privilege_id'], 'exist', 'skipOnError' => true, 'targetClass' => GovPrivilege::className(), 'targetAttribute' => ['gov_privilege_id' => 'id']],
            [['kabupatenkota_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kabupatenkota::className(), 'targetAttribute' => ['kabupatenkota_id' => 'id']],
            [['kecamatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kecamatan::className(), 'targetAttribute' => ['kecamatan_id' => 'id']],
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
            'gov_privilege_id' => 'Gov Privilege ID',
            'code' => 'Code',
            'name' => 'Name',
            'code_acc' => 'Code Acc',
            'address' => 'Address',
            'province_id' => 'Province ID',
            'kabupatenkota_id' => 'Kabupatenkota ID',
            'kecamatan_id' => 'Kecamatan ID',
            'desakelurahan_id' => 'Desakelurahan ID',
            'postal_code' => 'Postal Code',
            'phone' => 'Phone',
            'pic_name' => 'Pic Name',
            'pic_nip' => 'Pic Nip',
            'pic_title' => 'Pic Title',
            'keeper_name' => 'Keeper Name',
            'keeper_nip' => 'Keeper Nip',
            'keeper_title' => 'Keeper Title',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchKibas()
    {
        return $this->hasMany(BatchKiba::className(), ['gov_unit_id' => 'id']);
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
    public function getGovPrivilege()
    {
        return $this->hasOne(GovPrivilege::className(), ['id' => 'gov_privilege_id']);
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
    public function getProvince()
    {
        return $this->hasOne(Province::className(), ['id' => 'province_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return $this->hasMany(Room::className(), ['gov_unit_id' => 'id']);
    }
}
