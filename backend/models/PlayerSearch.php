<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Player;

/**
 * PlayerSearch represents the model behind the search form of `backend\models\Player`.
 */
class PlayerSearch extends Player
{
    public $tiername;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tierid'], 'integer'],
            [['name', 'nickname', 'status', 'image', 'gameid', 'nohp', 'tiername'], 'safe'],
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
        $query = Player::find();
        $query->joinWith(['tier'])
            ->orderBy('name');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['tiername'] = [
            'asc' => ['tiername'=> SORT_ASC],
            'desc' => ['tiername'=> SORT_DESC]
        ];
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tierid' => $this->tierid,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'nickname', $this->nickname])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'gameid', $this->gameid])
            ->andFilterWhere(['like', 'tiername', $this->tiername])
            ->andFilterWhere(['like', 'nohp', $this->nohp]);

        return $dataProvider;
    }
}
