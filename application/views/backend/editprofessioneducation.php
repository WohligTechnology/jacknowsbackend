<section class="panel">
<header class="panel-heading">
<h3 class="panel-title">professioneducation Details </h3>
</header>
<div class="panel-body">
<form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/editprofessioneducationsubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class=" form-group">
<label class="col-sm-2 control-label" for="normal-field">User</label>
<div class="col-sm-4">
<?php echo form_dropdown("user",$user,set_value('user',$before->user),"class='chzn-select form-control'");?>
</div>
</div>
<div class=" form-group">
<label class="col-sm-2 control-label" for="normal-field">Profession</label>
<div class="col-sm-4">
<?php echo form_dropdown("profession",$profession,set_value('profession',$before->profession),"class='chzn-select form-control'");?>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Degree</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="degree" value='<?php echo set_value('degree',$before->degree);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Institute</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="institute" value='<?php echo set_value('institute',$before->institute);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Year of Passing</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="yearofpassing" value='<?php echo set_value('yearofpassing',$before->yearofpassing);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
<div class="col-sm-4">
<button type="submit" class="btn btn-primary">Save</button>
<a href='<?php echo site_url("site/viewprofessioneducation?id=").$this->input->get('professionid')."&userid=".$this->input->get('userid'); ?>' class='btn btn-secondary'>Cancel</a>
</div>
</div>
</form>
</div>
</section>
