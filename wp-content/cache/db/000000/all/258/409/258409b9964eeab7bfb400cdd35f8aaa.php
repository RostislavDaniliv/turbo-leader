}MÜV<?php exit; ?>a:6:{s:10:"last_error";s:0:"";s:10:"last_query";s:475:"SELECT   wp_posts.ID FROM wp_posts  INNER JOIN wp_postmeta ON ( wp_posts.ID = wp_postmeta.post_id ) WHERE 1=1  AND ( 
  wp_posts.ID NOT IN (
				SELECT object_id
				FROM wp_term_relationships
				WHERE term_taxonomy_id IN (97)
			)
) AND ( 
  ( wp_postmeta.meta_key = '_um_core' AND CAST(wp_postmeta.meta_value AS CHAR) = 'admin' )
) AND wp_posts.post_type = 'um_role' AND ((wp_posts.post_status = 'publish')) GROUP BY wp_posts.ID ORDER BY wp_posts.post_date DESC LIMIT 0, 5";s:11:"last_result";a:1:{i:0;O:8:"stdClass":1:{s:2:"ID";s:4:"5300";}}s:8:"col_info";a:1:{i:0;O:8:"stdClass":13:{s:4:"name";s:2:"ID";s:5:"table";s:8:"wp_posts";s:3:"def";s:0:"";s:10:"max_length";i:4;s:8:"not_null";i:1;s:11:"primary_key";i:0;s:12:"multiple_key";i:0;s:10:"unique_key";i:0;s:7:"numeric";i:1;s:4:"blob";i:0;s:4:"type";s:3:"int";s:8:"unsigned";i:1;s:8:"zerofill";i:0;}}s:8:"num_rows";i:1;s:10:"return_val";i:1;}