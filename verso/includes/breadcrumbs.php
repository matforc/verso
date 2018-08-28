<?php 	

#-----------------------------------------------------------------#
# Breadcrumb
#-----------------------------------------------------------------#
if (!function_exists('santos_breadcrumbs')) {
function santos_breadcrumbs() {

       global $options;
		global $post;
		
		$santos_options = get_option('santos_options');
		
		$delimiter = '<span> &#47; </span>';
	
        echo '<div class="breadcrumb"><div class="inner">';

				if (!is_front_page()) {
						echo '<a href="';
						echo esc_url( home_url() );
						echo '">' . esc_html__('Home', 'santos');
						echo "</a>" . $delimiter;
				}
				
				if (function_exists('is_woocommerce') && is_woocommerce() && is_archive()) {
						$shop_page_id = wc_get_page_id('shop');
						$shop_page = get_post($shop_page_id);
						$permalinks = get_option('woocommerce_permalinks');
						if ($shop_page_id && $shop_page && get_option('page_on_front') !== $shop_page_id) {
								//echo '<a href="' . esc_url(get_permalink($shop_page)) . '">' . $shop_page->post_title . '</a> ';
								echo esc_attr($shop_page->post_title);
						}
				}
				
				
				else if( get_post_type() == 'post' && !is_category() && !is_author() && !is_tag() && !is_single() && !is_search() && !is_404() ) {
				echo esc_attr($santos_options['blog_page_title']).' ';    
				}
				
				
				
				if (is_category() && !is_singular('santos-portfolio')) {
						
						$category = get_the_category();
						$ID = $category[0]->cat_ID;
						
						echo is_wp_error($cat_parents = get_category_parents($ID, TRUE, ' <span>/</span> ')) ? '' : '<span class="breadcrumb-categories-holder">' . $cat_parents . '</span>';
						
				} 

				else if (is_single() && !is_attachment()) {
						
						if (get_post_type() == 'product') {
								
								if ($terms = wc_get_product_terms($post->ID, 'product_cat', array(
										'orderby' => 'parent',
										'order' => 'DESC'
								))) {
										
										$main_term = $terms[0];
										
										$ancestors = get_ancestors($main_term->term_id, 'product_cat');
										
										$ancestors = array_reverse($ancestors);
										
										foreach ($ancestors as $ancestor) {
												$ancestor = get_term($ancestor, 'product_cat');
												
												if (!is_wp_error($ancestor) && $ancestor) echo '<a href="' . get_term_link($ancestor->slug, 'product_cat') . '">' . $ancestor->name . '</a>' . $delimiter;
										}
										
										echo '<a href="' . get_term_link($main_term->slug, 'product_cat') . '">' . $main_term->name . '</a>' . $delimiter;
								}
								
								echo get_the_title();
						} 
						elseif (is_singular('santos-portfolio')) {
								$portfolio_category = get_the_terms($post->ID, 'santos-portfolio-category');
								if (!empty($portfolio_category)) {
										echo '<a href="'. get_term_link( $portfolio_category[0]->slug, 'santos-portfolio-category' ) .'">'.$portfolio_category[0]->name .'</a>'. $delimiter;
								}
								echo '<span>' . get_the_title() . '</span>';
								
								
						} 
						elseif (get_post_type() != 'post') {
				
								if (function_exists('is_bbpress') && is_bbpress()) {
								} 
								else {
										$post_type = get_post_type_object(get_post_type());
										$slug = $post_type->rewrite;
										echo '<a href="' . get_post_type_archive_link(get_post_type()) . '">' . $post_type->labels->singular_name . '</a>' . $delimiter;
										echo get_the_title();
								}
						} 
						else {
								$cat = current(get_the_category());
								echo get_category_parents($cat, true, $delimiter);
								echo get_the_title();
						}
				} 
				elseif (is_page() && !$post->post_parent) {
				
			
						
						echo get_the_title();
				} 
				elseif (is_page() && $post->post_parent) {
						
						$parent_id = $post->post_parent;
						$breadcrumbs = array();
						
						while ($parent_id) {
								$page = get_page($parent_id);
								$breadcrumbs[] = '<a href="' . esc_url(get_permalink($page->ID)) . '">' . get_the_title($page->ID) . '</a>';
								$parent_id = $page->post_parent;
						}
						
						$breadcrumbs = array_reverse($breadcrumbs);
						
						foreach ($breadcrumbs as $crumb) echo do_shortcode($crumb . '' . $delimiter);
						
						echo get_the_title();
				} 
				elseif (is_attachment()) {
						
						$parent = get_post($post->post_parent);
						$cat = get_the_category($parent->ID);
						if($cat){
						$cat = $cat[0];
						}
						
						echo is_wp_error($cat_parents = get_category_parents($cat, TRUE, '' . $delimiter . '')) ? '' : $cat_parents;
						
					
						echo '<a href="' . esc_url(get_permalink($parent)) . '">' . $parent->post_title . '</a>' . $delimiter;
						echo get_the_title();
				} 
				elseif (is_search()) {
						
						echo esc_html__('Search results for &ldquo;', 'santos') . get_search_query() . '&rdquo;';
				} 
				elseif (is_404()) {
						
						echo esc_html__('404', 'santos');
				} 
				elseif (is_tag()) {
						
						echo esc_html__('Tag &ldquo;', 'santos') . single_tag_title('', false) . '&rdquo;';
				} 
				elseif (is_author()) {
						
						$userdata = get_userdata(get_the_author_meta('ID'));
						echo esc_html__('Author:', 'santos') . ' ' . $userdata->display_name;
				} 
				elseif (is_day()) {
						
						echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $delimiter;
						echo '<a href="' . get_month_link(get_the_time('Y') , get_the_time('m')) . '">' . get_the_time('F') . '</a>' . $delimiter;
						echo get_the_time('d');
				} 
				elseif (is_month()) {
						
						echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $delimiter;
						echo get_the_time('F');
				} 
				elseif (is_year()) {
						
						echo get_the_time('Y');
				}
				
				if (get_query_var('paged')) echo ' (' . esc_html__('Page', 'santos') . ' ' . get_query_var('paged') . ')';
				
				if (is_tax()) {
						$term = get_term_by('slug', get_query_var('term') , get_query_var('taxonomy'));
						if (function_exists('is_woocommerce') && is_woocommerce() && is_archive()) {
								echo esc_attr($delimiter);
						}
						
						echo '<span>' . esc_attr($term->name) . '</span>';
				}
				
				if (function_exists('is_bbpress') && is_bbpress()) {
						$item = array();
						
						$post_type_object = get_post_type_object(bbp_get_forum_post_type());
						
						if (!empty($post_type_object->has_archive) && !bbp_is_forum_archive()) {
								$item[] = '<a href="' . get_post_type_archive_link(bbp_get_forum_post_type()) . '">' . bbp_get_forum_archive_title() . '</a>';
						}
						
						if (bbp_is_forum_archive()) {
								$item[] = bbp_get_forum_archive_title();
						} 
						elseif (bbp_is_topic_archive()) {
								$item[] = bbp_get_topic_archive_title();
						} 
						elseif (bbp_is_single_view()) {
								$item[] = bbp_get_view_title();
						} 
						elseif (bbp_is_single_topic()) {
								
								$topic_id = get_queried_object_id();
								
								$item = array_merge($item, santos_breadcrumbs_get_parents(bbp_get_topic_forum_id($topic_id)));
								
								if (bbp_is_topic_split() || bbp_is_topic_merge() || bbp_is_topic_edit()) $item[] = '<a href="' . bbp_get_topic_permalink($topic_id) . '">' . bbp_get_topic_title($topic_id) . '</a>';
								else $item[] = bbp_get_topic_title($topic_id);
								
								if (bbp_is_topic_split()) $item[] = esc_html__('Split', 'santos');
								elseif (bbp_is_topic_merge()) $item[] = esc_html__('Merge', 'santos');
								elseif (bbp_is_topic_edit()) $item[] = esc_html__('Edit', 'santos');
						} 
						elseif (bbp_is_single_reply()) {
								
								$reply_id = get_queried_object_id();
								
								$item = array_merge($item, santos_breadcrumbs_get_parents(bbp_get_reply_topic_id($reply_id)));
								
								if (!bbp_is_reply_edit()) {
										$item[] = bbp_get_reply_title($reply_id);
								} 
								else {
										$item[] = '<a href="' . bbp_get_reply_url($reply_id) . '">' . bbp_get_reply_title($reply_id) . '</a>';
										$item[] = esc_html__('Edit', 'santos');
								}
						} 
						elseif (bbp_is_single_forum()) {
								
								$forum_id = get_queried_object_id();
								$forum_parent_id = bbp_get_forum_parent_id($forum_id);
								
								if (0 !== $forum_parent_id) $item = array_merge($item, santos_breadcrumbs_get_parents($forum_parent_id));
								
								$item[] = bbp_get_forum_title($forum_id);
						} 
						elseif (bbp_is_single_user() || bbp_is_single_user_edit()) {
								
								if (bbp_is_single_user_edit()) {
										$item[] = '<a href="' . bbp_get_user_profile_url() . '">' . bbp_get_displayed_user_field('display_name') . '</a>';
										$item[] = esc_html__('Edit', 'santos');
								} 
								else {
										$item[] = bbp_get_displayed_user_field('display_name');
								}
						}
						
						echo implode($delimiter, $item);
				}

        echo "</div></div>";
			
}
}


function santos_breadcrumbs_get_parents($post_id = '', $separator = '/')
{
		
		$parents = array();
		
		if ($post_id == 0) return $parents;
		
		while ($post_id) {
				$page = get_page($post_id);
				$parents[] = '<a href="' . get_permalink($post_id) . '" title="' . esc_attr(get_the_title($post_id)) . '">' . get_the_title($post_id) . '</a>';
				$post_id = $page->post_parent;
		}
		
		if ($parents) $parents = array_reverse($parents);
		
		return $parents;
}
