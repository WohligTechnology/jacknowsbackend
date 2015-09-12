<div id="page-title">
    <a class="btn btn-primary btn-labeled fa fa-plus margined pull-right" href="<?php echo site_url("site/createusergallery?id=".$user); ?>">Create</a>
    <h1 class="page-header text-overflow">usergallery Details </h1>
</div>
<div id="page-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel drawchintantable">
                <?php $this->chintantable->createsearch("usergallery List");?>
                <div class="fixed-table-container">
                    <div class="fixed-table-body">
                        <table class="table table-hover" id="" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th data-field="id">ID</th>
<!--                                    <th data-field="user">User</th>-->
                                    <th data-field="type">Type</th>
                                    <th data-field="image">Image</th>
                                    <th data-field="audio">Audio</th>
                                    <th data-field="video">Video</th>
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
            if(resultrow.type==0)
            {
            resultrow.image="<a href='<?php echo base_url('uploads').'/'; ?>"+resultrow.image+"' target='_blank'><img src='<?php echo base_url('uploads').'/'; ?>"+resultrow.image+"' width='80px' height='80px'></a>";
            }
            if(resultrow.type==0)
                resultrow.type="Image";
            else if(resultrow.type==1)
                resultrow.type="Audio";
            else if(resultrow.type==2)
                resultrow.type="Video";
            return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.type + "</td><td>" + resultrow.image + "</td><td>" + resultrow.audio + "</td><td>" + resultrow.video + "</td><td><a class='btn btn-primary btn-xs' href='<?php echo site_url('site/editusergallery?id=');?>" + resultrow.user + "&galleryid="+resultrow.id+"'><i class='icon-pencil'></i></a><a class='btn btn-danger btn-xs' onclick=return confirm(\"Are you sure you want to delete?\") href='<?php echo site_url('site/deleteusergallery?id='); ?>" + resultrow.user + "&galleryid="+resultrow.id+"'><i class='icon-trash '></i></a></td></tr>";
        }
        generatejquery("<?php echo $base_url;?>");
    </script>
</div>
