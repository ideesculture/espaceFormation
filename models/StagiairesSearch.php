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
            [['nom', 'prenom', 'email2', 'telephone', 'historique_sessions', 'reglement_valide_version', 'reglement_valide_date', 'cgv_valide_version', 'cgv_valide_date', 'cgu_valide_version', 'cgu_valide_date'], 'safe'],
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
            ->andFilterWhere(['like', 'email2', $this->email2])
            ->andFilterWhere(['like', 'telephone', $this->telephone])
            ->andFilterWhere(['like', 'historique_sessions', $this->historique_sessions])
            ->andFilterWhere(['like', 'reglement_valide_version', $this->reglement_valide_version])
			->andFilterWhere(['like', 'reglement_valide_date', $this->reglement_valide_date])
            ->andFilterWhere(['like', 'cgv_valide_version', $this->cgv_valide_version])
			->andFilterWhere(['like', 'cgv_valide_date', $this->cgv_valide_date])
            ->andFilterWhere(['like', 'cgu_valide_version', $this->cgu_valide_version])
			->andFilterWhere(['like', 'cgu_valide_date', $this->cgu_valide_date]);

        return $dataProvider;
    }
}
