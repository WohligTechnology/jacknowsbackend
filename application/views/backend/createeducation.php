<div id="page-title">
    <a href="<?php echo site_url("site/vieweducation?id=".$user); ?>" class="btn btn-primary btn-labeled fa fa-arrow-left margined pull-right">Back</a>
    <h1 class="page-header text-overflow">education Details </h1>
</div>
<div id="page-content">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
Create education </h3>
                </div>
                <div class="panel-body">
                    <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/createeducationsubmit");?>' enctype='multipart/form-data'>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Education Id</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="educationid" value='<?php echo set_value(' educationid ');?>'>
                                </div>
                            </div>
                            <div class=" form-group" style="display:none;">
                                <label class="col-sm-2 control-label" for="normal-field">User</label>
                                <div class="col-sm-6">
                                    <input type="text" id="normal-field" class="form-control" name="user" value='<?php echo set_value(' user ',$user);?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">School Name</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="schoolname" value='<?php echo set_value(' schoolname ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Field Of Study</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="fieldofstudy" value='<?php echo set_value(' fieldofstudy ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Start Date</label>
                                <div class="col-sm-4">
                                    <input type="date" id="normal-field" class="form-control" name="startdate" value='<?php echo set_value(' startdate ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">End Date</label>
                                <div class="col-sm-4">
                                    <input type="date" id="normal-field" class="form-control" name="enddate" value='<?php echo set_value(' enddate ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Degree</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="degree" value='<?php echo set_value(' degree ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Activities</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="activities" value='<?php echo set_value(' activities ');?>'>
                                </div>
                            </div>
                            <div class=" form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Notes</label>
                                <div class="col-sm-8">
                                    <textarea name="notes" id="" cols="20" rows="10" class="form-control tinymce">
                                        <?php echo set_value( 'notes');?>
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="<?php echo site_url("site/vieweducation?id=".$user); ?>" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                    </form>
                    </div>
            </section>
            </div>
        </div>
    </div>
