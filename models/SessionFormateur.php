<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "SessionFormateur".
 *
 * @property int $id
 * @property int|null $session_id
 * @property int|null $formateur_id
 *
 * @property Formateurs $formateur
 * @property Sessions $session
 */
class SessionFormateur extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'SessionFormateur';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['session_id', 'formateur_id'], 'integer'],
            [['session_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sessions::class, 'targetAttribute' => ['session_id' => 'id']],
            [['formateur_id'], 'exist', 'skipOnError' => true, 'targetClass' => Formateurs::class, 'targetAttribute' => ['formateur_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'session_id' => 'Session ID',
            'formateur_id' => 'Formateur ID',
        ];
    }

    /**
     * Gets query for [[Formateur]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFormateur()
    {
        return $this->hasOne(Formateurs::class, ['id' => 'formateur_id']);
    }

    /**
     * Gets query for [[Session]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSession()
    {
        return $this->hasOne(Sessions::class, ['id' => 'session_id']);
    }
}
