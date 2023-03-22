<?php

namespace app\models;

use yii\db\ActiveRecord;

class HeatingNode extends ActiveRecord
{
    public static function tableName()
    {
        return 'heating_node';
    }
    
    public function getBranch()
    {
        return $this->hasOne(Branch::class, ['id' => 'branch_id']);
    }
}
