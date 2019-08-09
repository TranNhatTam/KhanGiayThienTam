<?php

use yii\db\Migration;

class m180926_085042_create_table_product_property extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%product_property}}', [
            'property_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'status' => $this->text()->notNull(),
            'is_main' => $this->tinyInteger()->notNull(),
            'priority' => $this->integer()->notNull(),
            'is_deleted' => $this->tinyInteger(1)->defaultValue(0),
        ], $tableOptions);

        $this->addPrimaryKey('PRIMARYKEY', '{{%product_property}}', ['property_id', 'product_id']);
    }

    public function down()
    {
        $this->dropTable('{{%product_property}}');
    }
}
