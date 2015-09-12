<div id="page-title">
    <a href="<?php echo site_url("site/viewcertification?id=".$user); ?>" class="btn btn-primary btn-labeled fa fa-arrow-left margined pull-right">Back</a>
    <h1 class="page-header text-overflow">certification Details </h1>
</div>
<div id="page-content">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
Create certification </h3>
                </div>
                <div class="panel-body">
                    <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/createcertificationsubmit");?>' enctype='multipart/form-data'>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Certification Id</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="certificationid" value='<?php echo set_value(' certificationid ');?>'>
                                </div>
                            </div>
                            <div class=" form-group" style="display:none;">
                                <label class="col-sm-2 control-label" for="normal-field">User</label>
                                <div class="col-sm-6">
                                    <input type="text" id="normal-field" class="form-control" name="user" value='<?php echo set_value(' user ',$user);?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Certification Name</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="certificationname" value='<?php echo set_value(' certificationname ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Authority Name</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="authorityname" value='<?php echo set_value(' authorityname ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">License Number</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="licensenumber" value='<?php echo set_value(' licensenumber ');?>'>
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
                                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="<?php echo site_url("site/viewcertification?id=".$user); ?>" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                    </form>
                    </div>
            </section>
            </div>
        </div>
    </div>
