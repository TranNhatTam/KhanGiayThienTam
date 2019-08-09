<?php

use yii\db\Migration;

/**
 * Class m181109_032818_create_table_business
 */
class m181109_032818_create_table_business extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%business}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(255),
            'hot_line' => $this->string(255),
            'phone' => $this->string(255),
            'thumbnail_base_url' => $this->string('1024'),
            'thumbnail_path' => $this->string('1024'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%business}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181109_032818_create_table_business cannot be reverted.\n";

        return false;
    }
    */
}
