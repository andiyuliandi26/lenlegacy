<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tier".
 *
 * @property int $id
 * @property string $tiername
 */
class Tier extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tier';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tiername'], 'required'],
            [['tiername'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tiername' => 'Tier Name',
        ];
    }

    /**
     * {@inheritdoc}
     * @return TierQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TierQuery(get_called_class());
    }
}
