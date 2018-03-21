<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "articulo_paquete".
 *
 * @property string $id_articulo
 * @property string $id_paquete
 * @property int $cantidad
 * @property string $precio
 *
 * @property Articulo $articulo
 * @property Paquete $paquete
 */
class ArticuloPaquete extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'articulo_paquete';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_articulo', 'id_paquete', 'cantidad', 'precio'], 'required'],
            [['id_articulo', 'id_paquete', 'cantidad'], 'integer'],
            [['precio'], 'number'],
            [['id_articulo', 'id_paquete'], 'unique', 'targetAttribute' => ['id_articulo', 'id_paquete']],
            [['id_articulo'], 'exist', 'skipOnError' => true, 'targetClass' => Articulo::className(), 'targetAttribute' => ['id_articulo' => 'id']],
            [['id_paquete'], 'exist', 'skipOnError' => true, 'targetClass' => Paquete::className(), 'targetAttribute' => ['id_paquete' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_articulo' => 'Id Articulo',
            'id_paquete' => 'Id Paquete',
            'cantidad' => 'Cantidad',
            'precio' => 'Precio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticulo()
    {
        return $this->hasOne(Articulo::className(), ['id' => 'id_articulo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaquete()
    {
        return $this->hasOne(Paquete::className(), ['id' => 'id_paquete']);
    }
}
