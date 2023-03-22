<?php

namespace app\models;

use yii\db\ActiveRecord;

class Branch extends ActiveRecord
{
    public function getHeatingNodes()
    {
        return $this->hasMany(HeatingNode::class, ['branch_id' => 'id']);
    }
}
