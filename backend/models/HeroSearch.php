<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Hero;

/**
 * HeroSearch represents the model behind the search form of `app\models\Hero`.
 */
class HeroSearch extends Hero
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'durability', 'offense', 'abilityeffect', 'difficulty'], 'integer'],
            [['heroname', 'images'], 'safe'],
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
        $query = Hero::find();

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
            'durability' => $this->durability,
            'offense' => $this->offense,
            'abilityeffect' => $this->abilityeffect,
            'difficulty' => $this->difficulty,
        ]);

        $query->andFilterWhere(['like', 'heroname', $this->heroname])
            ->andFilterWhere(['like', 'images', $this->images]);

        return $dataProvider;
    }
}
