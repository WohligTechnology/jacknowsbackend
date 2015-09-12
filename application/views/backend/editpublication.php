<section class="panel">
    <header class="panel-heading">
        <h3 class="panel-title">publication Details </h3>
    </header>
    <div class="panel-body">
        <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/editpublicationsubmit");?>' enctype='multipart/form-data'>
            <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$beforepublication->id);?>" style="display:none;">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Publication ID</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="publicationid" value='<?php echo set_value(' publicationid ',$beforepublication->publicationid);?>'>
                </div>
            </div>
            <div class=" form-group" style="display:none;">
                <label class="col-sm-2 control-label" for="normal-field">User</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="user" value='<?php echo set_value(' user ',$beforepublication->user);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Title</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="title" value='<?php echo set_value(' title ',$beforepublication->title);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Publisher Name</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="publishername" value='<?php echo set_value(' publishername ',$beforepublication->publishername);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Author Id</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="authorid" value='<?php echo set_value(' authorid ',$beforepublication->authorid);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Author Name</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="authorname" value='<?php echo set_value(' authorname ',$beforepublication->authorname);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Date</label>
                <div class="col-sm-4">
                    <input type="date" id="normal-field" class="form-control" name="date" value='<?php echo set_value(' date ',$beforepublication->date);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Publication URL</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="publicationurl" value='<?php echo set_value(' publicationurl ',$beforepublication->publicationurl);?>'>
                </div>
            </div>
            <div class=" form-group">
                <label class="col-sm-2 control-label" for="normal-field">Summary</label>
                <div class="col-sm-8">
                    <textarea name="summary" id="" cols="20" rows="10" class="form-control tinymce">
                        <?php echo set_value( 'summary',$beforepublication->summary);?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href='<?php echo site_url("site/viewpublication"); ?>' class='btn btn-secondary'>Cancel</a>
                </div>
            </div>
        </form>
    </div>
</section>
