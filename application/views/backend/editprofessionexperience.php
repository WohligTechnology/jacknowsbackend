<section class="panel">
<header class="panel-heading">
<h3 class="panel-title">professionexperience Details </h3>
</header>
<div class="panel-body">
<form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/editprofessionexperiencesubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class=" form-group">
<label class="col-sm-2 control-label" for="normal-field">Profession</label>
<div class="col-sm-4">
<?php echo form_dropdown("profession",$profession,set_value('profession',$before->profession),"class='chzn-select form-control'");?>
</div>
</div>
<div class=" form-group">
<label class="col-sm-2 control-label" for="normal-field">User</label>
<div class="col-sm-4">
<?php echo form_dropdown("user",$user,set_value('user',$before->user),"class='chzn-select form-control'");?>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">companyname</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="companyname" value='<?php echo set_value('companyname',$before->companyname);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">jobtitle</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="jobtitle" value='<?php echo set_value('jobtitle',$before->jobtitle);?>'>
</div>
</div>
<div class=" form-group">
<label class="col-sm-2 control-label" for="normal-field">Company Logo</label>
<div class="col-sm-4">
<input type="file" id="normal-field" class="form-control" name="companylogo" value='<?php echo set_value('companylogo',$before->companylogo);?>'>
</div>
</div>
<div class=" form-group">
<label class="col-sm-2 control-label" for="normal-field">jobdescription</label>
<div class="col-sm-8">
<textarea name="jobdescription" id="" cols="20" rows="10" class="form-control tinymce"><?php echo set_value( 'jobdescription',$before->jobdescription);?></textarea>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Start date</label>
<div class="col-sm-4">
<input type="date" id="normal-field" class="form-control" name="startdate" value='<?php echo set_value('startdate',$before->startdate);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">End Date</label>
<div class="col-sm-4">
<input type="date" id="normal-field" class="form-control" name="enddate" value='<?php echo set_value('enddate',$before->enddate);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
<div class="col-sm-4">
<button type="submit" class="btn btn-primary">Save</button>
<a href='<?php echo site_url("site/viewprofessionexperience"); ?>' class='btn btn-secondary'>Cancel</a>
</div>
</div>
</form>
</div>
</section>
