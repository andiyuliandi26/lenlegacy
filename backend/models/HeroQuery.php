<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Hero]].
 *
 * @see Hero
 */
class HeroQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Hero[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Hero|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
