<?php

use yii\db\Migration;

class m180926_085042_create_table_history_sendsms extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%history_sendsms}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(),
            'customer_id' => $this->integer(),
            'sendto' => $this->string()->notNull(),
            'sent_at' => $this->dateTime(),
            'content' => $this->text()->notNull(),
            'is_deleted' => $this->tinyInteger(1)->defaultValue(0),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%history_sendsms}}');
    }
}
