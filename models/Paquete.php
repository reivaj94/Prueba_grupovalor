<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "paquete".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $descuento
 * @property string $total
 *
 * @property ArticuloPaquete[] $articuloPaquetes
 * @property Articulo[] $articulos
 * @property CotizacionPaquete[] $cotizacionPaquetes
 * @property Cotizacion[] $cotizacions
 */
class Paquete extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'paquete';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'descuento','total'], 'required'],
            [['descuento', 'total'], 'number'],
            [['descripcion'], 'string', 'max' => 60],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
            'descuento' => 'Descuento %',
            'total' => 'Total bs'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticuloPaquetes()
    {
        return $this->hasMany(ArticuloPaquete::className(), ['id_paquete' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticulos()
    {
        return $this->hasMany(Articulo::className(), ['id' => 'id_articulo'])->viaTable('articulo_paquete', ['id_paquete' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCotizacionPaquetes()
    {
        return $this->hasMany(CotizacionPaquete::className(), ['id_paquete' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCotizacions()
    {
        return $this->hasMany(Cotizacion::className(), ['id' => 'id_cotizacion'])->viaTable('cotizacion_paquete', ['id_paquete' => 'id']);
    }
}
