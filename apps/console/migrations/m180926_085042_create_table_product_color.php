<?php

use yii\db\Migration;

class m180926_085042_create_table_product_color extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%product_color}}', [
            'product_id' => $this->integer()->notNull(),
            'color_id' => $this->integer()->notNull(),
            'price_plus' => $this->double()->notNull(),
            'status' => $this->string(),
            'is_deleted' => $this->tinyInteger(1)->defaultValue(0),
        ], $tableOptions);

        $this->addPrimaryKey('PRIMARYKEY', '{{%product_color}}', ['product_id', 'color_id']);
    }

    public function down()
    {
        $this->dropTable('{{%product_color}}');
    }
}
