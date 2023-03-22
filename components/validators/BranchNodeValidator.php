<?php

namespace app\components\validators;

use yii\validators\Validator;
use yii\helpers\ArrayHelper;
use app\models\Branch;

class BranchNodeValidator extends Validator
{
    public function validateAttribute($model, $attribute): void
    {
        $branch_nodes = Branch::findOne($model->branch_id)->heatingNodes; 
        $branch_nodes_ids = ArrayHelper::getColumn($branch_nodes, 'id');

        if (!in_array((int)$model->$attribute, $branch_nodes_ids)) {
            $this->addError($model, $attribute, 'Указанный тепловой узел не принадлежит указанному филиалу');
        }
    }
}
