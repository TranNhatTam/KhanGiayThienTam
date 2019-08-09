<?php

use yii\db\Migration;

class m180926_085042_create_table_product extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%product}}', [
            'id' => $this->bigPrimaryKey(),
            'url_id' => $this->integer()->unsigned()->notNull(),
            'name' => $this->string()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'brand_id' => $this->integer()->notNull(),
            'unit_price' => $this->double()->notNull(),
            'discount' => $this->integer(),
            'star_rating' => $this->integer(),
            'total_view' => $this->integer(),
            'status' => $this->string(),
            'description' => $this->text()->notNull(),
            'short_detail' => $this->text()->notNull(),
            'warranty' => $this->string(),
            'group_id' => $this->integer()->defaultValue('0'),
            'technical_detail' => $this->text(),
            'additional_detail' => $this->string(),
            'unit_in_stock' => $this->integer()->notNull()->defaultValue('0'),
            'quantity_in_stock' => $this->integer()->notNull()->defaultValue('0'),
            'suppiler_id' => $this->integer(),
            'product_ref' => $this->string(),
            'is_deleted' => $this->tinyInteger(1)->defaultValue(0),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%product}}');
    }
}
