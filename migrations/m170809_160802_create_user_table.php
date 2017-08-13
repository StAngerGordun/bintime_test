<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m170809_160802_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        
        if ($this->db->driverName === 'mysql')
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('user', [
            'id'         => $this->primaryKey(),
            'name'       => $this->string()->notNull(),
            'surname'    => $this->string()->notNull(),
            'login'      => $this->string()->notNull(),
            'password'   => $this->string()->notNull(),
            'gender_id'     => $this->integer(2),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP '),
        ], $tableOptions);
        
    }
    
    /**
     * @inheritdoc
     */
    public function down()
    {
       
        $this->dropTable('user');
    }
}
