<?php
/* @var $this application\controllers\LinksController */
/* @var $model application\models\Link */

$this->breadcrumbs=array(
	'Ссылки',
);
?>

<div class="links-index">
    <h1>Ссылки для редиректа</h1>

    <div class="form-group">
        <?= \TbHtml::linkButton('Добавить', [
            'color' => \TbHtml::BUTTON_COLOR_PRIMARY,
            'url' => ['links/create']
        ]); ?>
    </div>

    <div class="table-responsive">
        <?php $this->widget('\TbGridView',array(
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'type' => [\TbHtml::GRID_TYPE_BORDERED, \TbHtml::GRID_TYPE_STRIPED],
            'columns' => [
                ['name' => 'code', 'value' => function($model) {
                    $url = $this->createAbsoluteUrl('site/open', ['code' => $model->code] + $model->utmValues);
                    return \TbHtml::link($url, $url);
                }, 'type' => 'html'],
                ['name' => 'link', 'value' => function($model) {
                    return \TbHtml::link($model->link, $model->link);
                }, 'type' => 'html'],
                ['name' => 'status', 'value' => '$data->statusText', 'filter' => $model->statuses],
                ['name' => 'redirectsCount', 'header' => 'Переходы', 'filter' => false],
                ['name' => 'created_at', 'filter' => false],
                ['name' => 'updated_at', 'filter' => false],
                ['class'=>'\TbButtonColumn', 'buttons' => [
                    'view' => [
                   		'label' => 'Переходы',
                        'url' => function($model) { return $this->createUrl('redirects/index', ['application_models_Redirect[link_id]' => $model->code]); }
                    ],
                ], 'htmlOptions' => ['class' => 'text-center']],
            ],
        )); ?>
    </div>
</div>
