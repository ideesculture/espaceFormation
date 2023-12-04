<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "SessionStagiaire".
 *
 * @property int $id
 * @property int|null $session_id
 * @property int|null $stagiaire_id
 * @property int|null $organisation_id
 * @property int|null $present_demij1
 * @property int|null $present_demij2
 * @property int|null $present_demij3
 * @property int|null $present_demij4
 * @property int|null $present_demij5
 * @property int|null $present_demij6
 * @property int|null $present_demij7
 * @property int|null $present_demij8
 * @property int|null $present_demij9
 * @property int|null $present_demij10
 * @property string|null $reponses_questionnaire_niveau_initial_json
 * @property string|null $reponses_questionnaire_niveau_final_json
 * @property string|null $reponses_satisfaction_json
 * @property int|null $stagiaire_hors_convention_auditeur_libre
 *
 * @property Sessions $session0
 * @property Stagiaires $stagiaire0
 */
class SessionStagiaire extends \yii\db\ActiveRecord
{
    public $organisation_id;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'SessionStagiaire';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['session_id', 'stagiaire_id', 'present_demij1', 'present_demij2', 'present_demij3', 'present_demij4', 'present_demij5', 'present_demij6', 'present_demij7', 'present_demij8', 'present_demij9', 'present_demij10', 'stagiaire_hors_convention_auditeur_libre', 'organisation_id'], 'integer'],
            [['reponses_questionnaire_niveau_initial_json', 'reponses_questionnaire_niveau_final_json', 'reponses_satisfaction_json'], 'string'],
            [['session_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sessions::class, 'targetAttribute' => ['session_id' => 'id']],
            [['stagiaire_id'], 'exist', 'skipOnError' => true, 'targetClass' => Stagiaires::class, 'targetAttribute' => ['stagiaire_id' => 'id']],
            [['organisation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organisations::class, 'targetAttribute' => ['organisation_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'session_id' => '',
            'stagiaire_id' => 'Stagiaire',
            'present_demij1' => 'Present Demij1',
            'present_demij2' => 'Present Demij2',
            'present_demij3' => 'Present Demij3',
            'present_demij4' => 'Present Demij4',
            'present_demij5' => 'Present Demij5',
            'present_demij6' => 'Present Demij6',
            'present_demij7' => 'Present Demij7',
            'present_demij8' => 'Present Demij8',
            'present_demij9' => 'Present Demij9',
            'present_demij10' => 'Present Demij10',
            'reponses_questionnaire_niveau_initial_json' => 'Reponses Questionnaire Niveau Initial Json',
            'reponses_questionnaire_niveau_final_json' => 'Reponses Questionnaire Niveau Final Json',
            'reponses_satisfaction_json' => 'Reponses Satisfaction Json',
            'stagiaire_hors_convention_auditeur_libre' => 'Stagiaire Hors Convention Auditeur Libre',
        ];
    }

    /**
     * Gets query for [[Session0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSession0()
    {
        return $this->hasOne(Sessions::class, ['id' => 'session_id']);
    }

    /**
     * Gets query for [[Stagiaire0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStagiaire0()
    {
        return $this->hasOne(Stagiaires::class, ['id' => 'stagiaire_id']);
    }

    /**
     * Gets query for [[Organisation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrganisation()
    {
        return $this->hasOne(Organisations::class, ['id' => 'organisation_id']);
    }

}
