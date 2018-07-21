<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?> 
<?php if ($status == '1') { ?>
    <a class="label label-success<?php echo (isset($permissionKey) && is_allow_action($permissionKey) === FALSE) ? '' : ' changestatus'; ?>" data-id="<?php echo $id; ?>" data-status="1" href="<?php echo (isset($permissionKey) && is_allow_action($permissionKey) === FALSE) ? 'javascript:;' : site_url($url); ?>">Active</a>
<?php } else { ?>
    <a class="label label-danger<?php echo (isset($permissionKey) && is_allow_action($permissionKey) === FALSE) ? '' : ' changestatus'; ?>" data-id="<?php echo $id; ?>" data-status="0" href="<?php echo (isset($permissionKey) && is_allow_action($permissionKey) === FALSE) ? 'javascript:;' : site_url($url); ?>">Inactive</a> 
<?php } ?>