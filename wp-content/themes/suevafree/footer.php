<?php if ( !suevafree_setting('suevafree_view_footer') || suevafree_setting('suevafree_view_footer') == "on" ) : ?>
    
    <footer id="footer">

		<?php do_action( 'suevafree_bottom_sidebar' ); ?>

        <div class="container">
    
             <div class="row copyright" >
                
                <div class="col-md-5" >
                
					<?php do_action('suevafree_copyright'); ?>
				
                </div>
            
            	<?php if ( !suevafree_setting('suevafree_footer_social_buttons') || suevafree_setting('suevafree_footer_social_buttons') == "on" ) : ?>
                
                    <div class="col-md-7" >
        
                        <div class="social-buttons">
                        
                            <?php do_action( 'suevafree_socials' ); ?>
                        
                        </div>
                        
                    </div>
    
				<?php endif; ?>

            </div>
            
        </div>
    
    </footer>

<?php endif; ?>

</div>

<?php 

	if ( !suevafree_setting('suevafree_view_back_to_top') || suevafree_setting('suevafree_view_back_to_top') == "on" )
		
		echo '<div id="back-to-top" class="back-to-top"><i class="fa fa-chevron-up"></i></div>';

	wp_footer(); 
	
?>   

</body>

</html>