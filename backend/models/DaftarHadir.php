<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "daftar_hadir".
 *
 * @property integer $id
 * @property integer $id_penjadwalan
 * @property string $npm_mahasiswa
 *
 * @property Penjadwalan $idPenjadwalan
 * @property Mahasiswa $npmMahasiswa
 */
class DaftarHadir extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'daftar_hadir';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_penjadwalan', 'npm_mahasiswa'], 'required'],
            [['id_penjadwalan'], 'integer'],
            [['npm_mahasiswa'], 'string', 'max' => 7],
            [['id_penjadwalan'], 'exist', 'skipOnError' => true, 'targetClass' => Penjadwalan::className(), 'targetAttribute' => ['id_penjadwalan' => 'id']],
            [['npm_mahasiswa'], 'exist', 'skipOnError' => true, 'targetClass' => Mahasiswa::className(), 'targetAttribute' => ['npm_mahasiswa' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_penjadwalan' => 'Id Penjadwalan',
            'npm_mahasiswa' => 'Npm Mahasiswa',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPenjadwalan()
    {
        return $this->hasOne(Penjadwalan::className(), ['id' => 'id_penjadwalan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNpmMahasiswa()
    {
        return $this->hasOne(Mahasiswa::className(), ['id' => 'npm_mahasiswa']);
    }
}
