<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "semester_pendek".
 *
 * @property integer $id
 * @property string $npm
 * @property string $harga
 * @property string $waktu_daftar
 * @property integer $user_id
 *
 * @property Nilai[] $nilais
 * @property Mahasiswa $npm0
 */
class SemesterPendek extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'semester_pendek';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['npm', 'harga', 'waktu_daftar', 'user_id'], 'required'],
            [['waktu_daftar'], 'safe'],
            [['user_id'], 'integer'],
            [['npm'], 'string', 'max' => 7],
            [['harga'], 'string', 'max' => 20],
            [['npm'], 'exist', 'skipOnError' => true, 'targetClass' => Mahasiswa::className(), 'targetAttribute' => ['npm' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'npm' => 'Npm',
            'harga' => 'Harga',
            'waktu_daftar' => 'Waktu Daftar',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNilais()
    {
        return $this->hasMany(Nilai::className(), ['id_sp' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNpm0()
    {
        return $this->hasOne(Mahasiswa::className(), ['id' => 'npm']);
    }
}
