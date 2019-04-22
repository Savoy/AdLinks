<?php
/* @var $this application\controllers\LinksController */
/* @var $model application\models\Link */

$this->breadcrumbs=array(
	'Ссылки'=>array('index'),
	'Редактирование ссылки #'.$model->id,
);
?>

<div class="links-index">
    <h1>Редактирование служебной ссылки #<?php echo $model->id; ?></h1>

    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
