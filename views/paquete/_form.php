<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use app\models\Articulo;
/* @var $this yii\web\View */
/* @var $model app\models\Paquete */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="paquete-form">                  
                                           
    <?php $form = ActiveForm::begin(['id'=>'dynamic-form-paquete']); ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descuento')->textInput(['maxlength' => true]) ?>

    
 <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Añadir Articulo</h4></div>
        <div class="panel-body">
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 999, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelArticuloPaquete[0],
                'formId' => 'dynamic-form-paquete',
                'formFields' => [
                    'id_articulo',
                    'cantidad',                    
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelArticuloPaquete as $i => $auxArticuloPaquete): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Articulo</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body"> 
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($auxArticuloPaquete, "[{$i}]id_articulo")->dropDownList(ArrayHelper::map(Articulo::find()->all(),'id','descripcion'),
                                	['prompt'=>'Seleccionar Articulo']) 
                                ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($auxArticuloPaquete, "[{$i}]cantidad")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div><!-- .row -->
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

  
<?php 
$form_script = <<< JS
    
        $(document).ready(function () {
            $(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
                console.log("beforeInsert");
            });

            $(".dynamicform_wrapper").on("afterInsert", function(e, item) {
                console.log("afterInsert");
            });

            $(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
                if (! confirm("¿Está seguro que desea eliminar este item?")) {
                    return false;
                }
                return true;
            });

            $(".dynamicform_wrapper").on("afterDelete", function(e) {
                console.log("Item eliminado.");
            });

            $(".dynamicform_wrapper").on("limitReached", function(e, item) {
                alert("Límite de items alcanzado.");
            });
        })
JS;
$this->registerJs($form_script);
?> 