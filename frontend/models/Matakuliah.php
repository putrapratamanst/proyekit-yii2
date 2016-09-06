<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "matakuliah".
 *
 * @property integer $id
 * @property string $matakuliah
 * @property integer $sks
 * @property integer $jam
 * @property integer $id_tahun_ajaran
 * @property integer $semester
 *
 * @property Dhs[] $dhs
 * @property TahunAjaran $idTahunAjaran
 */
class Matakuliah extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'matakuliah';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['matakuliah', 'sks', 'jam', 'id_tahun_ajaran', 'semester'], 'required'],
            [['sks', 'jam', 'id_tahun_ajaran', 'semester'], 'integer'],
            [['matakuliah'], 'string', 'max' => 50],
            [['id_tahun_ajaran'], 'exist', 'skipOnError' => true, 'targetClass' => TahunAjaran::className(), 'targetAttribute' => ['id_tahun_ajaran' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'matakuliah' => 'Matakuliah',
            'sks' => 'Sks',
            'jam' => 'Jam',
            'id_tahun_ajaran' => 'Id Tahun Ajaran',
            'semester' => 'Semester',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDhs()
    {
        return $this->hasMany(Dhs::className(), ['id_matakuliah' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTahunAjaran()
    {
        return $this->hasOne(TahunAjaran::className(), ['id' => 'id_tahun_ajaran']);
    }
}
