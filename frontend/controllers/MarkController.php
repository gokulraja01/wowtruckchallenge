<?php

namespace frontend\controllers;

use Yii;
use app\models\Marks;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * MarkController implements the CRUD actions for Mark model.
 */
class MarkController extends Controller
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
                    'delete' => ['GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all Mark models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
			return $this->redirect('site/login');
		}
		$model = Marks::find()->all();
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Mark model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
			return $this->redirect('site/login');
		}
		return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Mark model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
			return $this->redirect('site/login');
		}
		$model = new Marks();
		$model->scenario = 'create';
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			$postdata = Yii::$app->request->post();
			Yii::$app->db->createCommand()->insert('marks', [
				'student_id' => $postdata['Marks']['student_id'],
				'mark' => json_encode($postdata['Marks']['mark']),
			])->execute();
			Yii::$app->session->setFlash('success', 'Mark Entered Successfully');				
			return $this->redirect(['index']);                                
        } else {					
            return $this->render('create', [
                'model' => $model,				
            ]);
        }
    }

    /**
     * Updates an existing Mark model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
			return $this->redirect('site/login');
		}
				
		$model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $postdata = Yii::$app->request->post();
				$model->mark = json_encode($postdata['mark']);
				$model->update();
				Yii::$app->session->setFlash('success', 'Mark Updated Successfully');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Mark model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
			return $this->redirect('site/login');
		}
		$this->findModel($id)->delete();
		Yii::$app->session->setFlash('success', 'Mark Deleted Successfully');

        return $this->redirect(['index']);
    }

    /**
     * Finds the Mark model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mark the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Marks::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
