<div id="page-title">
<a href="<?php echo site_url("site/viewprofessionexperience"); ?>" class="btn btn-primary btn-labeled fa fa-arrow-left margined pull-right">Back</a>
<h1 class="page-header text-overflow">professionexperience Details </h1>
</div>
<div id="page-content">
<div class="row">
<div class="col-lg-12">
<section class="panel">
<div class="panel-heading">
<h3 class="panel-title">
Create professionexperience </h3>
</div>
<div class="panel-body">
<form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/createprofessionexperiencesubmit");?>' enctype= 'multipart/form-data'>
<div class="panel-body">
<div class=" form-group">
<label class="col-sm-2 control-label" for="normal-field">Profession</label>
<div class="col-sm-4">
<?php echo form_dropdown("profession",$profession,set_value('profession',$this->input->get('id')),"class='chzn-select form-control'");?>
</div>
</div>
<div class=" form-group">
<label class="col-sm-2 control-label" for="normal-field">User</label>
<div class="col-sm-4">
<?php echo form_dropdown("user",$user,set_value('user'),"class='chzn-select form-control'");?>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">companyname</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="companyname" value='<?php echo set_value('companyname');?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">jobtitle</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="jobtitle" value='<?php echo set_value('jobtitle');?>'>
</div>
</div>
<div class=" form-group">
<label class="col-sm-2 control-label" for="normal-field">Company Logo</label>
<div class="col-sm-4">
<input type="file" id="normal-field" class="form-control" name="companylogo" value='<?php echo set_value('companylogo');?>'>
</div>
</div>
<div class=" form-group">
<label class="col-sm-2 control-label" for="normal-field">jobdescription</label>
<div class="col-sm-8">
<textarea name="jobdescription" id="" cols="20" rows="10" class="form-control tinymce"><?php echo set_value( 'jobdescription');?></textarea>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Start date</label>
<div class="col-sm-4">
<input type="date" id="normal-field" class="form-control" name="startdate" value='<?php echo set_value('startdate');?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">End Date</label>
<div class="col-sm-4">
<input type="date" id="normal-field" class="form-control" name="enddate" value='<?php echo set_value('enddate');?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
<div class="col-sm-4">
<button type="submit" class="btn btn-primary">Save</button>
<a href="<?php echo site_url("site/viewprofessionexperience"); ?>" class="btn btn-secondary">Cancel</a>
</div>
</div>
</form>
</div>
</section>
</div>
</div>
</div>
