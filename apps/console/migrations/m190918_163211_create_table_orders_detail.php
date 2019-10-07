<?php

use yii\db\Migration;

/**
 * Class m190918_163211_create_table_orders_detail
 */
class m190918_163211_create_table_orders_detail extends Migration
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

        $this->createTable('{{%orders_detail}}', [
            'id' => $this->bigPrimaryKey(),
            'order_id' => $this->bigInteger()->notNull(),
            'product_id' => $this->bigInteger()->notNull(),
            'unit_price' => $this->double()->notNull(),
            'quantity' => $this->integer()->notNull(),
            'tax_value' => $this->double()->notNull(),
            'discount' => $this->double()->notNull(),
            'total_price' => $this->double()->notNull(),
            'note' => $this->text(),
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
        $this->dropTable('{{%orders_detail}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190918_163211_create_table_orders_detail cannot be reverted.\n";

        return false;
    }
    */
}
