<?php
class AWITPTP_settings
{
    public function plugin_settings()
    {
        // Add a menu for option page
        add_action('admin_menu', 'AWITPTP_settings_menu');
        function AWITPTP_settings_menu()
        {
            add_options_page('AWITPTP Plugin Settings', 'Post icon', 'manage_options', 'AWITPTP_plugin', 'AWITPTP_option_page');
        }

        // Create the option page
        function AWITPTP_option_page()
        {
?>
    <div class="wrap">
    <h2>Add WP Icon to Post Titles</h2>
    <form action="options.php" method="post">
    <?php
            settings_fields('AWITPTP_options');
            do_settings_sections('AWITPTP_plugin');
            submit_button('Save Changes', 'primary');
?>
    </form>
    </div>
    <?php
        }

        // Register and define the settings
        add_action('admin_init', 'AWITPTP_admin_init');
        function AWITPTP_admin_init()
        {
            // Define the setting args
            $args = array(
                'type' => 'string',
                'default' => NULL
            );
            // Register settings
            register_setting('AWITPTP_options', 'AWITPTP_options', $args);

            // Add a settings section
            add_settings_section('AWITPTP_main', 'AWITPTP Plugin Settings', 'AWITPTP_section_text', 'AWITPTP_plugin');

            // Create our settings field enable
            add_settings_field('AWITPTP_settings_enable', 'Enable', 'AWITPTP_settings_enable', 'AWITPTP_plugin', 'AWITPTP_main');

            // Create our settings field dashicon
            add_settings_field('AWITPTP_settings_post_type', 'Post Type', 'AWITPTP_settings_post_type', 'AWITPTP_plugin', 'AWITPTP_main');

            // Create our settings field post type
            add_settings_field('AWITPTP_settings_dashicon', 'DashIcon', 'AWITPTP_settings_dashicon', 'AWITPTP_plugin', 'AWITPTP_main');

            // Create our settings field position
            add_settings_field('AWITPTP_settings_position', 'Position', 'AWITPTP_settings_position', 'AWITPTP_plugin', 'AWITPTP_main');

        }

        // Draw the section header
        function AWITPTP_section_text()
        {
            echo '<p>Enter your settings here.</p>';
        }

        function AWITPTP_settings_enable()
        {
            // Get option value from the database
            // Set to 'disable' as a default if the option does not exist
            $options = get_option('AWITPTP_options', ['Enable' => 'enable']);
            $enable = $options['Enable'];
            // Define the select option values for position
            $items = array(
                'enable',
                'disable'
            );
            echo "<select id='AWITPTP_Enable' name='AWITPTP_options[Enable]'>";
            foreach ($items as $item)
            {
                // Loop through the option values
                // If saved option matches the option value, select it
                echo "<option value='" . esc_attr($item) . "'
 " . selected($enable, $item, false) . ">" . esc_html($item) . "</option>";
            }
            echo "</select>";
        }

        function AWITPTP_settings_post_type()
        {
            // Get option value from the database
            // Set to first category as a default if the option does not exist
            $items = get_categories();
            $items_reversed = array_reverse($items);
            foreach ($items_reversed as $item)
            {
                $options = get_option('AWITPTP_options', ['Post_Type' => $item->name]);
            }
            $post_type = $options['Post_Type'];
            // Define the select option values for post type
            echo "<select id='AWITPTP_post_type' name='AWITPTP_options[Post_Type]'>";
            foreach ($items as $item)
            {
                // Loop through the option values
                // If saved option matches the option value, select it
                echo "<option value='" . esc_attr($item->name) . "'
 " . selected($post_type, $item->name, false) . ">" . $item->name . "</option>";
            }
            echo "</select>";
        }

        function AWITPTP_settings_dashicon()
        {
            // Get option value from the database
            // Set to 'welcome' as a default if the option does not exist
            $options = get_option('AWITPTP_options', ['Dashicon' => 'dashicons-welcome-write-blog']);
            $dashicon = $options['Dashicon'];
            // Define the select option values for icons
            $items = array(
                'Welcome' => 'dashicons-welcome-write-blog',
                'Status' => 'dashicons-format-status',
                'Gallery' => 'dashicons-format-gallery'
            );
            echo "<select id='AWITPTP_Dashicon' name='AWITPTP_options[Dashicon]'>";
            foreach ($items as $item => $item_value)
            {
                // Loop through the option values
                // If saved option matches the option value, select it
                echo "<option value='" . esc_attr($item_value) . "'
 " . selected($dashicon, $item_value, false) . ">" . esc_html($item) . "</option>";
            }
            echo "</select>";
        }

        function AWITPTP_settings_position()
        {
            // Get option value from the database
            // Set to 'right' as a default if the option does not exist
            $options = get_option('AWITPTP_options', ['Position' => 'right']);
            $position = $options['Position'];
            // Define the select option values for position
            $items = array(
                'right',
                'left'
            );
            echo "<select id='AWITPTP_Position' name='AWITPTP_options[Position]'>";
            foreach ($items as $item)
            {
                // Loop through the option values
                // If saved option matches the option value, select it
                echo "<option value='" . esc_attr($item) . "'
 " . selected($position, $item, false) . ">" . esc_html($item) . "</option>";
            }
            echo "</select>";
        }

    }

}

