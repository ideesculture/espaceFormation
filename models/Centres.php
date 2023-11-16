<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Centres".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $lieu
 * @property string|null $georeference
 * @property string|null $url_lieu1
 * @property string|null $url_lieu2
 * @property string|null $url_lieu3
 */
class Centres extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Centres';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'lieu', 'georeference', 'url_lieu1', 'url_lieu2', 'url_lieu3'], 'string'],
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
            'lieu' => Yii::t('app', 'Lieu'),
            'georeference' => Yii::t('app', 'Georeference'),
            'url_lieu1' => Yii::t('app', 'Url Lieu1'),
            'url_lieu2' => Yii::t('app', 'Url Lieu2'),
            'url_lieu3' => Yii::t('app', 'Url Lieu3'),
        ];
    }
}
