<section class="panel">
    <header class="panel-heading">
        <h3 class="panel-title">education Details </h3>
    </header>
    <div class="panel-body">
        <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/editeducationsubmit");?>' enctype='multipart/form-data'>
            <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$beforeeducation->id);?>" style="display:none;">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Education Id</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="educationid" value='<?php echo set_value(' educationid ',$beforeeducation->educationid);?>'>
                </div>
            </div>
            <div class=" form-group" style="display:none;">
                <label class="col-sm-2 control-label" for="normal-field">User</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="user" value='<?php echo set_value(' user ',$beforeeducation->user);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">School Name</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="schoolname" value='<?php echo set_value(' schoolname ',$beforeeducation->schoolname);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Field Of Study</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="fieldofstudy" value='<?php echo set_value(' fieldofstudy ',$beforeeducation->fieldofstudy);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Start Date</label>
                <div class="col-sm-4">
                    <input type="date" id="normal-field" class="form-control" name="startdate" value='<?php echo set_value(' startdate ',$beforeeducation->startdate);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">End Date</label>
                <div class="col-sm-4">
                    <input type="date" id="normal-field" class="form-control" name="enddate" value='<?php echo set_value(' enddate ',$beforeeducation->enddate);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Degree</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="degree" value='<?php echo set_value(' degree ',$beforeeducation->degree);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Activities</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="activities" value='<?php echo set_value(' activities ',$beforeeducation->activities);?>'>
                </div>
            </div>
            <div class=" form-group">
                <label class="col-sm-2 control-label" for="normal-field">Notes</label>
                <div class="col-sm-8">
                    <textarea name="notes" id="" cols="20" rows="10" class="form-control tinymce">
                        <?php echo set_value( 'notes',$beforeeducation->notes);?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href='<?php echo site_url("site/vieweducation?id=".$user); ?>' class='btn btn-secondary'>Cancel</a>
                </div>
            </div>
        </form>
    </div>
</section>
