<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

// Helper menu dinamis
function getParentMenu($kodeMenu)
{
    $sql = 'SELECT `menu`.`parent` FROM menu WHERE `kodeMenu` = ' . "'$kodeMenu'";
    $query = DB::select($sql);

    if (count($query) > 0) {
        $hasil = $query[0]->parent;
    } else {
        $hasil = 'KOSONG';
    }
    return $hasil;
}

function getMenuDetail($kodeMenu)
{
    $sql = 'SELECT `menu`.* FROM menu WHERE `menu`.`kodeMenu`="' . $kodeMenu . '" LIMIT 1';
    return DB::select($sql);
}

function getMenu($kodeMenu)
{
    $sql = "SELECT menu.*, icon.nameIcon AS icon_name FROM menu LEFT JOIN icon ON menu.id_icon = icon.id_icon  WHERE type = 'Parent' GROUP BY menu.kodeMenu, menu.id_menu, menu.type, menu.parent, menu.sort, menu.nameMenu, menu.id_icon, menu.URL, icon.nameIcon ORDER BY menu.sort asc";
    $result = DB::select($sql);
    $parent_kode_menu = getParentMenu($kodeMenu);

    $menu = '';

    if (count($result) > 0) {
        foreach ($result as $temp) {
            if (empty($temp->parent)) {
                $parent = getMenuDetail($temp->kodeMenu);

                $parent_active = '';
                if ($parent[0]->kodeMenu == $parent_kode_menu) {
                    $parent_active = 'mm-active';
                }
            } else {
                $parent = getMenuDetail($temp->parent);

                $parent_active = '';
                if ($parent[0]->kode == $parent_kode_menu) {
                    $parent_active = 'mm-active';
                }
            }

            $kodeMenu2 = $parent[0]->kodeMenu;

            $sql_child = "SELECT menu.*, icon.nameIcon AS icon_name FROM menu LEFT JOIN icon ON menu.id_icon = icon.id_icon  WHERE menu.`type`='Child' AND menu.parent='$kodeMenu2' ORDER BY menu.`sort` ASC";
            $result_child = DB::select($sql_child);

            $menu_child = '';
            $menu_child_count = 0;
            if (count($result_child) > 0) {
                $menu_child .= '<ul class="mm-collapse">';
                foreach ($result_child as $child) {
                    $child_active = '';
                    if ($kodeMenu == $child->kodeMenu) {
                        $child_active = 'mm-active';
                    }

                    $menu_child .=
                        '<li class="' . $child_active . '">
                    <a href="' . $child->URL . '">
                    <i class="bx bx-right-arrow-alt"></i>' . $child->nameMenu . '
                    </a></li>';

                    $menu_child_count++;
                }
                $menu_child .= '</ul>';
            }

            $toggle = '';
            if ($menu_child_count > 0) {
                $toggle = 'has-arrow';
            }

            if ($menu_child_count > 0) {
                $menu = $menu . '
                <li class="' . $parent_active . '">
                    <a href="javascript:;" class="' . $toggle . '">
                        <div class="parent-icon">
                        <i class="' . $temp->icon_name . '"></i>
                        </div>
                        <div class="menu-title">' . $parent[0]->nameMenu . '</div>
                    </a>
                    ' . $menu_child . '
                </li>';
            } else {
                $menu = $menu . '
                <li class="' . $parent_active . '">
                    <a href="' . $parent[0]->URL . '">
                        <div class="parent-icon"><i class="' . $temp->icon_name . '"></i></div>
                        <div class="menu-title">' . $parent[0]->nameMenu . '</div>
                    </a>
                </li>';
            }
        }
        return $menu;
    }
}