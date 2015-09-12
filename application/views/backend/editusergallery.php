<section class="panel">
    <header class="panel-heading">
        <h3 class="panel-title">usergallery Details </h3>
    </header>
    <div class="panel-body">
        <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/editusergallerysubmit");?>' enctype='multipart/form-data'>
            <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$beforegallery->id);?>" style="display:none;">
            <div class=" form-group" style="display:none;">
                <label class="col-sm-2 control-label" for="normal-field">User</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="user" value='<?php echo set_value(' user ',$beforegallery->user);?>'>
                </div>
            </div>
            <div class=" form-group">
                <label class="col-sm-2 control-label" for="normal-field">Type</label>
                <div class="col-sm-4">
                    <?php echo form_dropdown( "type",$type,set_value( 'type',$beforegallery->type),"id='select88' class='chzn-select form-control' onchange='changetype()'");?>
                </div>
            </div>
           <?php
            if($beforegallery->type==0)
            {
            ?> 
                <div class=" form-group imageclass">
            <?php
            }
            else
            {
            ?>
            <div class=" form-group imageclass" style="display:none;">
            <?php
            }
            ?>
                <label class="col-sm-2 control-label" for="normal-field">Image</label>
                <div class="col-sm-4">
					<input type="file" id="normal-field" class="form-control" name="image" value="<?php echo set_value('image',$beforegallery->image);?>">
					<?php if($beforegallery->image == "")
						 { }
						 else
						 { ?>
							<img src="<?php echo base_url('uploads')."/".$beforegallery->image; ?>" width="140px" height="140px">
						<?php }
					?>
				  </div>
            </div>
            <?php
            if($beforegallery->type==1)
            {
            ?> 
                <div class=" form-group audioclass">
            <?php
            }
            else
            {
            ?>
            <div class=" form-group audioclass" style="display:none;">
            <?php
            }
            ?>
                <label class="col-sm-2 control-label" for="normal-field">Audio</label>
                <div class="col-sm-4">
                    <input type="file" id="normal-field" class="form-control" name="audio" value='<?php echo set_value(' audio ',$beforegallery->audio);?>'>
                </div>
            </div>
            <?php
            if($beforegallery->type==2)
            {
            ?> 
                <div class=" form-group videoclass">
            <?php
            }
            else
            {
            ?>
            <div class=" form-group videoclass" style="display:none;">
            <?php
            }
            ?>
                <label class="col-sm-2 control-label" for="normal-field">Video</label>
                <div class="col-sm-4">
                    <input type="file" id="normal-field" class="form-control" name="video" value='<?php echo set_value(' video ',$beforegallery->video);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href='<?php echo site_url("site/viewusergallery?id=".$user); ?>' class='btn btn-secondary'>Cancel</a>
                </div>
            </div>
        </form>
    </div>
</section>
<script>
    function changetype() {
        console.log($('#select88').val());
        if($('#select88').val()==0)
        {
            $( ".imageclass" ).show();
            $( ".videoclass" ).hide();
            $( ".audioclass" ).hide();
        }
        else if($('#select88').val()==1)
        {
            $( ".audioclass" ).show();
            $( ".videoclass" ).hide();
            $( ".imageclass" ).hide();
        }
        else if($('#select88').val()==2)
        {
           $( ".videoclass" ).show();
            $( ".audioclass" ).hide();
            $( ".imageclass" ).hide();
        }
        else
        {
            $( ".imageclass" ).hide();
            $( ".audioclass" ).hide();
            $( ".videoclass" ).hide();
        }
    }
        </script>
