<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 14/05/15
 * Time: 22:03
 */

class Menu_m extends MY_Model
{
    protected $_table_name = 'tbl_menu';
    protected $_order_by = 'naam';
    public $_rules = array(
        'naam' => array(
            'field' => 'naam',
            'label' => 'Naam',
            'rules' => 'trim|xss_clean|required|max_length[100]'
        )
    );

    public function get_new ()
    {
        $menu = new stdClass();
        $menu->naam = '';
        return $menu;
    }

    public function delete ($id)
    {
        // Delete a menu
        parent::delete($id);
    }

    public function get_all ()
    {
        // Fetch pages without parents
        $this->db->select('menu_id, naam');
        $menus = parent::get();

        // Return key => value pair array
        $array = array(
            0 => 'Niet in menu tonen'
        );
        if (count($menus)) {
            foreach ($menus as $menu) {
                $array[$menu->menu_id] = $menu->naam;
            }
        }

        return $array;
    }
}
