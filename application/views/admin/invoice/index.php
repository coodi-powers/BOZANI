<?php

$arr_cat = array();

foreach($categories as $categorie)
{
    $arr_cat[$categorie->id] = $categorie->name;
}


$arr_map = array();

foreach($maps as $map)
{
    $arr_map[$map->id] = $map->name;
}


$arr_years = array('2013', '2014', '2015', '2016');

?>



<!-- Row Start -->
<div class="row">
    <div class="col-md-7 col-lg-7">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <nav class="navbar navbar-default" role="navigation" style="margin-bottom: 0;">
                    <div class="container">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-9">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#">Year</a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-9">
                            <ul class="nav navbar-nav">
                                <?php
                                foreach($arr_years as $year)
                                {
                                    ?>
                                    <li id="year_<?php echo $year; ?>" <?php

                                    if($current_year == $year)
                                    {
                                        echo 'class="active"';
                                    }

                                    ?>><?php echo anchor('admin/invoice/view/'.$year, $year, 'onclick="selectYear('.$year.')"'); ?></li>
                                <?php

                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Row End -->

<script>
    function selectYear(year)
    {
        var selection_months = '#months_';
        selection_months += year;

        var selection_year = '#year_';
        selection_year += year;

        <?php
       foreach($arr_years as $year)
       {
       ?>
            $('#months_<?php echo $year; ?>').addClass('hide');
            $('#year_<?php echo $year; ?>').removeClass('active');
        <?php
        }
        ?>

        $(selection_months).removeClass('hide');
        $(selection_year).addClass('active');
    }
</script>


<?php

foreach($arr_years as $year)
{ ?>

    <!-- Row Start -->
    <div class="row <?php

    if($current_year != $year)
    {
        echo 'hide';
    }

    ?>" id="months_<?php echo $year; ?>">
        <div class="col-md-12 col-lg-12">
            <nav class="navbar navbar-default" role="navigation">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-9">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#"><?php echo $year; ?></a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-9">
                        <ul class="nav navbar-nav">
                            <li <?php if($current_month == '01') echo 'class="active"'; ?>><?php echo anchor('admin/invoice/view/'.$year.'-01', 'Jan'); ?></li>
                            <li <?php if($current_month == '02') echo 'class="active"'; ?>><?php echo anchor('admin/invoice/view/'.$year.'-02', 'Feb'); ?></li>
                            <li <?php if($current_month == '03') echo 'class="active"'; ?>><?php echo anchor('admin/invoice/view/'.$year.'-03', 'Mar'); ?></li>
                            <li <?php if($current_month == '04') echo 'class="active"'; ?>><?php echo anchor('admin/invoice/view/'.$year.'-04', 'Apr'); ?></li>
                            <li <?php if($current_month == '05') echo 'class="active"'; ?>><?php echo anchor('admin/invoice/view/'.$year.'-05', 'May'); ?></li>
                            <li <?php if($current_month == '06') echo 'class="active"'; ?>><?php echo anchor('admin/invoice/view/'.$year.'-06', 'June'); ?></li>
                            <li <?php if($current_month == '07') echo 'class="active"'; ?>><?php echo anchor('admin/invoice/view/'.$year.'-07', 'July'); ?></li>
                            <li <?php if($current_month == '08') echo 'class="active"'; ?>><?php echo anchor('admin/invoice/view/'.$year.'-08', 'Aug'); ?></li>
                            <li <?php if($current_month == '09') echo 'class="active"'; ?>><?php echo anchor('admin/invoice/view/'.$year.'-09', 'Sep'); ?></li>
                            <li <?php if($current_month == '10') echo 'class="active"'; ?>><?php echo anchor('admin/invoice/view/'.$year.'-10', 'Oct'); ?></li>
                            <li <?php if($current_month == '11') echo 'class="active"'; ?>><?php echo anchor('admin/invoice/view/'.$year.'-11', 'Nov'); ?></li>
                            <li <?php if($current_month == '12') echo 'class="active"'; ?>><?php echo anchor('admin/invoice/view/'.$year.'-12', 'Dec'); ?></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Row End -->


<?php
}
?>

    </div>
    <div class="col-lg-3 col-md-3">
        <div class="widget">
            <div class="widget-header">
                <div class="title">
                    Filter
                </div>
                    <span class="tools">
                        <?php echo anchor('admin/invoice/edit', '<i class="icon-plus"></i> Reset'); ?>
                        <i class="fa fa-plus"></i>
                    </span>
            </div>
            <?php echo form_open_multipart(); ?>
            <div class="widget-body">
                <div class="row">
                    <div class="col-lg-4" style="text-align: right;">
                        <p>Category:</p>
                    </div>
                    <div class="col-lg-8">
                        <select id="cat" name="cat" class="form-control" style="width: 100%;">
                            <option value="0">-- Select --</option>
                            <?php
                            foreach($arr_cat as $cat=>$key)
                            {
                                echo '
                                <option value="'.$cat.'" ';

                                                if($invoice->cat == $cat)
                                                {
                                                    echo 'selected';
                                                }

                                                echo '>
                                    '.$key.'
                                </option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row" style="margin-top: 20px;">
                    <div class="col-lg-4" style="text-align: right;">
                        <p>Map:</p>
                    </div>
                    <div class="col-lg-8">
                        <select id="map" name="map" class="form-control" style="width: 100%;">
                            <option value="0">-- Select --</option>
                            <?php
                            foreach($arr_map as $map=>$key)
                            {
                                echo '
                                <option value="'.$map.'" ';

                                            if($invoice->map == $map)
                                            {
                                                echo 'selected';
                                            }

                                            echo '>
                                '.$key.'
                            </option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row" style="margin-top: 20px;">
                    <div class="col-lg-4" style="text-align: right;">
                        <p>Order by:</p>
                    </div>
                    <div class="col-lg-8">
                        <select id="orderby" name="orderby" class="form-control" style="width: 100%;">
                            <option value="0">-- Select --</option>
                            <option value="id">ID</option>
                            <option value="title">Title</option>
                            <option value="date">Date</option>
                        </select>
                    </div>
                </div>
                <div class="row" style="margin-top: 20px;">
                    <div class="col-lg-12" style="text-align: right;">
                        <?php echo form_submit('submit_filter', 'Filter', 'class="btn btn-primary" style="width: 100%;" id="submit_filter"'); ?>
                    </div>
                </div>
            </div>
            <?php echo form_close();?>
        </div>
    </div>

    <div class="col-lg-2 col-md-2">
        <div class="widget">
            <div class="widget-header">
                <div class="title">
                    Search
                </div>
            </div>
            <div class="widget-body">
                    <input type="text" class="search-query" placeholder="Search here ...">
                    <i class="fa fa-search"></i>
            </div>
        </div>
    </div>

</div>
<!-- Row Start -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="widget">
            <div class="widget-header">
                <div class="title">
                    Invoices
                </div>
                    <span class="tools">
                        <?php echo anchor('admin/invoice/edit', '<i class="icon-plus"></i> Add an invoice'); ?>
                      <i class="fa fa-plus"></i>
                    </span>
            </div>
            <div class="widget-body">
                <div class="table-responsive">
                    <table class="table table-condensed table-striped table-bordered table-hover no-margin">
                        <thead>
                        <tr>
                            <th style="width:5%">
                                #
                            </th>
                            <th style="width:40%">
                                Title
                            </th>
                            <th style="width:15%">
                                Date
                            </th>
                            <th style="width:15%" class="hidden-phone">
                                Category
                            </th>
                            <th style="width:15%" class="hidden-phone">
                                Map
                            </th>
                            <th style="width:10%" class="hidden-phone">

                            </th>
                        </tr>
                        </thead>
                        <tbody>
                    <?php if(count($invoices)): foreach($invoices as $invoice): ?>
                        <tr>
                            <td>
                                <?php echo anchor('admin/invoice/detail/' . $invoice->id, $invoice->id); ?>
                            </td>
                            <td>
                                <?php echo anchor('admin/invoice/detail/' . $invoice->id, $invoice->title); ?>
                            </td>
                            <td>
                                <?php echo $invoice->date; ?>
                            </td>
                            <td class="hidden-phone">
                                <?php echo $arr_cat[$invoice->cat]; ?>
                            </td>
                            <td class="hidden-phone">
                                <?php echo $arr_map[$invoice->map]; ?>
                            </td>
                            <!-- <td class="hidden-phone"><a href="<?php echo base_url('../uploads/'.$_SESSION['id']).'/'.$invoice->file;  ?>"><?php echo $invoice->file; ?></a></td> -->
                            <td class="hidden-phone">
                                <p style="text-align: center; margin-bottom: 0px;">
                                    <?php echo btn_edit_invoice(site_url("admin/invoice/edit/") . '/'.$invoice->id); ?>
                                    <?php echo btn_delete_invoice(site_url("admin/invoice/delete/") .'/'. $invoice->id); ?>
                                </p>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">We could not find any invoices.</td>
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