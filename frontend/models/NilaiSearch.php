<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Nilai;

/**
 * NilaiSearch represents the model behind the search form about `frontend\models\Nilai`.
 */
class NilaiSearch extends Nilai
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_matakuliah', 'id_dhs', 'id_sp', 'user_id'], 'integer'],
            [['nilai'], 'safe'],
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
        $query = Nilai::find();

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
