<?php

/*
Plugin Name: Livestream Notice
Plugin URI: https://wordpress.org/plugins/livestream-notice
Description: Displays a notify type message of twitch channel name when they are live. Great if you're a streamer with a WordPress Blog and or if you're a programmer who wants to share you're live.
Version: 1.3.0
Author: MrDemonWolf
Author URI: http://www.mrdemonwolf.me
License: GPLv2
 */

class livestreamNotice
{

    private $version = '1.3.0';
    private $pluginPrefix = 'livestreamNotice';
    private $noticemessage = "Hey, did you know I am live streaming right now?";
    private $channelname = ''; // Define this property
    private $twitchclientid = ''; // Define this property

    public function __construct()
    {
        if (is_admin()) {
            $this->backendInit();
        }

        $this->frontendInit();
    }

    /**
     * Actions for backend.
     */
    public function backendInit()
    {
        add_action('admin_enqueue_scripts', array(
            $this,
            'enqueScripts',
        ));
        add_action('admin_menu', array(
            $this,
            'registerSettingsPage',
        ));
        add_action('admin_init', array(
            $this,
            'registerSettings',
        ));
    }

    public function frontendInit()
    {
        add_action('wp_print_styles', array(
            $this,
            'enqueScripts',
        ));

    }

    /**
     * Registers settings for plugin.
     */
    public function registerSettings()
    {
        register_setting($this->pluginPrefix . '-settings-group', $this->pluginPrefix . '-channelname');
        register_setting($this->pluginPrefix . '-settings-group', $this->pluginPrefix . '-twitchclientid');
        register_setting($this->pluginPrefix . '-settings-group', $this->pluginPrefix . '-noticemessage');

    }

    /**
     * Add a menu item to the admin bar.
     */
    public function registerSettingsPage()
    {
        add_options_page('Livestream Notice', 'Livestream Notice', 'manage_options', $this->pluginPrefix, array(
            $this,
            'showSettingsPage',
        ));
    }

    /**
     * Includes the settings page.
     */
    public function showSettingsPage()
    {
        include 'pages/settings.php';
    }

    public function enqueScripts()
    {
        if (!is_admin()) {
            wp_enqueue_style($this->pluginPrefix, plugin_dir_url(__FILE__) . 'livestream-notice.css', false, $this->version);

            wp_enqueue_script($this->pluginPrefix, plugin_dir_url(__FILE__) . 'livestream-notice.js', array(
                "jquery",
            ), $this->version, true);

        }

        $params = array(
            'channelname' => get_option($this->pluginPrefix . '-channelname', $this->channelname),
            'twitchclientid' => get_option($this->pluginPrefix . '-twitchclientid', $this->twitchclientid),
            'noticemessage' => get_option($this->pluginPrefix . '-noticemessage', $this->noticemessage),
        );

        wp_localize_script($this->pluginPrefix, 'livestreamNoticeSettings', $params);

    }
}
;

new livestreamNotice;
