<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "room".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 * @property string $code
 * @property string $name
 * @property integer $gov_unit_id
 *
 * @property GovUnit $govUnit
 */
class Room extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'room';
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
            [['user_id', 'gov_unit_id'], 'integer'],
            [['code', 'name', 'gov_unit_id'], 'required'],
            [['code'], 'string', 'max' => 45],
            [['name'], 'string', 'max' => 100],
            [['code'], 'unique'],
            [['gov_unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => GovUnit::className(), 'targetAttribute' => ['gov_unit_id' => 'id']],
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
            'code' => 'Code',
            'name' => 'Name',
            'gov_unit_id' => 'Gov Unit ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGovUnit()
    {
        return $this->hasOne(GovUnit::className(), ['id' => 'gov_unit_id']);
    }
}
