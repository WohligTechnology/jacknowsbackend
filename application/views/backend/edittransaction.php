<section class="panel">
    <header class="panel-heading">
        <h3 class="panel-title">transaction Details </h3>
    </header>
    <div class="panel-body">
        <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/edittransactionsubmit");?>' enctype='multipart/form-data'>
            <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
            <div class=" form-group">
                <label class="col-sm-2 control-label" for="normal-field">From User</label>
                <div class="col-sm-4">
                    <?php echo form_dropdown( "fromuser",$user,set_value( 'fromuser',$before->fromuser),"class='chzn-select form-control'");?>
                </div>
            </div>
            <div class=" form-group">
                <label class="col-sm-2 control-label" for="normal-field">To User</label>
                <div class="col-sm-4">
                    <?php echo form_dropdown( "touser",$user,set_value( 'touser',$before->touser),"class='chzn-select form-control'");?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Amount</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="amount" value='<?php echo set_value(' amount ',$before->amount);?>'>
                </div>
            </div>
<!--
            <div class=" form-group">
                <label class="col-sm-2 control-label" for="normal-field">Type</label>
                <div class="col-sm-4">
                    <?php echo form_dropdown( "type",$type,set_value( 'type',$before->type),"class='chzn-select form-control'");?>
                </div>
            </div>
-->
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href='<?php echo site_url("site/viewtransaction"); ?>' class='btn btn-secondary'>Cancel</a>
                </div>
            </div>
        </form>
    </div>
</section>
