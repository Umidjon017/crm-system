<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%room}}`.
 */
class m220319_164823_create_room_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{_room}}', [
            'id' => $this->primaryKey(),
            'name'=> $this->string('255')->notNull(),
            'number_of_students'=>$this->tinyInteger()->notNull(),
            'type'=>$this->tinyInteger()->notNull(),
            'status'=>$this->tinyInteger(1)->notNull()->defaultValue(1),
            'is_deleted' => $this->tinyInteger(1)->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{_room}}');
    }
}
