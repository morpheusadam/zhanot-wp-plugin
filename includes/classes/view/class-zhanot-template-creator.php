<?php
/**
 * Exit if accessed directly
 */
if (!defined('ABSPATH')) {
    exit;
}

class Zhanot_Template_Creator
{
    public $post_id;

    /**
     * Instance
     *
     * @since 1.2.0
     * @access private
     * @static
     *
     * @var Zhanot_Template_Creator The single instance of the class.
     */
    private static $_instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @return Zhanot_Template_Creator An instance of the class.
     * @since 1.2.0
     * @access public
     *
     */
    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function for_each($number_posts = -1, $auto_load = true)
    {
        $count = zhanot_get_all_posts_count('zhanot');
        if ($count >= 1) {
			$args = array(
                'post_type' => 'zhanot',
                'post_status' => 'publish',
                'numberposts' => $number_posts
            );
			if($auto_load){
				$args['meta_key'] = 'zhanot_post_auto_load';
				$args['meta_value'] = true;
			}	
            $posts = get_posts($args);
            if ($posts) {
                foreach ($posts as $post) {
                    $this->id($post->ID)->show_template();
                }
            }
        }
    }

    public function id($post_id)
    {
        $this->post_id = $post_id;
        return $this;
    }

    public function classes()
    {
        $post_id = $this->post_id;
        $auto_loader = (bool)zhanot_get_post_meta($post_id, 'zhanot_post_auto_load', true);
        $container_wide = (bool)zhanot_get_post_meta($post_id, 'zhanot_post_wide', true);
        $sticky = (bool)zhanot_get_post_meta($post_id, 'zhanot_sticky_noti', true);
        $a_target = (bool)zhanot_get_post_meta($post_id, 'zhanot_button_url_open_new_page', true);
        $on_display = zhanot_get_post_meta($post_id, 'zhanot_show_only_on', true);
        $only_once = zhanot_get_post_meta($post_id, 'zhanot_post_show_only_once', true);
        $classes = array(
            'auto_loader' => ($auto_loader) ? " zhanot-alert-auto-load-id-{$post_id} zhanot-alert-auto-load " : '',
            'container_wide' => ($container_wide) ? 'zhanot-container-full' : '',
            'sticky' => ($sticky) ? ' zhanot-sticky ' : '',
            'a_target' => ($a_target) ? '_blank' : '_self',
            'on_display' => ($on_display == 'mobile') ? 'mobile' : 'desktop',
            'only_once' => ($only_once) ? " zhanot-close-only-alert-{$post_id} " : '',
            'in_loop' => (in_the_loop()) ? 'zhanot-in-posts ' : '',
        );
        return $classes;
    }

    public function css($post_id)
    {
        $show_only = zhanot_get_post_meta($post_id, 'zhanot_show_only_on', true);
        if (!empty($show_only) && $show_only != null && $show_only != '' && $show_only != 'all') {
            ?>
            <style type="text/css" media="screen">
                <?php if ($show_only == 'desktop') { ?>
                @media screen and (max-width: 960px) {
                    .zhanot-alert-id-<?php echo $post_id; ?> {
                        display: none !important;
                    }
                }

                @media screen and (min-width: 960px) {
                    .zhanot-alert-id-<?php echo $post_id; ?> {
                        display: block !important;
                    }
                }

                <?php } elseif ($show_only == 'mobile') {?>
                @media screen and (max-width: 960px) {
                    .zhanot-alert-id-<?php echo $post_id; ?> {
                        display: block !important;
                    }
                }

                @media screen and (min-width: 960px) {
                    .zhanot-alert-id-<?php echo $post_id; ?> {
                        display: none !important;
                    }
                }

                <?php } ?>
            </style>
            <?php
        }
    }

