<?php

namespace app\controllers;

use Yii;
use app\models\AuthItemChild;
use app\models\AuthitemchildSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * AuthitemchildController implements the CRUD actions for AuthItemChild model.
 */
class AuthitemchildController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all AuthItemChild models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuthitemchildSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $query = AuthItemChild::find();
        $query->select('*');
        $query->from('auth_item_child');

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $roles = $query->orderBy('parent')
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();


        return $this->render('index', [
            'searchModel'       => $searchModel,
            'dataProvider'      => $dataProvider,
            'pagination'        => $pagination,
            'roles'             => $roles,
        ]);
    }

    /**
     * Displays a single AuthItemChild model.
     * @param string $parent
     * @param string $child
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($parent, $child)
    {

        $roles = Yii::$app->db->createCommand("SELECT * FROM auth_item_child WHERE parent='$parent' AND child='$child'")->queryAll();

        return $this->render('view', [
            'model'         => $this->findModel($parent, $child),
            'roles'         => $roles,
        ]);
    }

    /**
     * Creates a new AuthItemChild model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthItemChild();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'parent' => $model->parent, 'child' => $model->child]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AuthItemChild model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $parent
     * @param string $child
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($parent, $child)
    {
        $model = $this->findModel($parent, $child);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'parent' => $model->parent, 'child' => $model->child]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AuthItemChild model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $parent
     * @param string $child
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($parent, $child)
    {
        $this->findModel($parent, $child)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AuthItemChild model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $parent
     * @param string $child
     * @return AuthItemChild the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($parent, $child)
    {
        if (($model = AuthItemChild::findOne(['parent' => $parent, 'child' => $child])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
