<?php

use yii\db\Migration;

/**
 * Class m190811_014438_create_table_url
 */
class m190811_014438_create_table_url extends Migration
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

        $this->createTable('{{%url}}', [
            'id' => $this->primaryKey()->unsigned(),
            'route' => $this->string(255)->unique(),
            'suffix' => $this->string(16),
            'type' => $this->tinyInteger(1)->notNull(),
            'seo' => $this->text(),
            'updated_at' => $this->timestamp()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'is_deleted' => $this->tinyInteger(1)->defaultValue(0)
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable("{{%url}}");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190811_014438_create_table_url cannot be reverted.\n";

        return false;
    }
    */
}
