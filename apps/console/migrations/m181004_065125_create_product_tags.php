<?php

use yii\db\Migration;

/**
 * Class m181004_065125_create_product_tags
 */
class m181004_065125_create_product_tags extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_tag}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'tag_name' => $this->string()->notNull(),
            'is_deleted' => $this->tinyInteger(1)->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        foreach (['product_tag'] as $table) {
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
        echo "m181004_065125_create_product_tags cannot be reverted.\n";

        return false;
    }
    */
}
