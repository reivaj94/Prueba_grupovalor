<?php

use yii\db\Migration;

/**
 * Class m180318_142239_paquete
 */
class m180318_142239_paquete extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("paquete",[
            "id"                =>$this->primaryKey()->unsigned(),
            "descripcion"       =>$this->String(60)->notNull(),
            "descuento"         =>$this->decimal(3,2)->notNull(),
            "total"             =>$this->money()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('paquete');
        $this->dropTable("paquete");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180318_142239_paquete cannot be reverted.\n";

        return false;
    }
    */
}
