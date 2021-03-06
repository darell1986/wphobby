<?php

/**
 * Wp in Progress
 * 
 * @package Wordpress
 * @author WPinProgress
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * It is also available at this URL: http://www.gnu.org/licenses/gpl-3.0.txt
 */

if (!function_exists('suevafree_header_layout_4_function')) {

	function suevafree_header_layout_4_function($menu) { 
		
			do_action( 'suevafree_mobile_menu', $menu );
		
	?>

            <div id="wrapper">
        
                <div id="overlay-body"></div>
				
                <div id="header-wrapper" class="fixed-header header-4" >
                        
                    <header id="header" >
                        
                        <div class="container">
                        
                            <div class="row">
                                    
                                <div class="col-md-2" >
                                
                                	<div id="logo">
									
                                    	<?php do_action( 'suevafree_logo_layout', 'off' ); ?>
                                	
                                    </div>

                                </div>

                                <div class="col-md-10" >
                                 
                                    <nav class="suevafree-menu suevafree-general-menu">
                                            
                                        <?php 
										
											wp_nav_menu( array(
                                        		'theme_location' => $menu,
                                        		'menu_class' => $menu,
												'container' => 'false',
												'depth' => 3
												)
											); 
										
										?>
                                        
                                    </nav> 

                                    <div class="mobile-navigation"><i class="fa fa-bars"></i> </div>

                                </div>
            
                            </div>
                            
                        </div>
                                    
                    </header>
            
                </div>
            
<?php
		
	}

	add_action( 'suevafree_header_layout_4', 'suevafree_header_layout_4_function', 10, 2 );

}

?>