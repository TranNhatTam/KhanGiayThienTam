<?php

use yii\db\Migration;

/**
 * Class m190811_032222_create_table_category
 */
class m190811_032222_create_table_category extends Migration
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

        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(255)->notNull(),
            'thumbnail_path' => $this->string(),
            'thumbnail_base_url' => $this->string(),
            'icon' => $this->string(),
            'description' => $this->text(),
            'priority' => $this->integer()->notNull()->defaultValue('0'),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP'),
            'is_deleted' => $this->tinyInteger(1)->defaultValue(0),
            'url_id' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable("{{%category}}");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190811_032222_create_table_category cannot be reverted.\n";

        return false;
    }
    */
}
