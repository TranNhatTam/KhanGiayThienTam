<?php

use yii\db\Migration;

/**
 * Class m191001_151106_create_table_slider
 */
class m191001_151106_create_table_slider extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%slider}}', [
            'id' => $this->primaryKey(),
            'base_url' => $this->string(1024),
            'path' => $this->string(1024),
            'url' => $this->string(1024),
            'status' => $this->smallInteger()->notNull(),
            'order' => $this->integer(),
            'updated_at' => $this->timestamp()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'is_deleted' => $this->tinyInteger(1)->defaultValue(0),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%slider}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191001_151106_create_table_slider cannot be reverted.\n";

        return false;
    }
    */
}
