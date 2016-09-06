<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "approve".
 *
 * @property integer $id
 * @property string $approve_name
 * @property integer $approve_value
 */
class Approve extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'approve';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['approve_name', 'approve_value'], 'required'],
            [['approve_value'], 'integer'],
            [['approve_name'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'approve_name' => 'Approve Name',
            'approve_value' => 'Approve Value',
        ];
    }
}
