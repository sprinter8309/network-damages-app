<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%branch}}`.
 */
class m230322_145003_create_branch_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%branch}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string()->notNull(),
        ]);
        
        $this->createIndex('idx_branch-name', 'branch', 'name'); 
        
        $this->addForeignKey('fk_damage_branch_id', 'damage', 'branch_id', 'branch', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_damage_branch_id', 'damage');
        
        $this->dropIndex('idx_branch-name', 'branch');
        
        $this->dropTable('{{%branch}}');
    }
}
