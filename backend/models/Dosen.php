<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "dosen".
 *
 * @property integer $id_dosen
 * @property string $nama_dosen
 * @property string $email
 * @property integer $id_matakuliah
 */
class Dosen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dosen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_dosen', 'email', 'id_matakuliah'], 'required'],
            [['id_matakuliah'], 'integer'],
            [['nama_dosen'], 'string', 'max' => 50],
            ['email', 'email'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_dosen' => 'Id Dosen',
            'nama_dosen' => 'Nama Dosen',
            'email' => 'Email',
            'id_matakuliah' => 'Matakuliah',
        ];
    }
}
