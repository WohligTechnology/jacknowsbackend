<div id="page-title">
    <a href="<?php echo site_url("site/viewbooking"); ?>" class="btn btn-primary btn-labeled fa fa-arrow-left margined pull-right">Back</a>
    <h1 class="page-header text-overflow">booking Details </h1>
</div>
<div id="page-content">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
Create booking </h3>
                </div>
                <div class="panel-body">
                    <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/createbookingsubmit");?>' enctype='multipart/form-data'>
                        <div class="panel-body">
                            <div class=" form-group">
                                <label class="col-sm-2 control-label" for="normal-field">From User</label>
                                <div class="col-sm-4">
                                    <?php echo form_dropdown( "fromuser",$user,set_value( 'fromuser'), "class='chzn-select form-control'");?>
                                </div>
                            </div>
                            <div class=" form-group">
                                <label class="col-sm-2 control-label" for="normal-field">To User</label>
                                <div class="col-sm-4">
                                    <?php echo form_dropdown( "touser",$user,set_value( 'touser'), "class='chzn-select form-control'");?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Date</label>
                                <div class="col-sm-4">
                                    <input type="date" id="normal-field" class="form-control" name="date" value='<?php echo set_value(' date ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Start Time</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="starttime" value='<?php echo set_value(' starttime ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">End Time</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="endtime" value='<?php echo set_value(' endtime ');?>'>
                                </div>
                            </div>
                            <div class=" form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Status</label>
                                <div class="col-sm-4">
                                    <?php echo form_dropdown( "status",$status,set_value( 'status'), "class='chzn-select form-control'");?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="<?php echo site_url("site/viewbooking"); ?>" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                    </form>
                    </div>
            </section>
            </div>
        </div>
    </div>
