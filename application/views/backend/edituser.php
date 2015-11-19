	    <section class="panel">
		    <header class="panel-heading">
				 User Details
			</header>
			<div class="panel-body">
			  <form class="form-horizontal tasi-form" method="post" action="<?php echo site_url('site/editusersubmit');?>" enctype= "multipart/form-data">
				<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
				<div class="form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Email</label>
				  <div class="col-sm-4">
					<?php echo $before->email; ?>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Name</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="name" value="<?php echo set_value('name',$before->name);?>">
				  </div>
				</div>

				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Email</label>
				  <div class="col-sm-4">
					<input type="email" id="normal-field" class="form-control" name="email" value="<?php echo set_value('email',$before->email);?>">
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
					<input type="text" id="normal-field" class="form-control" name="contact" value="<?php echo set_value('contact',$before->contact);?>">
				  </div>
				</div>
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label">Type (Ameture/Professional)</label>
				  <div class="col-sm-4">
					<?php
						
						echo form_dropdown('type',$type,set_value('type',$before->type),'class="chzn-select form-control" 	data-placeholder="Choose a Type..."');
					?>
				  </div>
				</div>
				
				<div class="form-group">
				  <label class="col-sm-2 control-label" for="normal-field">AmeturePrice</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="ametureprice" value="<?php echo set_value('ametureprice',$before->ametureprice);?>">
				  </div>
				</div>
				
				<div class="form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Professional Price</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="professionalprice" value="<?php echo set_value('professionalprice',$before->professionalprice);?>">
				  </div>
				</div>
				
				<div class="form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Percent</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="percent" value="<?php echo set_value('percent',$before->percent);?>">
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Wallet</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="wallet" value="<?php echo set_value('wallet',$before->wallet);?>">
				  </div>
				</div>
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">SocialId</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="socialid" value="<?php echo set_value('socialid',$before->socialid);?>">
				  </div>
				</div>
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label">logintype</label>
				  <div class="col-sm-4">
					<?php
						
						echo form_dropdown('logintype',$logintype,set_value('logintype',$before->logintype),'class="chzn-select form-control" 	data-placeholder="Choose a Logintype..."');
					?>
				  </div>
				</div>
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label">Status</label>
				  <div class="col-sm-4">
					<?php
						
						echo form_dropdown('status',$status,set_value('status',$before->status),'class="chzn-select form-control" 	data-placeholder="Choose a Accesslevel..."');
					?>
				  </div>
				</div>
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label">Select Accesslevel</label>
				  <div class="col-sm-4">
					<?php 	 echo form_dropdown('accesslevel',$accesslevel,set_value('accesslevel',$before->accesslevel),'onchange="operatorcategories()"class="chzn-select form-control" 	data-placeholder="Choose a Accesslevel..."');
					?>
				  </div>
				</div>

				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Image</label>
				  <div class="col-sm-4">
					<input type="file" id="normal-field" class="form-control" name="image" value="<?php echo set_value('image',$before->image);?>">
					<?php if($before->image == "")
						 { }
						 else
						 { ?>
							<img src="<?php echo base_url('uploads')."/".$before->image; ?>" width="140px" height="140px">
						<?php }
					?>
				  </div>
				</div>
				
				<div class=" form-group" style="display:none;">
				  <label class="col-sm-2 control-label" for="normal-field">json</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="json" value="<?php echo set_value('json',$before->json);?>">
				  </div>
				</div>
                  
<!--                  //new fields-->
                  
                    <div class=" form-group">
				  <label class="col-sm-2 control-label">gender</label>
				  <div class="col-sm-4">
					<?php
						
						echo form_dropdown('gender',$gender,set_value('gender',$before->gender),'class="chzn-select form-control" 	data-placeholder="Choose a Accesslevel..."');
					?>
				  </div>
				</div>
                  <div class=" form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Address</label>
                                <div class="col-sm-8">
                                    <textarea name="address" id="" cols="20" rows="10" class="form-control tinymce"><?php echo set_value( 'address',$before->address);?></textarea>
                                </div>
                            </div>
                  <div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">City</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="city" value="<?php echo set_value('city',$before->city);?>">
				  </div>
				</div>
                  <div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">State</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="state" value="<?php echo set_value('state',$before->state);?>">
				  </div>
				</div>
                  <div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Pincode</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="pincode" value="<?php echo set_value('pincode',$before->pincode);?>">
				  </div>
				</div>
                  <div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Country</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="country" value="<?php echo set_value('country',$before->country);?>">
				  </div>
				</div>
                  <div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Twitter social</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="twittersocial" value="<?php echo set_value('twittersocial',$before->twittersocial);?>">
				  </div>
				</div>
                  <div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Youtube social</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="youtubesocial" value="<?php echo set_value('youtubesocial',$before->youtubesocial);?>">
				  </div>
				</div>
                  <div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Facebook social</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="facebooksocial" value="<?php echo set_value('facebooksocial',$before->facebooksocial);?>">
				  </div>
				</div>
<!--                  //new fields end-->
				
                  
                  
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