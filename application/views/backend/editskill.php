<section class="panel">
    <header class="panel-heading">
        <h3 class="panel-title">skill Details </h3>
    </header>
    <div class="panel-body">
        <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/editskillsubmit");?>' enctype='multipart/form-data'>
            <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$beforeskill->id);?>" style="display:none;">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Skill Id</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="skillid" value='<?php echo set_value(' skillid ',$beforeskill->skillid);?>'>
                </div>
            </div>
            <div class=" form-group" style="display:none;">
                <label class="col-sm-2 control-label" for="normal-field">User</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="user" value='<?php echo set_value(' user ',$beforeskill->user);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Skill Name</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="skillname" value='<?php echo set_value(' skillname ',$beforeskill->skillname);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href='<?php echo site_url("site/viewskill"); ?>' class='btn btn-secondary'>Cancel</a>
                </div>
            </div>
        </form>
    </div>
</section>
