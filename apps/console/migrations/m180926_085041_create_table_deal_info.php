<?php

use yii\db\Migration;

class m180926_085041_create_table_deal_info extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%deal_info}}', [
            'id' => $this->bigPrimaryKey(),
            'name' => $this->text()->notNull(),
            'detail' => $this->text(),
            'description' => $this->text(),
            'url' => $this->string(),
            'supplier_id' => $this->bigInteger(),
            'image' => $this->string(),
            'priority' => $this->integer()->notNull()->defaultValue('0'),
            'group_id' => $this->integer()->notNull()->defaultValue('0'),
            'deallist_id' => $this->bigInteger(),
            'is_deleted' => $this->tinyInteger(1)->defaultValue(0),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%deal_info}}');
    }
}
