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
 * @property string|null $derniere_version_reglement_interieur_accepte
 * @property string|null $derniere_version_cgv_acceptee
 * @property string|null $derniere_version_cgu_acceptee
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
        return 'Stagiaires';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'organisationId'], 'required'],
            [['nom', 'prenom', 'email2', 'telephone', 'historique_sessions', 'derniere_version_reglement_interieur_accepte', 'derniere_version_cgv_acceptee', 'derniere_version_cgu_acceptee'], 'string'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['organisationId'], 'exist', 'skipOnError' => true, 'targetClass' => Organisations::class, 'targetAttribute' => ['organisationId' => 'id']],
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
        return $this->hasOne(Organisations::class, ['id' => 'organisationId']);
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
            'derniere_version_reglement_interieur_accepte' => 'Derniere Version Reglement Interieur Accepte',
            'derniere_version_cgv_acceptee' => 'Derniere Version Cgv Acceptee',
            'derniere_version_cgu_acceptee' => 'Derniere Version Cgu Acceptee',
            'organisationId' => 'Nom de l\'Entreprise associées',
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
