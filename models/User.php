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
 * @property string $authKey
 *
 * @property Stagiaires $stagiaire
 * @property SessionStagiaire[] $stagiaireSessions
 */
class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    public $authKey;
    public $special_attribute;

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
            [['email', 'password', 'role'], 'required'],
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
            'email' => 'Email *',
            'password' => 'Password *',
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
}
