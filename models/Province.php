<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "province".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 * @property string $code
 * @property string $name
 *
 * @property BatchKiba[] $batchKibas
 * @property BatchKibb[] $batchKibbs
 * @property BatchKibc[] $batchKibcs
 * @property BatchKibd[] $batchKibds
 * @property BatchKibe[] $batchKibes
 * @property BatchKibf[] $batchKibfs
 * @property GovPrivilege[] $govPrivileges
 * @property GovUnit[] $govUnits
 * @property GovUser[] $govUsers
 * @property Kabupatenkota[] $kabupatenkotas
 * @property User[] $users
 */
class Province extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'province';
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
            [['user_id'], 'integer'],
            [['code', 'name'], 'required'],
            [['code'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 100],
            [['code'], 'unique'],
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
            'code' => 'Kode',
            'name' => 'Nama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchKibas()
    {
        return $this->hasMany(BatchKiba::className(), ['province_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchKibbs()
    {
        return $this->hasMany(BatchKibb::className(), ['province_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchKibcs()
    {
        return $this->hasMany(BatchKibc::className(), ['province_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchKibds()
    {
        return $this->hasMany(BatchKibd::className(), ['province_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchKibes()
    {
        return $this->hasMany(BatchKibe::className(), ['province_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchKibfs()
    {
        return $this->hasMany(BatchKibf::className(), ['province_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGovPrivileges()
    {
        return $this->hasMany(GovPrivilege::className(), ['province_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGovUnits()
    {
        return $this->hasMany(GovUnit::className(), ['province_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGovUsers()
    {
        return $this->hasMany(GovUser::className(), ['province_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKabupatenkotas()
    {
        return $this->hasMany(Kabupatenkota::className(), ['province_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['province_id' => 'id']);
    }

    public function getProvinceList()
    {
        $data = \app\models\Province::find()->asArray()->all();
        return ArrayHelper::map($data, 'id', 'name');
    }
}
