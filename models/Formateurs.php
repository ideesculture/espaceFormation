<?php

namespace app\models;
use Yii;

/**
 * This is the model class for table "Formateurs".
 *
 * @property int $id
 * @property string|null $nom
 * @property string|null $prenom
 * @property string|null $chemin_cv
 * @property string|null $liste_diplome
 * @property string|null $numero_decl_activite
 * @property string|null $qualiopi
 * @property string|null $siret
 * @property string|null $adresse
 * @property string|null $attestation_assurance_url
 * @property int $user_id
 * 
 * @property User $user
 * @property SessionFormateur[] $sessionFormateurs
 */
class Formateurs extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Formateurs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nom', 'prenom', 'chemin_cv', 'liste_diplome', 'numero_decl_activite', 'qualiopi', 'siret', 'adresse', 'attestation_assurance_url'], 'string'],
            [['user_id'], 'integer'],
            [['nom', 'prenom'], 'required', 'message' => 'Le champ {attribute} ne peut pas être vide'],
           ];
    }

  /**
     * Relation avec le modèle User
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

      /**
     * Gets query for [[SessionFormateurs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSessionFormateurs()
    {
        return $this->hasMany(SessionFormateur::class, ['formateur_id' => 'id'])->onDelete('CASCADE');
    }

    public function getDisplayName(){
        return $this->nom." ".$this->prenom;
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nom' => Yii::t('app', 'Nom'),
            'prenom' => Yii::t('app', 'Prenom'),
            'chemin_cv' => Yii::t('app', 'Chemin Cv'),
            'liste_diplome' => Yii::t('app', 'Liste Diplome'),
            'numero_decl_activite' => Yii::t('app', 'Numero Decl Activite'),
            'qualiopi' => Yii::t('app', 'Qualiopi'),
            'siret' => Yii::t('app', 'Siret'),
            'adresse' => Yii::t('app', 'Adresse'),
            'attestation_assurance_url' => Yii::t('app', 'Attestation Assurance Url'),
        ];
    }
}
