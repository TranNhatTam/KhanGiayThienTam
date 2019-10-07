<?php

use yii\db\Migration;

/**
 * Class m190811_064031_create_table_product
 */
class m190811_064031_create_table_product extends Migration
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

        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey()->unsigned(),
            'code' => $this->string()->notNull()->unique(),
            'name' => $this->string(255)->notNull(),
            'thumbnail_path' => $this->string(),
            'thumbnail_base_url' => $this->string(),
            'unit_price' => $this->double()->notNull()->defaultValue(0),
            'unit_in_stock' => $this->integer()->notNull()->defaultValue('0'),
            'quantity_in_stock' => $this->integer()->notNull()->defaultValue('0'),
            'discount' => $this->double(),
            'star_rating' => $this->integer(),
            'total_view' => $this->integer(),
            'warranty' => $this->string(),
            'short_detail' => $this->text(),
            'description' => $this->text(),
            'technical_detail' => $this->text(),
            'additional_detail' => $this->text(),
            'status' => $this->integer(),
            'priority' => $this->integer()->notNull()->defaultValue('0'),
            'update_at' => $this->timestamp()->notNull(),
            'create_at' => $this->timestamp()->notNull(),
            'is_deleted' => $this->tinyInteger(1)->defaultValue(0),
            'brand_id' => $this->integer(),
            'category_id' => $this->integer()->unsigned()->notNull(),
            'url_id' => $this->integer()->unsigned()->notNull(),
            'images' => $this->text(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable("{{%product}}");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190811_064031_create_table_product cannot be reverted.\n";

        return false;
    }
    */
}
