<?php

use yii\db\Migration;

class m180926_085041_create_table_color extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%color}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'color_code' => $this->string()->notNull(),
            'is_deleted' => $this->tinyInteger(1)->defaultValue(0),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%color}}');
    }
}
