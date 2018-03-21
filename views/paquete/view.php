<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Paquete */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Paquetes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paquete-view">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'descripcion',
            'descuento',
            'total',
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
                    foreach ($model->articuloPaquetes as $value) {
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
                            <?= $value->articulo->precio ?>
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
   

</div>
