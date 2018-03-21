<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Cotizacion */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cotizacions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cotizacion-view">

    <h1><?= Html::encode($this->title) ?></h1>

   

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombreCliente',
            'nombreVendedor',
            'ruc',
            'total',
            'impuesto',
        ],
    ]) ?>

    <h3>Articulos</h3>

    <div class="grid-view">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Descripción</th>
                    <th>Tipo</th>
                    <th>Precio $</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $index = 0;
                    foreach ($model->cotizacionArticulos as $value) {
                ?>
                    <tr>
                        <td>
                            <?= $index + 1 ?>
                        </td>
                        <td>
                            <?= $value->articulo->descripcion ?>
                        </td>
                        <td>
                            <?= $value->articulo->tipo ?>
                        </td>
                        <td>
                            <?= $value->total ?>
                        </td>
                        <td>
                            <?= $value->cantidad ?>
                        </td>
                    </tr>
                <?php
                        $index++;
                    }
                ?>
            </tbody>        
        </table>
    </div>

    <h3>Paquetes</h3>

    <div class="grid-view">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Descripción</th>
                    <th>Descuento</th>
                    <th>Total $</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $index = 0;
                    foreach ($model->cotizacionPaquetes as $value) {
                ?>
                    <tr>
                        <td>
                            <?= $index + 1 ?>
                        </td>
                        <td>
                            <?= $value->paquete->descripcion ?>
                        </td>
                        <td>
                            <?= $value->paquete->descuento ?>
                        </td>
                        <td>
                            <?= $value->total ?>
                        </td>
                    </tr>
                <?php
                        $index++;
                    }
                ?>
            </tbody>        
        </table>
    </div>

</div>
