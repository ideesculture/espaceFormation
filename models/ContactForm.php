<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * Envoi un mail à une adresse spécifique en utilsant les données du model récoltées
     * @param string $email  email adresse Cible
     * @return bool whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {

            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();

            $this->sendConfirmationEmail();
            return true;
        }
        return false;
    }

    public function sendConfirmationEmail()
    {
        // Envoi de l'e-mail de confirmation à la personne qui a rempli le formulaire
        Yii::$app->mailer->compose()
            ->setTo($this->email)
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setSubject('Confirmation de votre demande')
            ->setTextBody('Merci pour votre demande. Nous avons bien reçu votre message et nous vous contacterons bientôt.')
            ->send();
    }

}
