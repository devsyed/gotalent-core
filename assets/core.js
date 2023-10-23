
Dropzone.autoDiscover = false;
jQuery(document).ready(function($){
    
    /** Handle Dropzone and File Uploads through Dropzone.js */
    $(".gt-dropzone").each(function(index,val){
        new Dropzone(val, { 
            url: gotalent_ajax.ajax_url + '?action=' + $(val).attr('action') + '&id=' +  $(val).data('input-id'),
            acceptedFiles:"image/*,.png,.jpeg,.jpg",
            maxFiles: 1,
            autoProcessQueue:false,
            addRemoveLinks:true,
            success:function(files,response){
                var inputId = $(val).data('input-id');
                $(`#${inputId}`).val(response.data.message)
            },
        });
    })

    /** Select 2 */
    $('.js-example-basic-multiple').select2({
        tags:true
    });

    
    /** Datatables */
    let table = new DataTable('#myTable', {
        responsive: true,
        searching: false,
        paging: false,
    });
    /** End Datatables  */


    /** TinyMCE Editor */
    tinymce.init({
        selector: 'textarea.wysiwyg',
        a_plugin_option: true,
        a_configuration_option: 400
    });
    /** End TinyMCE Editor */
    
    /** Ajax Function | Sends Data to Form Action URL ( through admin-ajax ) */
    $('.gt-form').on('submit', function(e) {
        e.preventDefault();
        var form = this;
        var method = $(this).attr('method');
        var button = $(form).find('button[type="submit"]');
        setLoader(button);
        var action = makeActionNameReady($(this).attr('action'));
        var redirectUrl = $(this).data('redirect-url');
        // if (typeof Dropzone !== "undefined") {
        //     var dropzones = Dropzone.forElement(".gt-dropzone");
        //     if (dropzones) {
        //         dropzones.processQueue();
        //     }
        // }
        $.ajax({
            method:method,
            url:gotalent_ajax.ajax_url,
            data:{
                action:action,
                formData: $(this).serialize(),
            },
            success:function(res){
                console.log(res)
                setTimeout(function(){
                    removeLoader(button)
                },1000)
                if(res.data.code == 0){
                    $(form).siblings('.error-form').html(res?.data?.message)
                    $(form).siblings('.error-form').show();
                }
                if (res.data.code === 1) {
                    var successCallback = $(form).data('success-callback');
                    if (typeof window[successCallback] === 'function') {
                        window[successCallback](res.data.message); 
                    
                    }else {
                    if (redirectUrl) {
                        handleRedirect(redirectUrl);
                    }
                }
                }

            },
            error:function(err){
                setTimeout(function(){
                    removeLoader(button)
                },1000)
                $(form).siblings('.error-form').html(res?.data?.message)
            }
        })
    });


    /**
     * Converts action url to ajax_action string 
     * eg: gotalent/authenticate/login ===> gotalent_authenticate_login
     * @param {actionUrl} string 
     * @returns 
     */
    function makeActionNameReady(string)
    {
        return string.replace(/\//g, '_');
    }

    function handleRedirect(redirectUrl)
    {
        setTimeout(function(){
            window.location.href = redirectUrl;
        },3000)
    }


    function setLoader(elem)
    {
        $(elem).addClass('processing')
    }


    function removeLoader(elem) {   
        $(elem).removeClass('processing');
    }



    /** Generate Payment Link Button*/
    setTimeout(function(){
        var target =  document.querySelector(".chat-footer"); 
        if(!target) return;
        var paymentLinkGenerator = document.createElement("button");
        paymentLinkGenerator.classList.add("generate-payment-link");
        paymentLinkGenerator.dataset.bsToggle = 'modal';
        paymentLinkGenerator.dataset.bsTarget = '#generatePaymentLink';
        paymentLinkGenerator.innerText = 'Generate Payment Link'
        target.appendChild(paymentLinkGenerator)
        
    },1000) 


    /** Get Subcategories based on Category | Dashboard */
    $("select[name='_meta_talent_category']").trigger("change");
    $("select[name='_meta_talent_category']").on("change", function(e){
        var target = $("select[name='_meta_talent_sub_category']");
        $(target).html('');
        $.ajax({
            url:gotalent_ajax.ajax_url + `?action=gotalent_get_talent_subcategories&parent_id=${e.target.value}`,
            method:"GET",
            success:function(res){
                var subcats = res.data.message;
                $(subcats).each(function(index,val){
                    $(target).append(`<option value="${val.term_id}">${val.name}</option>`)
                })
                $(target).niceSelect('update');
            },
            error:function(e){
                console.log(e)
            }
        })
    })

    var slider = document.querySelector(".gt-range");
    var output = document.querySelector(".gt-range-input");
    if(slider && output){
        output.innerHTML = 'AED ' + slider.value;
        slider.oninput = function() {
            output.innerHTML = 'AED ' + this.value;
        }
    };



    


    
    
})