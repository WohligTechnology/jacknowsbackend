<div id="page-title">
<a class="btn btn-primary btn-labeled fa fa-plus margined pull-right" href="<?php echo site_url("site/createprofessionaward?id=").$this->input->get('id')."&userid=".$this->input->get('userid'); ?>">Create</a>
<h1 class="page-header text-overflow">professionaward Details </h1>
</div>
<div id="page-content">
<div class="row">
<div class="col-lg-12">
<div class="panel drawchintantable">
<?php $this->chintantable->createsearch("professionaward List");?>
<div class="fixed-table-container">
<div class="fixed-table-body">
<table class="table table-hover" id="" cellpadding="0" cellspacing="0">
<thead>
<tr>
<th data-field="id">ID</th>
<th data-field="user">User</th>
<th data-field="profession">Profession</th>
<th data-field="website">Website</th>
<th data-field="videolink">Video Link</th>
<th data-field="photo">photo</th>
</tr>
</thead>
<tbody>
</tbody>
</table>
</div>
<div class="fixed-table-pagination" style="display: block;">
<div class="pull-left pagination-detail">
<?php $this->chintantable->createpagination();?>
</div>
</div>
</div>
</div>
</div>
</div>
<script>
function drawtable(resultrow) {
    var photo="<a href='<?php echo base_url('uploads').'/'; ?>"+resultrow.photo+"' target='_blank'><img src='<?php echo base_url('uploads').'/'; ?>"+resultrow.photo+"' width='80px' height='80px'></a>";
                if(resultrow.photo=="")
                {
                photo="No Receipt Available";
                }
return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.user + "</td><td>" + resultrow.profession + "</td><td>" + resultrow.website + "</td><td>" + resultrow.videolink + "</td><td>" + photo + "</td><td><a class='btn btn-primary btn-xs' href='<?php echo site_url('site/editprofessionaward?id=');?>"+resultrow.id+"&professionid="+resultrow.professionid+"&userid="+resultrow.userid+"'><i class='icon-pencil'></i></a><a class='btn btn-danger btn-xs' onclick=\"return confirm('Are you sure you want to delete?');\" href='<?php echo site_url('site/deleteprofessionaward?id='); ?>"+resultrow.id+"&professionid="+resultrow.professionid+"&userid="+resultrow.userid+"'><i class='icon-trash '></i></a></td></tr>";
}
generatejquery("<?php echo $base_url;?>");
</script>
</div>
