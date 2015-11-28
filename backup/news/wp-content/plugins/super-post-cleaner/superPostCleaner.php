<?php
/*
Plugin Name: Super Post Cleaner
Plugin URI: http://cbuckconsulting.com/super-post-cleaner/
Description: Deletes duplicate posts from the database (without affecting menus) each time a new post is published.
Version: 0.1
Author: ChrisBuck
Author URI: http://cbuckconsulting.com
License: GPL2
*/

/*  Copyright 2012  Chris Buck  (email : Chris@CBuckConsulting.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function superPostCleaner(){
	global $wpdb;
	$prefix = $wpdb->prefix;
	
	$wpdb->query("DELETE a.* 
		FROM ".$prefix."posts AS a 
		INNER JOIN (SELECT Greater1.post_title, Titles.ID, Greater1.MinID FROM (SELECT post_title, MIN(ID) AS 'MinID', MAX(ID) AS 'MaxID' FROM ".$prefix."posts WHERE post_type = 'post' AND post_status = 'publish' 
		GROUP BY post_title HAVING COUNT(post_title)>1) AS Greater1 
		LEFT JOIN (SELECT post_title, ID FROM ".$prefix."posts) AS Titles 
		ON Greater1.post_title = Titles.post_title WHERE ID > MinID) AS b ON a.ID = b.ID WHERE a.ID = b.ID");
}
add_action('publish_post', 'superPostCleaner');

?>