<?php

use yii\db\Migration;

/**
 * Class m180820_180203_create_table_phone_number
 */
class m180820_180203_create_table_phone_number extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('tbl_phone_number', [
            'id' => $this->primaryKey()->unsigned(),
            'user_id' => $this->integer()->unsigned()->notNull(),
            'country_id' => $this->integer()->unsigned()->notNull(),
            'number' => $this->string(45)->notNull(),
            'verification_code' => $this->string(45)->notNull(),
            'verified' => $this->boolean()->notNull()->defaultValue(false),
            'active' => $this->boolean()->notNull()->defaultValue(true),
            'created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
        $this->createIndex('idx_tbl_phone_number_user_id_tbl_user', 'tbl_phone_number', 'user_id');
        $this->addForeignKey('fk_tbl_phone_number_user_id_tbl_user', 'tbl_phone_number', 'user_id', 'tbl_user', 'id', 'restrict', 'cascade');
        $this->createIndex('idx_tbl_phone_number_country_id_tbl_country', 'tbl_phone_number', 'country_id');
        $this->addForeignKey('fk_tbl_phone_number_country_id_tbl_country', 'tbl_phone_number', 'country_id', 'tbl_country', 'id', 'restrict', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropForeignKey('fk_tbl_phone_number_user_id_tbl_user', 'tbl_phone_number');
        $this->dropIndex('idx_tbl_phone_number_user_id_tbl_user', 'tbl_phone_number');
         $this->dropForeignKey('fk_tbl_phone_number_country_id_tbl_country', 'tbl_phone_number');
        $this->dropIndex('idx_tbl_phone_number_country_id_tbl_country', 'tbl_phone_number');
         $this->dropTable('tbl_phone_number');
    }

    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m180820_180203_create_table_phone_number cannot be reverted.\n";

      return false;
      }
     */
}
