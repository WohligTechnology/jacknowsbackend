<div id="page-title">
    <a href="<?php echo site_url("site/viewpublication?id=".$user); ?>" class="btn btn-primary btn-labeled fa fa-arrow-left margined pull-right">Back</a>
    <h1 class="page-header text-overflow">publication Details </h1>
</div>
<div id="page-content">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
Create publication </h3>
                </div>
                <div class="panel-body">
                    <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/createpublicationsubmit");?>' enctype='multipart/form-data'>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Publication ID</label>
                                <div class="col-sm-6">
                                    <input type="text" id="normal-field" class="form-control" name="publicationid" value='<?php echo set_value(' publicationid ');?>'>
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
                                <div class="col-sm-6">
                                    <input type="text" id="normal-field" class="form-control" name="title" value='<?php echo set_value(' title ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Publisher Name</label>
                                <div class="col-sm-6">
                                    <input type="text" id="normal-field" class="form-control" name="publishername" value='<?php echo set_value(' publishername ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Author Id</label>
                                <div class="col-sm-6">
                                    <input type="text" id="normal-field" class="form-control" name="authorid" value='<?php echo set_value(' authorid ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Author Name</label>
                                <div class="col-sm-6">
                                    <input type="text" id="normal-field" class="form-control" name="authorname" value='<?php echo set_value(' authorname ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Date</label>
                                <div class="col-sm-6">
                                    <input type="date" id="normal-field" class="form-control" name="date" value='<?php echo set_value(' date ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Publication URL</label>
                                <div class="col-sm-6">
                                    <input type="text" id="normal-field" class="form-control" name="publicationurl" value='<?php echo set_value(' publicationurl ');?>'>
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
                                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="<?php echo site_url(" site/viewpublication "); ?>" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                    </form>
                    </div>
            </section>
            </div>
        </div>
    </div>
