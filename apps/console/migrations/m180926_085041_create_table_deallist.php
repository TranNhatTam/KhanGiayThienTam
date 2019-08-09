<?php

use yii\db\Migration;

class m180926_085041_create_table_deallist extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%deallist}}', [
            'id' => $this->bigPrimaryKey(),
            'name' => $this->string()->notNull(),
            'details' => $this->text(),
            'reference' => $this->string(),
            'icon' => $this->string(),
            'priority' => $this->integer()->notNull()->defaultValue('0'),
            'group_id' => $this->integer()->notNull()->defaultValue('0'),
            'is_deleted' => $this->tinyInteger(1)->defaultValue(0),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%deallist}}');
    }
}
