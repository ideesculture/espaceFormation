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
