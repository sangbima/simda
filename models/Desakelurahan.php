<?php

namespace app\models;

use Yii;

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
 * @property Kecamatan $kecamatan
 * @property GovPrivilege[] $govPrivileges
 * @property GovUnit[] $govUnits
 * @property GovUser[] $govUsers
 * @property User[] $users
 */
class Desakelurahan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'desakelurahan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['user_id', 'kecamatan_id'], 'integer'],
            [['kecamatan_id', 'code', 'name'], 'required'],
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
            'kecamatan_id' => 'Kecamatan ID',
            'code' => 'Code',
            'name' => 'Name',
            'type' => 'Type',
        ];
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
}
