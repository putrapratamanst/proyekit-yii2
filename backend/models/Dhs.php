<?php

namespace backend\models;


use Yii;
use yii\helpers\Url;
use yii\base\Model;
use yii\web\UrlManager;
use backend\models\Mahasiswa;
use backend\models\MahasiswaSearch;
use yii\data\SqlDataProvider;
use backend\models\DhsSearch;
use yii\data\ActiveDataProvider;
use yii\db\Query;
//use backend\models\Semester;
/**
 * This is the model class for table "dhs".
 *
 * @property integer $id
 * @property integer $id_tahun_ajaran
 * @property string $npm_mahasiswa
 * @property string $semester
 * @property integer $user_id
 * @property integer $id_matakuliah
 * @property string $nilai
 *
 * @property Matakuliah $idMatakuliah
 * @property Mahasiswa $npmMahasiswa
 * @property Nilai[] $nilais
 */
class Dhs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dhs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tahun_ajaran', 'npm_mahasiswa', 'semester', 'user_id', 'id_matakuliah', 'nilai'], 'required'],
            [['id_tahun_ajaran', 'user_id', 'id_matakuliah'], 'integer'],
            [['npm_mahasiswa'], 'string', 'max' => 7],
            [['semester'], 'string', 'max' => 2],
            [['nilai'], 'string', 'max' => 11],
            [['id_matakuliah'], 'exist', 'skipOnError' => true, 'targetClass' => Matakuliah::className(), 'targetAttribute' => ['id_matakuliah' => 'id']],
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
            'id_tahun_ajaran' => 'Tahun Ajaran',
            'npm_mahasiswa' => 'Nama Mahasiswa',
            'semester' => 'Semester',
            'user_id' => 'User ID',
            'id_matakuliah' => ' Matakuliah',
            'nilai' => 'Nilai',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMatakuliah()
    {
        return $this->hasOne(Matakuliah::className(), ['id' => 'id_matakuliah']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNpmMahasiswa()
    {
        return $this->hasOne(Mahasiswa::className(), ['id' => 'npm_mahasiswa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNilais()
    {
        return $this->hasMany(Nilai::className(), ['id_dhs' => 'id']);
    }
    public function search($params)
    {
        $query = Nilai::find()
        ->joinWith('idDhs')
      ->where(['npm_mahasiswa'=>$this->npm_mahasiswa])

    ->orderBy('id_matakuliah','npm_mahasiswa');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_matakuliah' => $this->id_matakuliah,
            'id_dhs' => $this->id_dhs,
            'id_sp' => $this->id_sp,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'nilai', $this->nilai]);

        return $dataProvider;
    }
}
