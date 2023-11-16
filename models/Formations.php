<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Formations".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $prerequis
 * @property string|null $objectif1
 * @property string|null $objectif2
 * @property string|null $objectif3
 * @property string|null $objectif4
 * @property string|null $objectif5
 * @property string|null $objectif6
 * @property string|null $objectif7
 * @property string|null $objectif8
 * @property string|null $objectif9
 * @property string|null $objectif10
 * @property int|null $nbmax
 * @property string|null $url_planformation
 */
class Formations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Formations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'prerequis', 'objectif1', 'objectif2', 'objectif3', 'objectif4', 'objectif5', 'objectif6', 'objectif7', 'objectif8', 'objectif9', 'objectif10', 'url_planformation'], 'string'],
            [['nbmax'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'prerequis' => Yii::t('app', 'Prerequis'),
            'objectif1' => Yii::t('app', 'Objectif1'),
            'objectif2' => Yii::t('app', 'Objectif2'),
            'objectif3' => Yii::t('app', 'Objectif3'),
            'objectif4' => Yii::t('app', 'Objectif4'),
            'objectif5' => Yii::t('app', 'Objectif5'),
            'objectif6' => Yii::t('app', 'Objectif6'),
            'objectif7' => Yii::t('app', 'Objectif7'),
            'objectif8' => Yii::t('app', 'Objectif8'),
            'objectif9' => Yii::t('app', 'Objectif9'),
            'objectif10' => Yii::t('app', 'Objectif10'),
            'nbmax' => Yii::t('app', 'Nbmax'),
            'url_planformation' => Yii::t('app', 'Url Planformation'),
        ];
    }
}
