<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form TbActiveForm */

$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
    'Contact',
);
?>

<h1>Enter Your Settings</h1>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'alerts'=>array('contact'),
    )); ?>

<?php else: ?>

<p>
    If you want to automatic send today's report mail. Please fill these form bellow
</p>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'contact-form',
    'type'=>'horizontal',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
    <?php echo $form->textFieldRow($model,'name'); ?>
    <?php echo $form->textFieldRow($model,'time'); ?>
    <?php echo $form->textFieldRow($model,'from_name'); ?>
    <?php echo $form->textFieldRow($model,'from_mail'); ?>
    <?php echo $form->textFieldRow($model,'to_email'); ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton',array(
        'buttonType'=>'submit',
        'type'=>'primary',
        'label'=>'Submit',
    )); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>