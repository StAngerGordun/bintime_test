<?php

use yii\db\Migration;

class m170811_155332_addresses extends Migration
{
    //public function safeUp()
    //{
    //
    //}
    //
    //public function safeDown()
    //{
    //    echo "m170811_155332_addresses cannot be reverted.\n";
    //
    //    return false;
    //}

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
    
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
    
        $this->createTable('addresses', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'country' => $this->string()->notNull(),
            'country_short' => $this->string()->notNull(),
            'city' => $this->string()->notNull(),
            'street' => $this->string()->notNull(),
            'street_number' => $this->string()->notNull(),
            'postal_code' => $this->string()->notNull(),
            'office_number' => $this->string()
        ], $tableOptions);
    
        $this->createIndex(
            'idx-user_user_id',
            'addresses',
            'user_id'
        );
        $this->addForeignKey(
            'idx-user_user_id',
            'addresses',
            'user_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }
    
    public function down()
    {
        $this->dropForeignKey(
            'idx-user_user_id',
            'addresses');
        $this->dropIndex(
            'idx-user_user_id',
            'addresses'
            );
        $this->dropTable('addresses');
    }
    
}
