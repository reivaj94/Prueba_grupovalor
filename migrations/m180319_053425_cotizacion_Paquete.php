<?php

use yii\db\Migration;

/**
 * Class m180319_053425_cotizacion_Paquete
 */
class m180319_053425_cotizacion_Paquete extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("cotizacion_Paquete", [
                "id_cotizacion"     =>$this->integer()->unsigned(),
                "id_paquete"       =>$this->integer()->unsigned(),
                "cantidad"          =>$this->integer(),
                "total"             =>$this->decimal(10,2),
                "PRIMARY KEY(id_cotizacion, id_paquete)"
            ]);

    /**  ---------------------------
         ----ManytoMany-------------
         ...........................
    */    
    $this->createIndex('index_id_cotizacion-cotizacion_Paquete', 'cotizacion_Paquete', 'id_cotizacion');
    $this->addForeignKey('fk_id_cotizacion-cotizacion_Paquete', 'cotizacion_Paquete', 'id_cotizacion', 'cotizacion', 'id', 'restrict', 'cascade');

    $this->createIndex('index_id_paquete-cotizacion_Paquete', 'cotizacion_Paquete', 'id_paquete');
    $this->addForeignKey('fk_id_paquete-cotizacion_Paquete', 'cotizacion_Paquete', 'id_paquete', 'paquete', 'id', 'restrict', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable("cotizacion_Paquete");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180319_053425_cotizacion_Paquete cannot be reverted.\n";

        return false;
    }
    */
}
