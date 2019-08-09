<?php

use yii\db\Migration;

class m180926_085042_create_table_orders extends Migration
{
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
            'require_date' => $this->dateTime(),
            'ship_date' => $this->dateTime(),
            'fee_info' => $this->text(),
            'billing_info' => $this->text(),
            'payment_info' => $this->text(),
            'shiper_id' => $this->integer(),
            'freight' => $this->double()->notNull(),
            'ship_name' => $this->string(),
            'ship_phone' => $this->string(),
            'ship_email' => $this->string(),
            'ship_address' => $this->string(),
            'ship_city' => $this->string(),
            'ship_district' => $this->string(),
            'ship_ward' => $this->string(),
            'ship_postalcode' => $this->string(),
            'ship_country' => $this->string(),
            'total_price' => $this->double()->notNull(),
            'total_tax' => $this->double(),
            'status' => $this->string()->notNull(),
            'note' => $this->text(),
            'payment_type' => $this->integer(),
            'notification_type' => $this->integer(),
            'is_deleted' => $this->tinyInteger(1)->defaultValue(0),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%orders}}');
    }
}
