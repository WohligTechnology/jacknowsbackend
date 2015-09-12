<section class="panel">
    <header class="panel-heading">
        <h3 class="panel-title">certification Details </h3>
    </header>
    <div class="panel-body">
        <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/editcertificationsubmit");?>' enctype='multipart/form-data'>
            <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$beforecertification->id);?>" style="display:none;">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Certification Id</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="certificationid" value='<?php echo set_value(' certificationid ',$beforecertification->certificationid);?>'>
                </div>
            </div>
            <div class=" form-group" style="display:none;">
                <label class="col-sm-2 control-label" for="normal-field">User</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="user" value='<?php echo set_value(' user ',$beforecertification->user);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Certification Name</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="certificationname" value='<?php echo set_value(' certificationname ',$beforecertification->certificationname);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Authority Name</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="authorityname" value='<?php echo set_value(' authorityname ',$beforecertification->authorityname);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">License Number</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="licensenumber" value='<?php echo set_value(' licensenumber ',$beforecertification->licensenumber);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Start Date</label>
                <div class="col-sm-4">
                    <input type="date" id="normal-field" class="form-control" name="startdate" value='<?php echo set_value(' startdate ',$beforecertification->startdate);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">End Date</label>
                <div class="col-sm-4">
                    <input type="date" id="normal-field" class="form-control" name="enddate" value='<?php echo set_value(' enddate ',$beforecertification->enddate);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href='<?php echo site_url("site/viewcertification"); ?>' class='btn btn-secondary'>Cancel</a>
                </div>
            </div>
        </form>
    </div>
</section>
