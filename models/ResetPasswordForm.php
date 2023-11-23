<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ResetPasswordForm est le modèle utilisé pour reset le mot de passe.
 *
 * @property string $password
 * @property string $password_repeat
 * @property string $token
 */
class ResetPasswordForm extends Model
{
    public $password;
    public $password_repeat;
    public $token;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['password', 'password_repeat'], 'required'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Les mots de passe ne correspondent pas.'],
            ['token', 'string'],
        ];
    }

    public function resetPassword()
    {
        if ($this->validate()) {
            $user = User::findByPasswordResetToken($this->token);
            if ($user) {
                $user->setPassword($this->password);
                $user->removePasswordResetToken();

                return $user->save(false);
            }
        }

        return false;
    }
}
