<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Stagiaires".
 *
 * @property int $id
 * @property string $nom
 * @property string $prenom
 * @property string|null $email2
 * @property string|null $telephone
 * @property string|null $historique_sessions
 * @property string|null $reglement_valide_version
 * @property string|null $reglement_valide_date
 * @property string|null $cgu_valide_version
 * @property string|null $cgu_valide_date 
 * @property string|null $cgv_valide_version
 * @property string|null $cgv_valide_date
 * 
 * @property User $user
 * @property Organisations $organisation
 * @property SessionStagiaire[] $sessionStagiaires
 */
class Stagiaires extends \yii\db\ActiveRecord
{

    public $organisationId;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stagiaires';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'organisation_id'], 'required'],
            [['nom', 'prenom', 'email2', 'telephone', 'historique_sessions', 'reglement_valide_version', 'reglement_valide_date', 'cgv_valide_version', 'cgv_valide_date', 'cgu_valide_version', 'cgu_valide_date'], 'string'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['organisation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organisations::class, 'targetAttribute' => ['organisation_id' => 'id']],
            [['nom','prenom'], 'required', 'message' => 'Le champ {attribute} ne peut pas être vide'],
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getOrganisation()
    {
        return $this->hasOne(Organisations::class, ['id' => 'organisation_id']);
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nom' => 'Nom',
            'prenom' => 'Prenom',
            'email2' => 'Email de secours',
            'telephone' => 'Telephone',
            'historique_sessions' => 'Historique Sessions',
            'reglement_valide_version' => 'Règlement intérieur validé (version)',
			'reglement_valide_date' => 'Règlement intérieur validé (date)',
            'cgu_valide_version' => 'CGU validées (version)',
			'cgu_valide_date' => 'CGU validées (date)',
            'cgv_valide_version' => 'CGV validées (version)',
            'cgv_valide_date' => 'CGV validées (date)',
            'organisation_id' => 'Organisation *',
        ];
    }

    /**
     * Gets query for [[SessionStagiaires]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSessionStagiaires()
    {
        return $this->hasMany(SessionStagiaire::class, ['stagiaire_id' => 'id']);
    }

    public function getDisplayName(){
        return $this->nom." ".$this->prenom;
    }

    public function getOrganisationNom()
{
    return $this->organisation ? $this->organisation->nom : 'Aucune organisation';
}
}
