<div class="wrap">
    <h2>Easy 404 Redirect</h2>
    <form method="post" > 
        <?php settings_fields('easy_404_redirect_option'); ?>
        <?php @do_settings_fields('easy_404_redirect_option'); ?>

        <table class="form-table"> 
            <tr valign="top">
                <th scope="row"><label for="easy_404_redirect_enable">Enable Easy 404 Redirect</label></th>
                <td>
                    <input type="checkbox"  name="easy_404_redirect_enable" id="easy_404_redirect_enable" <?= get_option('easy_404_redirect_enable', 'off') == 'on' ? 'checked' : '' ?>>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><label for="page_id">Select the page</label></th>
                <td>
                    <input type="radio"  name="easy_404_redirect_home" value="home"  <?= get_option('easy_404_redirect_home', 'home') == 'home' ? 'checked' : '' ?> <?= get_option('easy_404_redirect_enable', 'off') != 'on' ? 'disabled' : ''; ?>>
                    Home page<br />
                    
                    <input type="radio" id="radio_easy_404_redirect_page" name="easy_404_redirect_home" value="page" <?= get_option('easy_404_redirect_home', 'home') == 'page' ? 'checked' : '' ?> <?= get_option('easy_404_redirect_enable', 'off') != 'on' ? 'disabled' : ''; ?>>
                    Other page: <?php wp_dropdown_pages(array('name'=>'easy_404_redirect_page', 'selected' => get_option('easy_404_redirect_page'))); ?>
                </td>
            </tr>
        </table>

        <?php @submit_button(); ?>
    </form>

    <a href="http://www.ninjapress.net/suite/" target="_blank">
        <img style="float:right" src="<?= plugins_url('images/ninjapress-logo.png', dirname(__FILE__)); ?>" />
    </a>
</div>