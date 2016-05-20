<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gov_main".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 * @property string $code
 * @property string $name
 * @property string $code_acc
 *
 * @property GovUser[] $govUsers
 */
class GovMain extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gov_main';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['user_id'], 'integer'],
            [['code', 'name', 'code_acc'], 'required'],
            [['code', 'code_acc'], 'string', 'max' => 45],
            [['name'], 'string', 'max' => 200],
            [['code_acc'], 'unique'],
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
            'code_acc' => 'Code Acc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGovUsers()
    {
        return $this->hasMany(GovUser::className(), ['gov_main_id' => 'id']);
    }
}
