<?php

namespace app\controllers;

use Yii;
use app\models\Cotizacion;
use app\models\CotizacionSearch;
use app\models\CotizacionArticulo;
use app\models\CotizacionPaquete;
use app\models\Model;
use app\models\Articulo;
use app\models\Paquete;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CotizacionController implements the CRUD actions for Cotizacion model.
 */
class CotizacionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Cotizacion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CotizacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cotizacion model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Cotizacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cotizacion();
        $modelsCotizacionArticulo = [new CotizacionArticulo];
        $modelsCotizacionPaquete = [new CotizacionPaquete];
        if ($model->load(Yii::$app->request->post())) {
            $modelsCotizacionArticulo = Model::createMultiple(CotizacionArticulo::classname());
            Model::loadMultiple($modelsCotizacionArticulo, Yii::$app->request->post());
            $modelsCotizacionPaquete = Model::createMultiple(CotizacionPaquete::classname());
            Model::loadMultiple($modelsCotizacionPaquete, Yii::$app->request->post());
            $transaction = \Yii::$app->db->beginTransaction();
            try {

                if ($flag = $model->save(false)) {
                    $totalArticulo = 0;
                    foreach ($modelsCotizacionArticulo as $auxCotizacionArticulo) {
                        $articulo = Articulo::findOne($auxCotizacionArticulo->id_articulo);
                        if($articulo){
                            $totalArticulo += $articulo->precio * $auxCotizacionArticulo->cantidad;
                            $auxCotizacionArticulo->id_cotizacion = $model->id;
                            $auxCotizacionArticulo->total = $articulo->precio;
                            if (! ($flag = $auxCotizacionArticulo->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    $totalPaquete = 0;
                    foreach ($modelsCotizacionPaquete as $auxCotizacionPaquete) {
                        $paquete = Paquete::findOne($auxCotizacionPaquete->id_paquete);
                        if($paquete){
                            $totalPaquete += $paquete->total* $auxCotizacionPaquete->cantidad;;
                            $auxCotizacionPaquete->id_cotizacion = $model->id;
                            $auxCotizacionPaquete->total = $paquete->total;
                            if (! ($flag = $auxCotizacionPaquete->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                }
                if ($flag) {
                    $total = $totalArticulo + $totalPaquete;
                    $model->total = $total + ($total * $model->impuesto / 100);
                    $model->save(false);
                    $transaction->commit();
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } catch (Exception $e) {
                $transaction->rollBack();
            }          
        }
        return $this->render('create', [
            'model' => $model,
            'modelsCotizacionArticulo' => (empty($modelsCotizacionArticulo)) ? [new CotizacionArticulo] : $modelsCotizacionArticulo,
            'modelsCotizacionPaquete' => (empty($modelsCotizacionPaquete)) ? [new CotizacionPaquete] : $modelsCotizacionPaquete,
        ]);
            
    }

    /**
     * Updates an existing Cotizacion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Cotizacion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cotizacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Cotizacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cotizacion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
