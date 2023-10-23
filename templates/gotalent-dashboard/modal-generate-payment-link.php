<script>
  function showGeneratedUrl(res)
  {
    var paymentLinkFields = document.querySelector(".payment-link-fields");
    fadeOutEffect(paymentLinkFields);
    paymentLinkFields.style.display = 'none';
    document.querySelector("#payment-generate-form").innerHTML = `<p class="copy-text">${res}</p>`
  }

  
  function fadeOutEffect(fadeTarget) {
    var fadeEffect = setInterval(function () {
        if (!fadeTarget.style.opacity) {
            fadeTarget.style.opacity = 1;
        }
        if (fadeTarget.style.opacity > 0) {
            fadeTarget.style.opacity -= 0.1;
        } else {
            clearInterval(fadeEffect);
        }
    }, 50);

}
</script>
<div class="modal fade" id="generatePaymentLink" tabindex="-1" aria-labelledby="generatePaymentLink" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <div class="d-flex justify-content-center align-items-center flex-column">
        <?php gt_logo(); ?>
        <h3 class="mt-3"><?php echo __('Generate Payment Link','gotalent-core'); ?></h3>
        <p class="text-sm mt-3"><?php echo __('Generate payment link according to your mutually agreed amount and description. A booking will be created once payment is successful.','gotalent-core'); ?></p>
        <form action="gotalent/generate_payment_link" id="payment-generate-form" method="POST" class="gt-form" data-success-callback="showGeneratedUrl">
            <div class="gt-form-control payment-link-fields">
              <?php GTFormHelper::generate_dashboard_form_fields(
                array(
                  array(
                      'type' => 'text',
                      'name' => 'total_amount',
                      'label' => 'Total Amount',
                      'required' => true,
                  ),
                  array(
                      'type' => 'textarea',
                      'name' => 'booking_details',
                      'label' => 'Booking Details',
                      'required' => false,
                  ),
                )) ?>
           <button type="submit" id="generate_payment_link_btn" class="btn-gt-default"><?php echo __('Generate Payment Link', 'gotalent-core'); ?></button>
            </div>
           <?php wp_nonce_field( 'gotalent_generate_payment_link', 'gotalent_generate_payment_link_nonce' ); ?>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>