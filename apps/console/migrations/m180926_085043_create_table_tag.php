<?php

use yii\db\Migration;

class m180926_085043_create_table_tag extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tag}}', [
            'id' => $this->primaryKey(),
            'url_id' => $this->integer()->unsigned()->notNull(),
            'name' => $this->string()->notNull(),
            'url' => $this->string(),
            'group_id' => $this->integer(),
            'priority' => $this->integer()->notNull()->defaultValue('0'),
            'is_deleted' => $this->tinyInteger(1)->defaultValue(0),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%tag}}');
    }
}
