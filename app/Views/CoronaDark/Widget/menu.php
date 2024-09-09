<?php
    function renderMenu($menu){
        $strMenu = '';
        if(sizeof($menu)){
            foreach($menu as $mn){
                if(sizeof($mn['anak'])){
                    $strMenu .= view_cell('\App\Libraries\Widget::parentMenu', [
                        'menu' => $mn,
                        'menuAnak' => renderMenu($mn['anak'])
                    ]);
                }else{
                    $strMenu.= view_cell('\App\Libraries\Widget::actionMenu', $mn);
                }
            }
        }
        return $strMenu;
    }
    $strMenu = renderMenu($menu);
?>
<?= $strMenu ?>