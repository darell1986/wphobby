<?php if(!defined('ABSPATH')) die('You are not allowed to call this page directly.'); ?>

<div class="wrap">
  <?php echo PrliAppHelper::page_title(__('Edit Group', 'pretty-link')); ?>

  <?php require(PRLI_VIEWS_PATH.'/shared/errors.php'); ?>

  <form name="form1" method="post" action="<?php echo admin_url("admin.php?page=pretty-link-groups"); ?>">
    <input type="hidden" name="action" value="update">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <?php wp_nonce_field('update-options'); ?>

    <table class="form-table">
      <tr class="form-field">
        <td width="75px" valign="top"><?php _e('Name:', 'pretty-link'); ?> </td>
        <td><input type="text" name="name" value="<?php echo htmlspecialchars(stripslashes(((isset($_POST['name']) and $record == null)?$_POST['name']:$record->name))); ?>" size="75">
          <br/><span class="setting-description"><?php _e("This is how you'll identify your Group.", 'pretty-link'); ?></span></td>
      </tr>
      <tr class="form-field">
        <td valign="top"><?php _e('Description:', 'pretty-link'); ?> </td>
        <td><textarea style="height: 100px;" name="description"><?php echo ((isset($_POST['description']) and $record == null)?$_POST['description']:$record->description); ?></textarea>
        <br/><span class="setting-description"><?php _e('A Description of this group.', 'pretty-link'); ?></span></td>
      </tr>
      <tr class="form-field" valign="top">
        <td valign="top"><?php _e('Links:', 'pretty-link'); ?> </td>
        <td valign="top">
          <div style="height: 400px; width: 95%; border: 1px solid #8cbdd5; overflow: auto;">
            <table width="100%" cellspacing="0">
              <thead style="background-color: #dedede; padding: 0px; margin: 0px; line-height: 8px; font-size: 14px;">
                <th style="padding-left: 5px; margin: 0px; width: 50%; min-width: 50%;"><strong><?php _e('Name', 'pretty-link'); ?></strong></th>
                <th style="padding-left: 5px; margin: 0px; width: 50%; min-width: 50%;"><strong><?php _e('Current Group', 'pretty-link'); ?></strong></th>
              </thead>
              <?php
              for($i = 0; $i < count($links); $i++) {
                $link = $links[$i];

                ?>
                <tr style="line-height: 15px; font-size: 12px;<?php echo (($i%2)?' background-color: #efefef;':''); ?>">
                  <td style="min-width: 50%; width: 50%"><input type="checkbox" style="display:inline;width: 15px; padding: 0; margin: 0; float: left; text-align: left;" name="link[<?php echo $link->id; ?>]" <?php echo (((isset($_POST['link'][$link->id]) and $_POST['link'][$link->id] == 'on') or (empty($_POST) and $link->group_id == $record->id))?'checked="true"':''); ?>/><span>&nbsp;<?php echo htmlspecialchars(stripslashes($link->name)) . " <strong>(" . $link->slug . ")</strong>"; ?></span></td>
                  <td style="min-width: 50%; width: 50%"><?php echo htmlspecialchars(stripslashes($link->group_name)); ?></td>
                </tr>
                <?php

              }
              ?>
            </table>
          </div>
          <span class="setting-description"><?php _e('Select some links for this group. <strong>Note: each link can only be in one group at a time.</strong>', 'pretty-link'); ?></span>
        </td>
      </tr>
    </table>

    <p class="submit">
      <input type="submit" class="button button-primary" name="submit" value="<?php _e('Update', 'pretty-link'); ?>" /> &nbsp; <a href="<?php echo admin_url('admin.php?page=pretty-link-groups'); ?>" class="button"><?php _e('Cancel', 'pretty-link'); ?></a>
    </p>
  </form>
</div>
