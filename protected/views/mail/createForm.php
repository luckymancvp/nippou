<?php
/* @var $this MailController */

$this->breadcrumbs=array(
	'Mail',
);
?>

<h1>Write your form !!</h1>



<div class="row">
    <div class="span6">
        <?php
            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id' => 'verticalForm',
                'htmlOptions' => array('class' => 'well'),
            ));
            echo $form->textAreaRow($model, 'content', array("style"=>"width: 100%", 'rows'=>32));

            $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Submit'));
        ?>
    </div>
</div>


<?php $this->endWidget(); ?>