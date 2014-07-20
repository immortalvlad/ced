<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>['data-ajax'=>'false'],
)); ?>

<div data-role="fieldcontain">
    <?= $form->error($model,'email'); ?>
	<?= $form->labelEx($model,'email'); ?>
	<?= $form->textField($model,'email'); ?>
</div>
<div data-role="fieldcontain">
    <?= $form->error($model,'password'); ?>
	<?= $form->labelEx($model,'password'); ?>
	<?= $form->textField($model,'password'); ?>
</div>
<?= CHtml::submitButton('Bejelentkezés'); ?>

<?php $this->endWidget(); ?>

</div><!-- form -->

<div class="c">
<?php
echo CHtml::link('Elfelejtett jelszó', ['account/password']);
echo CHtml::link('Regisztráció', ['account/signup'], ['data-role'=>'button', 'data-inline'=>'true', 'data-theme'=>'e']);
?>
</div>
