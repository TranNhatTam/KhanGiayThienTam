<?php

use yii\db\Migration;

/**
 * Class m191002_153620_create_table_posts
 */
class m191002_153620_create_table_posts extends Migration
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

        $this->createTable('{{%posts}}', [
            'id' => $this->primaryKey(),
            'base_url' => $this->string(1024),
            'path' => $this->string(1024),
            'title' => $this->string(1024),
            'content' => $this->text(),
            'type' => $this->smallInteger()->notNull(),
            'status' => $this->smallInteger()->notNull(),
            'username' => $this->string(),
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
        $this->dropTable('{{%posts}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191002_153620_create_table_posts cannot be reverted.\n";

        return false;
    }
    */
}
