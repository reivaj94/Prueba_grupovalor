<?php

use yii\db\Migration;

/**
 * Class m180319_043302_cotizacion_Articulo
 */
class m180319_043302_cotizacion_Articulo extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
            $this->createTable("cotizacion_Articulo", [
                "id_cotizacion"     =>$this->integer()->unsigned(),
                "id_articulo"       =>$this->integer()->unsigned(),
                "cantidad"          =>$this->integer(),
                "total"             =>$this->decimal(10,2),
                "PRIMARY KEY(id_cotizacion, id_articulo)"
            ]


        );

    /**  ---------------------------
         ----ManytoMany-------------
         ...........................
    */    
    $this->createIndex('index_id_cotizacion', 'cotizacion_Articulo', 'id_cotizacion');
    $this->addForeignKey('fk_id_cotizacion', 'cotizacion_Articulo', 'id_cotizacion', 'cotizacion', 'id', 'restrict', 'cascade');

    $this->createIndex('index_id_articulo-cotizacion_Articulo', 'cotizacion_Articulo', 'id_articulo');
    $this->addForeignKey('fk_id_articulo-cotizacion_Articulo', 'cotizacion_Articulo', 'id_articulo', 'articulo', 'id', 'restrict', 'cascade');
    
    $this->batchInsert('cotizacion_Articulo', ['id_articulo', 'id_cotizacion', 'cantidad',"total"], [
            [2,1, 1, 270],            
            [4,1, 2, 240],
            [6,1, 1, 190],
            [7,1, 1, 80],
            
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable("cotizacion_Articulo");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180319_043302_cotizacion_Articulo cannot be reverted.\n";

        return false;
    }
    */
}
