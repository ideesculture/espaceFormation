<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Organisations;

/**
 * OrganisationsSearch represents the model behind the search form of `app\models\Organisations`.
 */
class OrganisationsSearch extends Organisations
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nom', 'personne_a_contacter1', 'email1', 'telephone1', 'personne_a_contacter2', 'email2', 'telephone2'], 'safe'],
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
        $query = Organisations::find();

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

        $query->andFilterWhere(['like', 'nom', $this->nom])
            ->andFilterWhere(['like', 'personne_a_contacter1', $this->personne_a_contacter1])
            ->andFilterWhere(['like', 'email1', $this->email1])
            ->andFilterWhere(['like', 'telephone1', $this->telephone1])
            ->andFilterWhere(['like', 'personne_a_contacter2', $this->personne_a_contacter2])
            ->andFilterWhere(['like', 'email2', $this->email2])
            ->andFilterWhere(['like', 'telephone2', $this->telephone2]);

        return $dataProvider;
    }
}
