<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>   
<div class="action-link">
    <?php if (isset($editUrl)) { ?> 
        <a href="<?php echo site_url($editUrl); ?>"  data-id="<?php echo $id; ?>" class="btn btn-block btn-warning btn-xs edit-row<?php echo (isset($editPermissionKey) && is_allow_action($editPermissionKey) === FALSE) ? ' disabled' : ''; ?>" data-toggle="tooltip" title="" data-original-title="Edit"> <span class="fa fa-edit"></span> </a>
    <?php } ?>
    <?php if (isset($permissionUrl)) { ?>
        <a href="<?php echo site_url($permissionUrl); ?>" data-id="<?php echo $id; ?>" class="btn btn-block btn-primary btn-xs"  data-toggle="tooltip" title="" data-original-title="Manage Permissions"> <span class="fa fa-key"></span> </a>
    <?php } ?>
    <?php if (isset($deleteUrl)) { ?>
        <a href="<?php echo site_url($deleteUrl); ?>" data-id="<?php echo $id; ?>" class="btn btn-block btn-danger btn-xs delete-row<?php echo (isset($deletePermissionKey) && is_allow_action($deletePermissionKey) === FALSE) ? ' disabled' : ''; ?>"  data-toggle="tooltip" title="" data-original-title="Delete"> <span class="fa fa-trash-o"></span> </a>
    <?php } ?>
    <?php if (isset($viewUrl)) { ?>
        <a href="<?php echo site_url($viewUrl); ?>" data-id="<?php echo $id; ?>" class="btn btn-block btn-primary btn-xs view-row"  data-toggle="tooltip" title="" data-original-title="View"> <span class="fa fa-eye"></span> </a>
    <?php } ?> 
    <?php if (isset($downloadUrl)) { ?>
        <a href="<?php echo site_url($downloadUrl); ?>" class="btn btn-block btn-primary btn-xs"  data-toggle="tooltip" title="" data-original-title="Download"> <span class="fa fa-download"></span> </a>
    <?php } ?>
    <?php if (isset($galleryUrl) && is_allow_action('package-gallery') === TRUE) { ?>
        <a href="<?php echo site_url($galleryUrl); ?>" class="btn btn-block btn-primary btn-xs"  data-toggle="tooltip" title="Package Gallery" data-original-title="Package Gallery"> <span class="fa fa-image"></span> </a>
    <?php } ?>
</div> 