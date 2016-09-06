<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "pembayaran".
 *
 * @property integer $id
 * @property string $file
 * @property string $id_mahasiswa
 * @property integer $user_id
 *
 * @property Mahasiswa $idMahasiswa
 */
class Pembayaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pembayaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file', 'id_mahasiswa', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['file'], 'file', 'extensions' => ['png','jpg','gif','pdf']],
            [['id_mahasiswa'], 'string', 'max' => 7],
            [['id_mahasiswa'], 'exist', 'skipOnError' => true, 'targetClass' => Mahasiswa::className(), 'targetAttribute' => ['id_mahasiswa' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'file' => 'File',
            'id_mahasiswa' => 'Id Mahasiswa',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMahasiswa()
    {
        return $this->hasOne(Mahasiswa::className(), ['id' => 'id_mahasiswa']);
    }
}
