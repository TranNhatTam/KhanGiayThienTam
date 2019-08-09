<?php

use yii\db\Migration;

class m180926_085043_create_table_status extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%status}}', [
            'status' => $this->string()->notNull()->append('PRIMARY KEY'),
            'name' => $this->string()->notNull(),
            'is_sendmail' => $this->integer()->notNull(),
            'priority' => $this->integer()->notNull(),
            'is_deleted' => $this->tinyInteger(1)->defaultValue(0),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%status}}');
    }
}
