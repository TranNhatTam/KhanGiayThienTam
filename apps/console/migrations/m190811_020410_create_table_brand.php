<?php

use yii\db\Migration;

/**
 * Class m190811_020410_create_table_brand
 */
class m190811_020410_create_table_brand extends Migration
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

        $this->createTable('{{%brand}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(255)->notNull(),
            'thumbnail_path' => $this->string(),
            'thumbnail_base_url' => $this->string(),
            'icon' => $this->string(),
            'description' => $this->text(),
            'priority' => $this->integer()->notNull()->defaultValue('0'),
            'create_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
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
        $this->dropTable("{{%brand}}");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190811_020410_create_table_brand cannot be reverted.\n";

        return false;
    }
    */
}
