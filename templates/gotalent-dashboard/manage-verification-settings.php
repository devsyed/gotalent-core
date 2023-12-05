<?php GTThemeHelper::gt_get_header('header-dashboard'); 

?>
<section class="flat-dashboard-setting <?php echo (get_user_meta(get_current_user_id(), 'uploaded_documents', true)) ? 'already-submitted-documents' : '' ?>">
    <div class="themes-container">
        <div class="row">
            <div class="col-lg-12 col-md-12 ">
                <div class="profile-setting bg-white">
                    <div class="d-flex align-items-center justify-content-between">
                    <form class="gt-form row" data-redirect-url="/gotalent-dashboard/manage-profile" method="POST" action="gotalent/user/process_meta" enctype="multipart/form-data">
                    <div class="gt-form-row">
                    <?php
                        echo GTFormHelper::generate_dashboard_form_fields(array(
                            array(
                                'type' => 'file',
                                'name' => 'profile-image-uploader',
                                'action' => 'gt_upload_images',
                                'max_upload' => 1,
                                'input_id' => '_meta_proof_one',
                                'message' => 'Passport Copy'
                            ),
                            array(
                                'type' => 'file',
                                'name' => 'cover-image-uploader',
                                'action' => 'gt_upload_images',
                                'max_upload' => 1,
                                'input_id' => '_meta_proof_two',
                                'message' => 'ID Copy'
                            ),
                        ))
                    ?>
                    </div>
                    <div class="save-form-wrapper">
                        <button type="submit" class="ms-3 btn-gt-default"><?php echo __('Upload Documents', 'gotalent-core'); ?></button>
                    </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php GTThemeHelper::gt_get_footer('footer-dashboard'); ?>