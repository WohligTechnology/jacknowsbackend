<div id="page-title">
<a href="<?php echo site_url("site/viewprofessioneducation"); ?>" class="btn btn-primary btn-labeled fa fa-arrow-left margined pull-right">Back</a>
<h1 class="page-header text-overflow">professioneducation Details </h1>
</div>
<div id="page-content">
<div class="row">
<div class="col-lg-12">
<section class="panel">
<div class="panel-heading">
<h3 class="panel-title">
Create professioneducation </h3>
</div>
<div class="panel-body">
<form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/createprofessioneducationsubmit");?>' enctype= 'multipart/form-data'>
<div class="panel-body">
<div class=" form-group">
<label class="col-sm-2 control-label" for="normal-field">User</label>
<div class="col-sm-4">
<?php echo form_dropdown("user",$user,set_value('user',$this->input->get('userid')),"class='chzn-select form-control'");?>
</div>
</div>
<div class=" form-group">
<label class="col-sm-2 control-label" for="normal-field">Profession</label>
<div class="col-sm-4">
<?php echo form_dropdown("profession",$profession,set_value('profession',$this->input->get('id')),"class='chzn-select form-control'");?>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Degree</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="degree" value='<?php echo set_value('degree');?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Institute</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="institute" value='<?php echo set_value('institute');?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Year of Passing</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="yearofpassing" value='<?php echo set_value('yearofpassing');?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
<div class="col-sm-4">
<button type="submit" class="btn btn-primary">Save</button>
<a href="<?php echo site_url("site/viewprofessioneducation?id=").$this->input->get('id')."&userid=".$this->input->get('userid'); ?>" class="btn btn-secondary">Cancel</a>
</div>
</div>
</form>
</div>
</section>
</div>
</div>
</div>
