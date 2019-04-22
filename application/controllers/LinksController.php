<?php
namespace application\controllers;

use Yii;
use application\components\Controller;
use application\models\Link;

class LinksController extends Controller
{
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Link;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['application_models_Link'])) {
			$model->attributes=$_POST['application_models_Link'];
			if ($model->save()) {
			    Yii::app()->user->setFlash('success', 'Новая ссылка успешно добавлена.');

				$this->redirect(array('index'));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['application_models_Link'])) {
			$model->attributes=$_POST['application_models_Link'];
			if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Измменения успешно сохранены.');

				$this->redirect(array('index'));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$model = $this->loadModel($id);
			$model->status = Link::STATUS_DELETED;
			$model->save();

			if (!isset($_GET['ajax'])) {
                $this->redirect(['index']);
			}
		} else {
			throw new \CHttpException(400,'Неверный запрос.');
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		//$dataProvider=new \CActiveDataProvider('application\models\Link');
        $model = new Link();
        if (isset($_REQUEST['application_models_Link'])) {
            $model->attributes = $_REQUEST['application_models_Link'];
        }

		$this->render('index',array(
			//'dataProvider'=>$dataProvider,
            'model' => $model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Link the loaded model
	 * @throws \CHttpException
	 */
	public function loadModel($id)
	{
		$model=Link::model()->findByPk($id);
		if ($model===null) {
            throw new \CHttpException(404,'Запрашиваемая Вами страница не найдена.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Link $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='link-form') {
			echo \CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}