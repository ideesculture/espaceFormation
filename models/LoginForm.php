<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;
    public $resetPasswordToken; 


    /**
     * @return array the validation rules.
     */
    public function rules()
{
    $rules = [
        [['email', 'password'], 'required', 'message' => '{attribute} ne peut pas être vide.'],
        ['email', 'email', 'message' => 'Format d\'email invalide.'],
        ['rememberMe', 'boolean'],
        ['password', 'validatePassword'],
    ];
    return $rules;
}

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'email' => 'Adresse Email',
            'password' => 'Mot de Passe',
            'rememberMe' => 'Se souvenir de moi',
            'resetPasswordToken' => 'Token de réinitialisation du mot de passe',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Mot de passe ou Email incorrect.');
            }
        }
    }

    /**
     * Logs in a user using the provided email and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }

}
