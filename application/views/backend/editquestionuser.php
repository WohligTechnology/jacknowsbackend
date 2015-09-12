<section class="panel">
    <header class="panel-heading">
        <h3 class="panel-title">questionuser Details </h3>
    </header>
    <div class="panel-body">
        <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/editquestionusersubmit");?>' enctype='multipart/form-data'>
            <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$beforequestionuser->id);?>" style="display:none;">
            <div class=" form-group" style="display:none;">
                <label class="col-sm-2 control-label" for="normal-field">Question</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="question" value='<?php echo set_value(' question ',$beforequestionuser->question);?>'>
                </div>
            </div>
            <div class=" form-group">
                <label class="col-sm-2 control-label" for="normal-field">To User</label>
                <div class="col-sm-4">
                    <?php echo form_dropdown( "touser",$user,set_value( 'touser',$beforequestionuser->touser),"class='chzn-select form-control'");?>
                </div>
            </div>
            <div class=" form-group">
                <label class="col-sm-2 control-label" for="normal-field">Status</label>
                <div class="col-sm-4">
                    <?php echo form_dropdown( "status",$status,set_value( 'status',$beforequestionuser->status),"class='chzn-select form-control'");?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href='<?php echo site_url("site/viewquestionuser?id=".$question); ?>' class='btn btn-secondary'>Cancel</a>
                </div>
            </div>
        </form>
    </div>
</section>