    public function js($post_id)
    {
        $auto_loader = (bool)zhanot_get_post_meta($post_id, 'zhanot_post_auto_load', true);
        $type = zhanot_get_post_meta($post_id, 'zhanot_noti_type', true);
        if ($auto_loader) {
            ?>
            <script id="zhanot-alert-once-script-tag-<?php echo $post_id; ?>" type="text/javascript">
                jQuery(document).ready(function ($) {
                    <?php if (zhanot_get_post_meta($post_id, 'zhanot_post_auto_load', true) == true ): ?>
                    $('body').prepend($('.zhanot-alert-auto-load-id-<?php echo $post_id; ?>'));
                    <?php endif; ?>
                    <?php if (zhanot_get_post_meta($post_id, 'zhanot_post_show_only_once', true)) : ?>
                    $(".zhanot-close-only-alert-<?php echo $post_id; ?>").on("click", function () {
                        if (!zhanot_getCookie("zhanot-close-only-alert-<?php echo $post_id; ?>")) {
                            zhanot_setCookie("zhanot-close-only-alert-<?php echo $post_id; ?>", "true", 365);
                        }
                    });
                    if (zhanot_getCookie("zhanot-close-only-alert-<?php echo $post_id; ?>")) {
                        if ($('.zhanot-close-only-alert-<?php echo $post_id; ?>').length > 0) {
                            $(".zhanot-close-only-alert-<?php echo $post_id; ?>, #zhanot-alert-once-script-tag-<?php echo $post_id; ?>").remove();
                        }
                    }
                    <?php endif; ?>
                });
            </script>
            <?php if ($type == 4): ?>
                <script type="text/javascript">
                    jQuery(document).ready(function ($) {
                        const second = 1000,
                            minute = second * 60,
                            hour = minute * 60,
                            day = hour * 24;
                        if ($('.zhanot-alert-id-<?php echo $post_id ?>').length > 0) {
                            let TargetDate = Date.parse('<?php echo zhanot_change_jalali_args(zhanot_get_post_meta($post_id, 'zhanot_post_timer_date', true)); ?> <?php echo zhanot_get_post_meta($post_id, 'zhanot_post_timer_time', true); ?>'),
                                x = setInterval(function () {

                                    let now = Date.parse(new Date()),
                                        distance = TargetDate - now;

                                    document.getElementById('zh-d-content-<?php echo $post_id ?>').innerText = Math.floor(distance / (day)),
                                        document.getElementById('zh-h-content-<?php echo $post_id ?>').innerText = Math.floor((distance % (day)) / (hour)),
                                        document.getElementById('zh-m-content-<?php echo $post_id ?>').innerText = Math.floor((distance % (hour)) / (minute)),
                                        document.getElementById('zh-s-content-<?php echo $post_id ?>').innerText = Math.floor((distance % (minute)) / second);


                                    if (distance < 0) {
                                        clearInterval(x);
                                        $(".zhanot-timer-<?php echo $post_id ?>").remove();
                                        $(".zhanot-js-timer-end-<?php echo $post_id ?>").css('display', 'inline-block');
                                    }

                                }, second);
                        }
                    });
                </script>
            <?php
            endif;
        }
    }

