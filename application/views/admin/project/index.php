
<!-- Row Start -->
<div class="row">
    <div class="col-lg-8 col-md-8">
        <div class="widget">
            <div class="widget-header">
                <div class="title">
                    projects
                </div>
                    <span class="tools">
                        <?php echo anchor('admin/project/edit', '<i class="icon-plus"></i> Add an project'); ?>
                      <i class="fa fa-plus"></i>
                    </span>
            </div>
            <div class="widget-body">
                <div class="table-responsive">
                    <table class="table table-condensed table-striped table-bordered table-hover no-margin">
                        <thead>
                        <tr>
                            <th style="width:70%">
                                Title
                            </th>
                            <th style="width:30%">
                                Categorie
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                    <?php if(count($projects)): foreach($projects as $project): ?>
                        <tr>
                            <td>
                                <?php echo anchor('admin/project/detail/' . $project->id, $project->title); ?>
                            </td>
                            <td>
                                <?php echo $project->cat_id; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">We could not find any projects.</td>
                        </tr>
                    <?php endif;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Row End -->