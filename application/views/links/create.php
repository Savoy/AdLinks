<?php
/* @var $this application\controllers\LinksController */
/* @var $model application\models\Link */

$this->breadcrumbs=array(
	'Ссылки'=>array('index'),
	'Новая ссылка',
);
?>

<div class="links-index">
    <h1>Новая ссылка</h1>

    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
