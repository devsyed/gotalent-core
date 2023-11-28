
<div class="modal fade gt-modal" id="registration-modal" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex justify-content-center align-items-center my-3">
                    <?php if(function_exists('gt_logo')): gt_logo(); endif;  ?>
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="register-as-talent-tab" data-bs-toggle="tab"
                            data-bs-target="#as-talent" type="button" role="tab" aria-selected="true">
                            <?php echo __('Register', 'gotalent-core'); ?></button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="register-as-recruiter-tab" data-bs-toggle="tab"
                            data-bs-target="#as-recruiter" type="button" role="tab" aria-selected="false">
                            <?php echo __('Login', 'gotalent-core'); ?></button>
                    </li>
                </ul>
                <div class="tab-content p-3">
                    <div class="tab-pane fade show active" id="as-talent" role="tabpanel" tabindex="0">
                    <p class="error-form"></p>
                    <form method="POST" class="gt-form" action="gotalent/authenticate/register" data-redirect-url="<?php echo home_url() . '/gotalent-dashboard/manage-profile' ?>">
                            <div class="d-flex gap-2">
                                <?php GTFormHelper::generate_form_fields(
                                    array(
                                        array(
                                            'type' => 'text',
                                            'name' => 'first_name',
                                            'label' => 'First name',
                                            'required' => false,
                                        ),
                                        array(
                                            'type' => 'text',
                                            'name' => 'last_name',
                                            'label' => 'Last Name',
                                            'required' => false,
                                        ),
                                    ));
                                ?>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <?php GTFormHelper::generate_form_fields(
                                    array(
                                        array(
                                            'type' => 'email',
                                            'name' => 'email_address',
                                            'label' => 'Email Address',
                                            'required' => false
                                        ),
                                        array(
                                            'type' => 'text',
                                            'name' => 'phone_number',
                                            'label' => 'Phone Number',
                                            'required' => true,
                                        ),
                                    ));
                                ?>
                            </div>

                            <?php GTFormHelper::generate_form_fields(
                                array(
                                    array(
                                        'type' => 'password',
                                        'name' => 'password',
                                        'label' => 'Password',
                                        'required' => true,
                                    ),
                                    array(
                                        'type' => 'radio',
                                        'name' => 'apply_as',
                                        'label' => 'Apply As',
                                        'options' => array(
                                            'talent' => 'Apply as Talent',
                                            'recruiter' => 'Apply as Recruiter',
                                        ),
                                        'checked' => 'recruiter',
                                    ),
                                ));
                            ?>


                            <button type="submit" class="btn-gt-default"><?php echo __('Create Account', 'gotalent-core'); ?></button>
                            <?php wp_nonce_field( 'gotalent_register', 'gotalent_register_nonce' ); ?>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="as-recruiter" role="tabpanel" aria-labelledby="profile-tab"
                        tabindex="0">
                        <p class="error-form"></p>
                        <form method="POST" class="gt-form" action="gotalent/authenticate/login" data-redirect-url="<?php echo home_url()  ?>">
                                <?php GTFormHelper::generate_form_fields(
                                    array(
                                        array(
                                            'type' => 'text',
                                            'name' => 'user_login',
                                            'label' => 'Email Address / Username',
                                            'required' => true,
                                        ),
                                        array(
                                            'type' => 'password',
                                            'name' => 'password',
                                            'label' => 'Password',
                                            'required' => true,
                                        ),
                                    ));
                                ?>
                                <?php wp_nonce_field( 'gotalent_login', 'gotalent_login_nonce' ); ?>
                            <button type="submit"  class="btn-gt-default"><?php echo __('Login', 'gotalent-core'); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
