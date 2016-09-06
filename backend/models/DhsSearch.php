<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Dhs;

/**
 * DhsSearch represents the model behind the search form about `backend\models\Dhs`.
 */
class DhsSearch extends Dhs
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_tahun_ajaran', 'user_id', 'id_matakuliah'], 'integer'],
            [['npm_mahasiswa', 'semester', 'nilai'], 'safe'],
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
        $query = Dhs::find();

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
            'id_tahun_ajaran' => $this->id_tahun_ajaran,
            'user_id' => $this->user_id,
            'id_matakuliah' => $this->id_matakuliah,
        ]);

        $query->andFilterWhere(['like', 'npm_mahasiswa', $this->npm_mahasiswa])
            ->andFilterWhere(['like', 'semester', $this->semester])
            ->andFilterWhere(['like', 'nilai', $this->nilai]);

        return $dataProvider;
    }
}
