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

?>



<h3><?php echo empty($invoice->id) ? 'Add a new invoice' : 'Edit invoice : ' . $invoice->title; ?></h3>

<?php echo validation_errors(); ?>
<?php echo form_open_multipart(); ?>
<table class="table">
    <tr>
        <td>Title</td>
        <td><?php echo form_input('title', set_value('title', $invoice->title)); ?></td>
    </tr>
    <tr>
        <td>Category</td>
        <td>
            <select id="cat" name="cat" class="form-control" style="width: 20%;">
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
        </td>
    </tr>
    <tr>
        <td>Map</td>
        <td>
            <select id="map" name="map" class="form-control" style="width: 20%;">
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
        </td>
    </tr>
    <tr>
        <td>Date</td>
        <td><?php echo form_input('date', set_value('date', $invoice->date), 'class="datepicker"'); ?></td>
    </tr>
    <tr>
        <td>Extra</td>
        <td><?php echo form_textarea('extra', set_value('extra', $invoice->extra, FALSE), 'class="textarea form-control" id="ckeditor1"'); ?></td>
    </tr>
    <tr>
        <td>File</td>
        <td><input type="file" name="userfile" size="20" /></td>
    </tr>
    <tr>
        <td></td>
        <td><div class="widget-body">
                <div class="hero-unit">
            <?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?></td>
        </div>
        </div>
    </tr>
</table>
<?php echo form_close();?>

