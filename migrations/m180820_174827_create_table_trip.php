<?php

use yii\db\Migration;

/**
 * Class m180820_174827_create_table_trip
 */
class m180820_174827_create_table_trip extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
          $this->createTable('tbl_trip', [
            'id' => $this->primaryKey()->unsigned(),
            'user_id' => $this->integer()->unsigned()->notNull(),
            'from' => $this->integer()->unsigned()->notNull(),
            'to' => $this->integer()->unsigned()->notNull(),
            'date' => $this->dateTime()->notNull(),
            'number_seats' => $this->integer(4)->notNull(),
            'duration' => $this->decimal(10, 1)->notNull(),
            'price' => $this->decimal(10, 2)->notNull(),
            'currency_id' => $this->integer()->unsigned()->notNull(),
            'status' => $this->integer(4)->notNull()->defaultValue(1),
            'created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated' => $this->timestamp()->notNull()
        ]);
        
        $this->createIndex('idx_tbl_trip_user_id_tbl_user', 'tbl_trip', 'user_id');
        $this->addForeignKey('fk_tbl_trip_user_id_tbl_user', 'tbl_trip', 'user_id', 'tbl_user', 'id', 'restrict', 'cascade');
        
        $this->createIndex('idx_tbl_trip_from_tbl_place', 'tbl_trip', 'from');
        $this->addForeignKey('fk_tbl_trip_from_tbl_place', 'tbl_trip', 'from', 'tbl_place', 'id', 'restrict', 'cascade');
        
        $this->createIndex('idx_tbl_trip_to_tbl_place', 'tbl_trip', 'to');
        $this->addForeignKey('fk_tbl_trip_to_tbl_place', 'tbl_trip', 'to', 'tbl_place', 'id', 'restrict', 'cascade');
        
        $this->createIndex('idx_tbl_trip_currency_id_tbl_currency', 'tbl_trip', 'currency_id');
        $this->addForeignKey('fk_tbl_trip_currency_id_tbl_currency', 'tbl_trip', 'currency_id', 'tbl_currency', 'id', 'restrict', 'cascade');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
         $this->dropForeignKey('fk_tbl_trip_user_id_tbl_user', 'tbl_trip');
        $this->dropIndex('idx_tbl_trip_user_id_tbl_user', 'tbl_trip');
         $this->dropForeignKey('fk_tbl_trip_from_tbl_place', 'tbl_trip');
        $this->dropIndex('idx_tbl_trip_from_tbl_place', 'tbl_trip');
         $this->dropForeignKey('fk_tbl_trip_to_tbl_place', 'tbl_trip');
        $this->dropIndex('idx_tbl_trip_to_tbl_place', 'tbl_trip');
         $this->dropForeignKey('fk_tbl_trip_currency_id_tbl_currency', 'tbl_trip');
        $this->dropIndex('idx_tbl_trip_currency_id_tbl_currency', 'tbl_trip');
        
        $this->dropTable('tbl_trip');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180820_174827_create_table_trip cannot be reverted.\n";

        return false;
    }
    */
}
