<div id="page-title">
    <a href="<?php echo site_url("site/viewlanguage?id=".$user); ?>" class="btn btn-primary btn-labeled fa fa-arrow-left margined pull-right">Back</a>
    <h1 class="page-header text-overflow">language Details </h1>
</div>
<div id="page-content">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
Create language </h3>
                </div>
                <div class="panel-body">
                    <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/createlanguagesubmit");?>' enctype='multipart/form-data'>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Language Id</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="languageid" value='<?php echo set_value(' languageid ');?>'>
                                </div>
                            </div>
                            
                            <div class=" form-group" style="display:none;">
                                <label class="col-sm-2 control-label" for="normal-field">User</label>
                                <div class="col-sm-6">
                                    <input type="text" id="normal-field" class="form-control" name="user" value='<?php echo set_value(' user ',$user);?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Language Name</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="languagename" value='<?php echo set_value(' languagename ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Proficiancy Level</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="proficiancylevel" value='<?php echo set_value(' proficiancylevel ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Proficiancy Name</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="proficiancyname" value='<?php echo set_value(' proficiancyname ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="<?php echo site_url("site/viewlanguage?id=".$user); ?>" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                    </form>
                    </div>
            </section>
            </div>
        </div>
    </div>
