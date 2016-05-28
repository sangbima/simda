<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord; 
use yii\helpers\ArrayHelper; 
use yii\behaviors\TimestampBehavior; 
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "kabupatenkota".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 * @property integer $province_id
 * @property string $code
 * @property string $name
 * @property string $type
 *
 * @property BatchKiba[] $batchKibas
 * @property GovPrivilege[] $govPrivileges
 * @property GovUnit[] $govUnits
 * @property GovUser[] $govUsers
 * @property Province $province
 * @property Kecamatan[] $kecamatans
 * @property User[] $users
 */
class Kabupatenkota extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kabupatenkota';
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
            [['user_id', 'province_id'], 'integer'],
            [['province_id', 'code', 'name'], 'required'],
            [['type'], 'string'],
            [['code'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 100],
            [['code'], 'unique'],
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
            'province_id' => 'Province ID',
            'code' => 'Code',
            'name' => 'Name',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchKibas()
    {
        return $this->hasMany(BatchKiba::className(), ['kabupatenkota_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGovPrivileges()
    {
        return $this->hasMany(GovPrivilege::className(), ['kabupatenkota_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGovUnits()
    {
        return $this->hasMany(GovUnit::className(), ['kabupatenkota_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGovUsers()
    {
        return $this->hasMany(GovUser::className(), ['kabupatenkota_id' => 'id']);
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
    public function getKecamatans()
    {
        return $this->hasMany(Kecamatan::className(), ['kabupatenkota_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['kabupatenkota_id' => 'id']);
    }

    public function getProvinceList() 
    { 
        $data = \app\models\Province::find()->asArray()->all(); 
        return $data ? ArrayHelper::map($data, 'id', 'name') : []; 
    } 
}
