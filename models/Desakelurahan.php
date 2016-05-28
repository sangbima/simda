<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "desakelurahan".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 * @property integer $kecamatan_id
 * @property string $code
 * @property string $name
 * @property string $type
 *
 * @property BatchKiba[] $batchKibas
 * @property BatchKibb[] $batchKibbs
 * @property BatchKibc[] $batchKibcs
 * @property BatchKibd[] $batchKibds
 * @property BatchKibe[] $batchKibes
 * @property BatchKibf[] $batchKibfs
 * @property Kecamatan $kecamatan
 * @property GovPrivilege[] $govPrivileges
 * @property GovUnit[] $govUnits
 * @property GovUser[] $govUsers
 * @property User[] $users
 */
class Desakelurahan extends \yii\db\ActiveRecord
{

    public $province_id;
    public $kabupatenkota_id;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'desakelurahan';
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
            [['user_id', 'kecamatan_id'], 'integer'],
            [['kecamatan_id', 'code', 'name', 'province_id', 'kabupatenkota_id'], 'required'],
            [['type'], 'string'],
            [['code'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 100],
            [['code'], 'unique'],
            [['kecamatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kecamatan::className(), 'targetAttribute' => ['kecamatan_id' => 'id']],
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
            'kecamatan_id' => 'Kecamatan',
            'province_id' => 'Provinsi',
            'kabupatenkota_id' => 'Kabupaten/Kota',
            'code' => 'Kode',
            'name' => 'Nama',
            'type' => 'Tipe',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchKibas()
    {
        return $this->hasMany(BatchKiba::className(), ['desakelurahan_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchKibbs()
    {
        return $this->hasMany(BatchKibb::className(), ['desakelurahan_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchKibcs()
    {
        return $this->hasMany(BatchKibc::className(), ['desakelurahan_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchKibds()
    {
        return $this->hasMany(BatchKibd::className(), ['desakelurahan_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchKibes()
    {
        return $this->hasMany(BatchKibe::className(), ['desakelurahan_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchKibfs()
    {
        return $this->hasMany(BatchKibf::className(), ['desakelurahan_id' => 'id']);
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
    public function getGovPrivileges()
    {
        return $this->hasMany(GovPrivilege::className(), ['desakelurahan_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGovUnits()
    {
        return $this->hasMany(GovUnit::className(), ['desakelurahan_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGovUsers()
    {
        return $this->hasMany(GovUser::className(), ['desakelurahan_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['desakelurahan_id' => 'id']);
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
}
