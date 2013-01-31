<?php
/* @var $this MailController */

    $this->breadcrumbs=array(
        'Mail',
    );

    $cs = Yii::app()->clientScript;
    $cs->registerCoreScript( 'jquery.ui' );
    $cs->registerCssFile(Yii::app()->baseUrl . '/css/jquery.ui.timepicker.css','screen');
    $cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.ui.timepicker.js');
    $cs->registerCssFile(
        Yii::app()->assetManager->publish(
            Yii::app()->basePath . '/vendors/jquery.ui/redmond/'
        ).
            '/jquery-ui-1.8.18.custom.css', 'screen'
    );
?>



<h1>Send Mail Today !!</h1>
<div class="row">
    <div class="span6 well" id="content-form" style="min-height: 780px;">
        <?php
            echo $contentForm."";
        ?>
    </div>

    <div class="span4">
        <form method="post" id="params" class="form-vertical">
            <div class="input-prepend">
                <span class="add-on"><i class="icon-time"></i></span>
                <input type="text" name="params[time]" id="time" style="width: 150px;">
            </div>
            <br>
        </form>
    </div>

    <div class="span2">
        <div class="btn-group">
            <button class="btn btn-danger" id="params-submit">Submit</button>
            <button class="btn dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li>
                    <a href="#myModal" data-toggle="modal" id="review-button">Review</a>
                </li>
            </ul>
        </div>
    </div>

</div>

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Mail Content Review</h3>
    </div>
    <div class="modal-body" id="review-content">
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
</div>

<script>

    function genParamForm(param){
        html = '<label><code>{'+param+'}</code></label>';
        html += '<textarea class="params" id="'+param+'" name="params['+param+']"  style="width: 100%;" rows=8/>';

        $("#params").append(html);
    }

    $(document).ready(function(){
        d = new Date();

        $('#time').timepicker({
            defaultTime: d.getHours()+':'+d.getMinutes(),
            hours:{starts:19,ends:24},
            minutes:{starts:0,ends:55,interval:15}
        });

        contentForm = $("#content-form").html();

        params = contentForm.match(/\{(.*)\}/g);
        for (i=0 ;i<params.length; i++){
            param = params[i].substr(1, params[i].length -2);
            switch (param){
                case "date":
                    break;
                case "time":
                    break;
                default:
                    genParamForm(param);
            }
        }

        $(".params").keyup(function(){

            param = $(this).attr("id");
            value = $(this).val();
            if (value == "") value = "{"+param+"}";
            $('#code-'+param).html(value);
        });

        $("#params-submit").click(function(e) {
            $("form").submit();
        });

        $("#review-button").click(function(e){
            $.ajax({
                url: '<?php echo Yii::app()->createUrl("/mail/review")?>',
                method: "post",
                data: $("form").serialize(),
                success: function(e){
                    $("#review-content").html(e);
                }
            });
        });
    });
</script>