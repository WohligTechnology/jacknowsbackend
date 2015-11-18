<div id="page-title">
<a href="<?php echo site_url("site/viewhobbyphotos"); ?>" class="btn btn-primary btn-labeled fa fa-arrow-left margined pull-right">Back</a>
<h1 class="page-header text-overflow">hobbyphotos Details </h1>
</div>
<div id="page-content">
<div class="row">
<div class="col-lg-12">
<section class="panel">
<div class="panel-heading">
<h3 class="panel-title">
Create hobbyphotos </h3>
</div>
<div class="panel-body">
<form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/createhobbyphotossubmit");?>' enctype= 'multipart/form-data'>
<div class="panel-body">
<div class=" form-group">
<label class="col-sm-2 control-label" for="normal-field">User</label>
<div class="col-sm-4">
<?php echo form_dropdown("user",$user,set_value('user'),"class='chzn-select form-control'");?>
</div>
</div>
<div class=" form-group">
<label class="col-sm-2 control-label" for="normal-field">Hobby</label>
<div class="col-sm-4">
<?php echo form_dropdown("hobby",$hobby,set_value('hobby'),"class='chzn-select form-control'");?>
</div>
</div>
<div class=" form-group">
<label class="col-sm-2 control-label" for="normal-field">Image</label>
<div class="col-sm-4">
<input type="file" id="normal-field" class="form-control" name="image" value='<?php echo set_value('image');?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
<div class="col-sm-4">
<button type="submit" class="btn btn-primary">Save</button>
<a href="<?php echo site_url("site/viewhobbyphotos"); ?>" class="btn btn-secondary">Cancel</a>
</div>
</div>
</form>
</div>
</section>
</div>
</div>
</div>
