<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
    'heading'=>"You have already sent today's report ",
)); ?>

<p>Do you want to send another report ?</p>
<form method="post">
<?php
    echo CHtml::submitButton("Yes", array("name"=>"resent", "class"=>"btn btn-danger"));
    echo "&nbsp";
    echo CHtml::submitButton("No", array("name"=>"resent", "class"=>"btn btn-success btn-large disabled"));
?>
</form>

<?php $this->endWidget(); ?>