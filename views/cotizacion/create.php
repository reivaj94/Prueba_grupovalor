<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Cotizacion */

$this->title = Yii::t('app', 'Create Cotizacion');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cotizacions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cotizacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsCotizacionArticulo' => (empty($modelsCotizacionArticulo)) ? [new CotizacionArticulo] : $modelsCotizacionArticulo,
        'modelsCotizacionPaquete' => (empty($modelsCotizacionPaquete)) ? [new CotizacionPaquete] : $modelsCotizacionPaquete,
    ]) ?>

</div>
