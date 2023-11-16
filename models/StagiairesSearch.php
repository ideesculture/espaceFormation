<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Stagiaires;

/**
 * StagiairesSearch represents the model behind the search form of `app\models\Stagiaires`.
 */
class StagiairesSearch extends Stagiaires
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nom', 'prenom', 'email', 'email2', 'telephone', 'historique_sessions', 'password', 'derniere_version_reglement_interieur_accepte', 'derniere_version_cgv_acceptee', 'derniere_version_cgu_acceptee'], 'safe'],
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
        $query = Stagiaires::find();

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
            ->andFilterWhere(['like', 'prenom', $this->prenom])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'email2', $this->email2])
            ->andFilterWhere(['like', 'telephone', $this->telephone])
            ->andFilterWhere(['like', 'historique_sessions', $this->historique_sessions])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'derniere_version_reglement_interieur_accepte', $this->derniere_version_reglement_interieur_accepte])
            ->andFilterWhere(['like', 'derniere_version_cgv_acceptee', $this->derniere_version_cgv_acceptee])
            ->andFilterWhere(['like', 'derniere_version_cgu_acceptee', $this->derniere_version_cgu_acceptee]);

        return $dataProvider;
    }
}
