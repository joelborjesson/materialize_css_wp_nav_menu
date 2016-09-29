<?php 
	function create_materialize_menu( $theme_location ) {
    	if ( ($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {
        	$menu_list = '<ul id="slide-out" class="side-nav" >';
         	$menu = get_term( $locations[$theme_location], 'nav_menu' );
        	$menu_items = wp_get_nav_menu_items($menu->term_id);
          
        	foreach( $menu_items as $menu_item ) {
            	if( $menu_item->menu_item_parent == 0 ) {
                	$parent = $menu_item->ID;
                	$menu_array = array();
                		foreach( $menu_items as $submenu ) {
							if( $submenu->menu_item_parent == $parent) {
                        		$bool = true;
                        		$menu_array[] = '<li><a href="' . $submenu->url . '">' . $submenu->title . '</a></li>' ."\n";
                        		$menu_array2[] = array("title"=>$submenu->title,"url"=>$submenu->url,"id"=>$submenu->ID);
                    		}

                		}
                		if( $bool == true && count( $menu_array ) > 0 ) {
                     		$menu_list .= '<li class="no-padding">' ."\n";
                        		$menu_list .= '<ul class="collapsible collapsible-accordion">' ."\n";
                            		$menu_list .= '<li>' ."\n";
                            			$menu_list .= '<a class="collapsible-header">' . $menu_item->title . '<i class="material-icons" style="float: right">arrow_drop_down</i></a>' ."\n";
                            			$menu_list .= '<div class="collapsible-body">' ."\n";
                                    		$menu_list .= '<ul>' ."\n";
                                    			foreach ($menu_array2 as $marray2) {
                                    				foreach ($menu_items as $menu_item) {
                                    					if ($menu_item->menu_item_parent == $marray2["id"]) {
                                    						$menu_list .= '<li class="no-padding">' ."\n";
                                    							$menu_list .= '<ul class="collapsible collapsible-accordion">' ."\n";
                                    								$menu_list .= '<li>' ."\n";
                                    									$special_id = $marray2["id"];
                                    									$menu_list .= '<a class="collapsible-header">' . $marray2["title"] . '<i class="material-icons" style="float: right">arrow_drop_down</i></a>' ."\n";
                                    									$menu_list .= '<div class="collapsible-body">' ."\n";
                                    										$menu_list .= '<ul>' ."\n";
                                    											$menu_list .= "<li class='collapsible-title'><a href='" . $menu_item->url . "'>" . $menu_item->title . "</a></li>";
                                    										$menu_list .= '</ul>' ."\n";
                                    									$menu_list .= '</div>' ."\n";
                                    								$menu_list .= '</li>' ."\n";
                                    							$menu_list .= '</ul>' ."\n";
                                    						$menu_list .= '</li>' ."\n";
                                    					}
                                    				}
                                    				if ($special_id == $marray2["id"]) {
                                    					// do nothing
                                    				}
                                    				else {
                                    					$menu_list .= "<li><a href='" . $marray2["url"] . "'>" . $marray2["title"] . "</a></li>";
                                    				}
                                    		}

                                    	$menu_list .= '</ul>' ."\n";
                                	$menu_list .= '</div>' ."\n";
                            	$menu_list .= '</li>' ."\n";
                        	$menu_list .= '</ul>' ."\n";
                     
                		}

                		else {
                     		$menu_list .= '<li>' ."\n";
                    		$menu_list .= '<a href="' . $menu_item->url . '">' . $menu_item->title . '</a></li>' ."\n";
                		}
                 
            	}
        	}
          
        	$menu_list .= '</li>' ."\n";
        	$menu_list .= '</ul>' ."\n";
  
    } 

    else {
        $menu_list = '<!-- no menu defined in location "'.$theme_location.'" -->';
    }
     
    echo $menu_list;
}



?>