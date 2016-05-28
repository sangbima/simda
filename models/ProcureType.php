<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "procure_type".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 * @property string $name
 *
 * @property BatchKiba[] $batchKibas
 * @property BatchKibb[] $batchKibbs
 * @property BatchKibc[] $batchKibcs
 * @property BatchKibd[] $batchKibds
 * @property BatchKibe[] $batchKibes
 * @property BatchKibf[] $batchKibfs
 */
class ProcureType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'procure_type';
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
            [['name'], 'required'],
            [['name'], 'string', 'max' => 45],
            [['name'], 'unique'],
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
            'name' => 'Asal Perolehan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchKibas()
    {
        return $this->hasMany(BatchKiba::className(), ['procure_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchKibbs()
    {
        return $this->hasMany(BatchKibb::className(), ['procure_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchKibcs()
    {
        return $this->hasMany(BatchKibc::className(), ['procure_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchKibds()
    {
        return $this->hasMany(BatchKibd::className(), ['procure_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchKibes()
    {
        return $this->hasMany(BatchKibe::className(), ['procure_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchKibfs()
    {
        return $this->hasMany(BatchKibf::className(), ['procure_type_id' => 'id']);
    }
}
