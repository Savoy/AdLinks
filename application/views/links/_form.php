<?php
/* @var $this application\controllers\LinksController */
/* @var $model application\models\Link */
/* @var $form \TbActiveForm */
?>

<div class="form">
    <?php $form=$this->beginWidget('\TbActiveForm', array(
        'id'=>'link-form',
        'enableClientValidation'=>true,
        'enableAjaxValidation'=>false,
    )); ?>

    <p class="help-block">Поля помеченные <span class="required">*</span> обязательны для заполнения.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'link',array('rows'=>6,'span'=>8)); ?>

    <?php echo $form->textFieldControlGroup($model,'utm_source',array('span'=>5,'maxlength'=>255)); ?>

    <?php echo $form->textFieldControlGroup($model,'utm_medium',array('span'=>5,'maxlength'=>255)); ?>

    <?php echo $form->textFieldControlGroup($model,'utm_campaign',array('span'=>5,'maxlength'=>255)); ?>

    <?php echo $form->textFieldControlGroup($model,'utm_content',array('span'=>5,'maxlength'=>255)); ?>

    <?php echo $form->textFieldControlGroup($model,'utm_term',array('span'=>5,'maxlength'=>255)); ?>

    <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', array(
            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
            'size'=>TbHtml::BUTTON_SIZE_LARGE,
        )); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->
