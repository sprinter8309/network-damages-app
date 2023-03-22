<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%damage}}`.
 */
class m230322_144808_create_damage_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%damage}}', [
            'id' => $this->primaryKey(),
            'branch_id'=>$this->integer()->notNull(),
            'heating_node_id'=>$this->integer()->notNull(),
            'emergence_time' => $this->dateTime(),
            'leakage_size'=>$this->float()->notNull(),
            'is_delete' => $this->boolean()
        ]);
        
        $this->createIndex('idx_damage-branch_id', 'damage', 'branch_id');               
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx_damage-branch_id', 'damage');
        
        $this->dropTable('{{%damage}}');
    }
}
