<section class="panel">
    <header class="panel-heading">
        <h3 class="panel-title">patent Details </h3>
    </header>
    <div class="panel-body">
        <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/editpatentsubmit");?>' enctype='multipart/form-data'>
            <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$beforepatent->id);?>" style="display:none;">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Patent Id</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="patentid" value='<?php echo set_value(' patentid ',$beforepatent->patentid);?>'>
                </div>
            </div>
            <div class=" form-group" style="display:none;">
                <label class="col-sm-2 control-label" for="normal-field">User</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="user" value='<?php echo set_value(' user ',$beforepatent->user);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Title</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="title" value='<?php echo set_value(' title ',$beforepatent->title);?>'>
                </div>
            </div>
            <div class=" form-group">
                <label class="col-sm-2 control-label" for="normal-field">Summary</label>
                <div class="col-sm-8">
                    <textarea name="summary" id="" cols="20" rows="10" class="form-control tinymce">
                        <?php echo set_value( 'summary',$beforepatent->summary);?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Number</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="number" value='<?php echo set_value(' number ',$beforepatent->number);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Status ID</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="statusid" value='<?php echo set_value(' statusid ',$beforepatent->statusid);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Status</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="status" value='<?php echo set_value(' status ',$beforepatent->status);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Office Name</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="officename" value='<?php echo set_value(' officename ',$beforepatent->officename);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Inventor Id</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="inventorid" value='<?php echo set_value(' inventorid ',$beforepatent->inventorid);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Inventor Name</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="inventorname" value='<?php echo set_value(' inventorname ',$beforepatent->inventorname);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Date</label>
                <div class="col-sm-4">
                    <input type="date" id="normal-field" class="form-control" name="date" value='<?php echo set_value(' date ',$beforepatent->date);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">URL</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="url" value='<?php echo set_value(' url ',$beforepatent->url);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href='<?php echo site_url("site/viewpatent?id=".$user); ?>' class='btn btn-secondary'>Cancel</a>
                </div>
            </div>
        </form>
    </div>
</section>
