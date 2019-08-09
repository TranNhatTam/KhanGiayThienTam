<?php

use yii\db\Migration;

/**
 * Class m181113_032451_update_table_business
 */
class m181113_032451_update_table_business extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%business}}', 'link_facebook', $this->string(512));
        $this->addColumn('{{%business}}', 'link_skype', $this->string(512));
        $this->addColumn('{{%business}}', 'link_google_plus', $this->string(512));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%business}}', 'link_facebook');
        $this->dropColumn('{{%business}}', 'link_skype');
        $this->dropColumn('{{%business}}', 'link_google_plus');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181113_032451_update_table_business cannot be reverted.\n";

        return false;
    }
    */
}
