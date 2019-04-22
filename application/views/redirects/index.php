<?php
/* @var $this application\controllers\RedirectsController */
/* @var $model application\models\Redirect */

$this->breadcrumbs=array(
	'Переходы',
);
?>

<div class="links-index">
    <h1>Переходы</h1>

    <div class="table-responsive">
        <?php $this->widget('\TbGridView',array(
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'type' => [\TbHtml::GRID_TYPE_BORDERED, \TbHtml::GRID_TYPE_STRIPED],
            'columns' => [
                ['name' => 'link_id', 'value' => function ($model) {
                    return $this->createAbsoluteUrl('site/open', ['code' => $model->link->code]);
                }],
                ['name' => 'ip_long', 'value' => '$data->ip'],
                'user_agent',
                'utm_source',
                'utm_medium',
                'utm_campaign',
                'utm_content',
                'utm_term',
                ['name' => 'created_at', 'filter' => false],
            ],
        )); ?>
    </div>
</div>
