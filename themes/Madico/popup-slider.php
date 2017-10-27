<?php
$sliderID=$_POST['sliderID'];
$content = get_post_meta($sliderID,'wpcf-slider-content',true);
$popup_title=get_the_title($sliderID);

?>
<div class="modal-dialog modal-sm" role="document">
        <div class="modal-content-outer">
            <div class="modal-content">
                <div class="modal-header">
                    <a class="close close-reveal-modal" data-dismiss="modal">&times;</a>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button> -->
                    <h2 class="modal-title" id="myModalLabel"><?php echo (!empty($popup_title)? $popup_title:'slider has no title') ?></h2>
                    </div>
                    <div class="modal-body">
                    <?php echo (!empty($content)? $content:'slider has no content') ?>
                    </div>
            </div>
        </div>
    </div>


<script type="text/javascript">
jQuery(document).ready(function () {
    jQuery('.close-reveal-modal modal-backdrop').on('click',function () {
        jQuery('.close-reveal-modal').trigger('reveal:close');
        jQuery('.rep_modal').removeClass('modalActive');
    });
    jQuery('body').on('click',function () {
    jQuery('.close-reveal-modal').trigger('reveal:close');
    jQuery('.rep_modal').removeClass('modalActive');
    });
    //To remove the modal pop-up content on modal pop-up close process
    jQuery('#modal_rep').on('hidden.bs.modal', function () {
        jQuery('.rep_modal').removeClass('modalActive');
    });
    jQuery('#modal_rep').bind('reveal:close', function () {
        $('.rep_modal').removeClass('modalActive');
    });
});
</script>