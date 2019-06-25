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
 * @property Season $season
 */
class Schedule extends \yii\db\ActiveRecord
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
            [['gamename','status'], 'string', 'max' => 100],
            //[['id'], 'exist', 'skipOnError' => true, 'targetClass' => Season::className(), 'targetAttribute' => ['id' => 'id']],
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
            'status' => 'Status Game'
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
    public function getSeason()
    {
        return $this->hasOne(Season::className(), ['id' => 'seasonid']);
    }

    /**
     * {@inheritdoc}
     * @return ScheduleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ScheduleQuery(get_called_class());
    }
}
