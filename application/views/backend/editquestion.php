<section class="panel">
    <header class="panel-heading">
        <h3 class="panel-title">question Details </h3>
    </header>
    <div class="panel-body">
        <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/editquestionsubmit");?>' enctype='multipart/form-data'>
            <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
            <div class=" form-group">
                <label class="col-sm-2 control-label" for="normal-field">From User</label>
                <div class="col-sm-4">
                    <?php echo form_dropdown( "fromuser",$user,set_value( 'fromuser',$before->fromuser),"class='chzn-select form-control'");?>
                </div>
            </div>
            <div class=" form-group">
                <label class="col-sm-2 control-label" for="normal-field">Question</label>
                <div class="col-sm-8">
                    <textarea name="question" id="" cols="20" rows="10" class="form-control tinymce"><?php echo set_value( 'question',$before->question);?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href='<?php echo site_url("site/viewquestion"); ?>' class='btn btn-secondary'>Cancel</a>
                </div>
            </div>
        </form>
    </div>
</section>
