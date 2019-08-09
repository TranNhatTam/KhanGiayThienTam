<?php

use yii\db\Migration;

class m180926_085041_create_table_category_define extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%category_define}}', [
            'id' => $this->primaryKey(),
            'key' => $this->string()->notNull(),
            'extra_lbs' => $this->double(),
            'extra_number' => $this->double(),
            'extra_percent' => $this->double(),
            'title' => $this->text()->notNull(),
            'priority' => $this->integer(),
            'group_id' => $this->integer(),
            'min_price' => $this->double(),
            'max_price' => $this->double(),
            'is_deleted' => $this->tinyInteger(1)->defaultValue(0),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%category_define}}');
    }
}
