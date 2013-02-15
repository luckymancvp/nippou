<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form TbActiveForm */

$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
    'Contact',
);
?>

<h1>Register with Us</h1>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'alerts'=>array('contact'),
    )); ?>

<?php else: ?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'contact-form',
    'type'=>'horizontal',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

    <?php
    $this->widget('zii.widgets.CDetailView', array(
        'data'=>$model,
    ));
    ?>

    <div class="form-actions">
        <?php
            echo CHtml::link("Change Settings", array("/me/change"), array("class"=>"btn btn-danger"));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>