<?php

use yii\db\Migration;

class m180926_085043_create_table_wish_list extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%wish_list}}', [
            'id' => $this->primaryKey(),
            'customer_id' => $this->integer()->notNull(),
            'product_code' => $this->string()->notNull(),
            'product_name' => $this->string()->notNull(),
            'product_image' => $this->string()->notNull(),
            'product_detail' => $this->text()->notNull(),
            'is_deleted' => $this->tinyInteger(1)->defaultValue(0),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%wish_list}}');
    }
}
