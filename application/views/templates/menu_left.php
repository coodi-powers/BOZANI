
<div class="col-md-4">
    <ul class="nav nav-pills nav-stacked subnav-links">
        <?php

        foreach($left_menu_items as $menu_item): ?>
            <?php
            $active = "";
            if($page->id == $menu_item['id'])
            {
                $active = "active";
            }
            ?>
        <?php

        $sub = '';
        foreach ($left_menu_items_children[$menu_item['id']] as $menu_child)
        {
            $sub .=  '<li role="presentation" >'.$menu_child['title'].'</li>';
        }

        echo '<li role="presentation" class="'.$active.'"><a href="'.base_url('index.php/'.$menu_item['slug']).'" >'.$menu_item['title'].'</a>';

        if($sub != '')
        {
            echo '
            <div style="padding-left:20px;">
                <ul id="drilldown-'.$menu_item['id'].'" class="nav nav-pills nav-stacked collapse in">
            '.$sub .'
                </ul>
            </div>';
        }

        echo '</li>';

        endforeach; ?>
    </ul>
</div>
<div class="col-md-8">
    <div class="content-block text-center">
        <?php

        $arr_plugins = explode('[[DEFAULT_CONTENT]]', $plugins);

        echo $arr_plugins[0];

        ?>


        <h1><?php echo $page->title; ?></h1>
        <p>
            <?php echo $page->body; ?>
        </p>

        <?php

        $arr_plugins = explode('[[DEFAULT_CONTENT]]', $plugins);

        echo $arr_plugins[1];

        ?>
    </div>
</div>