Tickle Me Tweets
----------------

This Wordpress plugin shows recent tweets from any valid twitter handle through a shortcode or a widget

Features
########

* The Plugin Tickle Me Tweets is fully-based on the WordPress [Plugin API](http://codex.wordpress.org/Plugin_API).
* Uses [PHPDoc](http://en.wikipedia.org/wiki/PHPDoc) conventions to document the code.
* Uses [abraham/twitterauth](https://github.com/abraham/twitteroauth) as the Twitter Authorization.

Contents
########

The WordPress Plugin Tickle Me Tweets includes the following files:

* This README and a ChangeLog file.
* A subdirectory called 'tickle-me-tweets' that represents the core plugin file.

Installation
############

1. Copy the 'tickle-me-tweets' directory into your wp-content/plugins directory
2. Navigate to the Plugins dashboard page
3. Find `plugin-name` and activate

Usage
#####

1. Once activated, navigate to Settings -> Twitter Settings
2. Use the instructions on the page the get the appropriate settings from a new twitter application
3. Input the following 3 items from the Twitter App:
	API Key
	API Secret
	Access Token
	Access Token Secret
4. Save the settings
5. Setup Widget:
	1. Navigate to Appearance -> Widgets
	2. Add the Widget to one of the sidebar fields
6. Use Shortcode:
	* [show_tweets screen_name="HANDLE" count="COUNT"]
	* HANDLE is the user's twitter handle
	* COUNT is the number of tweets to show

License
#######

The WordPress Plugin Tickle Me Tweets is licensed under the GPL v2 or later.

> This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

> This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

> You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA