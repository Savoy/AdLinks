<?php
namespace application\controllers;

use Yii;
use application\components\Controller;
use application\models\Redirect;

class RedirectsController extends Controller
{
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

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
        $model = new Redirect();
        if (isset($_REQUEST['application_models_Redirect'])) {
            $model->attributes = $_REQUEST['application_models_Redirect'];
        }

        $this->render('index',array(
            'model' => $model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Redirect the loaded model
	 * @throws \CHttpException
	 */
	public function loadModel($id)
	{
		$model=Redirect::model()->findByPk($id);
		if ($model===null) {
            throw new \CHttpException(404,'Запрашиваемая Вами страница не найдена.');
		}
		return $model;
	}
}