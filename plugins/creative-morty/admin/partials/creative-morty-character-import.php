<h2><?php echo __( 'Rick & Morty Character sync','creative-morty'); ?></h2>
<div class="">

    <div>
        <p><?php echo __('Existing entries will be deleted and replaced by the new ones'); ?></p>
    </div>

    <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" id="nds_add_user_meta_form" >

        <input type="hidden" name="action" value="creative_morty_character_sync">
        <?php wp_nonce_field('creative_morty_character_sync') ?>
        <div>
            <br>
            <label> <?php _e('Import Limit', 'creative_morty'); ?> </label><br>
            <input required id="creative_morty_sync_limit" type="number" step="1" max="500" min="1" name="cm_sync_limit" value="10" /><br>
        </div>
        <p class="submit"><input type="submit" name="sync" id="submit" class="button button-primary" value="Sync"></p>
    </form>
    <br/><br/>
</div>