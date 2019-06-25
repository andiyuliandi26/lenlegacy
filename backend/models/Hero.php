<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "hero".
 *
 * @property int $id
 * @property string $heroname
 * @property int $durability
 * @property int $offense
 * @property int $abilityeffect
 * @property int $difficulty
 * @property string $images
 *
 * @property Gamedetails[] $gamedetails
 * @property Herorole[] $heroroles
 */
class Hero extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hero';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['heroname'], 'required'],
            [['durability', 'offense', 'abilityeffect', 'difficulty'], 'integer'],
            [['heroname'], 'string', 'max' => 45],
            [['images'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'heroname' => 'Heroname',
            'durability' => 'Durability',
            'offense' => 'Offense',
            'abilityeffect' => 'Abilityeffect',
            'difficulty' => 'Difficulty',
            'images' => 'Images',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGamedetails()
    {
        return $this->hasMany(GameDetails::className(), ['heroid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHeroroles()
    {
        return $this->hasMany(Herorole::className(), ['heroid' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return HeroQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HeroQuery(get_called_class());
    }
}
