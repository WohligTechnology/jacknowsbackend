<div id="page-title">
    <a class="btn btn-primary btn-labeled fa fa-plus margined pull-right" href="<?php echo site_url("site/createbooking"); ?>">Create</a>
    <h1 class="page-header text-overflow">booking Details </h1>
</div>
<div id="page-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel drawchintantable">
                <?php $this->chintantable->createsearch("booking List");?>
                <div class="fixed-table-container">
                    <div class="fixed-table-body">
                        <table class="table table-hover" id="" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th data-field="id">ID</th>
                                    <th data-field="fromusername">From User</th>
                                    <th data-field="tousername">To User</th>
                                    <th data-field="date">Date</th>
                                    <th data-field="starttime">Start Time</th>
                                    <th data-field="endtime">End Time</th>
                                    <th data-field="status">Status</th>
                                    <th data-field="View Details">View Details</th>
                                    <th data-field="Action">Action</th>
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
            var details="<a class='btn btn-primary btn-labeled fa fa-plus margined' href='<?php echo site_url("site/viewdetailsofbooking?id="); ?>"+resultrow.id+"'>View Details</a>";
            return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.fromusername + "</td><td>" + resultrow.tousername + "</td><td>" + resultrow.date + "</td><td>" + resultrow.starttime + "</td><td>" + resultrow.endtime + "</td><td>" + resultrow.status + "</td><td>" + details + "</td><td><a class='btn btn-primary btn-xs' href='<?php echo site_url('site/editbooking?id=');?>" + resultrow.id + "'><i class='icon-pencil'></i></a><a class='btn btn-danger btn-xs' onclick=return confirm(\"Are you sure you want to delete?\") href='<?php echo site_url('site/deletebooking?id='); ?>" + resultrow.id + "'><i class='icon-trash '></i></a></td></tr>";
        }
        generatejquery("<?php echo $base_url;?>");
    </script>
</div>
</div>
