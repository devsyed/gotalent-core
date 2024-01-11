<?php
get_header();
GTThemeHelper::show_breadcrumb('Proceed Your Booking with Talent','Select the package you want to book the talent for.');
$talent_id = isset($_GET['talent_id']) ? $_GET['talent_id'] : 0;
$packages = GTPackagePostType::gt_get_all_talent_packages($talent_id);
?>
<div class="wrapper-buy-package">
    <div class="container mt-5 py-5">
       <?php if(get_user_meta($talent_id,'accept_custom_offers', true)) : ?>
        <div class="row justify-content-start align-items-center mb-4">
            <h6 class="text-center mb-3">Send a Custom Quote!</h6>
            <div class="col-md-6 mx-auto text-center">
            <form action="/buy-package" method="GET">
                <input type="hidden" name="query_id" value="0">
                <input type="hidden" name="talent_id" value="<?php echo $talent_id ?>">
                <?php
                    GTFormHelper::generate_form_fields(array(
                        array(
                            'type' => 'number',
                            'name' => 'custom_quote',
                            'required' => true,
                            'label' => 'Enter Your Budget Here',
                            'placeholder' => 'Enter your custom budget.'
                        ),
                    ))
                ?>
                <button type="submit" class="btn-gt-default">Send Custom Quote</button>
            </form>
            </div>
            <hr class="mt-5 divider">
        </div>
        <?php endif; ?>
        <div class="row justify-content-start">
            <div class="col-md-12">
                <div class="row gap-5">
                <?php 
            if(!empty($packages)): foreach($packages as $package):
                 GTHelpers::gt_get_template_part('package-single.php', $package); 
                    endforeach; 
                else:
                    echo 'Talent does not have any Packages ';
             endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>