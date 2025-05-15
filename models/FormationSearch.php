<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Formations;

/**
 * FormationSearch represents the model behind the search form of `app\models\Formations`.
 */
class FormationSearch extends Formations
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nbmax'], 'integer'],
            [['name', 'prerequis', 'objectif1', 'objectif2', 'objectif3', 'objectif4', 'objectif5', 'objectif6', 'objectif7', 'objectif8', 'objectif9', 'objectif10', 'url_planformation'], 'safe'],
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
        $query = Formations::find();

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
            'nbmax' => $this->nbmax,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'prerequis', $this->prerequis])
            ->andFilterWhere(['like', 'objectif1', $this->objectif1])
            ->andFilterWhere(['like', 'objectif2', $this->objectif2])
            ->andFilterWhere(['like', 'objectif3', $this->objectif3])
            ->andFilterWhere(['like', 'objectif4', $this->objectif4])
            ->andFilterWhere(['like', 'objectif5', $this->objectif5])
            ->andFilterWhere(['like', 'objectif6', $this->objectif6])
            ->andFilterWhere(['like', 'objectif7', $this->objectif7])
            ->andFilterWhere(['like', 'objectif8', $this->objectif8])
            ->andFilterWhere(['like', 'objectif9', $this->objectif9])
            ->andFilterWhere(['like', 'objectif10', $this->objectif10])
            ->andFilterWhere(['like', 'url_planformation', $this->url_planformation]);

        return $dataProvider;
    }
}
