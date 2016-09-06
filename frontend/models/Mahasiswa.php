<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mahasiswa".
 *
 * @property string $id
 * @property string $nama
 * @property string $kelas
 * @property string $tempat_lahir
 * @property string $tanggal_lahir
 * @property string $jenis_kelamin
 * @property string $agama
 * @property string $jurusan
 * @property integer $user_id
 *
 * @property Dhs[] $dhs
 * @property SemesterPendek[] $semesterPendeks
 */
class Mahasiswa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mahasiswa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nama', 'kelas', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'jurusan', 'user_id'], 'required'],
            [['tanggal_lahir'], 'safe'],
            [['user_id'], 'integer'],
            [['id'], 'string', 'max' => 7],
            [['nama', 'tempat_lahir'], 'string', 'max' => 50],
            [['kelas'], 'string', 'max' => 60],
            [['jenis_kelamin'], 'string', 'max' => 20],
            [['agama'], 'string', 'max' => 15],
            [['jurusan'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'NPM Mahasiswa',
            'nama' => 'Nama',
            'kelas' => 'Kelas',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'jenis_kelamin' => 'Jenis Kelamin',
            'agama' => 'Agama',
            'jurusan' => 'Jurusan',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDhs()
    {
        return $this->hasMany(Dhs::className(), ['npm_mahasiswa' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSemesterPendeks()
    {
        return $this->hasMany(SemesterPendek::className(), ['npm' => 'id']);
    }
}
