<?php

use yii\db\Migration;

/**
 * Class m180318_131533_articulo
 */
class m180318_131533_articulo extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("articulo",[
            "id"                =>$this->primaryKey()->unsigned(),
            "descripcion"       =>$this->String(60)->notNull(),
            "tipo"              =>$this->String (30)->notNull(),
            "precio"            =>$this->money()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('articulo');
        $this->dropTable("articulo");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180318_131533_articulo cannot be reverted.\n";

        return false;
    }
    */
}
