<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "dosen".
 *
 * @property integer $id_dosen
 * @property integer $nama_dosen
 * @property string $alamat
 * @property string $email
 * @property string $no_hp
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
            [['id_dosen', 'nama_dosen', 'alamat', 'email', 'no_hp', 'id_matakuliah'], 'required'],
            [['id_dosen', 'nama_dosen', 'id_matakuliah'], 'integer'],
            [['alamat', 'email'], 'string', 'max' => 100],
            [['no_hp'], 'string', 'max' => 20],
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
            'alamat' => 'Alamat',
            'email' => 'Email',
            'no_hp' => 'No Hp',
            'id_matakuliah' => 'Id Matakuliah',
        ];
    }
}
