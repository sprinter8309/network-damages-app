<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\components\validators\BranchNodeValidator;
use app\models\dto\ManageDamageDataDto;

class Damage extends ActiveRecord
{
    public function rules()
    {
        return [
            ['leakage_size', 'required', 'message' => 'Введите величину утечки'],
            ['leakage_size', 'number', 'message' => 'Величина утечки должна быть числом'],
            ['heating_node_id', BranchNodeValidator::class]
        ];
    }
    
    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT=>['branch_id', 'heating_node_id', 'leakage_size']
        ];
    }
    
    public function getBranch()
    {
        return $this->hasOne(Branch::class, ['id' => 'branch_id']);
    }
    
    public function getHeatingNode()
    {
        return $this->hasOne(HeatingNode::class, ['id' => 'heating_node_id']);
    }
    
    public static function getReferenceDataForLists()
    {
        $branches_records = Branch::find()->all();       
        $branches = [];
        foreach ($branches_records as $branches_record) {
            $branches += [
                $branches_record->id=>$branches_record->name
            ];
        }
        
        $heating_nodes_records = HeatingNode::find()->all();
        $heating_nodes = [];
        foreach ($heating_nodes_records as $heating_nodes_record) {
            $heating_nodes += [
                $heating_nodes_record->id=>$heating_nodes_record->name
            ];
        }
        
        return ManageDamageDataDto::loadFromArray([
            'branches'=>$branches,
            'heating_nodes'=>$heating_nodes,
            'damage_model'=>null
        ]);
    }
}
