<div id="page-title">
    <a href="<?php echo site_url("site/viewtransaction"); ?>" class="btn btn-primary btn-labeled fa fa-arrow-left margined pull-right">Back</a>
    <h1 class="page-header text-overflow">transaction Details </h1>
</div>
<div id="page-content">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
Create transaction </h3>
                </div>
                <div class="panel-body">
                    <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/createtransactionsubmit");?>' enctype='multipart/form-data'>
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
                                <label class="col-sm-2 control-label" for="normal-field">Amount</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="amount" value='<?php echo set_value(' amount ');?>'>
                                </div>
                            </div>
<!--
                            <div class=" form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Type</label>
                                <div class="col-sm-4">
                                    <?php echo form_dropdown( "type",$type,set_value( 'type'), "class='chzn-select form-control'");?>
                                </div>
                            </div>
-->
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="<?php echo site_url("site/viewtransaction"); ?>" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                    </form>
                    </div>
            </section>
            </div>
        </div>
    </div>
