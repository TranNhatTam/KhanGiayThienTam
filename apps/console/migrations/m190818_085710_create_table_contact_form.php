<?php

use yii\db\Migration;

/**
 * Class m190702_035913_create_table_contact_form
 */
class m190818_085710_create_table_contact_form extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%contact_form}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'phone' =>$this->integer()->notNull(),
            'email' => $this->string()->notNull(),
            'subject' => $this->string(),
            'body' => $this->string(),
        ]);
    }

    /**
     * @return bool|void
     */
    public function down()
    {
        $this->dropTable('{{%contact_form}}');
    }



    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190702_035913_create_table_contact_form cannot be reverted.\n";

        return false;
    }
    */
}

