
<div class="row">
	<div class="col-lg-12">
		<section class="panel">
			<header class="panel-heading">
                Booking Details
                <style>
                    tr
                    {
                    text-align:center;
                    }
                    th
                    {
                    text-align:center;
                    }
</style>
            </header>
            <div class="row">
               <div class="col-lg-3">
                   
               </div>
               <div class="col-lg-6">
                   <table class="table table-striped table-hover border-top " id="sample_1" cellpadding="0" cellspacing="0" >
                        <tr>
                            <th>From User</th>
                            <th></th>
                            <th>To User</th>
                        </tr>
                        <tr>
                            <td><?php echo $booking->fromusername;?></td>
                            <td></td>
                            <td><?php echo $booking->tousername; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $booking->fromcontact;?></td>
                            <td></td>
                            <td><?php echo $booking->tocontact; ?></td>
                        </tr>
                        <tr>
                            <th></th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><?php echo $booking->date; ?></td>
                            <td>&nbsp;</td>
                        </tr>
                          <tr>
                            <th>Start Time</th>
                            <th></th>
                            <th>End Time</th>
                        </tr>
                        <tr>
                            <td><?php echo $booking->starttime;?></td>
                            <td></td>
                            <td><?php echo $booking->endtime; ?></td>
                        </tr>
                          <tr>
                            <th></th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>
                    <?php echo form_dropdown( "status",$status,set_value( 'status',$booking->statusid),"id='select88' class='chzn-select form-control' onchange='changestatus()'");?>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        
<!--
                        <tr>
                            <th></th>
                            <th>Status</th>
                            <th></th>
                        </tr>
-->
<!--
                        <tr>
                            <td>&nbsp;</td>
                            <td>
                    <a class="btn btn-primary btn-labeled fa fa-plus margined pull-right" href="<?php echo site_url("site/changeuser?id=".$booking->id."&"); ?>">Create</a>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
-->
                           
                    </table>
               </div>
               <div class="col-lg-3">
                   
               </div>
                
            </div>
            
			
		</section>
	</div>
  </div>
<script>

    function changestatus() {
        var bookingid="<?php echo $booking->id;?>";
//        console.log(bookingid);
//        console.log($("#select88").val());
        $.getJSON(
            "<?php echo base_url(); ?>index.php/site/changestatus", {
                id: bookingid,
                status: $("#select88").val()
            },
            function (data) {
                console.log(data);
                nodata=data;
                alert("status Changes!!!");
//                changeexternalamenitydropdown(data);

            }

        );
    }
</script>