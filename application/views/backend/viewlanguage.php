<div id="page-title">
    <a class="btn btn-primary btn-labeled fa fa-plus margined pull-right" href="<?php echo site_url("site/createlanguage?id=".$user); ?>">Create</a>
    <h1 class="page-header text-overflow">language Details </h1>
</div>
<div id="page-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel drawchintantable">
                <?php $this->chintantable->createsearch("language List");?>
                <div class="fixed-table-container">
                    <div class="fixed-table-body">
                        <table class="table table-hover" id="" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th data-field="id">ID</th>
<!--
                                    <th data-field="languageid">Language Id</th>
                                    <th data-field="user">User</th>
-->
                                    <th data-field="languagename">Language Name</th>
<!--                                    <th data-field="proficiancylevel">Proficiancy Level</th>-->
                                    <th data-field="proficiancyname">Proficiancy Name</th>
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
            return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.languagename + "</td><td>" + resultrow.proficiancyname + "</td><td><a class='btn btn-primary btn-xs' href='<?php echo site_url('site/editlanguage?id=');?>" + resultrow.user + "&languageid="+resultrow.id+"'><i class='icon-pencil'></i></a><a class='btn btn-danger btn-xs' onclick=return confirm(\"Are you sure you want to delete?\") href='<?php echo site_url('site/deletelanguage?id='); ?>" + resultrow.user + "&languageid="+resultrow.id+"'><i class='icon-trash '></i></a></td></tr>";
        }
        generatejquery("<?php echo $base_url;?>");
    </script>
</div>
