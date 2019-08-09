<?php

use yii\db\Migration;

class m180926_085042_create_table_payment_type extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%payment_type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'active' => $this->integer()->notNull()->defaultValue('0'),
            'priority' => $this->integer()->notNull()->defaultValue('0'),
            'description' => $this->text(),
            'is_deleted' => $this->tinyInteger(1)->defaultValue(0),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%payment_type}}');
    }
}
