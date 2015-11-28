
=== Plugin Name ===
Contributors: ChrisBuck
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=5YPBMNAUB3RJN
Tags: posts, post, duplicate, duplicates, eraser, delete, content
Requires at least: 2.9.0
Tested up to: 3.3.1
Stable tag: 0.1

Deletes duplicate posts from the database (without affecting menus) each time a new post is published.

== Description ==

This plugin deletes duplicate posts from the database, without affecting menus, each time a new post is published. This is an improvement over other similar plugins that would constantly delete custom menus. This plugin works automatically in the background once it is enabled.

The plugin will automatically delete posts with the exact same post title as a previous post, leaving the original post undisturbed. This is particularly useful for when you have syndicated content or auto-posts that result in erroneous duplicates. The original will remain, and all the duplicates will be deleted, allowing you to preserve your page views on the original.

== Installation ==

1. Upload `superpostcleaner.php` to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Your plugin will automatically delete duplicate posts WHEN YOU PUBLISH A NEW POST.

== Frequently Asked Questions ==

= Will the plugin delete duplicate posts when I enable it? =
No. You have to first publish a post for the plugin to work. It works in the background when new posts are published.
= Does the plugin put posts in the trash? =
No. The plugin works directly on the database. Duplicate posts are actually deleted.

== Screenshots ==

== Changelog ==