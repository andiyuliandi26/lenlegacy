<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "gamedetails".
 *
 * @property int $id
 * @property int $gameid
 * @property int $playerid
 * @property int $heroid
 * @property string $team
 * @property int $herodamage
 * @property int $herodamagepersentage
 * @property int $turretdamage
 * @property int $turretdamagepersentage
 * @property int $damagetaken
 * @property int $damagetakenpersentage
 * @property int $kill
 * @property int $death
 * @property int $assist
 * @property string $gold
 * @property string $rating
 * @property string $medal
 * @property int $isvictory
 * @property int $ismvpwinning
 * @property int $ismvplose
 *
 * @property Games $game
 * @property Hero $hero
 * @property Player $player
 */
class GameDetails extends \yii\db\ActiveRecord
{
    public $avgkill;
    public $avgassist;
    public $avgdeath;
    public $avgrating;
    public $play;
    public $lose;
    public $winrate;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gamedetails';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gameid', 'playerid', 'heroid', 'herodamage', 'herodamagepersentage', 'turretdamage', 'turretdamagepersentage', 'damagetaken', 'damagetakenpersentage', 'kill', 'death', 'assist', 'isvictory', 'ismvpwinning', 'ismvplose'], 'integer'],
            [['rating'], 'number'],
            [['isadditional'], 'safe'],
            [['team'], 'string', 'max' => 1],
            [['gold', 'medal'], 'string', 'max' => 45],
            [['gameid'], 'exist', 'skipOnError' => true, 'targetClass' => Games::className(), 'targetAttribute' => ['gameid' => 'id']],
            [['heroid'], 'exist', 'skipOnError' => true, 'targetClass' => Hero::className(), 'targetAttribute' => ['heroid' => 'id']],
            [['playerid'], 'exist', 'skipOnError' => true, 'targetClass' => Player::className(), 'targetAttribute' => ['playerid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gameid' => 'Game',
            'playerid' => 'Player',
            'heroid' => 'Hero',
            'team' => 'Team',
            'herodamage' => 'Hero DMG',
            'herodamagepersentage' => '% Hero DMG',
            'turretdamage' => 'Turret DMG',
            'turretdamagepersentage' => '% Turret DMG',
            'damagetaken' => 'Damage Taken',
            'damagetakenpersentage' => '% Damage Taken',
            'kill' => 'Kills',
            'death' => 'Deaths',
            'assist' => 'Assists',
            'gold' => 'Golds',
            'rating' => 'Rating',
            'medal' => 'Medal',
            'isvictory' => 'Victory',
            'ismvpwinning' => 'MVP Winning',
            'ismvplose' => 'MVP Lose',
            'isadditional' => 'Additional Player',
            'additionalscore' => 'Additional Score'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGame()
    {
        return $this->hasOne(Games::className(), ['id' => 'gameid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHero()
    {
        return $this->hasOne(Hero::className(), ['id' => 'heroid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayer()
    {
        return $this->hasOne(Player::className(), ['id' => 'playerid']);
    }

    /**
     * {@inheritdoc}
     * @return GameDetailsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GameDetailsQuery(get_called_class());
    }
}
