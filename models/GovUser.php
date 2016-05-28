<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "gov_user".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 * @property integer $gov_main_id
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
 * @property GovPrivilege[] $govPrivileges
 * @property Desakelurahan $desakelurahan
 * @property GovMain $govMain
 * @property Kabupatenkota $kabupatenkota
 * @property Kecamatan $kecamatan
 * @property Province $province
 */
class GovUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gov_user';
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
            [['user_id', 'gov_main_id', 'province_id', 'kabupatenkota_id', 'kecamatan_id', 'desakelurahan_id'], 'integer'],
            [['gov_main_id', 'code', 'name', 'code_acc'], 'required'],
            [['latitude', 'longitude'], 'number'],
            [['code', 'code_acc', 'phone'], 'string', 'max' => 45],
            [['name', 'address'], 'string', 'max' => 200],
            [['postal_code'], 'string', 'max' => 10],
            [['pic_name', 'pic_nip', 'pic_title', 'keeper_name', 'keeper_nip', 'keeper_title'], 'string', 'max' => 100],
            [['code_acc'], 'unique'],
            [['desakelurahan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Desakelurahan::className(), 'targetAttribute' => ['desakelurahan_id' => 'id']],
            [['gov_main_id'], 'exist', 'skipOnError' => true, 'targetClass' => GovMain::className(), 'targetAttribute' => ['gov_main_id' => 'id']],
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
            'gov_main_id' => 'Bidang Pemerintahan',
            'code' => 'Kode',
            'name' => 'Nama',
            'code_acc' => 'Kode Rekening',
            'address' => 'Alamat',
            'province_id' => 'Province',
            'kabupatenkota_id' => 'Kabupaten/Kota',
            'kecamatan_id' => 'Kecamatan',
            'desakelurahan_id' => 'Desa/Kelurahan',
            'postal_code' => 'Kode Pos',
            'phone' => 'Telp',
            'pic_name' => 'Nama Penanggung Jawab',
            'pic_nip' => 'NIP Penanggung Jawab',
            'pic_title' => 'Jabatan Penanggung Jawab',
            'keeper_name' => 'Nama Pemelihara',
            'keeper_nip' => 'NIP Pemelihara',
            'keeper_title' => 'Jabatan Pemelihara',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGovPrivileges()
    {
        return $this->hasMany(GovPrivilege::className(), ['gov_user_id' => 'id']);
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
    public function getGovMain()
    {
        return $this->hasOne(GovMain::className(), ['id' => 'gov_main_id']);
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

    public function getGovMainList()
    {
        $datas = \app\models\GovMain::find()->asArray()->all();

        $dataAll = array();
        foreach ($datas as $key => $value) {
            $dataAll[$key] = ['id' => $value['id'], 'name' => $value['code_acc'] .' - '.$value['name']];
        }

        return $datas ? ArrayHelper::map($dataAll, 'id', 'name') : [];
    }

    public function getProvinceList()
    {
        $data = \app\models\Province::find()->asArray()->all();
        return ArrayHelper::map($data, 'id', 'name');
    }

    public function getAllKabupatenKota()
    {
        $data = \app\models\Kabupatenkota::find()->asArray()->all();
        return ArrayHelper::map($data, 'id', 'name');
    }

    public function getAllKecamatan()
    {
        $data = \app\models\Kecamatan::find()->asArray()->all();
        return ArrayHelper::map($data, 'id', 'name');
    }

    public function getAllDesaKelurahan()
    {
        $data = \app\models\Desakelurahan::find()->asArray()->all();
        return ArrayHelper::map($data, 'id', 'name');
    }
}
