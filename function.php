<?php 
/**
* Codes to add meta box functionality to the 
* Features
* Product -  Themes
**/
$nameAFTArray = '';
global $nameAFTArray;
	function add_featuresthemes_meta_box_themes() {
		add_meta_box( 
			'featuresthemes-meta-box-themes', 
			'Features PRO for Theme', 
			'featuresthemes_field_meta_box_themes', 
			'deals', //deals
			'advanced', 
			'high', 
			null 
		);
	}
	add_action('add_meta_boxes', 'add_featuresthemes_meta_box_themes');


	function featuresthemes_field_meta_box_themes($object) {
		wp_nonce_field(basename(__FILE__), "featuresthemes-meta-box-nonce-themes");

		?>
		<table class="form-table">
		<?php

		global $post;

    	$args = array(
			'posts_per_page'   => '',
			
			'post_type'        => 'dealfeatures',
			'post_status'      => 'publish',
			'suppress_filters' => true 
		);
		$posts_array = get_posts( $args ); 




		foreach ( $posts_array as $post ) : setup_postdata( $post ); 
		
			$post_id = get_the_ID();

			global $queryFTID;
			global $queryFTTitle;
			global $queryFTDesc;
			global $queryFTContent;

			global $featArrayID;


			$queryFTID = 'metaf-' . $post_id;
			$queryFTTitle = get_the_title();
			$queryFTDesc = get_the_content();
			$queryFTContent = '';

			$featArrayID = array();
			$featArrayID[] = $queryFTID;

			


			
		?>
			<tr>
				<td class="team_meta_box_td" colspan="2">
					<label for="theme_title"><?php echo $queryFTTitle; echo ' ("'. $queryFTID . '")'; ?>
					</label>
				</td>
				<td colspan="4">
		            <?php
		                $checkbox_value = get_post_meta($object->ID, $queryFTID, true);

		                if($checkbox_value == "")
		                {
		                    ?>
		                        <input name="<?php echo $queryFTID;?>" type="checkbox" value="true">
		                    <?php
		                }
		                else if($checkbox_value == "true")
		                {
		                    ?>  
		                        <input name="<?php echo $queryFTID;?>" type="checkbox" value="true" checked>
		                    <?php
		                }
		            ?>
				</td>    
				 <td colspan="4">       
				    
					<p class="description"><?php _e( $queryFTDesc, 'themes-themes-text-domain' ); ?></p>
				</td>
			</tr>

		<?php 

		endforeach; 


		var_dump($featArrayID);

		wp_reset_postdata();


		
		?>


		</table>

			<?php
			
	} //featuresthemes_field_meta_box_themes






	function save_featuresthemes_meta_box_themes($post_id, $post, $update, $featArrayID) {
		global $post;
		if (!isset($_POST['featuresthemes-meta-box-nonce-themes']) || !wp_verify_nonce($_POST['featuresthemes-meta-box-nonce-themes'], basename(__FILE__)))
			return $post_id;

		if(!current_user_can( 'edit_post', $post_id ))
			return $post_id;

		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
			return $post_id;

		$slug = "deals";//deals
    	if($slug != $post->post_type)
        	return $post_id;
        


        $feaArray[] = 'metaf-100';
        $feaArray[] = 'metaf-96';
        // This array works but i want it to be dynamic and get all id as foreach for all the post type features.
        //and then pass it to the below foreach to save and update.

        foreach ($featArrayID as $feaKey) {
        	$metaFea[$feaKey] = ( isset( $_POST[$feaKey] ) ? esc_textarea( $_POST[$feaKey] ) : '' );
        }


        /* Gets value from above array/foreach & then saves the metadata */
		foreach ($metaFea as $fkey => $fvalue) {
		 	update_post_meta( $post->ID, $fkey, $fvalue );
		} 


	} //save_themes_meta_box_themes
	add_action("save_post", "save_featuresthemes_meta_box_themes", 10, 3);
