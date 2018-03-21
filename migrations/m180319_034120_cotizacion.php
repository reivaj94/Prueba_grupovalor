<?php

use yii\db\Migration;

/**
 * Class m180319_034120_cotizacion
 */
class m180319_034120_cotizacion extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("cotizacion",[
            "id"                  =>$this->primaryKey()->unsigned(),
            "nombreCliente"       =>$this->String(60)->notNull(),
            "nombreVendedor"      =>$this->String(60)->notNull(),
            "ruc"                 =>$this->String(20)->notNull(),
            "total"               =>$this->money()->notNull(),
            "impuesto"            =>$this->Decimal(5,2)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable("cotizacion");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180319_034120_cotizacion cannot be reverted.\n";

        return false;
    }
    */
}
