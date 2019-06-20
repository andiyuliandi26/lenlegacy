<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Games;

/**
 * GamesSearch represents the model behind the search form of `backend\models\Games`.
 */
class GamesSearch extends Games
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'seasonid', 'gameduration'], 'integer'],
            [['gamename', 'gamedate'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Games::find();

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
            'gamedate' => $this->gamedate,
            'seasonid' => $this->seasonid,
            'gameduration' => $this->gameduration,
        ]);

        $query->andFilterWhere(['like', 'gamename', $this->gamename]);

        return $dataProvider;
    }
}
