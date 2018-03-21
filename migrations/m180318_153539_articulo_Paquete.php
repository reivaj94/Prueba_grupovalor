<?php

use yii\db\Migration;

/**
 * Class m180318_153539_articulo_Paquete
 */
class m180318_153539_articulo_Paquete extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("articulo_Paquete",[
            "id_articulo"        =>$this->integer()->unsigned(),
            "id_paquete"         =>$this->integer()->unsigned(),
            "cantidad"           =>$this->integer()->notNull(),
            "precio"             =>$this->decimal(10,2)->notNull(),
            'PRIMARY KEY(id_articulo, id_paquete)'
        ]);
    
    /**  ---------------------------
         ----ManytoMany-------------
         ...........................
    */    
    $this->createIndex('index_id_articulo', 'articulo_Paquete', 'id_articulo');
    $this->addForeignKey('fk_id_articulo', 'articulo_Paquete', 'id_articulo', 'articulo', 'id', 'restrict', 'cascade');

    $this->createIndex('index_id_paquete', 'articulo_Paquete', 'id_paquete');
    $this->addForeignKey('fk_id_paquete', 'articulo_Paquete', 'id_paquete', 'paquete', 'id', 'restrict', 'cascade');

    $this->batchInsert('articulo_Paquete', ['id_articulo', 'id_paquete', 'cantidad',"precio"], [
            [2,1, 1, 270],            
            [4,1, 2, 240],
            [6,1, 1, 190],
            [7,1, 1, 80],
            [9,2, 1, 70],
            [10,2, 1, 55],
            [11,3, 1, 80],
            [12,3, 1, 75],
            [1,4, 1, 230],
            [4,4, 4, 120],
            [6,4, 1, 190],
            [7,4, 1, 80],
            [9,4, 1, 70],

        ]);
    }



    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete("articulo_Paquete");
        $this->dropTable("articulo_Paquete");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180318_133539_articulo_Paquete cannot be reverted.\n";

        return false;
    }
    */
}
