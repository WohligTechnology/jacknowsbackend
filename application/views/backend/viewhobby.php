<div id="page-title">
<a class="btn btn-primary btn-labeled fa fa-plus margined pull-right" href="<?php echo site_url("site/createhobby?id=").$this->input->get('id'); ?>">Create</a>
<h1 class="page-header text-overflow">hobby Details </h1>
</div>
<div id="page-content">
<div class="row">
<div class="col-lg-12">
<div class="panel drawchintantable">
<?php $this->chintantable->createsearch("hobby List");?>
<div class="fixed-table-container">
<div class="fixed-table-body">
<table class="table table-hover" id="" cellpadding="0" cellspacing="0">
<thead>
<tr>
<th data-field="id">ID</th>
<!--<th data-field="user">User</th>-->
<th data-field="category">Category</th>
<th data-field="expinyrs">Experience In Years</th>
<th data-field="description">Description</th>
<!--<th data-field="skills">Skills</th>-->
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
return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.category + "</td><td>" + resultrow.expinyrs + "</td><td>" + resultrow.description + "</td><td><a class='btn btn-primary btn-xs' href='<?php echo site_url('site/edithobby?id=');?>"+resultrow.id+"&userid="+resultrow.userid+"'><i class='icon-pencil'></i></a><a class='btn btn-danger btn-xs' onclick=\"return confirm('Are you sure you want to delete?');\" href='<?php echo site_url('site/deletehobby?id='); ?>"+resultrow.id+"&userid="+resultrow.userid+"'><i class='icon-trash '></i></a></td></tr>";
}
generatejquery("<?php echo $base_url;?>");
</script>
</div>
