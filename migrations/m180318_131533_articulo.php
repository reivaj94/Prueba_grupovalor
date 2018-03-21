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
         $this->batchInsert('articulo', ['descripcion', 'tipo', 'precio'], [
            ['Case1', 'Hardware', '230'],
            ['Case2', 'Hardware', '270'],
            ['RAM-2G', 'Hardware', '120'],
            ['RAM-4G', 'Hardware', '120'],
            ['SSD-512G', 'Hardware', '120'],
            ['Motherboard-Intel445', 'Hardware', '190'],
            ['HDD-1T', 'Hardware', '80'],
            ['Case3', 'Hardware', '90'],
            ['Windows7', 'Software', '70'],
            ['Microsoft Office - 2016', 'Software', '55'],
            ['Adobe Photoshop CC', 'Software', '80'],
            ['Corel Draw', 'Software', '75'],
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
