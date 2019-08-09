<?php

use yii\db\Migration;

class m180926_085043_create_table_tracking_status extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tracking_status}}', [
            'status' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'group' => $this->integer(),
            'priority' => $this->integer(),
            'is_deleted' => $this->tinyInteger(1)->defaultValue(0),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%tracking_status}}');
    }
}
