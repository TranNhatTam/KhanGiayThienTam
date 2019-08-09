<?php

use yii\db\Migration;

class m180926_085041_create_table_category_deal extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%category_deal}}', [
            'category_id' => $this->integer()->notNull(),
            'deallist_id' => $this->integer()->notNull(),
            'is_deleted' => $this->tinyInteger(1)->defaultValue(0),
        ], $tableOptions);

        $this->addPrimaryKey('PRIMARYKEY', '{{%category_deal}}', ['category_id', 'deallist_id']);
    }

    public function down()
    {
        $this->dropTable('{{%category_deal}}');
    }
}
