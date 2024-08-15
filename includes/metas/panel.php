<div class="zhanot-admin-noti-wrap">
    <script type="text/javascript">
        var $tinmce_options = {
            tinymce: {
                wpautop: true,
                theme: 'modern',
                skin: 'lightgray',
                formats: {
                    alignleft: [
                        {selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li', styles: {textAlign: 'left'}},
                        {selector: 'img,table,dl.wp-caption', classes: 'alignleft'}
                    ],
                    aligncenter: [
                        {selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li', styles: {textAlign: 'center'}},
                        {selector: 'img,table,dl.wp-caption', classes: 'aligncenter'}
                    ],
                    alignright: [
                        {selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li', styles: {textAlign: 'right'}},
                        {selector: 'img,table,dl.wp-caption', classes: 'alignright'}
                    ],
                    strikethrough: {inline: 'del'}
                },
                relative_urls: false,
                remove_script_host: false,
                convert_urls: false,
                browser_spellcheck: true,
                fix_list_elements: true,
                entities: '38,amp,60,lt,62,gt',
                entity_encoding: 'raw',
                keep_styles: false,
                paste_webkit_styles: 'font-weight font-style color',
                preview_styles: 'font-family font-size font-weight font-style text-decoration text-transform',
                tabfocus_elements: ':prev,:next',
                plugins: 'charmap,hr,media,paste,tabfocus,textcolor,fullscreen,wordpress,wpeditimage,wpgallery,wplink,wpdialogs,wpview',
                resize: 'vertical',
                menubar: false,
                indent: false,
                toolbar1: 'bold,italic,strikethrough,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,link,unlink,wp_more,spellchecker,fullscreen,wp_adv',
                toolbar2: 'formatselect,underline,alignjustify,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help',
                toolbar3: '',
                toolbar4: '',
                body_class: 'id post-type-post post-status-publish post-format-standard',
                wpeditimage_disable_captions: false,
                wpeditimage_html5_captions: true

            },
            quicktags: true,
            mediaButtons: true
        };
    </script>
    <div class="zdnw-header">
        <div class="zdnw-header-time">
            <div class="zdnw-right-panel">
                <span class="date"><?php echo zhanot_change_number(ZH_jdate('d', time())); ?></span>
                <em><?php echo zhanot_change_number(ZH_jdate('F Y', time())); ?></em>
                <em>
                    <?php _e('Alert number', ZHANOT_TEXT_DOMAIN) ?>
                    <?php
                    global $post_id;
                    echo zhanot_change_number($post_id);
                    ?>
                </em>
            </div>
            <div class="zdnw-left-panel">
                <div class="zndw-ajax-search">
                </div>
            </div>
        </div>
    </div>
    <div class="zhanot-admin-noti-tabs">
        <ul>
            <?php
            $limit = 9;
            for ($i = 1; $i <= $limit; $i++):
                switch ($i) {
                    case 1:
                        $text = __('Text with button', ZHANOT_TEXT_DOMAIN);
                        break;
                    case 2:
                        $text = __('Product Introduction', ZHANOT_TEXT_DOMAIN);
                        break;
                    case 3:
                        $text = __('Post Introduction', ZHANOT_TEXT_DOMAIN);
                        break;
                    case 4:
                        $text = __('Timer', ZHANOT_TEXT_DOMAIN);
                        break;
                    case 5:
                        $text = __('Social Network', ZHANOT_TEXT_DOMAIN);
                        break;
                    case 6:
                        $text = __('Contact Info', ZHANOT_TEXT_DOMAIN);
                        break;
                    case 7:
                        $text = __('Image with Url', ZHANOT_TEXT_DOMAIN);
                        break;
                    case 8:
                        $text = __('Html Content', ZHANOT_TEXT_DOMAIN);
                        break;
                    case 9:
                        $text = __('Random Text', ZHANOT_TEXT_DOMAIN);
                        break;
                }
                ?>
                <li>
                    <div class="tab" data-zhanot-tab="<?php echo $i; ?>">
                        <input <?php zhanot_current_meta_tab_active($i, 'radio'); ?> type="radio" value="<?php echo $i; ?>" name="zhanot_noti_type" class="zhanot-noti-type" id="<?php echo 'zhanot_noti_type_' . $i; ?>">
                        <label for="<?php echo 'zhanot_noti_type_' . $i; ?>">
                            <img src="<?php echo ZHANOT_IMG_URL . 'tabs-icon-' . $i . '.svg'; ?>">
                            <span><?php echo $text; ?></span>
                        </label>
                    </div>
                </li>
            <?php endfor; ?>
        </ul>
    </div>
    <div class="zhanot-admin-noti-main-menu">
        <div class="zhanot-noti-btn zhanot-open-toggle-box" data-zhanot-open-toggle="zhanot-open-user-settings">
            <?php _e('User settings', ZHANOT_TEXT_DOMAIN) ?>
        </div>
        <div class="zhanot-noti-btn zhanot-open-toggle-box" data-zhanot-open-toggle="zhanot-open-noti-settings">
            <?php _e('Alert settings', ZHANOT_TEXT_DOMAIN) ?>
        </div>
        <div class="zhanot-open-user-settings zhanot-popup-toggle">
            <div class="popup-panel">
                <div class="zhanot-open-toggle-box zhanot-toggle-close"><i class="zhanot-ion-cancel-2"></i></div>
                <div class="zhanot-field">
                    <input type="checkbox" name="zhanot_post_show_only_once" id="zhanot_post_show_only_once" value="1" <?php echo $zhanot_meta_box_check_only == true ? ' checked="checked"' : ''; ?>>
                    <label for="zhanot_post_show_only_once"><?php _e('View once for each visitor?', ZHANOT_TEXT_DOMAIN) ?></label>
                    <div class="zh-td-dec"><?php _e('This event will be activated when the visitor click on the button to close the notification', ZHANOT_TEXT_DOMAIN); ?></div>
                </div>
                <div class="zhanot-field">
                    <input type="checkbox" name="zhanot_post_hide_logged_in_users" class="zhanot_uniq_checkbox" data-id="zhanot_post_for_user_roles" id="zhanot_post_hide_logged_in_users" value="1" <?php echo $zhanot_post_hide_logged_in_users == true ? ' checked="checked"' : ''; ?>>
                    <label for="zhanot_post_hide_logged_in_users"><?php _e('Hide logged in users', ZHANOT_TEXT_DOMAIN) ?></label>
                </div>
                <div class="zhanot-field">
                    <input type="checkbox" name="zhanot_post_for_user_roles" class="zhanot_uniq_checkbox" id="zhanot_post_for_user_roles" data-id="zhanot_post_hide_logged_in_users" value="1" <?php echo $zhanot_post_for_user_roles == true ? ' checked="checked"' : ''; ?>>
                    <label for="zhanot_post_for_user_roles"><?php _e('Display for specific user role', ZHANOT_TEXT_DOMAIN) ?></label>
                </div>
                <div class="zhanot-field">
                    <label for="zhanot_alert_users_role"><?php _e('Select User Roles', ZHANOT_TEXT_DOMAIN) ?></label>
                    <?php
                    $roles_obj = new WP_Roles();
                    $roles_names_array = $roles_obj->get_names();
                    $array_zh_roles = (array)zhanot_get_post_meta(get_the_id(), 'zhanot_alert_users_role', true);
                    if (is_array($array_zh_roles)) {
                        if (!empty($array_zh_roles)) {
                            foreach ($array_zh_roles as $role_value) {
                                $rols_selected[] = $role_value;
                            }
                        } else {
                            $rols_selected[] = [];
                        }
                    }
                    echo '<select name="zhanot_alert_users_role[]" class="zhanot-select-multiple zhanot-js-select-basic" multiple="multiple">';
                    foreach ($roles_names_array as $key => $value) {
                        ?>
                        <option <?php echo in_array($key, $rols_selected, true) ? 'selected' : ''; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
                        <?php
                    }
                    echo '</select>';
                    ?>
                    <div class="zh-td-dec"><?php _e('If blank, it will be displayed to all users and website visitors', ZHANOT_TEXT_DOMAIN); ?></div>
                </div>
            </div>
        </div>
        <div class="zhanot-open-noti-settings zhanot-popup-toggle">
            <div class="popup-panel">
                <div class="zhanot-open-toggle-box zhanot-toggle-close"><i class="zhanot-ion-cancel-2"></i></div>
                <div class="zhanot-acc-panels">
                    <div class="zhanot-acc-panel acc-panel-1">
                        <div class="acc-panel-title acc-toggle-btn" data-acc="1">
                            <i class="zhanot-ion-plus"></i> <?php _e('Show', ZHANOT_TEXT_DOMAIN); ?></div>
                        <div class="acc-content" style="display:none">
                            <div class="zhanot-field">
                                <input type="checkbox" name="zhanot_post_auto_load" id="zhanot_post_auto_load" value="1" <?php echo $zhanot_meta_box_check == true ? ' checked="checked"' : ''; ?>>
                                <label for="zhanot_post_auto_load"><?php _e('Automatically display top of website?', ZHANOT_TEXT_DOMAIN) ?></label>
                            </div>
                            <div class="zhanot-field">
                                <input type="checkbox" name="zhanot_post_wide" id="zhanot_post_wide" value="1" <?php echo $zhanot_meta_box_check_wide == true ? ' checked="checked"' : ''; ?>>
                                <label for="zhanot_post_wide"><?php _e('Widescreen display box content?', ZHANOT_TEXT_DOMAIN) ?></label>
                            </div>
                            <div class="zhanot-field">
                                <input type="checkbox" name="zhanot_sticky_noti" id="zhanot_sticky_noti" value="1" <?php echo $zhanot_sticky_noti == true ? ' checked="checked"' : ''; ?>>
                                <label for="zhanot_sticky_noti"><?php _e('Bottom sticky when scrolling', ZHANOT_TEXT_DOMAIN); ?></label>
                            </div>
                            <div class="zhanot-field">
                                <input type="checkbox" name="zhanot_button_url_open_new_page" id="zhanot_button_url_open_new_page" value="1"<?php echo $zhanot_url_new_page == true ? ' checked="checked"' : ''; ?>>
                                <label for="zhanot_button_url_open_new_page"><?php _e('Open link on new page?', ZHANOT_TEXT_DOMAIN) ?></label>
                            </div>
                            <div class="zhanot-field">
                                <input type="checkbox" name="zhanot_hidden_close_button" id="zhanot_hidden_close_button" value="1"<?php echo $zhanot_hidden_close_button == true ? ' checked="checked"' : ''; ?>>
                                <label for="zhanot_hidden_close_button"><?php _e('Hidden Close Button?', ZHANOT_TEXT_DOMAIN) ?></label>
                            </div>
                            <div class="zhanot-field">
                                <label for="zhanot_show_only_on"><?php _e('Show only on', ZHANOT_TEXT_DOMAIN) ?></label>
                                <select id="zhanot_show_only_on" name="zhanot_show_only_on">
                                    <option<?php echo zhanot_get_post_meta(get_the_id(), 'zhanot_show_only_on', true) == 'all' ? ' selected' : ''; ?> value="all"><?php _e('All', ZHANOT_TEXT_DOMAIN) ?></option>
                                    <option<?php echo zhanot_get_post_meta(get_the_id(), 'zhanot_show_only_on', true) == 'desktop' ? ' selected' : ''; ?> value="desktop"><?php _e('Desktop', ZHANOT_TEXT_DOMAIN) ?></option>
                                    <option<?php echo zhanot_get_post_meta(get_the_id(), 'zhanot_show_only_on', true) == 'mobile' ? ' selected' : ''; ?> value="mobile"><?php _e('Mobile', ZHANOT_TEXT_DOMAIN) ?></option>
                                </select>
                            </div>
                            <!--<div class="zhanot-field">
        <input type="checkbox" name="zhanot_show_in_specific_page" id="zhanot_show_in_specific_page" value="1"<?php echo $zhanot_show_in_specific_page == true ? ' checked="checked"' : ''; ?>>
        <label for="zhanot_show_in_specific_page"><?php _e('Show in specific page', ZHANOT_TEXT_DOMAIN) ?></label>
       </div>
       <div class="zhanot-field">
        <textarea dir="ltr" name="zhanot_specific_page" id="zhanot_specific_page"><?php
                            $specific = zhanot_get_post_meta(get_the_id(), 'zhanot_specific_page', true);
                            $pages = explode("\n", $specific);
                            if (count($pages) > 0) {
                                foreach ($pages as $page) {
                                    echo $page;
                                }
                            }
                            ?></textarea>
       </div>-->
                        </div>
                    </div>
                    <div class="zhanot-acc-panel acc-panel-2">
                        <div class="acc-panel-title acc-toggle-btn" data-acc="2">
                            <i class="zhanot-ion-plus"></i> <?php _e('Style', ZHANOT_TEXT_DOMAIN); ?></div>
                        <div class="acc-content" style="display:none">
                            <div class="zhanot-field">
                                <label class="title" for="zhanot_notification_img"><?php _e('Notification Background', ZHANOT_TEXT_DOMAIN) ?></label>
                                <input type="text" dir="ltr" class="zhanot_notification_img-url" name="zhanot_notification_img" size="60" value="<?php echo zhanot_get_post_meta(get_the_id(), 'zhanot_notification_img', true); ?>">
                                <div class="zhanot-noti-select-image">
                                    <i class="zhanot-ion-photo"></i>
                                    <div class="zhanot-noti-images-list zhanot-scrollbar-style">
                                        <?php
                                        $display_images = [
                                            ZHANOT_IMG_URL . 'display-images/zhanot-display-img-1.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-display-img-2.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-display-img-3.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-display-img-4.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-display-img-5.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-display-img-6.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-display-img-7.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-display-img-8.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-display-img-9.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-display-img-10.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-display-img-11.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-display-img-12.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-cdisplay-img-13.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-cdisplay-img-14.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-cdisplay-img-15.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-cdisplay-img-16.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-display-img-17.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-display-img-18.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-display-img-19.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-display-img-20.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-display-img-21.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-display-img-22.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-display-img-23.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-display-img-24.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-display-img-25.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-display-img-26.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-display-img-27.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-display-img-28.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-display-img-29.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-display-img-30.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-display-img-31.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-display-img-32.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-display-img-33.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-display-img-34.jpg',
                                            ZHANOT_IMG_URL . 'display-images/zhanot-display-img-35.jpg',
                                        ];
                                        if (count($display_images) > 0):
                                            foreach ($display_images as $display_image):
                                                if (file_is_valid_image($display_image)):
                                                    ?>
                                                    <div class="zh-noti-display-img<?php echo zhanot_check_post_meta_selected_option('zhanot_notification_img', $display_image) == true ? ' selected' : ''; ?>" data-zh-img-src="<?php echo $display_image; ?>">
                                                        <img src="<?php echo $display_image; ?>" alt="zhanot Display Images <?php echo $i; ?>">
                                                    </div>
                                                <?php endif;
                                            endforeach;
                                        endif; ?>
                                    </div>
                                </div>
                                <button class="uploadax upload-box btn-success button" type="submit" id="zhanot_notification_img"><?php _e('Select Image', ZHANOT_TEXT_DOMAIN) ?></button>
                                <button class="uploadax upload-box-remove logo-remove btn-warning button" type="submit" data-id="zhanot_notification_img"><?php _e('Delete', ZHANOT_TEXT_DOMAIN) ?></button>
                            </div>
                            <div class="zhanot-field">
                                <label for="zhanot_alert_bg"><?php _e('Background color notification', ZHANOT_TEXT_DOMAIN) ?></label>
                                <input type="text" value="<?php echo zhanot_get_post_meta(get_the_id(), 'zhanot_alert_bg', true); ?>" name="zhanot_alert_bg" id="zhanot_alert_bg" class="zhanot-color-picker">
                            </div>
                            <div class="zhanot-field">
                                <label for="zhanot_alert_content_bg"><?php _e('Background color notification content', ZHANOT_TEXT_DOMAIN) ?></label>
                                <input type="text" value="<?php $c = zhanot_get_post_meta(get_the_id(), 'zhanot_alert_content_bg', true);
                                echo !empty($c) ? $c : '#ffffff'; ?>" name="zhanot_alert_content_bg" id="zhanot_alert_content_bg" class="zhanot-color-picker">
                            </div>
                            <div class="zhanot-field">
                                <label for="zhanot_alert_content_bg_opacity"><?php _e('Background color opacity notification content (0 to 99)', ZHANOT_TEXT_DOMAIN) ?></label>
                                <input type="number" min="0" max="99" value="<?php $c = zhanot_get_post_meta(get_the_id(), 'zhanot_alert_content_bg_opacity', true);
                                echo !empty($c) || $c == 0 ? $c : 99; ?>" name="zhanot_alert_content_bg_opacity" id="zhanot_alert_content_bg_opacity">
                            </div>
                            <div class="zhanot-field">
                                <label for="zhanot_alert_text_color"><?php _e('Text color notification', ZHANOT_TEXT_DOMAIN) ?></label>
                                <input type="text" value="<?php echo zhanot_get_post_meta(get_the_id(), 'zhanot_alert_text_color', true); ?>" id="zhanot_alert_text_color" name="zhanot_alert_text_color" class="zhanot-color-picker">
                            </div>
                            <div class="zhanot-field">
                                <label for="zhanot_alert_text_font_size"><?php _e('Notification Font size', ZHANOT_TEXT_DOMAIN) ?></label>
                                <input type="number" value="<?php echo zhanot_get_post_meta(get_the_id(), 'zhanot_alert_text_font_size', true); ?>" min="15" max="35" id="zhanot_alert_text_font_size" name="zhanot_alert_text_font_size" placeholder="15">
                            </div>
                            <div class="zhanot-field">
                                <label for="zhanot_alert_button_color"><?php _e('Button Color', ZHANOT_TEXT_DOMAIN) ?></label>
                                <input type="text" value="<?php echo zhanot_get_post_meta(get_the_id(), 'zhanot_alert_button_color', true); ?>" id="zhanot_alert_button_color" name="zhanot_alert_button_color" class="zhanot-color-picker">
                            </div>
                            <div class="zhanot-field">
                                <label for="zhanot_alert_text_button_color"><?php _e('Text Button Color', ZHANOT_TEXT_DOMAIN) ?></label>
                                <input type="text" value="<?php echo zhanot_get_post_meta(get_the_id(), 'zhanot_alert_text_button_color', true); ?>" id="zhanot_alert_text_button_color" name="zhanot_alert_text_button_color" class="zhanot-color-picker">
                            </div>
                            <div class="zhanot-field">
                                <label for="zhanot_alert_margin"><?php _e('Notification Margin (pixel)', ZHANOT_TEXT_DOMAIN) ?></label>
                                <div class="zhanot-mp-field">
                                    <?php
                                    $margin = zhanot_get_post_meta(get_the_id(), 'zhanot_alert_margin', true);
                                    $margin = explode(',', $margin);
                                    ?>
                                    <input type="number" min="0" value="<?php echo $margin[0]; ?>" name="zhanot_alert_margin_top" placeholder="<?php _e('Top', ZHANOT_TEXT_DOMAIN); ?>">
                                    <input type="number" min="0" value="<?php echo $margin[1]; ?>" name="zhanot_alert_margin_right" placeholder="<?php _e('Right', ZHANOT_TEXT_DOMAIN); ?>">
                                    <input type="number" min="0" value="<?php echo $margin[2]; ?>" name="zhanot_alert_margin_bottom" placeholder="<?php _e('Bottom', ZHANOT_TEXT_DOMAIN); ?>">
                                    <input type="number" min="0" value="<?php echo $margin[3]; ?>" name="zhanot_alert_margin_left" placeholder="<?php _e('Left', ZHANOT_TEXT_DOMAIN); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="zhanot-admin-noti-tabs-content">
        <div class="zhanot-admin-noti-tab zhanot-noti-tab-1" style="<?php echo zhanot_current_meta_tab(1) ? 'display: block' : 'display: none'; ?>">
            <h3><?php _e('Text with button', ZHANOT_TEXT_DOMAIN) ?></h3>
            <div class="zh-field">
                <textarea name="zhanot_simple_textfield" id="zhanot_simple_textfield" placeholder="<?php _e('Text notification', ZHANOT_TEXT_DOMAIN) ?>"><?php echo zhanot_get_post_meta(get_the_id(), 'zhanot_simple_textfield', true); ?></textarea>
            </div>
            <div class="zh-field">
                <input type="text" placeholder="<?php _e('Button Text notification', ZHANOT_TEXT_DOMAIN) ?>" name="zhanot_simple_btn_text" id="zhanot_simple_btn_text" value="<?php echo zhanot_get_post_meta(get_the_id(), 'zhanot_simple_btn_text', true); ?>">
            </div>
            <div class="zh-field">
                <input type="text" name="zhanot_simple_btn_url" placeholder="<?php _e('Button Url notification', ZHANOT_TEXT_DOMAIN) ?>" id="zhanot_simple_btn_url" value="<?php echo zhanot_get_post_meta(get_the_id(), 'zhanot_simple_btn_url', true); ?>">
            </div>
        </div>
        <div class="zhanot-admin-noti-tab zhanot-noti-tab-2" style="<?php echo zhanot_current_meta_tab(2) ? 'display: block' : 'display: none'; ?>">
            <h3><?php _e('Product Introduction', ZHANOT_TEXT_DOMAIN) ?></h3>
            <div class="zh-field">
                <input type="text" dir="ltr" placeholder="<?php _e('Product Image', ZHANOT_TEXT_DOMAIN) ?>" class="zhanot_product_img-url" name="zhanot_product_img" size="60" value="<?php echo zhanot_get_post_meta(get_the_id(), 'zhanot_product_img', true); ?>">
            </div>
            <button class="uploadax upload-box button" type="submit" id="zhanot_product_img"><?php _e('Select Image', ZHANOT_TEXT_DOMAIN) ?></button>
            <button class="uploadax upload-box-remove logo-remove button" type="submit" data-id="zhanot_product_img"><?php _e('Delete', ZHANOT_TEXT_DOMAIN) ?></button>
            <div class="zh-field">
                <textarea name="zhanot_product_textfield" id="zhanot_product_textfield" placeholder="<?php _e('Text notification', ZHANOT_TEXT_DOMAIN) ?>"><?php echo zhanot_get_post_meta(get_the_id(), 'zhanot_product_textfield', true); ?></textarea>
            </div>
            <div class="zh-field">
                <input type="text" placeholder="<?php _e('Discount percent', ZHANOT_TEXT_DOMAIN) ?>" name="zhanot_product_discount" id="zhanot_product_discount" value="<?php echo get_post_meta(get_the_id(), 'zhanot_product_discount', true); ?>" placeholder="50%">
            </div>
            <div class="zh-field">
                <input type="text" placeholder="<?php _e('Product price', ZHANOT_TEXT_DOMAIN) ?>" name="zhanot_product_price" id="zhanot_product_price" value="<?php echo get_post_meta(get_the_id(), 'zhanot_product_price', true); ?>">
            </div>
            <div class="zh-field">
                <input type="text" placeholder="<?php _e('Button Text notification', ZHANOT_TEXT_DOMAIN) ?>" name="zhanot_product_btn_text" id="zhanot_product_btn_text" value="<?php echo get_post_meta(get_the_id(), 'zhanot_product_btn_text', true); ?>">
            </div>
            <div class="zh-field">
                <input type="text" placeholder="<?php _e('Button Url notification', ZHANOT_TEXT_DOMAIN) ?>" name="zhanot_product_btn_url" id="zhanot_product_btn_url" value="<?php echo get_post_meta(get_the_id(), 'zhanot_product_btn_url', true); ?>">
            </div>
        </div>
        <div class="zhanot-admin-noti-tab zhanot-noti-tab-3" style="<?php echo zhanot_current_meta_tab(3) ? 'display: block' : 'display: none'; ?>">
            <h3><?php _e('Post Introduction', ZHANOT_TEXT_DOMAIN) ?></h3>
            <div class="zh-field">
                <input type="text" dir="ltr" placeholder="<?php _e('Post Image', ZHANOT_TEXT_DOMAIN) ?>" class="zhanot_post_img-url" name="zhanot_post_img" value="<?php echo get_post_meta(get_the_id(), 'zhanot_post_img', true); ?>">
            </div>
            <button class="uploadax upload-box button" type="submit" id="zhanot_post_img"><?php _e('Select Image', ZHANOT_TEXT_DOMAIN) ?></button>
            <button class="uploadax upload-box-remove logo-remove button" type="submit" data-id="zhanot_post_img"><?php _e('Delete', ZHANOT_TEXT_DOMAIN) ?></button>
            <div class="zh-field">
                <textarea name="zhanot_post_textfield" id="zhanot_post_textfield" placeholder="<?php _e('Text notification', ZHANOT_TEXT_DOMAIN) ?>"><?php echo get_post_meta(get_the_id(), 'zhanot_post_textfield', true); ?></textarea>
            </div>
            <div class="zh-field">
                <input type="text" name="zhanot_post_btn_text" placeholder="<?php _e('Button Text notification', ZHANOT_TEXT_DOMAIN) ?>" id="zhanot_post_btn_text" value="<?php echo get_post_meta(get_the_id(), 'zhanot_post_btn_text', true); ?>">
            </div>
            <div class="zh-field">
                <input type="text" name="zhanot_post_btn_url" placeholder="<?php _e('Button Url notification', ZHANOT_TEXT_DOMAIN) ?>" id="zhanot_post_btn_url" value="<?php echo get_post_meta(get_the_id(), 'zhanot_post_btn_url', true); ?>">
            </div>
        </div>
        <div class="zhanot-admin-noti-tab zhanot-noti-tab-4" style="<?php echo zhanot_current_meta_tab(4) ? 'display: block' : 'display: none'; ?>">
            <h3><?php _e('Timer', ZHANOT_TEXT_DOMAIN) ?></h3>
            <div class="zh-field">
                <label for=""><?php _e('Timer Background color', ZHANOT_TEXT_DOMAIN) ?></label>
                <input type="text" value="<?php echo get_post_meta(get_the_id(), 'zhanot_alert_timer_bg_color', true); ?>" id="zhanot_alert_timer_bg_color" name="zhanot_alert_timer_bg_color" class="zhanot-color-picker">
            </div>
            <div class="zh-field">
                <label for=""><?php _e('Timer Text color', ZHANOT_TEXT_DOMAIN) ?></label>
                <input type="text" value="<?php echo get_post_meta(get_the_id(), 'zhanot_alert_timer_text_color', true); ?>" id="zhanot_alert_timer_text_color" name="zhanot_alert_timer_text_color" class="zhanot-color-picker">
            </div>
            <div class="zh-field">
                <label for=""><?php _e('Timer Shadow color', ZHANOT_TEXT_DOMAIN) ?></label>
                <input type="text" value="<?php echo get_post_meta(get_the_id(), 'zhanot_alert_timer_shadow_color', true); ?>" id="zhanot_alert_timer_shadow_color" name="zhanot_alert_timer_shadow_color" class="zhanot-color-picker">
            </div>
            <div class="zh-field">
                <textarea name="zhanot_timer_textfield" id="zhanot_timer_textfield" placeholder="<?php _e('Text notification', ZHANOT_TEXT_DOMAIN) ?>"><?php echo get_post_meta(get_the_id(), 'zhanot_timer_textfield', true); ?></textarea>
            </div>
            <div class="zh-field">
                <input type="text" autocomplete="off" placeholder="<?php _e('Timer end Date', ZHANOT_TEXT_DOMAIN) ?>" name="zhanot_post_timer_date" id="zhanot-date-picker" value="<?php echo zhanot_check_jdate_empty('zhanot_post_timer_date'); ?>">
            </div>
            <div class="zh-field">
                <input type="time" placeholder="<?php _e('Time', ZHANOT_TEXT_DOMAIN) ?>" name="zhanot_post_timer_time" id="zhanot_post_timer_time" value="<?php echo get_post_meta(get_the_id(), 'zhanot_post_timer_time', true); ?>">
                <div class="zh-field">
                    <div class="zh-input-slug">
                        PM = <?php _e('Post meridian', ZHANOT_TEXT_DOMAIN) ?>
                    </div>
                    <div class="zh-input-slug">
                        AM = <?php _e('Ante meridiem', ZHANOT_TEXT_DOMAIN) ?>
                    </div>
                </div>
            </div>
            <div class="zh-field">
                <input type="text" placeholder="<?php _e('Timer end Text', ZHANOT_TEXT_DOMAIN) ?>" name="zhanot_post_timer_end_text" id="zhanot_post_timer_end_text" value="<?php echo get_post_meta(get_the_id(), 'zhanot_post_timer_end_text', true); ?>">
            </div>
            <div class="zh-field">
                <input type="text" placeholder="<?php _e('Button Text notification', ZHANOT_TEXT_DOMAIN) ?>" name="zhanot_timer_btn_text" id="zhanot_timer_btn_text" value="<?php echo get_post_meta(get_the_id(), 'zhanot_timer_btn_text', true); ?>">
            </div>
            <div class="zh-field">
                <input type="text" placeholder="<?php _e('Button Url notification', ZHANOT_TEXT_DOMAIN) ?>" name="zhanot_timer_btn_url" id="zhanot_timer_btn_url" value="<?php echo get_post_meta(get_the_id(), 'zhanot_timer_btn_url', true); ?>">
            </div>
        </div>
        <div class="zhanot-admin-noti-tab zhanot-noti-tab-5" style="<?php echo zhanot_current_meta_tab(5) ? 'display: block' : 'display: none'; ?>">
            <h3><?php _e('Social Network', ZHANOT_TEXT_DOMAIN) ?></h3>
            <div class="zh-field">
                <textarea name="zhanot_socials_textfield" id="zhanot_socials_textfield" placeholder="<?php _e('Text notification', ZHANOT_TEXT_DOMAIN) ?>"><?php echo get_post_meta(get_the_id(), 'zhanot_socials_textfield', true); ?></textarea>
            </div>
            <div class="zh-field">
                <input type="text" placeholder="<?php _e('Google plus', ZHANOT_TEXT_DOMAIN) ?>" name="zhanot_post_gplus_url" id="zhanot_post_gplus_url" value="<?php echo get_post_meta(get_the_id(), 'zhanot_post_gplus_url', true); ?>">
                <input type="text" placeholder="<?php _e('Pinterest', ZHANOT_TEXT_DOMAIN) ?>" name="zhanot_post_pinterest_url" id="zhanot_post_pinterest_url" value="<?php echo get_post_meta(get_the_id(), 'zhanot_post_pinterest_url', true); ?>">
                <input type="text" placeholder="<?php _e('Twitter', ZHANOT_TEXT_DOMAIN) ?>" name="zhanot_post_twitter_url" id="zhanot_post_twitter_url" value="<?php echo get_post_meta(get_the_id(), 'zhanot_post_twitter_url', true); ?>">
                <input type="text" placeholder="<?php _e('Instagram', ZHANOT_TEXT_DOMAIN) ?>" name="zhanot_post_ins_url" id="zhanot_post_ins_url" value="<?php echo get_post_meta(get_the_id(), 'zhanot_post_ins_url', true); ?>">
                <input type="text" placeholder="<?php _e('Github', ZHANOT_TEXT_DOMAIN) ?>" name="zhanot_post_github_url" id="zhanot_post_github_url" value="<?php echo get_post_meta(get_the_id(), 'zhanot_post_github_url', true); ?>">
                <input type="text" placeholder="<?php _e('Telegram', ZHANOT_TEXT_DOMAIN) ?>" name="zhanot_post_tg_url" id="zhanot_post_tg_url" value="<?php echo get_post_meta(get_the_id(), 'zhanot_post_tg_url', true); ?>">
                <input type="text" placeholder="<?php _e('WhatsApp phone number', ZHANOT_TEXT_DOMAIN) ?>" name="zhanot_post_wapp_url" id="zhanot_post_wapp_url" value="<?php echo get_post_meta(get_the_id(), 'zhanot_post_wapp_url', true); ?>">
                <input type="text" placeholder="<?php _e('Linkedin', ZHANOT_TEXT_DOMAIN) ?>" name="zhanot_post_in_url" id="zhanot_post_in_url" value="<?php echo get_post_meta(get_the_id(), 'zhanot_post_in_url', true); ?>">
                <input type="text" placeholder="<?php _e('Facebook', ZHANOT_TEXT_DOMAIN) ?>" name="zhanot_post_fb_url" id="zhanot_post_fb_url" value="<?php echo get_post_meta(get_the_id(), 'zhanot_post_fb_url', true); ?>">
            </div>
        </div>
        <div class="zhanot-admin-noti-tab zhanot-noti-tab-6" style="<?php echo zhanot_current_meta_tab(6) ? 'display: block' : 'display: none'; ?>">
            <h3><?php _e('Contact Info', ZHANOT_TEXT_DOMAIN) ?></h3>
            <div class="zh-field">
                <textarea name="zhanot_contactus_textfield" id="zhanot_contactus_textfield" placeholder="<?php _e('Text notification', ZHANOT_TEXT_DOMAIN) ?>"><?php echo get_post_meta(get_the_id(), 'zhanot_contactus_textfield', true); ?></textarea>
            </div>
            <div class="zh-field">
                <input type="text" placeholder="<?php _e('Phone number', ZHANOT_TEXT_DOMAIN) ?>" name="zhanot_post_phone_number" id="zhanot_post_phone_number" value="<?php echo get_post_meta(get_the_id(), 'zhanot_post_phone_number', true); ?>">
            </div>
            <div class="zh-field">
                <input type="text" placeholder="<?php _e('Email address', ZHANOT_TEXT_DOMAIN) ?>" name="zhanot_post_email" id="zhanot_post_email" value="<?php echo get_post_meta(get_the_id(), 'zhanot_post_email', true); ?>">
            </div>
        </div>
        <div class="zhanot-admin-noti-tab zhanot-noti-tab-7" style="<?php echo zhanot_current_meta_tab(7) ? 'display: block' : 'display: none'; ?>">
            <h3><?php _e('Image with Url', ZHANOT_TEXT_DOMAIN) ?></h3>
            <div class="zh-field">
                <input type="text" placeholder="<?php _e('Select Image', ZHANOT_TEXT_DOMAIN) ?>" dir="ltr" class="zhanot_image_url-url" name="zhanot_image_url" value="<?php echo get_post_meta(get_the_id(), 'zhanot_image_url', true); ?>">
            </div>
            <button class="uploadax upload-box btn-success button" type="submit" id="zhanot_image_url"><?php _e('Select Image', ZHANOT_TEXT_DOMAIN) ?></button>
            <button class="uploadax upload-box-remove logo-remove btn-warning button" type="submit" data-id="zhanot_image_url"><?php _e('Delete', ZHANOT_TEXT_DOMAIN) ?></button>
            <div class="zh-field">
                <input type="text" placeholder="<?php _e('Image alternate', ZHANOT_TEXT_DOMAIN) ?>" name="zhanot_image_url_alt_text" id="zhanot_image_url_alt_text" value="<?php echo get_post_meta(get_the_id(), 'zhanot_image_url_alt_text', true); ?>">
            </div>
            <div class="zh-field">
                <input type="text" placeholder="<?php _e('Url', ZHANOT_TEXT_DOMAIN) ?>" name="zhanot_image_url_external" id="zhanot_image_url_external" value="<?php echo get_post_meta(get_the_id(), 'zhanot_image_url_external', true); ?>">
            </div>
        </div>
        <div class="zhanot-admin-noti-tab zhanot-noti-tab-8" style="<?php echo zhanot_current_meta_tab(8) ? 'display: block' : 'display: none'; ?>">
            <h3><?php _e('Html Content', ZHANOT_TEXT_DOMAIN) ?></h3>
            <div class="zh-field">
                <label for="zhanot_html_content_textfield"><?php _e('Content notification', ZHANOT_TEXT_DOMAIN) ?></label>
                <?php wp_editor(stripslashes(get_post_meta(get_the_id(), 'zhanot_html_content_textfield', true)), 'zhanot_html_content_textfield', $editor_settings); ?>
            </div>
        </div>
        <div class="zhanot-admin-noti-tab zhanot-noti-tab-9" style="<?php echo zhanot_current_meta_tab(9) ? 'display: block' : 'display: none'; ?>">
            <h3><?php _e('Random Text', ZHANOT_TEXT_DOMAIN) ?></h3>
            <div id="zhanot-random-content-lists">
                <?php
                wp_enqueue_editor();
                $rand_content = get_post_meta(get_the_id(), 'zhanot_random_content_textfield', true);
                if (is_array($rand_content)) {
                    $i = 1;
                    foreach ($rand_content as $context) { ?>
                        <div class="zh-field zh-field-<?php echo $i; ?>">
                            <span class="zh-col-close" data-zh-field="<?php echo $i; ?>"><i class="zhanot-ion-cancel"></i> <em><?php echo $i; ?></em></span>
                            <div class="zh-field">
                                <textarea placeholder="<?php _e('Content', ZHANOT_TEXT_DOMAIN) ?>" id="zhanot_random_content_textfield_<?php echo $i; ?>" name="zhanot_random_content_textfield[]"><?php echo $context; ?></textarea>
                            </div>
                            <script type="text/javascript">
                                jQuery(document).ready(function () {
                                    wp.editor.initialize("zhanot_random_content_textfield_<?php echo $i; ?>", $tinmce_options);
                                });
                            </script>
                        </div>
                        <?php
                        $i++;
                    }
                }
                ?>
            </div>
            <div class="zhanot-add-new-content-wrapper">
                <button type="button" class="zhanot-add-new-random"><?php _e('Add New Content', ZHANOT_TEXT_DOMAIN) ?></button>
            </div>
            <script type="text/javascript">
                function textarea_to_tinymce(id) {
                    if (typeof (tinyMCE) == "object" && typeof (tinyMCE.execCommand) == "function") {
                        tinyMCE.execCommand("mceAddEditor", false, id);
                    }
                }

                jQuery(document).ready(function ($) {
                    $('body').on("click", '.zhanot-add-new-random', function () {
                        var rand_num = Math.floor((Math.random() * 1000000000) + 1000);
                        $('#zhanot-random-content-lists').append('<div class="zh-field zh-field-' + rand_num + '"><span class="zh-col-close" data-zh-field="' + rand_num + '"><i class="zhanot-ion-cancel"></i><em>' + rand_num + '</em></span><div class="zh-field"><textarea placeholder="<?php _e('Content', ZHANOT_TEXT_DOMAIN) ?>" class="zhanot-wp-tinymce-' + rand_num + '" id="zhanot-wp-tinymce-' + rand_num + '" name="zhanot_random_content_textfield[]"></textarea></div></div>');
                        wp.editor.initialize("zhanot-wp-tinymce-" + rand_num + "", $tinmce_options);
                    });
                    $('body').on("click", '.zh-col-close', function (e) {
                        e.preventDefault();
                        var $this = $(this);
                        var $data_col = $this.data('zh-field');
                        $('.zh-field-' + $data_col + '').slideUp();
                        $('.zh-field-' + $data_col + '').remove();
                    });
                });
            </script>
        </div>
    </div>
</div>