<?php

use yii\db\Migration;

/**
 * Class m190918_163052_create_table_orders
 */
class m190918_163052_create_table_orders extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%orders}}', [
            'id' => $this->bigPrimaryKey(),
            'customer_id' => $this->bigInteger(),
            'employee_id' => $this->bigInteger(),
            'order_date' => $this->dateTime(),
            'ship_date' => $this->dateTime(),
            'fee_info' => $this->text(),
            'billing_info' => $this->text(),
            'payment_info' => $this->text(),
            'shipper_id' => $this->integer(),
            'freight' => $this->double()->notNull(),
            'ship_name' => $this->string(),
            'ship_phone' => $this->string(),
            'ship_email' => $this->string(),
            'ship_address' => $this->string(),
            'ship_city' => $this->string(),
            'ship_district' => $this->string(),
            'ship_ward' => $this->string(),
            'ship_postcode' => $this->string(),
            'ship_country' => $this->string(),
            'total_price' => $this->double()->notNull(),
            'total_tax' => $this->double(),
            'status' => $this->integer()->notNull(),
            'ship_status' => $this->integer(),
            'payment_status' => $this->integer(),
            'note' => $this->text(),
            'payment_type' => $this->integer(),
            'notification_type' => $this->integer(),
            'update_at' => $this->timestamp()->notNull(),
            'create_at' => $this->timestamp()->notNull(),
            'is_deleted' => $this->tinyInteger(1)->defaultValue(0),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%orders}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190918_163052_create_table_orders cannot be reverted.\n";

        return false;
    }
    */
}
