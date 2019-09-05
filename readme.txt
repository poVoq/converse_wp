=== ConverseJS ===
Contributors: camaran & poVoq
Tags: chat, converse, xmpp, jabber
Requires at least: 4.6
Tested up to: 5.2.2
Requires PHP: 7.1
Stable tag: 5.0.1
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Converse.js is an open source webchat client, that runs in the browser and can be integrated into any website.

== Description ==

Converse.js is an open source webchat client, that runs in the browser and can be integrated into any website.

It's similar to Facebook chat, but also supports multi-user chatrooms.

Converse.js can connect to any accessible XMPP/Jabber server, either from a public provider, or to one you have set up yourself.

For more information, check out [conversejs](https://conversejs.org/).

== Installation ==

= From your WordPress dashboard =

1. Visit 'Plugins > Add New'
2. Search for 'converseJS'
3. Activate ConverseJS from your Plugins page.
4. Click Options from your Plugin page

= From WordPress.org =

1. Download ConverseJS.
2. Upload the 'conversejs' directory to your '/wp-content/plugins/' directory, using your favorite method (ftp, sftp, scp, etc...)
3. Activate ConverseJS from your Plugins page.
4. Click Options from your Plugin page

== Frequently Asked Questions ==

= Where i can found variables documentations? =

The Official documentation is available [here](https://conversejs.org/docs/html/index.html)

= Can i keep login between wordpress page? =

Yes you must use Bosh Server (WebSocket not support this)

= What's the DNS record for automatic Bind server? =

For automatic bind server you must set a TXT record: _xmppconnect IN TXT "_xmpp-client-xbosh=https://web.example.org:5280/bosh" standard [XEP-0156](http://xmpp.org/extensions/xep-0156.html)

= I must insert a TXT record? =

No, if the plugin not found TXT record work with default bind server or with the server insert in to options page.

== Screenshots ==

1. The chat login form
2. The chat admin panel

== Changelog ==
= 5.0.1 =
* ConverseJS [5.0.1](https://github.com/conversejs/converse.js/releases/tag/v5.0.1)
* Clean up
* Add libsignal.js for OMEMO
* Switch to GPLv3 in compliance with libsignal.js

= 4.2.0 = 
* ConverseJS [4.2.0](https://github.com/conversejs/converse.js/releases/tag/v4.2.0)

= 4.1.0 = 
* ConverseJS [4.1.0](https://github.com/conversejs/converse.js/releases/tag/v4.1.0)

= 4.0.6 = 
* ConverseJS [4.0.6](https://github.com/conversejs/converse.js/releases/tag/v4.0.6)

= 4.0.5.1 =
* Fixed Media Javascript Error

= 4.0.5 = 
* ConverseJS [4.0.5](https://github.com/conversejs/converse.js/releases/tag/v4.0.5)

= 4.0.4 = 
* ConverseJS [4.0.4](https://github.com/conversejs/converse.js/releases/tag/v4.0.4)
* ConverseJS [4.0.3](https://github.com/conversejs/converse.js/releases/tag/v4.0.3)

= 4.0.2.1 = 
* Locales of conversejs updated
* Add privacy Text in Privacy Policy suggested page
* Add Romanian and Hindi in languages option

= 4.0.2 =
* ConverseJS [4.0.2](https://github.com/conversejs/converse.js/releases/tag/v4.0.2)
* ConverseJS [4.0.1](https://github.com/conversejs/converse.js/releases/tag/v4.0.1)
* ConverseJS [4.0.0](https://github.com/conversejs/converse.js/releases/tag/v4.0.0)

= 3.3.5 =
* Add Conversejs appears options (Thank you Mako)

= 3.3.4 =
* ConverseJS [3.3.4](https://github.com/jcbrand/converse.js/releases/tag/v3.3.4)
* removed unneccessary css file
* add inverse css for full screen support

= 3.3.3.2 =
* Fix Priority Setting (thank you gyulavitez)

= 3.3.3.1 =
* Fix Play Suonds option (thank you gyulavitez)

= 3.3.3 =
* ConverseJS [3.3.3](https://github.com/jcbrand/converse.js/releases/tag/v3.3.3)

= 3.3.2.2 =
* Mobile Style Fix

= 3.3.2.1 =
* Back to converseJS 3.3.1 for bug

= 3.3.2 =
* ConverseJS [3.3.2](https://github.com/jcbrand/converse.js/releases/tag/v3.3.2)

= 3.3.1 =
* ConverseJS [3.3.1](https://github.com/jcbrand/converse.js/releases/tag/v3.3.1) and [3.3.0](https://github.com/jcbrand/converse.js/releases/tag/v3.3.0)
* fix converseJS mobile style

= 3.2.1.1 =
* Disabled registration Tab and add option for enable it

= 3.2.1 =
* ConverseJS [3.2.1](https://github.com/jcbrand/converse.js/releases/tag/v3.2.1)

= 3.2.0.1 =
* New emoji option

= 3.2.0 =
* ConverseJS [3.2.0](https://github.com/jcbrand/converse.js/blob/master/CHANGES.md)

= 3.0.2 =
* ConverseJS [3.0.2](https://github.com/jcbrand/converse.js/releases/tag/v3.0.2)

= 3.0.1.3 =
* Bug Fix

= 3.0.1.2 =
* Add show_send_button option

= 3.0.1 =
* ConverseJS [3.0.1](https://github.com/jcbrand/converse.js/releases/tag/v3.0.1)

= 3.0.0.5 =
* Restore logout function

= 3.0.0.3 =
* More Avada Compatibility

= 3.0.0.2 =
* Use official CDN

= 3.0.0.1 =
* Updated logout plugin
* Add priority option

= 3.0.0 =
* ConverseJS [3.0.0](https://github.com/jcbrand/converse.js/releases/tag/v3.0.0)
* From this version the plugin follow the version of ConverseJS

= 2.7.2 =
* ConverseJS [2.0.6](https://github.com/jcbrand/converse.js/releases/tag/v2.0.6)

= 2.7.1 =
* ConverseJS [2.0.5](https://github.com/jcbrand/converse.js/releases/tag/v2.0.5)

= 2.7.0 =
* Automatically set bind server from DNS
* Update help page with DNS info
* Update option page with DNS info
* Add bind server in resource hints
* Fix: mobile css are missing
* Logout link redirect
* Add preBind Class
* More performance optimization
* ConverseJS [2.0.4](https://github.com/jcbrand/converse.js/releases/tag/v2.0.4)

= 2.6.12 =
* ConverseJS [2.0.3](https://github.com/jcbrand/converse.js/releases/tag/v2.0.2)

= 2.6.11 =
* Fix Custom Variables (ohneel71)

= 2.6.10 =
* ConverseJS [2.0.1](https://github.com/jcbrand/converse.js/releases/tag/v2.0.1)

= 2.6.9 =
* Add ChatMe Username field in user profile page
* Remove websocket support

= 2.6.8 =
* Auto Join MUC at Login

= 2.6.7 =
* ConverseJS [2.0.0](https://github.com/jcbrand/converse.js/releases/tag/v2.0.0)

= 2.6.6 =
* ConverseJS [1.0.6](https://github.com/jcbrand/converse.js/releases/tag/v1.0.6)

= 2.6.5 =
* Better Performance
* ConverseJS [1.0.4](https://github.com/jcbrand/converse.js/releases/tag/v1.0.4)

= 2.6.4 =
* Removed languages folder

= 2.6.3 =
* Min CSS

= 2.6.2 =
* ConverseJS [1.0.3](https://github.com/jcbrand/converse.js/releases/tag/v1.0.3)

= 2.6.1 =
* Fixed jQuery conflict
* min version

= 2.6.0 =
* Compatible with WordPress 4.5 or higher
* Use wp_add_inline_script

= 2.5.21 =
* ConverseJS [1.0.2](https://github.com/jcbrand/converse.js/releases/tag/v1.0.2)

= 2.5.19 =
* bug Fix

= 2.5.18 =
* ConverseJS [1.0.0](https://github.com/jcbrand/converse.js/releases/tag/v1.0.0)
* Add support for mobile ConverseJS

= 2.5.17 =
* Only from local not more CDN

= 2.5.16 =
* Removed languages folder for use wordpress translations system

= 2.5.15 =
* ConverseJS [0.10.1](https://github.com/jcbrand/converse.js/releases/tag/v0.10.1)
* Default Domain
* ConverseJS 0.10.1 CDN

= 2.5.14 =
* KeepAlive support (only for bosh server), tanks Olightsound

= 2.5.13 =
* Auto Languages with conversejs native function
* All conversejs language

= 2.5.12 =
* Add auto_away option
* Add auto_xa option
* Add "some of site" language option
* Bug Fix

= 2.5.11 =
* Dedicated CDN Domain

= 2.5.10 =
* CDN for CSS

= 2.5.9 =
* Performance Fix

= 2.5.5 =
* Security Fix

= 2.5.4 =
* Security Fix

= 2.5.3 =
* Hide in Mobile device

= 2.5.2 =
* Fix CSS Missing

= 2.5.1 =
* Twenty Sixteen Compatibility Fix

= 2.5.0 =
* Performace

= 2.4.19 =
* ConverseJS [0.10.0](https://github.com/jcbrand/converse.js/releases/tag/v0.10.0)

= 2.4.18 =
* ConverseJS [0.9.6](https://github.com/jcbrand/converse.js/releases/tag/v0.9.6)

= 2.4.17 =
* Add hide_offline_users option

= 2.4.15 =
* Bug fix for WS url

= 2.4.14 =
* CDN bug fix

= 2.4.13 =
* csi_waiting_time
* auto_subscribe
* auto_list_rooms

= 2.4.12 =
* Add option for enable domain in chat service

= 2.4.11 =
* Bug Fix

= 2.4.10 =
* Add MAM option

= 2.4.9 =
* ConverseJS [0.9.5](https://github.com/jcbrand/converse.js/releases/tag/v0.9.5)

= 2.4.8 =
* Now ConverseJS core is in CDN for fast update

= 2.4.7 =
* Admin Page Fix

= 2.4.6 =
* New translation

= 2.4.5 =
* Aria Tag

= 2.4.4 =
* Add Hide_muc_server option
* Add enable_roster_group option

= 2.4.3 =
* Fix Custom variable Bug

= 2.4.2 =
* Add ChatMe namespace
* Updated Italian Language
* Plugin_key is now variable
* Removed old code

= 2.4.1 =
* Add converse_actual filter for custom actual array
* Add converse_html filter for custom html

= 2.4.0 =
* Updated Italian Language
* Add support for WebSocket server
* Add support for sound with path
* Add options to manage: emoticons button, clear button, call button and toggle participants

= 2.3.2 =
* Bug Fix Sorry

= 2.3.1 =
* ConverseJS [0.9.4](https://github.com/jcbrand/converse.js/releases/tag/v0.9.4)

= 2.3.0 =
* Code rewrite for options

= 2.2.0 =
* New ChatMe menu page (first implementation)
* Bug fix

= 2.1.8 =
* ConverseJS [0.9.3](https://github.com/jcbrand/converse.js/releases/tag/v0.9.3)

= 2.1.7 = 
* New Bind Server bind.chatme.im

= 2.1.6 =
* ConverseJS [0.9.2](https://github.com/jcbrand/converse.js/releases/tag/v0.9.2)

= 2.1.5 = 
* New Bind Server

= 2.1.4 = 
* Add POT file
* Add italian language

= 2.1.3 =
* Fix The plugin generated 3 characters of unexpected output during activation. 

= 2.1.2 = 
* Add defer

= 2.1.1 =
* Add help screen

= 2.1.0 =
* ConverseJS [0.9.1](https://github.com/jcbrand/converse.js/releases/tag/v0.9.1)
* Add Custom Variable Box

= 2.0.5 =
* wp_enqueue_style and wp_enqueue_script for more compatibility
* CSS Conflict resolved

= 2.0.4 =
* New Call Button Api

= 2.0.3 =
* New universal bosh server (work with every XMPP account)
* Tested with wordpress 4.2

= 2.0.2 =
* Can Manage show_controlbox_by_default for closed chat panel (Chat panel openend by default)

= 2.0.1 =
* ConverseJS [0.9.0](https://github.com/jcbrand/converse.js/releases/tag/v0.9.0)

= 2.0 =
* More HTML5
* Rewrited Object PHP
* Require PHP 5
* ConverseJS [0.8.5](https://github.com/jcbrand/converse.js/releases/tag/v0.8.5) and [0.8.6](https://github.com/jcbrand/converse.js/releases/tag/v0.8.6)

= 1.5.8 =
* Converse [0.8.4](https://github.com/jcbrand/converse.js/releases/tag/v0.8.4)

= 1.5.7 =
* New http-bind

= 1.5.6 =
* Bug fix

= 1.5.5 =
* Converse [0.8.2](https://github.com/jcbrand/converse.js/releases/tag/v0.8.2) e [0.8.3](https://github.com/jcbrand/converse.js/releases/tag/v0.8.3)

= 1.5.4 =
* Converse [0.8.1](https://github.com/jcbrand/converse.js/releases/tag/v0.8.1)

= 1.5.3 = 
* Optimitations

= 1.5.2 =
* ADD support for show_call_button (default:false), message_carbons (default:false), forward_messages (default:false)
* Add UnInstall file

= 1.5.1 =
* Bug Fix

= 1.5.0 =
* Converse [0.8.0](https://github.com/jcbrand/converse.js/releases/tag/v0.8.0)

= 1.4.2 =
* More Security

= 1.4.1 =
* More Optimizations

= 1.4 =
* Optimizations

= 1.3 =
* Converse 0.7.4

= 1.2 =
* Converse 0.7.3

= 1.1.1 =
* optimization

= 1.1 =
* Converse 0.7.2 integrated
* No external installation required

= 1.0.2 =
* Bug Fix
* Support for custom installation of converseJS

= 1.0.1 =
* Bug Fix

= 1.0 =
* First stable version

== Upgrade Notice ==

= 4.2.0 = 
* ConverseJS [4.2.0](https://github.com/conversejs/converse.js/releases/tag/v4.2.0)
