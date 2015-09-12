<div id="page-title">
    <a href="<?php echo site_url("site/viewpatent?id=".$user); ?>" class="btn btn-primary btn-labeled fa fa-arrow-left margined pull-right">Back</a>
    <h1 class="page-header text-overflow">patent Details </h1>
</div>
<div id="page-content">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
Create patent </h3>
                </div>
                <div class="panel-body">
                    <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/createpatentsubmit");?>' enctype='multipart/form-data'>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Patent Id</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="patentid" value='<?php echo set_value(' patentid ');?>'>
                                </div>
                            </div>
                            <div class=" form-group" style="display:none;">
                                <label class="col-sm-2 control-label" for="normal-field">User</label>
                                <div class="col-sm-6">
                                    <input type="text" id="normal-field" class="form-control" name="user" value='<?php echo set_value(' user ',$user);?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Title</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="title" value='<?php echo set_value(' title ');?>'>
                                </div>
                            </div>
                            <div class=" form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Summary</label>
                                <div class="col-sm-8">
                                    <textarea name="summary" id="" cols="20" rows="10" class="form-control tinymce">
                                        <?php echo set_value( 'summary');?>
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Number</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="number" value='<?php echo set_value(' number ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Status ID</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="statusid" value='<?php echo set_value(' statusid ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Status</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="status" value='<?php echo set_value(' status ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Office Name</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="officename" value='<?php echo set_value(' officename ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Inventor Id</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="inventorid" value='<?php echo set_value(' inventorid ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Inventor Name</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="inventorname" value='<?php echo set_value(' inventorname ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Date</label>
                                <div class="col-sm-4">
                                    <input type="date" id="normal-field" class="form-control" name="date" value='<?php echo set_value(' date ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">URL</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="url" value='<?php echo set_value(' url ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="<?php echo site_url("site/viewpatent?id=".$user); ?>" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                    </form>
                    </div>
            </section>
            </div>
        </div>
    </div>
