<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[GameDetails]].
 *
 * @see GameDetails
 */
class GameDetailsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GameDetails[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GameDetails|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
