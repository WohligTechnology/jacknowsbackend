<section class="panel">
<header class="panel-heading">
<h3 class="panel-title">hobbywebsite Details </h3>
</header>
<div class="panel-body">
<form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/edithobbywebsitesubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class=" form-group">
<label class="col-sm-2 control-label" for="normal-field">User</label>
<div class="col-sm-4">
<?php echo form_dropdown("user",$user,set_value('user',$before->user),"class='chzn-select form-control'");?>
</div>
</div>
<div class=" form-group">
<label class="col-sm-2 control-label" for="normal-field">Hobby</label>
<div class="col-sm-4">
<?php echo form_dropdown("hobby",$hobby,set_value('hobby',$before->hobby),"class='chzn-select form-control'");?>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Website</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="website" value='<?php echo set_value('website',$before->website);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
<div class="col-sm-4">
<button type="submit" class="btn btn-primary">Save</button>
<a href='<?php echo site_url("site/viewhobbywebsite"); ?>' class='btn btn-secondary'>Cancel</a>
</div>
</div>
</form>
</div>
</section>
