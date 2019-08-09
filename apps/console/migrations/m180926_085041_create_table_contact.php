<?php

use yii\db\Migration;

class m180926_085041_create_table_contact extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%contact}}', [
            'id' => $this->primaryKey(),
            'sender_name' => $this->text()->notNull(),
            'email' => $this->text()->notNull(),
            'phone' => $this->text()->notNull(),
            'subject' => $this->text()->notNull(),
            'created_at' => $this->dateTime(),
            'is_deleted' => $this->tinyInteger(1)->defaultValue(0),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%contact}}');
    }
}
