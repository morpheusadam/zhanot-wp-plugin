<?php
/**
 * Exit if accessed directly
 */
if (!defined('ABSPATH')) {
    exit;
}

class zhanot_show_posts_widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'wp_zhanot_widget',
            __('Zhanot Widget', ZHANOT_TEXT_DOMAIN),
            array('description' => __('Zhanot notifications bar in Widgets', ZHANOT_TEXT_DOMAIN))
        );
    }

    /**
     * Front-end display of widget.
     *
     * @param array $args Widget arguments.
     * @param array $instance Saved values from database.
     *
     * @see WP_Widget::widget()
     *
     */
    public function widget($args, $instance)
    {
        $html = '';
        $zh_post = $instance['zh_post'];
        ?>
        <div class="zhanot_in_widgets">
            <?php
            $posts = get_posts(array(
                'include' => $zh_post,
                'post_type' => 'zhanot',
                'orderby' => 'post__in',
                'numberposts' => 1
            ));
            foreach ($posts as $post) {
                global $zhanot_loop;
                echo $zhanot_loop->id($zh_post)->show_content();
            }
            wp_reset_postdata();
            ?>
        </div>
        <?php
    }

    public function form($instance)
    {
        if (isset($instance['zh_post'])) {
            $zh_post = $instance['zh_post'];
        } else {
            $zh_post = '';
        }
        ?>
        <p>
            <label for="zh_post"><?php _e('Select Notification', ZHANOT_TEXT_DOMAIN) ?></label>
            <select class="zh_post" name="<?php echo $this->get_field_name('zh_post'); ?>" style="width: 100%;">
                <?php
                global $post;
                $posts = get_posts(array(
                    'post_type' => 'zhanot',
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'numberposts' => -1
                ));
                $query_posts = array();
                if ($posts) {
                    foreach ($posts as $post) {
                        setup_postdata($post);
                        $selected = $zh_post == get_the_ID() ? 'selected' : '';
                        echo '<option ' . $selected . ' value="' . get_the_ID() . '">' . get_the_title() . '</option>';
                    }
                    wp_reset_postdata();
                }
                ?>
            </select>
        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     * @see WP_Widget::update()
     *
     */
    public
    function update(
        $new_instance, $old_instance
    )
    {
        $instance = array();
        $instance['zh_post'] = (!empty($new_instance['zh_post'])) ? strip_tags($new_instance['zh_post']) : '';

        return $instance;
    }
}
