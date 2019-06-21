<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "games".
 *
 * @property int $id
 * @property string $gamename
 * @property string $gamedate
 * @property int $seasonid
 * @property int $gameduration
 *
 * @property Gamedetails[] $gamedetails
 * @property Season $id0
 */
class Games extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'games';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gamedate', 'seasonid'], 'required'],
            [['gamedate'], 'safe'],
            [['seasonid', 'gameduration'], 'integer'],
            [['gamename'], 'string', 'max' => 100],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Season::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gamename' => 'Gamename',
            'gamedate' => 'Gamedate',
            'seasonid' => 'Seasonid',
            'gameduration' => 'Gameduration',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGamedetails()
    {
        return $this->hasMany(Gamedetails::className(), ['gameid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Season::className(), ['seasonid' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return GamesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GamesQuery(get_called_class());
    }
}
