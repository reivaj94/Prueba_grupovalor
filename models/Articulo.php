<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "articulo".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $tipo
 * @property string $precio
 *
 * @property ArticuloPaquete[] $articuloPaquetes
 * @property Paquete[] $paquetes
 * @property CotizacionArticulo[] $cotizacionArticulos
 * @property Cotizacion[] $cotizacions
 */
class Articulo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'articulo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'tipo', 'precio'], 'required'],
            [['precio'], 'number'],
            [['descripcion'], 'string', 'max' => 60],
            [['tipo'], 'string', 'max' => 30],
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
            'tipo' => 'Tipo',
            'precio' => 'Precio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticuloPaquetes()
    {
        return $this->hasMany(ArticuloPaquete::className(), ['id_articulo' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaquetes()
    {
        return $this->hasMany(Paquete::className(), ['id' => 'id_paquete'])->viaTable('articulo_paquete', ['id_articulo' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCotizacionArticulos()
    {
        return $this->hasMany(CotizacionArticulo::className(), ['id_articulo' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCotizacions()
    {
        return $this->hasMany(Cotizacion::className(), ['id' => 'id_cotizacion'])->viaTable('cotizacion_articulo', ['id_articulo' => 'id']);
    }
}
