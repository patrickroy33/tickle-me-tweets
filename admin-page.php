<?php
function twitter_create_menu() {
	//create new settings options page
	add_options_page('Twitter Shortcodes and Widgets Settings', 'Twitter Settings', 'administrator', __FILE__, 'twitter_system_page');

	//call register settings function
	add_action( 'admin_init', 'twitter_register_settings' );
}


function twitter_register_settings() {
	/* twitter api settings  */
	register_setting( 'twitter-settings-group', 'twitter_consumer_key' );
    register_setting( 'twitter-settings-group', 'twitter_consumer_secret' );
    register_setting( 'twitter-settings-group', 'twitter_access_token' );
    register_setting( 'twitter-settings-group', 'twitter_access_token_secret' );
}

function twitter_system_page() {
?>
    <style type="text/css">
        ul li {
            list-style-type: circle;
            margin-left:30px;
        }
        input[type="text"] {
            width:70%;
            margin-bottom:5px;
        }
        textarea {
            width:70%;
            height:225px;
            resize:none;
        }
        h3 {
            border-top:1px dashed #000;
            margin:0px 0px 0px 0px;
            padding:15px 0px 0px 0px;
        }
        .form-table {
            margin-top:0px;
        }
    </style>
    <div class="wrap">
        <h2>Twitter Shortcodes and Widgets Settings</h2>
        <h3>Create Twitter Application</h3>
        <ol>
            <li>Log in to <a href="https://twitter.com/login?redirect_after_login=https%3A//apps.twitter.com/" target="_blank">Twitter Application</a> using an existing Twitter Account</li>
            <li>Once logged in, "Create New App"</li>
            <li>Setup the application with a Name, Description and Website</li>
            <li>Agree to the "Rules of the Road" and "Create you Twitter Application"</li>
            <li>Once Application is created, click on the "API Keys"</li>
            <li>Use "Create my access token" to create new access tokens</li>
            <li>
                Use the following information from this page and place below:
                <ul style="margin-top:5px;">
                    <li>Consumer Key</li>
                    <li>Consumer Secret</li>
                    <li>Access Token</li>
                    <li>Access Token Secret</li>
                </ul>
            </li>
        </ol>
        <br /><br />
        <form method="post" action="options.php">
            <?php settings_fields( 'twitter-settings-group' ); ?>
            <?php do_settings_sections( 'twitter-settings-group' ); ?>
            <h3>Twitter API Settings</h3>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        Consumer Key
                    </th>
                    <td>
                        <input type="text" name="twitter_consumer_key" value="<?php echo get_option('twitter_consumer_key'); ?>" /><br />
                    </td>
                </tr>
                 
                <tr valign="top">
                    <th scope="row">
                        Consumer Secret
                    </th>
                    <td>
                        <input type="text" name="twitter_consumer_secret" value="<?php echo get_option('twitter_consumer_secret'); ?>" /><br />
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                        Access Token
                    </th>
                    <td>
                        <input type="text" name="twitter_access_token" value="<?php echo get_option('twitter_access_token'); ?>" /><br />
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                        Access Token Secret
                    </th>
                    <td>
                        <input type="text" name="twitter_access_token_secret" value="<?php echo get_option('twitter_access_token_secret'); ?>" /><br />
                    </td>
                </tr>
            </table>
            
            <?php submit_button(); ?>

        </form>
    </div>
<?php }