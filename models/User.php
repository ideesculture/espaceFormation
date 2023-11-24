<?php

namespace app\models;

use app\models\Formateurs;
use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "Utilisateurs".
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $role
 * @property string $password_reset_token
 * @property string $authKey
 *
 * @property Formateurs $formateur
 * @property Stagiaires $stagiaire
 * @property SessionStagiaire[] $stagiaireSessions
 */
class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    public $authKey;

    public static function tableName()
    {
        return 'Utilisateurs';
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password', 'role'],'required', 'message' => 'Le champ {attribute} ne peut pas être vide'],
            ['role', 'string'],
            ['email', 'email'],
            ['email', 'unique'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Mot de passe',
            'role' => 'Role',
            'authKey' => 'Auth Key',
        ];
    }

    public function getFormateur()
    {
        return $this->hasOne(Formateurs::class, ['user_id' => 'id']);
    }

    public function getStagiaire()
    {
        return $this->hasOne(Stagiaires::class, ['user_id' => 'id']);
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }


    /**
     * Gets query for [[StagiaireSessions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStagiaireSessions()
    {
        return $this->hasMany(SessionStagiaire::class, ['stagiaire_id' => 'id'])
            ->via('stagiaire');
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['accessToken' => $token]);
    }

    /**
     * Set mot de passe haché
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Méthode pour supprimer le token Reset Password aprés utilisation
    */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates mot_de_passe
     *
     * @param string $password mot_de_passe to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Génère Un Token de mot de passe
     * Cette méthode est appelée avant de sauvegarder en base.
     *
     * @return string Le Token de Reset de Mot de passe
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
        return $this->password_reset_token;
    }

    /**
     * Finds a user by the given password reset token.
     *
     * @param string $token The password reset token
     * @return User|null The user model, or `null` if a user with the given token is not found
     */
    public static function findByPasswordResetToken($token)
    {
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
       
        // Vérifie si le token a expiré
        if ($timestamp + $expire < time()) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
        ]);
    }
}
