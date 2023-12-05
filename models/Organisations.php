<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "organisations".
 *
 * @property int $id
 * @property string $nom
 *
 * @property Stagiaires[] $stagiaires
 */
class Organisations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'organisations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nom'], 'required'],
            [['nom'], 'string', 'max' => 255],
            [['personne_a_contacter1', 'personne_a_contacter2'], 'string', 'max' => 255],
            [['email1', 'email2'], 'email'],
            [['telephone1', 'telephone2'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nom' => 'Nom',
            'personne_a_contacter1'=> 'Personne à Contacter',
            'email1'=> 'Email',
            'telephone1'=> 'Telephone',
            'personne_a_contacter2'=> 'Autre Personne à contacter',
            'email2'=> 'Email2',
            'telephone2'=> 'Telephone2',
        ];
    }

    /**
     * Gets query for [[Stagiaires]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStagiaires()
    {
        return $this->hasMany(Stagiaires::class, ['organisation_id' => 'id']);
    }

}
