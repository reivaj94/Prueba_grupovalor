<?php

namespace app\controllers;

use Yii;
use app\models\Paquete;
use app\models\Articulo;
use app\models\Model;
use app\models\PaqueteSearch;
use app\models\ArticuloPaquete;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaqueteController implements the CRUD actions for Paquete model.
 */
class PaqueteController extends Controller
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
     * Lists all Paquete models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PaqueteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Paquete model.
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
     * Creates a new Paquete model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Paquete();
        $modelArticuloPaquete = [new ArticuloPaquete];

        if ($model->load(Yii::$app->request->post())) {
            $modelArticuloPaquete = Model::createMultiple(ArticuloPaquete::classname());
            Model::loadMultiple($modelArticuloPaquete, Yii::$app->request->post());

            $transaction = \Yii::$app->db->beginTransaction();
            try {
                if ($flag = $model->save(false)) {
                    $total = 0;
                    foreach ($modelArticuloPaquete as $aux_articuloPaq) {
                        $articulo = Articulo::findOne($aux_articuloPaq->id_articulo);
                        $total += $articulo->precio * $aux_articuloPaq->cantidad;
                        $aux_articuloPaq->id_paquete = $model->id;
                        $aux_articuloPaq->precio = $articulo->precio;
                        if (! ($flag = $aux_articuloPaq->save(false))) {
                            $transaction->rollBack();
                            break;
                        }
                    }
                }
                if ($flag) {
                    $model->total = $total - ($total * $model->descuento / 100);
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
            'modelArticuloPaquete' => (empty($modelArticuloPaquete)) ? [new ArticuloPaquete] : $modelArticuloPaquete
        ]);
    }

    /**
     * Updates an existing Paquete model.
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
     * Deletes an existing Paquete model.
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
     * Finds the Paquete model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Paquete the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Paquete::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
