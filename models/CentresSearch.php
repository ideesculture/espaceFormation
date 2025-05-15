<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Centres;

/**
 * CentresSearch represents the model behind the search form of `app\models\Centres`.
 */
class CentresSearch extends Centres
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'lieu', 'georeference', 'url_lieu1', 'url_lieu2', 'url_lieu3'], 'safe'],
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
        $query = Centres::find();

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
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'lieu', $this->lieu])
            ->andFilterWhere(['like', 'georeference', $this->georeference])
            ->andFilterWhere(['like', 'url_lieu1', $this->url_lieu1])
            ->andFilterWhere(['like', 'url_lieu2', $this->url_lieu2])
            ->andFilterWhere(['like', 'url_lieu3', $this->url_lieu3]);

        return $dataProvider;
    }
}
