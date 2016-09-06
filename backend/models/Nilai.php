<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "nilai".
 *
 * @property integer $id
 * @property string $nilai
 * @property integer $id_dhs
 * @property integer $id_sp
 *
 * @property Dhs $idDhs
 * @property SemesterPendek $idSp
 */
class Nilai extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nilai';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nilai', 'id_dhs', ], 'required'],
            [['id_dhs', 'id_sp'], 'integer'],
            [['nilai'], 'string', 'max' => 11],
            [['id_dhs'], 'exist', 'skipOnError' => true, 'targetClass' => Dhs::className(), 'targetAttribute' => ['id_dhs' => 'id']],
            [['id_sp'], 'exist', 'skipOnError' => true, 'targetClass' => SemesterPendek::className(), 'targetAttribute' => ['id_sp' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nilai' => 'Nilai',
            'id_dhs' => 'Id Matakuliah',
            'id_sp' => 'Id Sp',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDhs()
    {
        return $this->hasOne(Dhs::className(), ['id' => 'id_dhs']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSp()
    {
        return $this->hasOne(SemesterPendek::className(), ['id' => 'id_sp']);
    }
}
