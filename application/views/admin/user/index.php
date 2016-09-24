
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Overzicht</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                            <tr>
                                <th>Naam</th>
                                <th>E-mailadres</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php if(count($users)): foreach($users as $user): ?>
                                <tr>
                                    <td><?php echo $user->username; ?></td>
                                    <td><?php echo $user->email; ?></td>
                                    <td class="icons">
                                        <a href="<?php echo anchor('admin/user/edit/'. $user->user_id, ''); ?>"><span class="label label-warning"><i class="fa fa-pencil"></i></span></a>
                                        <a href="<?php echo anchor('admin/user/delete/'.$user->user_id, ''); ?>"><span class="label label-danger"><i class="fa fa-times"></i></span></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3">Er werden geen gebruikers gevonden</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                        <a class="btn btn-primary dim" href="<?php echo anchor('admin/user/edit', ''); ?>"><i class="fa fa-plus"></i>&nbsp;Toevoegen</a>
                    </div>
                </div><!-- END CONTENT -->
            </div><!-- END IBOX -->
        </div><!-- END COL -->
    </div><!-- END ROW -->
</div><!-- END WRAPPER -->
