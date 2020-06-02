<div class="wrap" id="wpfba">
    <h2><?php _e('Foundation Block Adapter Settings', FOUNDATION_BLOCK_ADAPTER_DOMAIN); ?></h2>
    <div id="poststuff">
        <form id="wpfba-general-form" method="post" action="">
            <div class="postbox">
                <h3 class="hndle">
                    <label for="title"><?php _e('General Settings', FOUNDATION_BLOCK_ADAPTER_DOMAIN); ?></label>
                </h3>
                <div class="inside">
                    <table class="form-table">
                        <tbody>
                            <tr valign="top">
                                <th scope="row"><?php _e('Color palette', FOUNDATION_BLOCK_ADAPTER_DOMAIN); ?></th>
                                <td data-scope="whitelist">
                                    <textarea id="wpfba-general-colors" name="wpfba_general_colors" rows="5" style="width: 500px"><?php echo $this->menu->settings->colors; ?></textarea>
                                    <br/>
                                    <p class="description"><?php echo sprintf(__('Color palette as json object (see %s for more)', FOUNDATION_BLOCK_ADAPTER_DOMAIN), '<a href="https://developer.wordpress.org/block-editor/developers/themes/theme-support/">docs</a>'); ?></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="submit">
                        <input type="submit" name="wpfba_general_submit" class="button-primary" value="<?php echo __('Save', FOUNDATION_BLOCK_ADAPTER_DOMAIN); ?>" />
                    </p>
                </div>
            </div>
            <input type="hidden" name="wpfba_general_form" value="1" />
        </form>
    </div>
</div>
