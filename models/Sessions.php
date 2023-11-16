<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Sessions".
 *
 * @property int $id
 * @property int|null $formation_id
 * @property int|null $centre_id
 * @property string|null $debut
 * @property string|null $fin
 * @property string|null $contact_structure_ou_entreprise
 * @property string|null $contact_structure_ou_entreprise_email
 * @property string|null $contact_financeur
 * @property string|null $contact_financeur_email
 * @property string|null $adresse_structure_ou_entreprise
 * @property string|null $siret_structure_ou_entreprise
 * @property string|null $plan_de_formation
 * @property string|null $questionnaire_satisfaction_formateur
 *
 * @property Centres $centre0
 * @property Formations $formation0
 * @property SessionStagiaire[] $sessionStagiaires
 */
class Sessions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Sessions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['formation_id', 'centre_id'], 'integer'],
            [['debut', 'fin'], 'safe'],
            [['contact_structure_ou_entreprise', 'contact_structure_ou_entreprise_email', 'contact_financeur', 'contact_financeur_email', 'adresse_structure_ou_entreprise', 'siret_structure_ou_entreprise', 'plan_de_formation', 'questionnaire_satisfaction_formateur'], 'string'],
            [['formationrel'], 'exist', 'skipOnError' => true, 'targetClass' => Formations::class, 'targetAttribute' => ['formation_id' => 'id']],
            [['centrerel'], 'exist', 'skipOnError' => true, 'targetClass' => Centres::class, 'targetAttribute' => ['centre_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'formation_id' => 'Formation',
            'centre_id' => 'Centre',
            'debut' => 'Date de début',
            'fin' => 'Date de fin',
            'contact_structure_ou_entreprise' => "Nom de la personne à contacter",
            'contact_structure_ou_entreprise_email' => 'Email de la personne à contacter',
            'contact_financeur' => 'Nom de la personne à contacter pour la comptabilité',
            'contact_financeur_email' => 'Email de personne à contacter pour la comptabilité',
            'adresse_structure_ou_entreprise' => 'Adresse',
            'siret_structure_ou_entreprise' => 'Numéro de SIRET',
            'plan_de_formation' => 'Plan de formation',
            'questionnaire_satisfaction_formateur' => 'Questionnaire de satisfaction formateur',
        ];
    }

    /**
     * Gets query for [[Centre0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCentrerel()
    {
        return $this->hasOne(Centres::class, ['id' => 'centre_id']);
    }

    /**
     * Gets query for [[Formation0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFormationrel()
    {
        return $this->hasOne(Formations::class, ['id' => 'formation_id']);
    }

    /**
     * Gets query for [[SessionStagiaires]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSessionStagiaires()
    {
        return $this->hasMany(SessionStagiaire::class, ['session_id' => 'id']);
    }
}
