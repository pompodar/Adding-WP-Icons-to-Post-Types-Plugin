<?php
class AWITPTP_Add_Icon
{
    public function icon_adding()
    {
        add_filter('the_title', 'add_icon');
        function add_icon($title)
        {
            $options = get_option('AWITPTP_options');
            $post_type = $options['Post_Type'];
            $enable = $options['Enable'];
            $dashicon = $options['Dashicon'];
            if (in_category($post_type) && $enable == 'enable')
            {
                $position = $options['Position'];
                return '<span class="AWITPTP_icon ' . $position . " " . $dashicon . '">' . $title . '</span>';
            }
            else
            {
                return $title;
            }
        }
    }
}

