<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cotizacion_paquete".
 *
 * @property string $id_cotizacion
 * @property string $id_paquete
 * @property int $cantidad
 * @property string $total
 *
 * @property Cotizacion $cotizacion
 * @property Paquete $paquete
 */
class CotizacionPaquete extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cotizacion_paquete';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_cotizacion', 'id_paquete'], 'required'],
            [['id_cotizacion', 'id_paquete', 'cantidad'], 'integer'],
            [['total'], 'number'],
            [['id_cotizacion', 'id_paquete'], 'unique', 'targetAttribute' => ['id_cotizacion', 'id_paquete']],
            [['id_cotizacion'], 'exist', 'skipOnError' => true, 'targetClass' => Cotizacion::className(), 'targetAttribute' => ['id_cotizacion' => 'id']],
            [['id_paquete'], 'exist', 'skipOnError' => true, 'targetClass' => Paquete::className(), 'targetAttribute' => ['id_paquete' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_cotizacion' => 'Id Cotizacion',
            'id_paquete' => 'Id Paquete',
            'cantidad' => 'Cantidad',
            'total' => 'Total',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCotizacion()
    {
        return $this->hasOne(Cotizacion::className(), ['id' => 'id_cotizacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaquete()
    {
        return $this->hasOne(Paquete::className(), ['id' => 'id_paquete']);
    }
}
