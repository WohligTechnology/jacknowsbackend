<section class="panel">
    <header class="panel-heading">
        <h3 class="panel-title">booking Details </h3>
    </header>
    <div class="panel-body">
        <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/editbookingsubmit");?>' enctype='multipart/form-data'>
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
                <label class="col-sm-2 control-label" for="normal-field">Date</label>
                <div class="col-sm-4">
                    <input type="date" id="normal-field" class="form-control" name="date" value='<?php echo set_value(' date ',$before->date);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Start Time</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="starttime" value='<?php echo set_value(' starttime ',$before->starttime);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">End Time</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="endtime" value='<?php echo set_value(' endtime ',$before->endtime);?>'>
                </div>
            </div>
            <div class=" form-group">
                <label class="col-sm-2 control-label" for="normal-field">Status</label>
                <div class="col-sm-4">
                    <?php echo form_dropdown( "status",$status,set_value( 'status',$before->status),"class='chzn-select form-control'");?>
                </div>
            </div>
             <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Price</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="price" value='<?php echo set_value(' price ',$before->price);?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Round</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="round" value='<?php echo set_value(' round ',$before->round);?>'>
                                </div>
                            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href='<?php echo site_url("site/viewbooking"); ?>' class='btn btn-secondary'>Cancel</a>
                </div>
            </div>
        </form>
    </div>
</section>
