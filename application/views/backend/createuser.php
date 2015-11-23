<div class="row" style="padding:1% 0">
	<div class="col-md-12">
		<div class="pull-right">
			<a href="<?php echo site_url('site/viewusers'); ?>" class="btn btn-primary pull-right"><i class="icon-long-arrow-left"></i>&nbsp;Back</a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
	    <section class="panel">
		    <header class="panel-heading">
				 User Details
			</header>
			<div class="panel-body">
			  <form class="form-horizontal tasi-form" method="post" action="<?php echo site_url('site/createusersubmit');?>" enctype= "multipart/form-data">
                  <div class=" form-group">
				  <label class="col-sm-2 control-label">isexpert</label>
				  <div class="col-sm-4">
					<?php
						
						echo form_dropdown('isexpert',$isexpert,set_value('isexpert'),'class="chzn-select form-control" 	data-placeholder="Choose a Accesslevel..."');
					?>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Name</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="name" value="<?php echo set_value('name');?>">
				  </div>
				</div>
<!--
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Username</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="username" value="<?php echo set_value('username');?>">
				  </div>
				</div>
-->
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Email</label>
				  <div class="col-sm-4">
					<input type="email" id="normal-field" class="form-control" name="email" value="<?php echo set_value('email');?>">
				  </div>
				</div>
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="description-field">Password</label>
				  <div class="col-sm-4">
					<input type="password" id="description-field" class="form-control" name="password" value="">
				  </div>
				</div>
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="description-field">Confirm Password</label>
				  <div class="col-sm-4">
					<input type="password" id="description-field" class="form-control" name="confirmpassword" value="">
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Contact</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="contact" value="<?php echo set_value('contact');?>">
				  </div>
				</div>
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label">Type (Ameture/Professional)</label>
				  <div class="col-sm-4">
					<?php
						
						echo form_dropdown('type',$type,set_value('type'),'class="chzn-select form-control" 	data-placeholder="Choose a Type..."');
					?>
				  </div>
				</div>
				
				<div class="form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Ameture Price</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="ametureprice" value="<?php echo set_value('ametureprice','250');?>">
				  </div>
				</div>
				
				<div class="form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Professional Price</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="professionalprice" value="<?php echo set_value('professionalprice','500');?>">
				  </div>
				</div>
				
				<div class="form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Percent</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="percent" value="<?php echo set_value('percent','70');?>">
				  </div>
				</div>
				
				<div class="form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Wallet</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="wallet" value="<?php echo set_value('wallet');?>">
				  </div>
				</div>
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">SocialId</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="socialid" value="<?php echo set_value('socialid');?>">
				  </div>
				</div>
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label">logintype</label>
				  <div class="col-sm-4">
					<?php
						
						echo form_dropdown('logintype',$logintype,set_value('logintype'),'class="chzn-select form-control" 	data-placeholder="Choose a Logintype..."');
					?>
				  </div>
				</div>
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label">Status</label>
				  <div class="col-sm-4">
					<?php
						
						echo form_dropdown('status',$status,set_value('status'),'class="chzn-select form-control" 	data-placeholder="Choose a Accesslevel..."');
					?>
				  </div>
				</div>
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Image</label>
				  <div class="col-sm-4">
					<input type="file" id="normal-field" class="form-control" name="image" value="<?php echo set_value('image');?>">
				  </div>
				</div>
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label">Select Accesslevel</label>
				  <div class="col-sm-4">
					<?php 	 echo form_dropdown('accesslevel',$accesslevel,set_value('accesslevel'),'id="accesslevelid" onchange="operatorcategories()" class="chzn-select form-control" 	data-placeholder="Choose a Accesslevel..."');
					?>
				  </div>
				</div>
				
<!--
				<div class=" form-group categoryclass" style="display:none;">
				  <label class="col-sm-2 control-label">Category</label>
				  <div class="col-sm-4">
					<?php
						
						echo form_dropdown('category[]',$category,set_value('category'),'id="select10" class="chzn-select form-control" 	data-placeholder="Choose a category..." multiple');
					?>
				  </div>
				</div>
-->
				
				<div class=" form-group" style="display:none;">
				  <label class="col-sm-2 control-label" for="normal-field">json</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="json" value="<?php echo set_value('json');?>">
				  </div>
				</div>
                  <div class=" form-group">
				  <label class="col-sm-2 control-label">gender</label>
				  <div class="col-sm-4">
					<?php
						
						echo form_dropdown('gender',$gender,set_value('gender'),'class="chzn-select form-control" 	data-placeholder="Choose a Accesslevel..."');
					?>
				  </div>
				</div>
                  <div class=" form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Address</label>
                                <div class="col-sm-8">
                                    <textarea name="address" id="" cols="20" rows="10" class="form-control tinymce"><?php echo set_value( 'address');?></textarea>
                                </div>
                            </div>
                  <div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">City</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="city" value="<?php echo set_value('city');?>">
				  </div>
				</div>
                  <div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">State</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="state" value="<?php echo set_value('state');?>">
				  </div>
				</div>
                  <div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Pincode</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="pincode" value="<?php echo set_value('pincode');?>">
				  </div>
				</div>
                  <div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Country</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="country" value="<?php echo set_value('country');?>">
				  </div>
				</div>
                  <div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Twitter social</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="twittersocial" value="<?php echo set_value('twittersocial');?>">
				  </div>
				</div>
                  <div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Youtube social</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="youtubesocial" value="<?php echo set_value('youtubesocial');?>">
				  </div>
				</div>
                  <div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Facebook social</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="facebooksocial" value="<?php echo set_value('facebooksocial');?>">
				  </div>
				</div>
				<div class=" form-group">
				  <label class="col-sm-2 control-label">&nbsp;</label>
				  <div class="col-sm-4">
				  <button type="submit" class="btn btn-primary">Save</button>
				  <a href="<?php echo site_url('site/viewusers'); ?>" class="btn btn-secondary">Cancel</a>
				</div>
				</div>
			  </form>
			</div>
		</section>
	</div>
</div>
<script type="text/javascript">
    function operatorcategories() {
        console.log($('#accesslevelid').val());
        if($('#accesslevelid').val()==2)
        {
            $( ".categoryclass" ).show();
        }
       
        else
        {
            $( ".categoryclass" ).hide();
        }
       
    }
</script>