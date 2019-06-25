<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "player".
 *
 * @property int $id
 * @property string $name
 * @property string $nickname
 * @property int $tierid
 * @property string $status
 * @property string $image
 * @property string $gameid
 * @property string $nohp
 *
 * @property Gamedetails[] $gamedetails
 * @property Tier $tier
 */
class Player extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'player';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'nickname', 'gameid'], 'required'],
            [['tierid'], 'integer'],
			[['playerfullname','play'], 'safe'],
            [['name', 'nickname'], 'string', 'max' => 150],
            [['status'], 'string', 'max' => 45],
            [['image'], 'string', 'max' => 200],
            [['gameid', 'nohp'], 'string', 'max' => 20],
            [['tiername'], 'string', 'max' => 100],
            [['tierid'], 'exist', 'skipOnError' => true, 'targetClass' => Tier::className(), 'targetAttribute' => ['tierid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'nickname' => 'Nickname',
            'tierid' => 'Tier',
            'status' => 'Status',
            'image' => 'Image',
            'gameid' => 'Game ID',
            'nohp' => 'Nohp',
            'tiername' => 'Tier',
			'playerfullname' => 'Fullname',
			'play' => 'Play',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGamedetails()
    {
        return $this->hasMany(GameDetails::className(), ['playerid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTier()
    {
        return $this->hasOne(Tier::className(), ['id' => 'tierid']);
    }

    public function getTiername()
    {
        return $this->tier->tiername;
    }

	public function getPlay()
    {
        return $this->name;
    }

	public function getPlayerFullname(){
		return $this->name." (".$this->nickname.")";
	}

    /**
     * {@inheritdoc}
     * @return PlayerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PlayerQuery(get_called_class());
    }
}
