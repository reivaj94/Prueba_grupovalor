<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cotizacion_articulo".
 *
 * @property string $id_cotizacion
 * @property string $id_articulo
 * @property int $cantidad
 * @property string $total
 *
 * @property Articulo $articulo
 * @property Cotizacion $cotizacion
 */
class CotizacionArticulo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cotizacion_articulo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_cotizacion', 'id_articulo'], 'required'],
            [['id_cotizacion', 'id_articulo', 'cantidad'], 'integer'],
            [['total'], 'number'],
            [['id_cotizacion', 'id_articulo'], 'unique', 'targetAttribute' => ['id_cotizacion', 'id_articulo']],
            [['id_articulo'], 'exist', 'skipOnError' => true, 'targetClass' => Articulo::className(), 'targetAttribute' => ['id_articulo' => 'id']],
            [['id_cotizacion'], 'exist', 'skipOnError' => true, 'targetClass' => Cotizacion::className(), 'targetAttribute' => ['id_cotizacion' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_cotizacion' => 'Id Cotizacion',
            'id_articulo' => 'Id Articulo',
            'cantidad' => 'Cantidad',
            'total' => 'Total',
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
    public function getCotizacion()
    {
        return $this->hasOne(Cotizacion::className(), ['id' => 'id_cotizacion']);
    }
}
