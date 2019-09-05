<?php
/*
Plugin Name: ConverseJS
Plugin URI: https://conversejs.org/
Description: This plugin add the javascript code for Converse.js a Jabber/XMPP chat for your WordPress.
Version: 5.0.1
Author: camaran & poVoq
Author URI: https://github.com/poVoq/converse_wp
Text Domain: conversejs
*/

class converseJS {
    
static private $default 	= array(
				'languages' 				=> '/languages/',
				'language' 				    => '',	
				'webchat' 				    => 'https://conversejs.org/http-bind/',
				'providers_link'			=> 'http://example.com/',
				'placeholder'				=> ' e.g. example.com',
				'call'					    => 'false',
				'carbons'				    => 'false',
				'foward'				    => 'false',
				'panel'					    => 'true',
				'conver'				    => '5.0.1',
				'custom'				    => '',
				'clear'					    => 'true', 
				'emoticons'				    => 'false', 
				'toggle_participants'	    => 'false', 
				'play_sounds'				=> 'false',
				'xhr_user_search'			=> 'false',
				'prebind'				    => 'false',
				'hide_muc_server'			=> 'false',
				'auto_list_rooms'			=> 'false',
                'auto_subscribe'	   		=> 'false',
				'sounds_path'				=> './sounds/',
				'plugin_options_key'		=> 'converseJS',
				'roster_groups'				=> 'false',
				'allow_otr'				    => 'false',
				'message_archiving'			=> 'never',
				'csi_waiting_time'			=> 5,
				'auto_subscribe'			=> 'false',
				'auto_list_rooms'			=> 'false',
				'authentication'			=> 'login',
				'hide_offline_users'		=> 'false',
				'cache_otr_key'				=> 'false',
				'auto_away'				    => 0,
				'auto_xa'				    => 0,
				'keepalive' 				=> 'true',
				'default_domain'			=> 'chatme.im',
				'auto_join_rooms'			=> '',
				'logout'				    => '#',
				'conversejs_priority'		=> 10,
				'show_send_button' 			=> 'false',
				'registration_domain' 	    => '',
                'allow_registration'        => 'false',
                'conversejs_theme'          => 'default',
				);			

	function __construct() {
		add_action( 'plugins_loaded', array( $this, 'init' ) );
		}
		
