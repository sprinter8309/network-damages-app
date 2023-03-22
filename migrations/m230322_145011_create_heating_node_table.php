<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%heating_node}}`.
 */
class m230322_145011_create_heating_node_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%heating_node}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string()->notNull(),
            'branch_id'=>$this->integer()->notNull(),
        ]);
        
        $this->createIndex('idx_heating_node-name', 'heating_node', 'name'); 
        $this->createIndex('idx_heating_node-branch_id', 'heating_node', 'branch_id');   
        
        $this->addForeignKey('fk_damage_heating_node_id', 'damage', 'heating_node_id', 'heating_node', 'id');
        $this->addForeignKey('fk_heating_node_branch_id', 'heating_node', 'branch_id', 'branch', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_heating_node_branch_id', 'heating_node');
        $this->dropForeignKey('fk_damage_heating_node_id', 'damage');
        
        $this->dropIndex('idx_heating_node-branch_id', 'heating_node');
        $this->dropIndex('idx_heating_node-name', 'heating_node');
        
        $this->dropTable('{{%heating_node}}');
    }
}
