<div id="wrap">
    <h1><?php _e('Livestream Notice Settings', 'livestreamNotice');?></h1>

    <form method="post" action="options.php">

        <?php settings_fields('livestream-notice-settings-group');?>
        <?php do_settings_sections('livestream-notice-settings-group');?>

        <table class="form-table">
            <tbody>
            <tr valign="top">
                <th scope="row"><label
                        for="livestream-channelname"><?php _e('Twitch Channel', 'livestreamNotice');?></label></th>
                <td><input name="livestream-channelname" type="text" id="livestream-channelname" value="<?php echo esc_attr(get_option('livestream-channelname', '')); ?>" class="regular-text">
                    <p class="description"><?php _e('Your Twitch account username you want to show notices for on your website.', 'livestreamNotice');?></p>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label
                        for="livestream-noticemessage"><?php _e('Notice Message', 'livestreamNotice');?></label></th>
                <td><input name="livestream-noticemessage" type="text" id="livestream-noticemessage" value="<?php echo esc_attr(get_option('livestream-noticemessage', '')); ?>" class="regular-text">
                <p><?php _e('The default is "Hey, did you know I am live streaming right now?"', 'livestreamNotice');?></p>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label
                        for="livestream-twitchclientid"><?php _e('Twitch Client ID', 'livestreamNotice');?></label></th>
                <td><input name="livestream-twitchclientid" type="text" id="livestream-twitchclientid" value="<?php echo esc_attr(get_option('livestream-twitchclientid', '')); ?>" class="regular-text">
                <h4><?php _e('How to get your twitch client ID', 'livestreamNotice');?></h4>
                <div><?php _e('1. Go to the <a href="https://dev.twitch.tv/" target="_blank">Twitch Dev site</a> and log in to your account.', 'livestreamNotice');?></div>
                <div><?php _e('2. Under My Applications, choose Register an App.', 'livestreamNotice');?></div>
                <div><?php _e('3. On the Dashboard, under Developer Applications, choose Register Your Application.', 'livestreamNotice');?></div>
                <div><?php _e('4. On the Register Your Application page, complete the form and choose Register.', 'livestreamNotice');?></div>
                <div><?php _e('5. Note the generated client ID that you will use to paste into the <strong>Twitch Client ID field</strong>', 'livestreamNotice');?></div>
                </td>
            </tr>
            </tbody>
        </table>

        <?php submit_button();?>

    </form>
</div>
