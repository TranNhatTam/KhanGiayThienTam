<?php

use yii\db\Migration;

/**
 * Class m181004_065112_create_table_urls
 */
class m181004_065112_create_table_urls extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%urls}}', [
            'id' => $this->primaryKey()->unsigned(),
            'route' => $this->string(255)->notNull(),
            'suffix' => $this->string(16),
            'type' => $this->tinyInteger(1)->notNull(),
            'seo' => $this->text(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned(),
            'deleted_at' => $this->integer()->unsigned(),
            'is_deleted' => $this->tinyInteger(1)->defaultValue(0)
        ]);
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        foreach (['urls'] as $table) {
            $this->dropTable("{{%$table}}");
        }
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181004_065112_create_table_urls cannot be reverted.\n";

        return false;
    }
    */
}
