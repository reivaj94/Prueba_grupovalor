<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cotizacion".
 *
 * @property string $id
 * @property string $nombreCliente
 * @property string $nombreVendedor
 * @property string $ruc
 * @property string $total
 * @property string $impuesto
 *
 * @property CotizacionArticulo[] $cotizacionArticulos
 * @property Articulo[] $articulos
 * @property CotizacionPaquete[] $cotizacionPaquetes
 * @property Paquete[] $paquetes
 */
class Cotizacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cotizacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombreCliente', 'nombreVendedor', 'ruc', 'total'], 'required'],
            [['total', 'impuesto'], 'number'],
            [['nombreCliente', 'nombreVendedor'], 'string', 'max' => 60],
            [['ruc'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombreCliente' => 'Nombre Cliente',
            'nombreVendedor' => 'Nombre Vendedor',
            'ruc' => 'Ruc',
            'total' => 'Total',
            'impuesto' => 'Impuesto %',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCotizacionArticulos()
    {
        return $this->hasMany(CotizacionArticulo::className(), ['id_cotizacion' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticulos()
    {
        return $this->hasMany(Articulo::className(), ['id' => 'id_articulo'])->viaTable('cotizacion_articulo', ['id_cotizacion' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCotizacionPaquetes()
    {
        return $this->hasMany(CotizacionPaquete::className(), ['id_cotizacion' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaquetes()
    {
        return $this->hasMany(Paquete::className(), ['id' => 'id_paquete'])->viaTable('cotizacion_paquete', ['id_cotizacion' => 'id']);
    }
}
