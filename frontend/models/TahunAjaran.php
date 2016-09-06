<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tahun_ajaran".
 *
 * @property integer $id
 * @property string $tahun_ajaran
 *
 * @property Matakuliah[] $matakuliahs
 */
class TahunAjaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tahun_ajaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tahun_ajaran'], 'required'],
            [['tahun_ajaran'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tahun_ajaran' => 'Tahun Ajaran',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatakuliahs()
    {
        return $this->hasMany(Matakuliah::className(), ['id_tahun_ajaran' => 'id']);
    }
}
