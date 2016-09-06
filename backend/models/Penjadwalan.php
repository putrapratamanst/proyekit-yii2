<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "penjadwalan".
 *
 * @property integer $id
 * @property integer $id_dosen
 * @property integer $id_matakuliah
 * @property string $jam
 * @property string $ruang
 *
 * @property Dosen $idDosen
 * @property Matakuliah $idMatakuliah
 */
class Penjadwalan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'penjadwalan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_dosen', 'id_matakuliah', 'jam', 'ruang'], 'required'],
            [['id_dosen', 'id_matakuliah'], 'integer'],
            [['jam', 'ruang'], 'string', 'max' => 11],
            [['id_dosen'], 'exist', 'skipOnError' => true, 'targetClass' => Dosen::className(), 'targetAttribute' => ['id_dosen' => 'id_dosen']],
            [['id_matakuliah'], 'exist', 'skipOnError' => true, 'targetClass' => Matakuliah::className(), 'targetAttribute' => ['id_matakuliah' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_dosen' => 'Id Dosen',
            'id_matakuliah' => 'Id Matakuliah',
            'jam' => 'Jam',
            'ruang' => 'Ruang',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDosen()
    {
        return $this->hasOne(Dosen::className(), ['id_dosen' => 'id_dosen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMatakuliah()
    {
        return $this->hasOne(Matakuliah::className(), ['id' => 'id_matakuliah']);
    }
}
