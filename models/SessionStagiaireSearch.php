<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SessionStagiaire;

/**
 * SessionStagiaireSearch represents the model behind the search form of `app\models\SessionStagiaire`.
 */
class SessionStagiaireSearch extends SessionStagiaire
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'session', 'stagiaire', 'present_demij1', 'present_demij2', 'present_demij3', 'present_demij4', 'present_demij5', 'present_demij6', 'present_demij7', 'present_demij8', 'present_demij9', 'present_demij10', 'stagiaire_hors_convention_auditeur_libre'], 'integer'],
            [['reponses_questionnaire_niveau_initial_json', 'reponses_questionnaire_niveau_final_json', 'reponses_satisfaction_json'], 'safe'],
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
        $query = SessionStagiaire::find();

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
            'session' => $this->session,
            'stagiaire' => $this->stagiaire,
            'present_demij1' => $this->present_demij1,
            'present_demij2' => $this->present_demij2,
            'present_demij3' => $this->present_demij3,
            'present_demij4' => $this->present_demij4,
            'present_demij5' => $this->present_demij5,
            'present_demij6' => $this->present_demij6,
            'present_demij7' => $this->present_demij7,
            'present_demij8' => $this->present_demij8,
            'present_demij9' => $this->present_demij9,
            'present_demij10' => $this->present_demij10,
            'stagiaire_hors_convention_auditeur_libre' => $this->stagiaire_hors_convention_auditeur_libre,
        ]);

        $query->andFilterWhere(['like', 'reponses_questionnaire_niveau_initial_json', $this->reponses_questionnaire_niveau_initial_json])
            ->andFilterWhere(['like', 'reponses_questionnaire_niveau_final_json', $this->reponses_questionnaire_niveau_final_json])
            ->andFilterWhere(['like', 'reponses_satisfaction_json', $this->reponses_satisfaction_json]);

        return $dataProvider;
    }
}
