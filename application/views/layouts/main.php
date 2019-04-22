<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<!-- Bootstrap -->
	<?php Yii::app()->bootstrap->register(); ?>

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<div class="wrap">
	<?php $this->widget('\TbNavbar', [
		'color' => 'inverse',
		'collapse' => true,
		'items' => [
			[
				'class' => '\TbNav',
				'items' => [
					['label' => 'Главная', 'url' => ['site/index']],
					['label' => 'Ссылки', 'url' => ['links/index']],
					['label' => 'Статистика', 'url' => ['statistics/index']],
				]
			]
		]
	]); ?>

	<div class="container">
		<?= $content; ?>
	</div>
</div>
<footer class="footer">
	<div class="container">
		<p class="pull-left">&copy; <?= \Yii::app()->name; ?> <?= date('Y') ?></p>

		<p class="pull-right"><?= \Yii::powered() ?></p>
	</div>
</footer>
</body>
</html>