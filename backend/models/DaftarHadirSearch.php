<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\DaftarHadir;

/**
 * DaftarHadirSearch represents the model behind the search form about `backend\models\DaftarHadir`.
 */
class DaftarHadirSearch extends DaftarHadir
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_penjadwalan'], 'integer'],
            [['npm_mahasiswa'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = DaftarHadir::find();

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
            'id_penjadwalan' => $this->id_penjadwalan,
        ]);

        $query->andFilterWhere(['like', 'npm_mahasiswa', $this->npm_mahasiswa]);

        return $dataProvider;
    }
}
