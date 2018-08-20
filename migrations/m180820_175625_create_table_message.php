<?php

use yii\db\Migration;

/**
 * Class m180820_175625_create_table_message
 */
class m180820_175625_create_table_message extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('tbl_message', [
            'id' => $this->primaryKey()->unsigned(),
            'from_user_id' => $this->integer()->unsigned()->notNull(),
            'to_user_id' => $this->integer()->unsigned()->notNull(),
            'trip_id' => $this->integer()->unsigned()->notNull(),
            'text' => $this->text()->notNull(),
            'created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->createIndex('idx_tbl_message_from_user_id_tbl_user', 'tbl_message', 'from_user_id');
        $this->addForeignKey('fk_tbl_message_from_user_id_tbl_user', 'tbl_message', 'from_user_id', 'tbl_user', 'id', 'restrict', 'cascade');

        $this->createIndex('idx_tbl_message_to_user_id_tbl_user', 'tbl_message', 'to_user_id');
        $this->addForeignKey('fk_tbl_message_to_user_id_tbl_user', 'tbl_message', 'to_user_id', 'tbl_user', 'id', 'restrict', 'cascade');

        $this->createIndex('idx_tbl_message_trip_id_tbl_trip', 'tbl_message', 'trip_id');
        $this->addForeignKey('fk_tbl_message_trip_id_tbl_trip', 'tbl_message', 'trip_id', 'tbl_trip', 'id', 'restrict', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
         $this->dropForeignKey('fk_tbl_message_from_user_id_tbl_user', 'tbl_message');
        $this->dropIndex('idx_tbl_message_from_user_id_tbl_user', 'tbl_message');
         $this->dropForeignKey('fk_tbl_message_to_user_id_tbl_user', 'tbl_message');
        $this->dropIndex('idx_tbl_message_to_user_id_tbl_user', 'tbl_message');
         $this->dropForeignKey('fk_tbl_message_trip_id_tbl_trip', 'tbl_message');
        $this->dropIndex('idx_tbl_message_trip_id_tbl_trip', 'tbl_message');
        
        $this->dropTable('tbl_message');
    }

    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m180820_175625_create_table_message cannot be reverted.\n";

      return false;
      }
     */
}
