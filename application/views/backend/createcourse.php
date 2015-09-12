<div id="page-title">
    <a href="<?php echo site_url("site/viewcourse?id=".$user); ?>" class="btn btn-primary btn-labeled fa fa-arrow-left margined pull-right">Back</a>
    <h1 class="page-header text-overflow">course Details </h1>
</div>
<div id="page-content">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
Create course </h3>
                </div>
                <div class="panel-body">
                    <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/createcoursesubmit");?>' enctype='multipart/form-data'>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Course Id</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="courseid" value='<?php echo set_value(' courseid ');?>'>
                                </div>
                            </div>
                            <div class=" form-group" style="display:none;">
                                <label class="col-sm-2 control-label" for="normal-field">User</label>
                                <div class="col-sm-6">
                                    <input type="text" id="normal-field" class="form-control" name="user" value='<?php echo set_value(' user ',$user);?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Name</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="name" value='<?php echo set_value(' name ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Course Number</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="coursenumber" value='<?php echo set_value(' coursenumber ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="<?php echo site_url("site/viewcourse?id=".$user); ?>" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                    </form>
                    </div>
            </section>
            </div>
        </div>
    </div>
