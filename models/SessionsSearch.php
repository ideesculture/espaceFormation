<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sessions;

/**
 * SessionsSearch represents the model behind the search form of `app\models\Sessions`.
 */
class SessionsSearch extends Sessions
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'formation_id', 'centre_id'], 'integer'],
            [['debut', 'fin', 'contact_structure_ou_entreprise_nom', 'contact_structure_ou_entreprise_prenom', 'contact_structure_ou_entreprise_email', 'contact_financeur_nom', 'contact_financeur_prenom', 'contact_financeur_email', 'adresse_structure_ou_entreprise', 'siret_structure_ou_entreprise', 'plan_de_formation', 'questionnaire_satisfaction_formateur'], 'safe'],
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
        $query = Sessions::find();

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
            'formation_id' => $this->formation_id,
            'centre_id' => $this->centre_id,
            'debut' => $this->debut,
            'fin' => $this->fin,
        ]);

        $query->andFilterWhere(['like', 'contact_structure_ou_entreprise', $this->contact_structure_ou_entreprise])
            ->andFilterWhere(['like', 'contact_structure_ou_entreprise_email', $this->contact_structure_ou_entreprise_email])
            ->andFilterWhere(['like', 'contact_financeur', $this->contact_financeur])
            ->andFilterWhere(['like', 'contact_financeur_email', $this->contact_financeur_email])
            ->andFilterWhere(['like', 'adresse_structure_ou_entreprise', $this->adresse_structure_ou_entreprise])
            ->andFilterWhere(['like', 'siret_structure_ou_entreprise', $this->siret_structure_ou_entreprise])
            ->andFilterWhere(['like', 'plan_de_formation', $this->plan_de_formation])
            ->andFilterWhere(['like', 'questionnaire_satisfaction_formateur', $this->questionnaire_satisfaction_formateur]);

        $query->joinWith(["formationrel"]);
        $query->joinWith(["centrerel"]);


        return $dataProvider;
    }
}
