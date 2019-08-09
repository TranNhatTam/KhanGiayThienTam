<?php

use yii\db\Migration;

class m180926_085041_create_table_category extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'category_code' => $this->string(),
            'url_id' => $this->integer()->unsigned()->notNull(),
            'name' => $this->string()->notNull(),
            'priority' => $this->integer()->notNull()->defaultValue('0'),
            'category_icon' => $this->string(),
            'description' => $this->text(),
            'extra_number' => $this->double(),
            'extra_text' => $this->text(),
            'extra_lbs' => $this->double(),
            'is_parent' => $this->integer()->notNull()->defaultValue('1'),
            'parent_id' => $this->integer(),
            'group_id' => $this->integer(),
            'is_deleted' => $this->tinyInteger(1)->defaultValue(0),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%category}}');
    }
}
