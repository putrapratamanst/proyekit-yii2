<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Matakuliah;

/**
 * MatakuliahSearch represents the model behind the search form about `backend\models\Matakuliah`.
 */
class MatakuliahSearch extends Matakuliah
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sks', 'jam', 'id_tahun_ajaran', 'semester'], 'integer'],
            [['matakuliah'], 'safe'],
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
        $query = Matakuliah::find();

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
            'sks' => $this->sks,
            'jam' => $this->jam,
            'id_tahun_ajaran' => $this->id_tahun_ajaran,
            'semester' => $this->semester,
        ]);

        $query->andFilterWhere(['like', 'matakuliah', $this->matakuliah]);

        return $dataProvider;
    }
}
