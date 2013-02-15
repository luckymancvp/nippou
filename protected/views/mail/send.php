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



<h1>Send Today's Report !!</h1>
<div class="row">
    <div class="span6 well" id="content-form" style="min-height: 780px;">
        <?php
            echo $contentForm."";
        ?>
    </div>
    <div class="span4">
        <form method="post" id="params" class="form-vertical" action="<?php echo $this->createUrl('/mail/send')?>">

            <div class="input-prepend">
                <span class="add-on"><i class="icon-time"></i></span>
                <input type="text" class="time-picker" name="params[time1]" id="time1" style="width: 150px;">
            </div>
            <div class="input-prepend">
                <span class="add-on"><i class="icon-time"></i></span>
                <input type="text" class="time-picker" name="params[time2]" id="time2" style="width: 150px;">
            </div>
            <br>
        </form>
    </div>

    <div class="span2">
        <div class="btn-group">
            <button type="button" name="yt0" data-loading-text="Saving..." class="btn btn-primary" id="buttonStateful">Save Now</button>
            <button class="btn dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li>
                    <a href="#" id="params-submit">Submit</a>
                    <a href="#myModal" data-toggle="modal" id="review-button">Review</a>
                </li>
            </ul>
        </div>

        <p class="muted" id="save-notify"></p>
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

    previousValue = <?php echo $previousValue?>;

    function genParamForm(param){
        html = '<label><code>{'+param+'}</code></label>';
        html += '<textarea class="params" id="'+param+'" name="params['+param+']"  style="width: 100%;" rows=8/>';

        $("#params").append(html);
    }

    $(document).ready(function(){
        d = new Date();

        $('#time1').timepicker({
            defaultTime: d.getHours()+':'+d.getMinutes(),
            hours:{starts:08,ends:11},
            minutes:{starts:0,ends:55,interval:15}
        });

        $('#time2').timepicker({
            defaultTime: d.getHours()+':'+d.getMinutes(),
            hours:{starts:19,ends:24},
            minutes:{starts:0,ends:55,interval:15}
        });

        contentForm = $("#content-form").html();

        params = contentForm.match(/\{([^}]*)\}/g);
        for (i=0 ;i<params.length; i++){
            param = params[i].substr(1, params[i].length -2);
            switch (param){
                case "date":
                    break;
                case "time1":
                    break;
                case "time2":
                    break;
                default:
                    genParamForm(param);
            }
        }

        // set previous data into field
        for (param in previousValue){
            $("#"+param).val(previousValue[param]);
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

    $('#buttonStateful').click(function() {
        var btn = $(this);
        btn.button('loading'); // call the loading function
        saveNow();
    });

    function saveNow()
    {
        $.ajax({
            url: '<?php echo $this->createUrl('/mail/save');?>',
            data: $("#params").serialize(),
            success: function(data) {
                var d = new Date();
                $('#buttonStateful').button('reset');
                $('#save-notify').html("Saved at time "+ d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds());
                $('#save-notify').fadeIn("fast", function(){
                    setTimeout(function() {
                        $('#save-notify').fadeOut('slow');
                    }, 3000);
                });
            }
        });
    }

    function autoSave(){
        saveNow();
        setTimeout(function() {
            autoSave();
        }, 5000);
    }

    setTimeout(function() {
        autoSave();
    }, 5000);
</script>