<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Formateurs;

/**
 * FormateursSearch represents the model behind the search form of `app\models\Formateurs`.
 */
class FormateursSearch extends Formateurs
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['nom', 'prenom', 'chemin_cv', 'liste_diplome', 'numero_decl_activite', 'qualiopi', 'siret', 'adresse', 'attestation_assurance_url'], 'safe'],
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
        $query = Formateurs::find();

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
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'nom', $this->nom])
            ->andFilterWhere(['like', 'prenom', $this->prenom])
            ->andFilterWhere(['like', 'chemin_cv', $this->chemin_cv])
            ->andFilterWhere(['like', 'liste_diplome', $this->liste_diplome])
            ->andFilterWhere(['like', 'numero_decl_activite', $this->numero_decl_activite])
            ->andFilterWhere(['like', 'qualiopi', $this->qualiopi])
            ->andFilterWhere(['like', 'siret', $this->siret])
            ->andFilterWhere(['like', 'adresse', $this->adresse])
            ->andFilterWhere(['like', 'attestation_assurance_url', $this->attestation_assurance_url]);
        return $dataProvider;
    }
}
