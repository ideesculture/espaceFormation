<?php

namespace app\models;

use Yii;
use yii\base\Model;

class PasswordResetRequestForm extends Model
{
    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'required', 'message' => '{attribute} ne peut pas être vide.'],
            ['email', 'email', 'message' => 'Format d\'email invalide.'],
            ['email', 'exist', 'targetClass' => User::class, 'message' => 'Cet email n\'existe pas.'],
        ];
    }

    /**
     * Envoie un e-mail avec un lien de réinitialisation de mot de passe.
     *
     * @return bool whether the email was sent
     */
    public function sendPasswordResetEmail()
    {
        if ($this->validate()) {
            $user = User::findOne(['email' => $this->email]);
            if ($user) {
                $user->generatePasswordResetToken();
                if ($user->save()) {
                    return Yii::$app
                        ->mailer
                        ->compose(
                            ['html' => 'passwordResetToken-html'],
                            ['user' => $user]
                        )
                        ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                        ->setTo($this->email)
                        ->setSubject('Réinitialisation du mot de passe pour ' . Yii::$app->name)
                        ->send();
                }
            }
        }

        return false;
    }
}
