<?php
/**
 * @var $this MailController
 * @var $cs CClientScript
 */

$cs = Yii::app()->clientScript;
$cs->registerCssFile(Yii::app()->theme->baseUrl. "/css/wysihtml5.css", "screen");
echo '<script type="text/javascript" src="'.Yii::app()->theme->baseUrl.'/js/wysihtml5-0.3.0_rc2.min.js"></script>';
echo '<script type="text/javascript" src="'.Yii::app()->theme->baseUrl.'/js/wysihtml5.js"></script>';

$this->breadcrumbs=array(
	'Mail',
);
?>

<h1>Write your form !!</h1>



<div class="row">
    <div class="span8">
        <?php
            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id' => 'verticalForm',
                'htmlOptions' => array('class' => 'well'),
            ));
            echo $form->textAreaRow($model, 'content', array("id"=>"form-input","style"=>"width: 100%", 'rows'=>32));

            $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Submit'));
        ?>
    </div>
</div>


<?php $this->endWidget(); ?>

<script>
    $(document).ready(function(){
        $('#form-input').wysihtml5();
    });
</script>