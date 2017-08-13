<?php

use yii\db\Migration;

class m170812_163102_gender extends Migration
{
    //public function safeUp()
    //{
    //
    //}
    //
    //public function safeDown()
    //{
    //    echo "m170812_163102_gender cannot be reverted.\n";
    //
    //    return false;
    //}
    
    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        
        if ($this->db->driverName === 'mysql')
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('gender', [
            'id'      => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ], $tableOptions);
    
        $this->createIndex(
            'idx-user_gender_id',
            'user',
            'gender_id'
        );
        $this->addForeignKey(
            'idx-user_gender_id',
            'user',
            'gender_id',
            'gender',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }
    
    public function down()
    {
        $this->dropTable('addresses');
    }
}
