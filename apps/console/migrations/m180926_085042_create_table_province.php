<?php

use yii\db\Migration;

class m180926_085042_create_table_province extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%province}}', [
            'id' => $this->string()->notNull()->append('PRIMARY KEY'),
            'name' => $this->string()->notNull(),
            'type' => $this->string()->notNull(),
            'is_deleted' => $this->tinyInteger(1)->defaultValue(0),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%province}}');
    }
}