	function init() {
      	load_plugin_textdomain( 'conversejs');
		//if ( get_option('place') == '' or get_option('place') == 'main' or get_option('place') == 'both' or ( get_option('place') == 'admin' and current_user_can('publish_posts') ) ) {
	    	add_action( 'wp_enqueue_scripts', 		array( $this, 'get_converse_head') );
		//}
		//if ( get_option('place') == 'admin' or get_option('place') == 'both' ) {
		//	add_action( 'admin_enqueue_scripts', array( &$this, 'get_converse_head' ) );
		//}
		add_action( 'admin_menu', 		    	array( $this, 'converse_menu') );
		add_action( 'admin_init', 		    	array( $this, 'register_converse_mysettings') );
		add_action( 'admin_init',               array( $this, 'conversejs_add_privacy_policy_content') );
		add_filter( 'user_contactmethods', 		array( $this, 'add_user_conversejs_xmpp') );
		add_filter( 'wp_resource_hints', 		array( $this, 'add_resource_hints'), 10, 2 );
		add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array( $this, 'add_action_converse_links') );
		}

    function conversejs_add_privacy_policy_content() {
 
        $content = sprintf(
            __( 'When you use a XMPP chat service it transmits some data (username, password and hopefully OMEMO encrypted conversations data) to the XMPP server(s).
 
                For more details you can see <a href="%s" target="_blank">Privacy Policy of this service</a>.',
                'conversejs' ),
                'https://example.com/privacy/'
    );
 
        wp_add_privacy_policy_content(
            'ConverseJS',
            wp_kses_post( wpautop( $content, false ) )
        );
    }

    function add_action_converse_links ( $links ) {
      	$mylinks = array( '<a href="' . admin_url( 'admin.php?page=' . self::$default['plugin_options_key'] ) . '">' . __( 'Settings', 'conversejs' ) . '</a>', '<a href="http://example.com" target="_blank">' . __('Get hosted XMPP', 'conversejs') . '</a>' );
      	return array_merge( $links, $mylinks );
      	      	}

    function converse_add_help_tab () {
        $screen = get_current_screen();

        $screen->add_help_tab( array(
              	      	'id'		=> 'converse_help_tab',
              	      	'title'		=> esc_html__('Bosh Server', 'conversejs'),
              	      	'content'	=> '<p>' . esc_html__( 'The Bind Server used from ConverseJS to connect to XMPP server, you can use', 'conversejs') . ' <b>' . esc_html__('https://bind.example.com', 'conversejs' ) . '</b> ' . esc_html__('for all XMPP service login.', 'conversejs' ) . '<br/><br/>' . esc_html__('Variable:', 'conversejs' ) . ' <i>' . esc_html__('bosh_service_url', 'conversejs' ) . '</i><br/>' . esc_html__('Default value:', 'conversejs' ) . ' <i>' . esc_html__('https://bind.example.com', 'conversejs' ) . '</i></p><p>' . esc_html__('With support for keepAlive sessione between wordpress page and post (For example you can chat without relogin in every page of the site).', 'conversejs' ) . '</p><p>' . esc_html__('The plugin read automatically the setting from DNS record (_xmppconnect.domain) of domain where is installed, if the record is not present the plugin use default value or read from option setting if you give one.', 'conversejs' ) . '</p>',
          	      	) );

        $screen->add_help_tab( array(
              	      	'id'		=> 'converse_help_tab_3',
              	      	'title'		=> esc_html__('Provider Link', 'conversejs'),
              	      	'content'	=> '<p>' . esc_html__( 'The link with XMPP service list, for example:', 'conversejs') . ' <b>' . esc_html__( 'http://example.com/', 'conversejs') . '</b>.<br/><br/>' . esc_html__( 'Variable:', 'conversejs') . ' <i>' . esc_html__( 'providers_link', 'conversejs') . '</i><br/>' . esc_html__('Default value:', 'conversejs'). ' <i>' . esc_html__('http://example.com/', 'conversejs') . '</i></p>',
          	      	) );

        $screen->add_help_tab( array(
              	      	'id'		=> 'converse_help_tab_4',
              	      	'title'		=> esc_html__('Register Placeholder', 'conversejs'),
              	      	'content'	=> '<p>' . esc_html__( 'The placeholder that show in register page.', 'conversejs') . '<br/><br/>' . esc_html__( 'Variable:', 'conversejs') . ' <i>' . esc_html__( 'domain_placeholder', 'conversejs') . '</i><br/>' . esc_html__( 'Default value:', 'conversejs') . ' <i>' . esc_html__( 'e.g. example.com', 'conversejs') . '</i></p>',
          	      	) );

        $screen->set_help_sidebar(
                              '<p><strong>' . esc_html__('Other Resources', 'conversejs') . '</strong></p><p><a href="https://conversejs.org/" target="_blank">' . esc_html__('ConverseJS Official Site', 'conversejs') . '</a></p><p><a href="https://conversejs.org/docs/html/index.htmls" target="_blank">' . esc_html__('ConverseJS Official Documentation', 'conversejs') . '</a></p><p><a href="http://xmpp.net" target="_blank">' . esc_html__('XMPP.net', 'conversejs') . '</a></p><p><a href="http://example.com" target="_blank">' . esc_html__('example site', 'conversejs') . '</a></p>'
                             );
      	      	}

	function add_user_conversejs_xmpp($profile_fields) {
		$profile_fields['conversejs_xmpp'] = __( 'XMPP Username', 'conversejs' );
		return $profile_fields;
		}

	function get_user_conversejs_xmpp() {
  		$user_id = get_user_meta( get_current_user_id() );
  		$conversejs_xmpp_profile = $user_id['conversejs_xmpp'][0];
		return $conversejs_xmpp_profile;
		}

	static function getHost() {
		$vhost = parse_url ( $_SERVER["HTTP_HOST"], PHP_URL_HOST );
		$dominio = $vhost['host'];
		if (dns_get_record('_xmppconnect.' . $dominio,DNS_TXT,$authns) ) {
				$data = dns_get_record('_xmppconnect.' . $dominio,DNS_TXT,$authns);
				$host = $data[0]['txt'];
			$host = explode('=',$host);
			$host = $host[1];
		} else {
			$host = (get_option('bosh') == '') ? self::$default['webchat'] : get_option('bosh');
		}
			return $host;
	}

	function add_resource_hints( $hints, $relation_type ) {
		if ( 'dns-prefetch' === $relation_type ) {
				$hints[] = self::getHost();
		}
			return $hints;
	}

	function get_converse_head() {

		$current_user = wp_get_current_user();

		wp_register_style( 'wordpress-fix', plugins_url( '/css/wordpress-fix.css', __FILE__ ), array('conversejs'), self::$default['conver'] );
		wp_enqueue_style( 'wordpress-fix' );

		wp_register_style( 'conversejs', plugins_url( '/core/css/converse.min.css', __FILE__ ), array(), self::$default['conver'] );
		wp_enqueue_style( 'conversejs' );

		wp_register_script( 'conversejs', plugins_url( '/core/converse.min.js', __FILE__ ), array(), self::$default['conver'], true );
		wp_enqueue_script( 'conversejs' );
		
		wp_register_script( 'conversejs', plugins_url( '/core/libsignal-protocol.min.js', __FILE__ ), array(), self::$default['conver'], true );
		wp_enqueue_script( 'conversejs' );

		$setting = array(
				'language'			=> esc_html(get_option('language')),
				'webchat'			=> esc_js( self::getHost() ),
				'providers_link'		=> esc_url(get_option('providers_link')),
				'placeholder'			=> esc_js(get_option('placeholder')),
				'call'				=> esc_html(get_option('call')),
				'carbons'			=> esc_html(get_option('carbons')),
				'foward'			=> esc_html(get_option('foward')),
				'panel'				=> esc_html(get_option('panel')),
				'custom'			=> wp_kses(get_option('custom'),''),
				'clear'				=> esc_html(get_option('clear')),
				'emoticons'			=> esc_html(get_option('emoticons')),
				'toggle_participants'		=> esc_html(get_option('toggle_participants')), 
				'play_sounds'			=> esc_html(get_option('play_sounds')),
				'xhr_user_search'		=> esc_html(get_option('xhr_user_search')),
				'prebind'			=> esc_html(get_option('prebind')),
				'hide_muc_server'		=> esc_html(get_option('hide_muc_server')),
				'auto_list_rooms'		=> esc_html(get_option('auto_list_rooms')),
				'auto_subscribe'		=> esc_html(get_option('auto_subscribe')),	
				'sounds_path'			=> esc_html(get_option('sounds_path')),
				'roster_groups'			=> esc_html(get_option('roster_groups')),
				'message_archiving'		=> esc_html(get_option('message_archiving')),
				'csi_waiting_time'		=> esc_html(get_option('csi_waiting_time')),
				'auto_list_rooms'		=> esc_html(get_option('auto_list_rooms')),
				'auto_subscribe'		=> esc_html(get_option('auto_subscribe')),
				'authentication'		=> esc_html(get_option('authentication')),
				'hide_offline_users'		=> esc_html(get_option('hide_offline_users')),
				'allow_otr'			    => esc_html(get_option('allow_otr')),
				'cache_otr_key'			=> esc_html(get_option('cache_otr_key')),
				'auto_away'			    => esc_html(get_option('auto_away')),
				'auto_xa'			    => esc_html(get_option('auto_xa')),
				'default_domain'		=> esc_js(get_option('default_domain')),
				'auto_join_rooms'		=> esc_js(get_option('auto_join_rooms')),
				'join_rooms_nick'		=> $current_user->display_name,	
				'logout'			    => esc_url(get_option('logout')),
				'conversejs_priority'		=> (int) get_option('conversejs_priority'),
				'show_send_button' 		=> esc_html(get_option('show_send_button')),
				'registration_domain' 		=> esc_html(get_option('registration_domain')),
                'allow_registration'    => esc_html(get_option('allow_registration')),
                'conversejs_theme'      => esc_html(get_option('conversejs_theme'))
		);
						
		foreach( $setting as $k => $settings )
			if( false == $settings )
				unset( $setting[$k]);
						
		$actual = apply_filters( 'converse_actual', wp_parse_args( $setting, self::$default ) );
        
       		$auto_join_muc = ($actual['auto_join_rooms'] == '') ? '' : "auto_join_rooms: [ {'jid': '" . $actual['auto_join_rooms'] . "', 'nick': '" . $actual['join_rooms_nick'] . "'}],";
            
		    $converse_html = "

			  converse.plugins.add('chatme-logout', { 
       				initialize: function () { 
           				this._converse.on('logout', function (ev) { 
               					window.location.href = \"{$actual['logout']}\"; 
               				}); 
           			} 
       			}); 

		    	converse.initialize({
                    authentication: '{$actual['authentication']}',
                    bosh_service_url: '{$actual['webchat']}',
                    show_controlbox_by_default: {$actual['panel']},
				    authentication: '{$actual['authentication']}',
				    auto_list_rooms: {$actual['auto_list_rooms']},
				    auto_subscribe: {$actual['auto_subscribe']},
				    hide_muc_server: {$actual['hide_muc_server']},
				    i18n: '{$actual['language']}',
                    locales_url: '" . plugins_url( '/core/locale/{{{locale}}}/LC_MESSAGES/converse.json', __FILE__ ) . "',
				    prebind: {$actual['prebind']},
				    xhr_user_search: {$actual['xhr_user_search']},
				    message_carbons: {$actual['carbons']},
				    forward_messages: {$actual['foward']},
				    domain_placeholder: '{$actual['placeholder']}',
				    providers_link: '{$actual['providers_link']}',
				    play_sounds: {$actual['play_sounds']},
				    sounds_path: '{$actual['sounds_path']}',
				    roster_groups: {$actual['roster_groups']},
				    keepalive: {$actual['keepalive']},
				    {$actual['custom']}
				    allow_otr: {$actual['allow_otr']},
				    {$auto_join_muc}
				    cache_otr_key: {$actual['cache_otr_key']},
				    auto_away: {$actual['auto_away']},
				    auto_xa: {$actual['auto_xa']},
				    default_domain: '{$actual['default_domain']}',
				    message_archiving: '{$actual['message_archiving']}',
				    csi_waiting_time: {$actual['csi_waiting_time']},
				    auto_list_rooms: {$actual['auto_list_rooms']},
				    auto_subscribe: {$actual['auto_subscribe']},
				    hide_offline_users: {$actual['hide_offline_users']},
				    visible_toolbar_buttons: { call: {$actual['call']}, clear: {$actual['clear']}, emoji: {$actual['emoticons']}, toggle_participants: {$actual['toggle_participants']} },
				    whitelisted_plugins: ['chatme-logout'],
				    priority: {$actual['conversejs_priority']},
				    show_send_button: {$actual['show_send_button']},
				    registration_domain: '{$actual['registration_domain']}',
                    allow_registration: {$actual['allow_registration']}, 
                    theme: '{$actual['conversejs_theme']}', 
                    show_message_load_animation: true,
		    	});
			"; 
                
        $inline_conversejs = apply_filters( 'converse_html', $converse_html );

		wp_add_inline_script( 'conversejs', $inline_conversejs );
	}

	function converse_menu() {
  		$my_admin_page = add_options_page( esc_html__('ConverseJS','conversejs'), esc_html__('ConverseJS','conversejs'), 'manage_options', self::$default['plugin_options_key'], array($this, 'converse_options') );
  		add_action('load-'.$my_admin_page, array( $this, 'converse_add_help_tab') );
		}

	function register_converse_mysettings() {
		//register_setting('converse_options_list', 'place');
		register_setting('converse_options_list', 'language');
		register_setting('converse_options_list', 'bosh');
		register_setting('converse_options_list', 'call');
		register_setting('converse_options_list', 'carbons');
		register_setting('converse_options_list', 'foward');
		register_setting('converse_options_list', 'providers_link');
		register_setting('converse_options_list', 'placeholder');
		register_setting('converse_options_list', 'panel');
		register_setting('converse_options_list', 'custom');
		register_setting('converse_options_list', 'clear'); 
		register_setting('converse_options_list', 'emoticons'); 
		register_setting('converse_options_list', 'toggle_participants');		
		register_setting('converse_options_list', 'play_sounds');
		register_setting('converse_options_list', 'sounds_path'); 
		register_setting('converse_options_list', 'roster_groups');
		register_setting('converse_options_list', 'hide_muc_server');
		register_setting('converse_options_list', 'allow_otr');
		register_setting('converse_options_list', 'cache_otr_key');
		register_setting('converse_options_list', 'message_archiving');
		register_setting('converse_options_list', 'csi_waiting_time');
		register_setting('converse_options_list', 'auto_list_rooms');
		register_setting('converse_options_list', 'auto_subscribe');
		register_setting('converse_options_list', 'authentication');
		register_setting('converse_options_list', 'hide_offline_users');
		register_setting('converse_options_list', 'auto_away');
		register_setting('converse_options_list', 'auto_xa');
		register_setting('converse_options_list', 'default_domain');
		register_setting('converse_options_list', 'auto_join_rooms');
		register_setting('converse_options_list', 'ispage');
		register_setting('converse_options_list', 'logout');
		register_setting('converse_options_list', 'conversejs_priority');
		register_setting('converse_options_list', 'show_send_button');
		register_setting('converse_options_list', 'registration_domain');
		register_setting('converse_options_list', 'allow_registration');
        register_setting('converse_options_list', 'conversejs_theme');
		}

	function converse_options() {
		if (!current_user_can('manage_options')) {
		wp_die( esc_html__('You do not have sufficient permissions to access this page.', 'conversejs') );
		}
?>
<div class="wrap">
	<h1>ConverseJS</h1>
	<p><?php esc_html_e('For more information visit', 'conversejs'); ?> <a href='http://www.example.com' target='_blank'><?php esc_html_e('www.example.com', 'conversejs'); ?></a> - <a href="https://webchat.example.com/?r=support" target="_blank"><?php esc_html_e('Support Chat Room', 'conversejs'); ?></a> - <a href="https://conversejs.org/" trget="_blank"><?php esc_html_e('ConverseJS.org', 'conversejs'); ?></a> - <a href="http://example.com/" target="_blank"><?php esc_html_e('Get your own XMPP server', 'conversejs'); ?></a></p>

	<form method="post" action="options.php">
    	<?php settings_fields( 'converse_options_list' ); ?>
    	<table class="form-table">
        	<!-- <tr valign="top">
				<th scope="row"><label for="place"><?php esc_html_e('Place where ConverseJS appears', 'conversejs'); ?></label></th>
			<td>
				<select id="place" name="place">
				<option value="main" <?php selected('main', get_option('place')); ?>><?php esc_html_e('Main screen', 'conversejs'); ?></option>
				<option value="admin" <?php selected('admin', get_option('place')); ?>><?php esc_html_e('Admin screen', 'conversejs'); ?></option>
				<option value="both" <?php selected('both', get_option('place')); ?>><?php esc_html_e('Both main and admin screen', 'conversejs'); ?></option>
				</select>
                <p class="description" id="place-description">
				    <?php esc_html_e('If you select admin screen converseJS appear also in the main screen if the logged user can publish posts ', 'conversejs'); ?>
                </p>
			</td>-->
			</tr>

			<tr valign="top">
        		<th scope="row"><label for="bosh"><?php esc_html_e('Bosh Server', 'conversejs'); ?></label>
			</th>
        	<td>	
			<?php esc_html_e('Automatic Selected or', 'conversejs'); ?> 
        		<input class="regular-text code" aria-describedby="bosh-description" id="bosh" name="bosh" type="url" placeholder="<?php esc_html_e('bosh service', 'conversejs'); ?>" value="<?php echo get_option('bosh'); ?>">
			<p class="description" id="bosh-description">
				<?php esc_html_e('We suggest: https://bind.example.com (With keepAlive support between wordpress page)', 'conversejs'); ?><br/>
				<?php printf( esc_html__('The automatic value of bosh server read from DNS record (if present) of your domain is %s else we use the default value or the value you set in this page.', 'conversejs'), self::getHost() ); ?>
			</p>
        	</td>
        	</tr> 
            
        	<tr valign="top">
        		<th scope="row"><label for="providers_link"><?php esc_html_e('Provider Link', 'conversejs'); ?></label></th>
        	<td>
        		<input class="regular-text code" aria-describedby="link-description" id="providers_link" name="providers_link" type="url" placeholder="<?php esc_html_e('provider link', 'conversejs'); ?>" value="<?php echo get_option('providers_link'); ?>"><p class="description" id="link-description"><?php esc_html_e('We suggest http://example.com', 'conversejs'); ?></p>
        	</td>
        	</tr> 

        	<tr valign="top">
        		<th scope="row"><label for="logout"><?php esc_html_e('Logout Link', 'conversejs'); ?></label></th>
        	<td>
        		<input class="regular-text code" aria-describedby="logout-description" id="logout" name="logout" type="url" placeholder="<?php esc_html_e('logout link', 'conversejs'); ?>" value="<?php echo get_option('logout'); ?>"><p class="description" id="logout-description"><?php esc_html_e('Link to redirect user when logout from ConverseJs, default: # (current page)', 'conversejs'); ?></p>
        	</td>
        	</tr>
            
            <tr valign="top">
        		<th scope="row"><?php esc_html_e('Enable Registration', 'conversejs'); ?></th>
        	<td>
        		<input type="checkbox" id="allow_registration" name="allow_registration" value="true" <?php checked('true', get_option('allow_registration')); ?> /><label for="allow_registration"><?php esc_html_e('Yes', 'conversejs'); ?></label><p class="description" id="allow_registration-description"><?php esc_html_e('Enable the registration from the web of new account, disabled by default for spam reason.', 'conversejs'); ?></p>
        	</td>
        	</tr            
            
        	<tr valign="top">
        		<th scope="row"><label for="placeholder"><?php esc_html_e('Register Placeholder', 'conversejs'); ?></label></th>
        	<td>
        		<input class="regular-text code" aria-describedby="placeholder-description" id="placeholder" name="placeholder" type="text" placeholder="<?php esc_html_e('e.g. example.com', 'conversejs'); ?>" value="<?php echo get_option('placeholder'); ?>"><p class="description" id="placeholder-description"><?php esc_html_e('We suggest e.g. chatme.im', 'conversejs'); ?></p>
        	</td>
        	</tr> 
            
         	<tr valign="top">
        		<th scope="row"><label for="default_domain"><?php esc_html_e('Default Domain', 'conversejs'); ?></label></th>
        	<td>
        		<input class="regular-text code" aria-describedby="default_domain-description" id="default_domain" name="default_domain" type="text" placeholder="<?php esc_html_e('chatme.im', 'conversejs'); ?>" value="<?php echo get_option('default_domain'); ?>"><p class="description" id="default_domain-description"><?php esc_html_e('Default domain for login with username only', 'conversejs'); ?></p>
        	</td>
        	</tr>                                      

         	<tr valign="top">
        		<th scope="row"><label for="auto_join_rooms"><?php esc_html_e('Auto Join MUC Chat', 'conversejs'); ?></label></th>
        	<td>
        		<input class="regular-text code" aria-describedby="auto_join_rooms-description" id="auto_join_rooms" name="auto_join_rooms" type="text" placeholder="<?php esc_html_e('muc123@conference.example.com', 'conversejs'); ?>" value="<?php echo get_option('auto_join_rooms'); ?>"><p class="description" id="auto_join_rooms-description"><?php esc_html_e('Auto Join MUC when login', 'conversejs'); ?></p>
        	</td>
        	</tr> 

        	<tr valign="top">
        		<th scope="row"><?php esc_html_e('Visible Buttons', 'conversejs'); ?></th>
        		<td>
				<p><input type="checkbox" id="call" name="call" value="true" <?php checked('true', get_option('call')); ?> /> <label for="call"><?php esc_html_e('Enable Call Button', 'conversejs'); ?></label></p>
				<p><input type="checkbox" id="clear" name="clear" value="true" <?php checked('true', get_option('clear')); ?> /> <label for="clear"><?php esc_html_e('Enable Clear Button', 'conversejs'); ?></label></p>
				<p><input type="checkbox" id="emoticons" name="emoticons" value="true" <?php checked('true', get_option('emoticons')); ?> /> <label for="emoticons"><?php esc_html_e('Enable Emoticons', 'conversejs'); ?></label></p>
				<p><input type="checkbox" name="toggle_participants" id="toggle_participants" value="true" <?php checked('true', get_option('toggle_participants')); ?> /> <label for="toggle_participants"><?php esc_html_e('Enable toggle participants Button', 'conversejs'); ?></label></p>
				<p><input type="checkbox" name="show_send_button" id="show_send_button" value="true" <?php checked('true', get_option('show_send_button')); ?> /> <label for="show_send_button"><?php esc_html_e('Show Send Button', 'conversejs'); ?></label></p>
			</td>
        	</tr>

        	<tr valign="top">
        		<th scope="row"><?php esc_html_e('Hide Chat Panel Open', 'conversejs'); ?></th>
        		<td><input type="checkbox" id="panel" name="panel" value="false" <?php checked('false', get_option('panel')); ?> /> <label for="panel"><?php esc_html_e('Yes', 'conversejs'); ?></label></td>
        	</tr>

        	<tr valign="top">
        		<th scope="row"><?php esc_html_e('Sounds', 'conversejs'); ?></th>
        		<td><input type="checkbox" id="play_sounds" name="play_sounds" value="true" <?php checked('true', get_option('play_sounds')); ?> /> <label for="play_sounds"><?php esc_html_e('Play Sounds', 'conversejs'); ?></label><br/><label for="sounds_path"><?php esc_html_e('Sounds Path', 'conversejs'); ?><input aria-describedby="sounds-description" class="regular-text code" id="sounds_path" name="sounds_path" type="text" placeholder="<?php esc_html_e('./sounds', 'conversejs'); ?>" value="<?php echo get_option('sounds_path'); ?>"></label><p class="description" id="sounds-description"><?php esc_html_e('sound patch ./sounds work with mp3 and odg', 'conversejs'); ?></p></td>
        	</tr>
            
            <tr valign="top">
            	<th scope="row"><?php esc_html_e('Theme', 'conversejs'); ?></th>
        		<td>
                    <select id="conversejs_theme" name="conversejs_theme">
				        <option value="default" <?php selected('default', get_option('conversejs_theme')); ?>><?php esc_html_e('Default', 'conversejs'); ?></option>
                        <option value="concord" <?php selected('concord', get_option('conversejs_theme')); ?>><?php esc_html_e('Concord', 'conversejs'); ?></option>
				    </select>
                </td>
        	</tr>

        	<tr valign="top">
        		<th scope="row"><?php esc_html_e('Functions', 'conversejs'); ?></th>
        		<td>
				<p><input type="checkbox" name="carbons" id="carbons" value="true" <?php checked('true', get_option('carbons')); ?> /> <label for="carbons"><?php esc_html_e('Enable Messages Carbons', 'conversejs'); ?></label></p>
				<p><input type="checkbox" name="foward" id="foward" value="true" <?php checked('true', get_option('foward')); ?> /> <label for="foward"><?php esc_html_e('Enable Foward Messages', 'conversejs'); ?></label></p>
				<p><input type="checkbox" name="hide_muc_server" id="hide_muc_server" value="true" <?php checked('true', get_option('hide_muc_server')); ?> /> <label for="hide_muc_server"><?php esc_html_e('Hide MUC Server', 'conversejs'); ?></label></p>
				<p><input type="checkbox" name="allow_otr" id="allow_otr" aria-describedby="allow_otr-description" value="true" <?php checked('true', get_option('allow_otr')); ?> /> <label for="allow_otr"><?php esc_html_e('Enable OTR', 'conversejs'); ?></label> - <input type="checkbox" name="cache_otr_key" id="cache_otr_key" aria-describedby="cache_otr_key-description" value="true" <?php checked('true', get_option('cache_otr_key')); ?> /> <label for="cache_otr_key"><?php esc_html_e('Cache OTR Key', 'conversejs'); ?></label></p>
				<p class="description" id="allow_otr-description"><?php esc_html_e('Enable OTR for more security chat conversations', 'conversejs'); ?></p>
				<p><input type="checkbox" name="auto_subscribe" id="auto_subscribe" value="true" <?php checked('true', get_option('auto_subscribe')); ?> /> <label for="auto_subscribe"><?php esc_html_e('Auto Subscribe', 'conversejs'); ?></label></p>
				<p><input type="checkbox" name="auto_list_rooms" id="auto_list_rooms" value="true" <?php checked('true', get_option('auto_list_rooms')); ?> /> <label for="auto_list_rooms"><?php esc_html_e('Auto List Rooms', 'conversejs'); ?></label></p>
				<p><input type="checkbox" name="hide_offline_users" id="hide_offline_users" value="true" <?php checked('true', get_option('hide_offline_users')); ?> /> <label for="hide_offline_users"><?php esc_html_e('Hide Offline Users', 'conversejs'); ?></label></p>
			</td>
			</tr>

			<tr valign="top">
				<th scope="row"><?php esc_html_e('Roster', 'conversejs'); ?></th>
				<td><input id="roster_groups" type="checkbox" name="roster_groups" value="true" <?php checked('true', get_option('roster_groups')); ?> /> <label for="roster_groups"><?php esc_html_e('Enable Roster Groups', 'conversejs'); ?></label></td>
			</tr>

			<tr valign="top">
				<th scope="row"><label for="custom"><?php esc_html_e('Custom Variable', 'conversejs'); ?><br/><?php esc_html_e('More info', 'conversejs'); ?> <a href="https://conversejs.org/docs/html/configuration.html#configuration-variables" target="_blank"><?php esc_html_e('Here.', 'conversejs'); ?></a><br/><?php esc_html_e('Not Overwrite the varables managed from other options.', 'conversejs'); ?></label></th>
				<td><textarea aria-describedby="custom-description" class="large-text code" id="custom" name="custom" rows="4" cols="50"><?php echo wp_kses(get_option('custom'),''); ?></textarea><p class="description" id="custom-description"><?php esc_html_e('For advance use converse_html hook', 'conversejs'); ?></p></td>
			</tr>

			<tr valign="top">
				<th scope="row"><label for="language"><?php esc_html_e('Converse language', 'conversejs'); ?></label></th>
			<td>
				<select id="language" name="language">
				<option value="<?php echo substr(get_locale(), 0,2); ?>" <?php selected('substr(get_locale(), 0,2);', get_option('language')); ?>><?php esc_html_e('Some of Site', 'conversejs'); ?></option>
				<option value="af" <?php selected('af', get_option('language')); ?>><?php esc_html_e('Afrikaans', 'conversejs'); ?></option>
				<option value="de" <?php selected('de', get_option('language')); ?>><?php esc_html_e('Deutsch', 'conversejs'); ?></option>
				<option value="en" <?php selected('en', get_option('language')); ?>><?php esc_html_e('English', 'conversejs'); ?></option>
				<option value="es" <?php selected('es', get_option('language')); ?>><?php esc_html_e('Espa&ntilde;ol', 'conversejs'); ?></option>
				<option value="fr" <?php selected('fr', get_option('language')); ?>><?php esc_html_e('Fran&ccedil;ais', 'conversejs'); ?></option>
				<option value="he" <?php selected('he', get_option('language')); ?>><?php esc_html_e('Hebrew', 'conversejs'); ?></option>
				<option value="hi" <?php selected('hi', get_option('language')); ?>><?php esc_html_e('Hindi', 'conversejs'); ?></option>
				<option value="hu" <?php selected('hu', get_option('language')); ?>><?php esc_html_e('Hungarian', 'conversejs'); ?></option>
				<option value="id" <?php selected('id', get_option('language')); ?>><?php esc_html_e('Indonesian', 'conversejs'); ?></option>
				<option value="it" <?php selected('it', get_option('language')); ?>><?php esc_html_e('Italiano', 'conversejs'); ?></option>
				<option value="ja" <?php selected('ja', get_option('language')); ?>><?php esc_html_e('Japan', 'conversejs'); ?></option>
				<option value="nb" <?php selected('nb', get_option('language')); ?>><?php esc_html_e('Norwegian', 'conversejs'); ?></option>
				<option value="nl" <?php selected('nl', get_option('language')); ?>><?php esc_html_e('Nederlands', 'conversejs'); ?></option>
				<option value="oc" <?php selected('oc', get_option('language')); ?>><?php esc_html_e('Catalan', 'conversejs'); ?></option>
				<option value="pl" <?php selected('pl', get_option('language')); ?>><?php esc_html_e('Polish', 'conversejs'); ?></option>
				<option value="pt" <?php selected('pt', get_option('language')); ?>><?php esc_html_e('Portuguese', 'conversejs'); ?></option>
				<option value="ro" <?php selected('ro', get_option('language')); ?>><?php esc_html_e('Romanian', 'conversejs'); ?></option>
				<option value="ru" <?php selected('ru', get_option('language')); ?>><?php esc_html_e('Russian', 'conversejs'); ?></option>
				<option value="uk" <?php selected('uk', get_option('language')); ?>><?php esc_html_e('Ukrainian', 'conversejs'); ?></option>
				<option value="zh" <?php selected('zh', get_option('language')); ?>><?php esc_html_e('Chinese', 'conversejs'); ?></option>
				</select>
			</td>
		</tr>
			<tr valign="top">
				<th scope="row"><label for="message_archiving"><?php esc_html_e('Message Archive Management', 'conversejs'); ?></label></th>
			<td>
				<select id="message_archiving" name="message_archiving" aria-describedby="message_archiving-description">
				<option value="never" <?php selected('never', get_option('message_archiving')); ?>><?php esc_html_e('Never', 'conversejs'); ?></option>
				<option value="always" <?php selected('always', get_option('message_archiving')); ?>><?php esc_html_e('Always', 'conversejs'); ?></option>
				<option value="roster" <?php selected('roster', get_option('message_archiving')); ?>><?php esc_html_e('Roster', 'conversejs'); ?></option>
				</select>
			<p class="description" id="message_archiving-description"><?php esc_html_e('Provides support for', 'conversejs'); ?> <a href="https://xmpp.org/extensions/xep-0313.html" target="_blank"><?php esc_html_e('XEP-0313: Message Archive Management', 'conversejs'); ?></a></p>
			</td>
		</tr>
			<tr valign="top">
				<th scope="row"><label for="csi_waiting_time"><?php esc_html_e('CSI Wainting Time', 'conversejs'); ?></label></th>
			<td>
				<select id="csi_waiting_time" name="csi_waiting_time" aria-describedby="csi_waiting_time-description">
				<option value="5" <?php selected('5', get_option('csi_waiting_time')); ?>><?php esc_html_e('5', 'conversejs'); ?></option>
				<option value="10" <?php selected('10', get_option('csi_waiting_time')); ?>><?php esc_html_e('10', 'conversejs'); ?></option>
				<option value="15" <?php selected('15', get_option('csi_waiting_time')); ?>><?php esc_html_e('15', 'conversejs'); ?></option>
				</select>
			<p class="description" id="csi_waiting_time-description"><?php esc_html_e('Provides support for XEP-0085 Chat State Indication', 'conversejs'); ?></p>
			</td>
		</tr>
			<tr valign="top">
				<th scope="row"><label for="auto_away"><?php esc_html_e('Auto Away After', 'conversejs'); ?></label></th>
			<td>
				<select id="auto_away" name="auto_away" aria-describedby="auto_away-description">
				<option value="0" <?php selected('0', get_option('auto_away')); ?>><?php esc_html_e('Disabled', 'conversejs'); ?></option>
				<option value="5" <?php selected('5', get_option('auto_away')); ?>><?php esc_html_e('5', 'conversejs'); ?></option>
				<option value="10" <?php selected('10', get_option('auto_away')); ?>><?php esc_html_e('10', 'conversejs'); ?></option>
				<option value="15" <?php selected('15', get_option('auto_away')); ?>><?php esc_html_e('15', 'conversejs'); ?></option>
				</select> <?php esc_html_e('Seconds', 'conversejs'); ?>
			</td>
		</tr>
		<tr valign="top">
				<th scope="row"><label for="auto_xa"><?php esc_html_e('Auto Extended Away After', 'conversejs'); ?></label></th>
			<td>
				<select id="auto_xa" name="auto_xa" aria-describedby="auto_xa-description">
				<option value="0" <?php selected('0', get_option('auto_xa')); ?>><?php esc_html_e('Disabled', 'conversejs'); ?></option>
				<option value="5" <?php selected('5', get_option('auto_xa')); ?>><?php esc_html_e('5', 'conversejs'); ?></option>
				<option value="10" <?php selected('10', get_option('auto_xa')); ?>><?php esc_html_e('10', 'conversejs'); ?></option>
				<option value="15" <?php selected('15', get_option('auto_xa')); ?>><?php esc_html_e('15', 'conversejs'); ?></option>
				</select> <?php esc_html_e('Seconds', 'conversejs'); ?>
			</td>
		</tr>
			<tr valign="top">
				<th scope="row"><label for="conversejs_priority"><?php esc_html_e('Priority', 'conversejs'); ?></label></th>
			<td>
				<select id="conversejs_priority" name="conversejs_priority" aria-describedby="conversejs_priority-description">
				<option value="0" <?php selected('0', get_option('conversejs_priority')); ?>><?php esc_html_e('Low', 'conversejs'); ?></option>
				<option value="10" <?php selected('10', get_option('conversejs_priority')); ?>><?php esc_html_e('Medium (Default)', 'conversejs'); ?></option>
				<option value="15" <?php selected('15', get_option('conversejs_priority')); ?>><?php esc_html_e('Hight', 'conversejs'); ?></option>
				</select>
			</td>
	</tr>

			<tr valign="top">
				<th scope="row"><label for="registration_domain"><?php esc_html_e('Registration Domain', 'conversejs'); ?></label></th>
			<td>
				<input class="regular-text code" aria-describedby="registration_domain-description" id="registration_domain" name="registration_domain" type="text" placeholder="<?php esc_html_e('Registration Domain', 'conversejs'); ?>" value="<?php echo get_option('registration_domain'); ?>"><p class="description" id="registration_domain-description"><?php esc_html_e('We suggest example.com', 'conversejs'); ?></p>
			</td>
		</tr>

	</table>

	<?php submit_button(); ?>

	<p><?php esc_html_e('For each request you can use our', 'conversejs') ?> <a href="http://forum.example.com" target="_blank"><?php esc_html_e('forum', 'conversejs') ?></a></p>

</div>
<?php
	}
}
$converseJS = new converseJS();
?>
