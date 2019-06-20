<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Tier]].
 *
 * @see Tier
 */
class TierQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Tier[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Tier|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