    public function show_template()
    {
        $post_id = $this->post_id;
        $options = $this->classes();
        $zacb = zhanot_get_post_meta($post_id, 'zhanot_alert_content_bg', true);
        $type = zhanot_get_post_meta($post_id, 'zhanot_noti_type', true);
        $options2 = zhanot_get_posts_class($post_id);
        $margin = zhanot_get_post_meta($post_id, 'zhanot_alert_margin', true);
        $margin = explode(',', $margin);
        if (!empty(zhanot_get_post_meta($post_id, 'zhanot_notification_img', true))) {
            $style = ' style="background-image: url(' . zhanot_get_post_meta($post_id, 'zhanot_notification_img', true) . ');margin:' . $margin[0] . 'px ' . $margin[1] . 'px ' . $margin[2] . 'px ' . $margin[3] . 'px "';
        } else {
            $bg_c = zhanot_get_post_meta($post_id, 'zhanot_alert_bg', true);
            $bg_color = (!empty($bg_c)) ? $bg_c : '#fff';
            $style = ' style="background:' . $bg_color . ';margin:' . $margin[0] . 'px ' . $margin[1] . 'px ' . $margin[2] . 'px ' . $margin[3] . 'px "';
        }
        if (in_array($type, array(5, 6))) {
            $cls = ' zhanot-alert-socials zhanot-alert-contactus ';
        } elseif (in_array($type, array(2, 3))) {
            $cls = ' zhanot-alert-post zhanot-alert-product ';
        } elseif ($type == 7) {
            $cls = ' no-padding zhanot-alert-image-w-url ';
        }
        ?>
        <div class="<?php echo $options['in_loop'] . $options['sticky'] . $cls; ?>zhanot-alert-wrapper<?php echo $options['auto_loader']; ?> zhanot-alert-class zhanot-alert-simple-text zhanot-alert-id-<?php echo $post_id; ?> zh-clear-fix<?php echo $options['only_once'] ?>"<?php echo $style ?>>
            <?php
            if ($type != 7) {
                echo ($type == 6) ? '<div class="zhanot-alert-web-social zh-clear-fix">' : '';
                ?>
                <div class="zhanot-container zh-clear-fix<?php echo $options['container_wide'] ?>">
                    <?php
                    if ($type != 8) {
                        if (!in_array($type, array(5, 6, 9))): ?>
                            <div class="zhanot-alert zhanot-alert-class zh-clear-fix"<?php echo ' style="background-color:' . zhanot_hex2rgba($zacb, $post_id) . '"'; ?>>
                        <?php
                        endif;
                        if (in_array($type, array(1, 2, 3, 4, 5, 6))):
                            if (in_array($type, array(2, 3))):
                                if ($type == 2) {
                                    $field = 'zhanot_product_img';
                                } else {
                                    $field = 'zhanot_post_img';
                                }
                                $img = zhanot_get_post_meta($post_id, $field, true);
                                if (!empty(zhanot_get_post_meta($post_id, 'zhanot_product_discount', true))): ?>
                                    <span class="zhanot-alert-discount"><?php echo zhanot_get_post_meta($post_id, 'zhanot_product_discount', true); ?><?php _e('Discount', ZHANOT_TEXT_DOMAIN); ?> </span>
                                <?php endif; ?>
                                <div class="zhanot-alert-cover">
                                    <?php if (!empty($img)): ?>
                                        <img src="<?php echo $img; ?>" alt="post">
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <div class="zhanot-alert-text" style="<?php echo $options2['text_font_size'] . $options2['text_color']; ?>">
                                <?php
                                switch ($type) {
                                    case 1:
                                        $text = 'zhanot_simple_textfield';
                                        break;
                                    case 2:
                                        $text = 'zhanot_product_textfield';
                                        break;
                                    case 3:
                                        $text = 'zhanot_post_textfield';
                                        break;
                                    case 4:
                                        $text = 'zhanot_timer_textfield';
                                        break;
                                    case 5:
                                        $text = 'zhanot_socials_textfield';
                                        break;
                                    case 6:
                                        $text = 'zhanot_contactus_textfield';
                                        break;
                                }
                                echo zhanot_get_post_meta($post_id, $text, true);
                                ?>
                                <?php if ($type == 2 && !empty(zhanot_get_post_meta($post_id, 'zhanot_product_price', true))): ?>
                                    <span class="zhanot-pro-price"><?php echo zhanot_get_post_meta($post_id, 'zhanot_product_price', true); ?></span>
                                <?php endif; ?>
                            </div>
                            <?php if ($type == 4): ?>
                            <div class="zhanot-alert-js-timer">
                                <div class="zhanot-timer zhanot-timer-<?php echo $post_id ?>">
                                    <div class="zh-time" id="days" style="<?php echo $options2['timer_bg']; ?>">
                                        <span id="zh-d-content-<?php echo $post_id ?>" style="<?php echo $options2['timer_color']; ?>"></span>
                                        <em style="<?php echo $options2['timer_shadow'];
                                        echo $options2['timer_color']; ?>"><?php _e('Days', ZHANOT_TEXT_DOMAIN) ?></em>
                                    </div>
                                    <div class="zh-time" id="hours" style="<?php echo $options2['timer_bg']; ?>">
                                        <span id="zh-h-content-<?php echo $post_id ?>" style="<?php echo $options2['timer_color']; ?>"></span>
                                        <em style="<?php echo $options2['timer_shadow'];
                                        echo $options2['timer_color']; ?>"><?php _e('Hours', ZHANOT_TEXT_DOMAIN) ?></em>
                                    </div>
                                    <div class="zh-time" id="minutes" style="<?php echo $options2['timer_bg']; ?>">
                                        <span id="zh-m-content-<?php echo $post_id ?>" style="<?php echo $options2['timer_color']; ?>"></span>
                                        <em style="<?php echo $options2['timer_shadow'];
                                        echo $options2['timer_color']; ?>"><?php _e('Minutes', ZHANOT_TEXT_DOMAIN) ?></em>
                                    </div>
                                    <div class="zh-time" id="zh-seconds" style="<?php echo $options2['timer_bg']; ?>">
                                        <span id="zh-s-content-<?php echo $post_id ?>" style="<?php echo $options2['timer_color']; ?>"></span>
                                        <em style="<?php echo $options2['timer_shadow'];
                                        echo $options2['timer_color']; ?>"><?php _e('Seconds', ZHANOT_TEXT_DOMAIN) ?></em>
                                    </div>
                                    <?php if (!empty(zhanot_get_post_meta($post_id, 'zhanot_timer_btn_text', true))): ?>
                                        <a href="<?php echo zhanot_get_post_meta($post_id, 'zhanot_timer_btn_url', true); ?>" title="<?php echo zhanot_get_post_meta($post_id, 'zhanot_timer_btn_text', true); ?>" style="<?php echo $options2['btn_color'] . $options2['btn_text_color']; ?>"<?php echo $options2['button_target']; ?>><?php echo zhanot_get_post_meta($post_id, 'zhanot_timer_btn_text', true); ?></a>
                                    <?php endif; ?>
                                </div>
                                <span class="zhanot-js-timer-end zhanot-js-timer-end-<?php echo $post_id ?>" style="display: none"><?php echo zhanot_get_post_meta($post_id, 'zhanot_post_timer_end_text', true); ?></span>
                            </div>
                        <?php
                        endif;
                            if ($type == 5): ?>
                                <div class="zhanot-social-lists">
                                    <?php if (!empty(get_post_meta($post_id, 'zhanot_post_fb_url', true))): ?>
                                        <a href="<?php echo get_post_meta($post_id, 'zhanot_post_fb_url', true); ?>" title="FaceBook" class="zhanot-fb-url"<?php echo $options2['button_target']; ?>><i class="zhanot-ion-facebook"></i></a>
                                    <?php endif; ?>
                                    <?php if (!empty(get_post_meta($post_id, 'zhanot_post_in_url', true))): ?>
                                        <a href="<?php echo get_post_meta($post_id, 'zhanot_post_in_url', true); ?>" title="LinkedIn" class="zhanot-in-url"<?php echo $options2['button_target']; ?>><i class="zhanot-ion-linkedin"></i></a>
                                    <?php endif; ?>
                                    <?php if (!empty(get_post_meta($post_id, 'zhanot_post_wapp_url', true))): ?>
                                        <a href="https://api.whatsapp.com/send?phone=<?php echo get_post_meta($post_id, 'zhanot_post_wapp_url', true); ?>" title="WhatsApp" class="zhanot-wapp-url"<?php echo $options2['button_target']; ?>><i class="zhanot-ion-whatsapp"></i></a>
                                    <?php endif; ?>
                                    <?php if (!empty(get_post_meta($post_id, 'zhanot_post_tg_url', true))): ?>
                                        <a href="<?php echo get_post_meta($post_id, 'zhanot_post_tg_url', true); ?>" title="Telegram" class="zhanot-tg-url"<?php echo $options2['button_target']; ?>><i class="zhanot-ion-paper-plane-empty"></i></a>
                                    <?php endif; ?>
                                    <?php if (!empty(get_post_meta($post_id, 'zhanot_post_github_url', true))): ?>
                                        <a href="<?php echo get_post_meta($post_id, 'zhanot_post_github_url', true); ?>" title="GitHub" class="zhanot-github-url"<?php echo $options2['button_target']; ?>><i class="zhanot-ion-github"></i></a>
                                    <?php endif; ?>
                                    <?php if (!empty(get_post_meta($post_id, 'zhanot_post_ins_url', true))): ?>
                                        <a href="<?php echo get_post_meta($post_id, 'zhanot_post_ins_url', true); ?>" title="Instagram" class="zhanot-ins-url"<?php echo $options2['button_target']; ?>><i class="zhanot-ion-instagram"></i></a>
                                    <?php endif; ?>
                                    <?php if (!empty(get_post_meta($post_id, 'zhanot_post_twitter_url', true))): ?>
                                        <a href="<?php echo get_post_meta($post_id, 'zhanot_post_twitter_url', true); ?>" title="Twitter" class="zhanot-tw-url"<?php echo $options2['button_target']; ?>><i class="zhanot-ion-twitter"></i></a>
                                    <?php endif; ?>
                                    <?php if (!empty(get_post_meta($post_id, 'zhanot_post_pinterest_url', true))): ?>
                                        <a href="<?php echo get_post_meta($post_id, 'zhanot_post_pinterest_url', true); ?>" title="Pinterest" class="zhanot-pinter-url"<?php echo $options2['button_target']; ?>><i class="zhanot-ion-pinterest"></i></a>
                                    <?php endif; ?>
                                    <?php if (!empty(get_post_meta($post_id, 'zhanot_post_gplus_url', true))): ?>
                                        <a href="<?php echo get_post_meta($post_id, 'zhanot_post_gplus_url', true); ?>" title="Google Plus" class="zhanot-gplus-url"<?php echo $options2['button_target']; ?>><i class="zhanot-ion-gplus"></i></a>
                                    <?php endif; ?>
                                </div>
                            <?php
                            endif;
                        endif;
                        if (in_array($type, array(1, 2, 3))):
                            switch ($type) {
                                case 1:
                                    $text = 'zhanot_simple_btn_text';
                                    $link = 'zhanot_simple_btn_url';
                                    break;
                                case 2:
                                    $text = 'zhanot_product_btn_text';
                                    $link = 'zhanot_product_btn_url';
                                    break;
                                case 3:
                                    $text = 'zhanot_post_btn_text';
                                    $link = 'zhanot_post_btn_url';
                                    break;
                                case 4:
                                    $text = 'zhanot_timer_btn_text';
                                    $link = 'zhanot_timer_btn_url';
                                    break;
                            }
                            if (!empty(zhanot_get_post_meta($post_id, $text, true))): ?>
                                <a href="<?php echo zhanot_get_post_meta($post_id, $link, true); ?>" title="<?php echo zhanot_get_post_meta($post_id, $text, true); ?>" class="zhanot-alert-btn" style="<?php echo $options2['btn_color'] . $options2['btn_text_color']; ?>"<?php echo $options2['button_target']; ?>><?php echo zhanot_get_post_meta($post_id, $text, true); ?></a>
                            <?php
                            endif;
                        endif;
                        if ($type == 6):
                            if (!empty(zhanot_get_post_meta($post_id, 'zhanot_post_phone_number', true))): ?>
                                <div class="zhanot-contact-us zhanot-phone-number"<?php echo zhanot_get_post_meta($post_id, 'zhanot_alert_text_color', true) ? ' style="color:' . zhanot_get_post_meta($post_id, 'zhanot_alert_text_color', true) . '"' : ''; ?>>
                                    <i class="zhanot-ion-mobile"></i>
                                    <?php echo zhanot_get_post_meta($post_id, 'zhanot_post_phone_number', true); ?>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty(zhanot_get_post_meta($post_id, 'zhanot_post_email', true))): ?>
                            <div class="zhanot-contact-us zhanot-email"<?php echo zhanot_get_post_meta($post_id, 'zhanot_alert_text_color', true) ? ' style="color:' . zhanot_get_post_meta($post_id, 'zhanot_alert_text_color', true) . '"' : ''; ?>>
                                <i class="zhanot-ion-mail"></i>
                                <?php echo zhanot_get_post_meta($post_id, 'zhanot_post_email', true); ?>
                            </div>
                        <?php
                        endif;
                        endif;
                        if (!in_array($type, array(5, 6, 9))):
                            ?>
                            </div>
                        <?php endif;
                        if ($type == 9):
                            $random_text = (array)zhanot_get_post_meta($post_id, 'zhanot_random_content_textfield', true);
                            if (is_array($random_text) && !empty($random_text)) {
                                print_r(array_rand(array_flip($random_text), 1));
                            }
                        endif;
                    } else {
                        echo zhanot_get_post_meta($post_id, 'zhanot_html_content_textfield', true);
                    } ?>
                </div>
                <?php
                echo ($type == 6) ? '</div>' : '';
            } else {
                if (!empty(zhanot_get_post_meta($post_id, 'zhanot_image_url', true))):
                    ?>
                    <a href="<?php echo zhanot_get_post_meta($post_id, 'zhanot_image_url_external', true); ?>" title="<?php echo zhanot_get_post_meta($post_id, 'zhanot_image_url_alt_text', true); ?>"<?php echo $options['a_target']; ?>>
                        <img src="<?php echo zhanot_get_post_meta($post_id, 'zhanot_image_url', true); ?>" alt="<?php echo zhanot_get_post_meta($post_id, 'zhanot_image_url_alt_text', true); ?>">
                    </a>
                <?php
                endif;
            }
            if (!get_post_meta($post_id, 'zhanot_hidden_close_button', true)): ?>
                <div class="zhanot-close-alert zhanot-alert-class"><i class="zhanot-ion-cancel"></i></div>
            <?php endif; ?>
        </div>
        <?php
        $this->css($post_id);
        $this->js($post_id);
    }
}