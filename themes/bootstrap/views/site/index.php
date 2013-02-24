<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
    'heading'=>'Welcome to '.CHtml::encode(Yii::app()->name),
)); ?>

<p>Congratulations! You've accessed to best website in the world.</p>

<?php
    if (Yii::app()->user->isGuest)
        echo CHtml::link("Register Now For Free", array("/site/register"), array("class"=>"btn btn-large btn-success"));
?>

<?php $this->endWidget(); ?>


<a class="a hasBackground"/>

<script>

    $(document).ready(function(){
        console.log($(".a").attr("class"));
    });
</script>

    <style>

    </style>
