<?php

use yii\db\Migration;

class m180926_085042_create_table_product_related extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%product_related}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'product_related_id' => $this->integer()->notNull(),
            'is_deleted' => $this->tinyInteger(1)->defaultValue(0),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%product_related}}');
    }
}
