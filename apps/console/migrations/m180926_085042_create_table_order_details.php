<?php

use yii\db\Migration;

class m180926_085042_create_table_order_details extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%order_details}}', [
            'id' => $this->bigPrimaryKey(),
            'order_id' => $this->bigInteger()->notNull(),
            'product_id' => $this->bigInteger()->notNull(),
            'product_code' => $this->string(),
            'product_image' => $this->string(),
            'product_ref' => $this->string(),
            'unit_price' => $this->double()->notNull(),
            'quantity' => $this->integer()->notNull(),
            'tax_value' => $this->double()->notNull(),
            'discount' => $this->double()->notNull(),
            'weight' => $this->double(),
            'category_id' => $this->integer(),
            'extra_number' => $this->double(),
            'extra_percent' => $this->double(),
            'extra_lbs' => $this->double(),
            'total_price' => $this->double(),
            'note' => $this->text(),
            'tracking_status' => $this->string(),
            'order_date' => $this->dateTime(),
            'status' => $this->string(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'is_deleted' => $this->tinyInteger(1)->defaultValue(0),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%order_details}}');
    }
}
