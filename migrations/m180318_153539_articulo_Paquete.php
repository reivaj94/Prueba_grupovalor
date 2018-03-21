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
