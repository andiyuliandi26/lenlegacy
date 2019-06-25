<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "season".
 *
 * @property int $id
 * @property string $league
 * @property string $seasonname
 * @property string $tglmulai
 * @property string $tglselesai
 * @property int $jumlahpeserta
 * @property string $status
 *
 * @property Games $games
 */
class Season extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'season';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['seasonname'], 'required'],
            [['tglmulai', 'tglselesai'], 'safe'],
            [['jumlahpeserta'], 'integer'],
            [['league'], 'string', 'max' => 100],
            [['seasonname', 'status'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'league' => 'League',
            'seasonname' => 'Seasonname',
            'tglmulai' => 'Tglmulai',
            'tglselesai' => 'Tglselesai',
            'jumlahpeserta' => 'Jumlahpeserta',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGames()
    {
        return $this->hasMany(Games::className(), ['seasonid' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return SeasonQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SeasonQuery(get_called_class());
    }
}
