<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use app\models\Articulo;
use app\models\Paquete;

/* @var $this yii\web\View */
/* @var $model app\models\Cotizacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cotizacion-form">

    <?php $form = ActiveForm::begin(['id'=>'dynamic-form-cotizacion']); ?>

    <?= $form->field($model, 'nombreCliente')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombreVendedor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ruc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'impuesto')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="col-sm-6">
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper_Articulo', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items-Articulo', // required: css class selector
                'widgetItem' => '.item-Articulo', // required: css class
                'limit' => 999, // the maximum times, an element can be added (default 999)
                'min' => 0, // 0 or 1 (default 1)
                'insertButton' => '.add-item-Articulo', // css class
                'deleteButton' => '.remove-item-Articulo', // css class
                'model' => $modelsCotizacionArticulo[0],
                'formId' => 'dynamic-form-cotizacion',
                'formFields' => [
                    'id_articulo',
                    'cantidad'
                ],
            ]); ?>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>
                        <i class="glyphicon glyphicon-envelope"></i> Articulo
                        <button type="button" class="add-item-Articulo btn btn-success btn-sm pull-right"><i class="glyphicon glyphicon-plus"></i> Añadir</button>
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="container-items-Articulo"><!-- widgetBody -->
                    <?php foreach ($modelsCotizacionArticulo as $i => $auxCotizacionArticulo): ?>
                        <div class="item-Articulo panel panel-default"><!-- widgetItem -->
                            <div class="panel-heading">
                                <h3 class="panel-title pull-left">Articulo</h3>
                                <div class="pull-right">
                                    <button type="button" class="remove-item-Articulo btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <?= $form->field($auxCotizacionArticulo, "[{$i}]id_articulo")->dropDownList(ArrayHelper::map(Articulo::find()->all(),'id','descripcion'),
                                            ['prompt'=>'Seleccionar Articulo']) 
                                        ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <?= $form->field($auxCotizacionArticulo, "[{$i}]cantidad")->textInput(['maxlength' => true]) ?>
                                    </div>
                                </div><!-- .row -->
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </div>
                </div>
            </div><!-- .panel -->
            <?php DynamicFormWidget::end(); ?>
        </div>

        <div class="col-sm-6">
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper_Paquete', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items-Paquete', // required: css class selector
                'widgetItem' => '.item-Paquete', // required: css class
                'limit' => 999, // the maximum times, an element can be added (default 999)
                'min' => 0, // 0 or 1 (default 1)
                'insertButton' => '.add-item-Paquete', // css class
                'deleteButton' => '.remove-item-Paquete', // css class
                'model' => $modelsCotizacionPaquete[0],
                'formId' => 'dynamic-form-cotizacion',
                'formFields' => [
                    'id_paquete',
                    'cantidad'
                ],
            ]); ?>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>
                        <i class="glyphicon glyphicon-envelope"></i> Paquetes
                        <button type="button" class="add-item-Paquete btn btn-success btn-sm pull-right"><i class="glyphicon glyphicon-plus"></i> Añadir</button>
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="container-items-Paquete"><!-- widgetBody -->
                    <?php foreach ($modelsCotizacionPaquete as $i => $auxCotizacionPaquete): ?>
                        <div class="item-Paquete panel panel-default"><!-- widgetItem -->
                            <div class="panel-heading">
                                <h3 class="panel-title pull-left">Paquete</h3>
                                <div class="pull-right">
                                    <button type="button" class="remove-item-Paquete btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <div class="col-sm-6">
                                    <?= $form->field($auxCotizacionPaquete, "[{$i}]id_paquete")->dropDownList(ArrayHelper::map(Paquete::find()->all(),'id','descripcion'),
                                        ['prompt'=>'Seleccionar Paquete']) 
                                    ?>
                                </div>
                                <div class="col-sm-6">
                                    <?= $form->field($auxCotizacionPaquete, "[{$i}]cantidad")->textInput(['maxlength' => true]) ?>
                                </div>
                                
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </div>
                </div>
            </div><!-- .panel -->
            <?php DynamicFormWidget::end(); ?>
        </div> 
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php 
$form_script = <<< JS

        $(document).ready(function () {
            $(".dynamicform_wrapper_Articulo").on("beforeInsert", function(e, item) {
                console.log("beforeInsert");
            });

            $(".dynamicform_wrapper_Articulo").on("afterInsert", function(e, item) {
                console.log("afterInsert");
            });

            $(".dynamicform_wrapper_Articulo").on("beforeDelete", function(e, item) {
                if (! confirm("¿Está seguro que desea eliminar este item?")) {
                    return false;
                }
                return true;
            });

            $(".dynamicform_wrapper_Articulo").on("afterDelete", function(e) {
                console.log("Item eliminado.");
            });

            $(".dynamicform_wrapper_Articulo").on("limitReached", function(e, item) {
                alert("Límite de items alcanzado.");
            });

            $(".dynamicform_wrapper_Paquete").on("beforeInsert", function(e, item) {
                console.log("beforeInsert");
            });

            $(".dynamicform_wrapper_Paquete").on("afterInsert", function(e, item) {
                console.log("afterInsert");
            });

            $(".dynamicform_wrapper_Paquete").on("beforeDelete", function(e, item) {
                if (! confirm("¿Está seguro que desea eliminar este item?")) {
                    return false;
                }
                return true;
            });

            $(".dynamicform_wrapper_Paquete").on("afterDelete", function(e) {
                console.log("Item eliminado.");
            });

            $(".dynamicform_wrapper_Paquete").on("limitReached", function(e, item) {
                alert("Límite de items alcanzado.");
            });
        })
JS;
$this->registerJs($form_script);
?>