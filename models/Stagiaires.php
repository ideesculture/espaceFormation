<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Stagiaires".
 *
 * @property int $id
 * @property string|null $nom
 * @property string|null $prenom
 * @property string|null $email2
 * @property string|null $telephone
 * @property string|null $historique_sessions
 * @property string|null $derniere_version_reglement_interieur_accepte
 * @property string|null $derniere_version_cgv_acceptee
 * @property string|null $derniere_version_cgu_acceptee
 * 
 *
 * @property User $user
 * @property SessionStagiaire[] $sessionStagiaires
 */
class Stagiaires extends \yii\db\ActiveRecord
{
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
            [['user_id'], 'integer'],
            [['nom', 'prenom', 'email2', 'telephone', 'historique_sessions', 'derniere_version_reglement_interieur_accepte', 'derniere_version_cgv_acceptee', 'derniere_version_cgu_acceptee'], 'string'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
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

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nom' => 'Nom *',
            'prenom' => 'Prenom *',
            'email2' => 'Email de secours',
            'telephone' => 'Telephone *',
            'historique_sessions' => 'Historique Sessions',
            'derniere_version_reglement_interieur_accepte' => 'Derniere Version Reglement Interieur Accepte',
            'derniere_version_cgv_acceptee' => 'Derniere Version Cgv Acceptee',
            'derniere_version_cgu_acceptee' => 'Derniere Version Cgu Acceptee',
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
}
