<section class="panel">
    <header class="panel-heading">
        <h3 class="panel-title">language Details </h3>
    </header>
    <div class="panel-body">
        <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/editlanguagesubmit");?>' enctype='multipart/form-data'>
            <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$beforelanguage->id);?>" style="display:none;">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Language Id</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="languageid" value='<?php echo set_value(' languageid ',$beforelanguage->languageid);?>'>
                </div>
            </div>
            <div class=" form-group" style="display:none;">
                <label class="col-sm-2 control-label" for="normal-field">User</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="user" value='<?php echo set_value(' user ',$beforelanguage->user);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Language Name</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="languagename" value='<?php echo set_value(' languagename ',$beforelanguage->languagename);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Proficiancy Level</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="proficiancylevel" value='<?php echo set_value(' proficiancylevel ',$beforelanguage->proficiancylevel);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Proficiancy Name</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="proficiancyname" value='<?php echo set_value(' proficiancyname ',$beforelanguage->proficiancyname);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href='<?php echo site_url("site/viewlanguage?id=".$user); ?>' class='btn btn-secondary'>Cancel</a>
                </div>
            </div>
        </form>
    </div>
</section>
