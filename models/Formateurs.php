<?php

namespace app\models;
use yii\web\UploadedFile;
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
 * 
 * 
 * @property User $user
 */
class Formateurs extends \yii\db\ActiveRecord
{

    // Propriété temporaire pour gérer le téléchargement du fichier
    public $imageFile;

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }

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
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
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

//   /**
//      * Gère le téléchargement du fichier.
//      * @return bool true si le téléchargement est réussi, sinon false
//      */
//     public function uploadListeDiplome()
// {
//     Yii::error('Début de la méthode uploadListeDiplome');

//     if ($this->validate(['uploadedListeDiplome'])) {
//         Yii::error('Validation passed');

//         if ($this->uploadedListeDiplome instanceof UploadedFile) {
//             Yii::error('uploadedListeDiplome is an instance of UploadedFile');

//             $uploadsPath = Yii::getAlias('@app/uploads');
//             $path = $uploadsPath . '/' . $this->user_id;

//             if (!is_dir($path)) {
//                 mkdir($path, 0777, true);
//             }

//             $filename = $path . '/' . $this->uploadedListeDiplome->baseName . '.' . $this->uploadedListeDiplome->extension;

//             if ($this->uploadedListeDiplome->saveAs($filename)) {
//                 $this->liste_diplome = $filename;
//                 Yii::info('File saved successfully');
//                 return true;
//             } else {
//                 Yii::error('Failed to save file');
//             }
//         } else {
//             Yii::error('uploadedListeDiplome is NOT an instance of UploadedFile');
//         }
//     } else {
//         Yii::error('Validation failed');
//     }

//     return false;
// }
    
    
        
    

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nom' => Yii::t('app', 'Nom *'),
            'prenom' => Yii::t('app', 'Prenom *'),
            'chemin_cv' => Yii::t('app', 'Chemin Cv'),
            'liste_diplome' => Yii::t('app', 'Liste Diplome'),
            'numero_decl_activite' => Yii::t('app', 'Numero Decl Activite'),
            'qualiopi' => Yii::t('app', 'Qualiopi'),
            'siret' => Yii::t('app', 'Siret'),
            'adresse' => Yii::t('app', 'Adresse'),
            'attestation_assurance_url' => Yii::t('app', 'Attestation Assurance Url'),
            'upload' => 'upload (img)',
        ];
    }
}
