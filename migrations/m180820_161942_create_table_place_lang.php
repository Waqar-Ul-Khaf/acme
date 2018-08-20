<?php

use yii\db\Migration;

/**
 * Class m180820_161942_create_table_place_lang
 */
class m180820_161942_create_table_place_lang extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('tbl_place_lang', [
            'id' => $this->primaryKey()->unsigned(),
            'place_id' => $this->integer()->unsigned()->notNull(),
            'locality' => $this->string(45)->notNull(),
            'country' => $this->string(45)->notNull(),
            'lang' => $this->string(2)->notNull()
        ]);
        $this->createIndex('idx_tbl_place_lang_place_id_tbl_place', 'tbl_place_lang', 'place_id');
        $this->addForeignKey('fk_tbl_place_lang_place_id_tbl_place', 'tbl_place_lang', 'place_id', 'tbl_place', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropForeignKey('fk_tbl_place_lang_place_id_tbl_place', 'tbl_place_lang');
        $this->dropIndex('idx_tbl_place_lang_place_id_tbl_place', 'tbl_place_lang');
        $this->dropTable('tbl_place_lang');
    }

    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m180820_161942_create_table_place_lang cannot be reverted.\n";

      return false;
      }
     */
}
