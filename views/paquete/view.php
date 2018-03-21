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

   

</div>
