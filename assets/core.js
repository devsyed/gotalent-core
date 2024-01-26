
Dropzone.autoDiscover = false;
jQuery(document).ready(function($){
    let dropzone; 
    $(".gt-dropzone").each(function(index,val){
        var maxFilesAllowed = $(val).data('max-upload');
        var inputId = $(val).data('input-id');
        dropzone = new Dropzone(val, { 
            url: gotalent_ajax.ajax_url + '?action=' + $(val).attr('action') + '&id=' +  $(val).data('input-id'),
            acceptedFiles:"image/*,.png,.jpeg,.jpg",
            maxFiles: maxFilesAllowed,
            autoProcessQueue:true,
            addRemoveLinks:true,
            parallelUploads:10,
            success:function(files,response){
               $(files).each(function(index,value){
                    var inputField = document.createElement('input');
                    inputField.setAttribute('type', 'hidden');
                    inputField.setAttribute('name', inputId);
                    inputField.value = response.data.message;
                    $("form").append(inputField);
                    
               })
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
        searching: true,
        paging: false,
    });


    /** Ajax Function | Sends Data to Form Action URL ( through admin-ajax ) */
    $('.gt-form').on('submit', function(e) {
        e.preventDefault();
        var form = this;
        var method = $(this).attr('method');
        var button = $(form).find('button[type="submit"]');
        setLoader(button);
        var action = makeActionNameReady($(this).attr('action'));
        var redirectUrl = $(this).data('redirect-url') || window.location.href;
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
            window.location.href = redirectUrl || window.location.href;
        },3000)
    }


    function setLoader(elem)
    {
        $(elem).addClass('processing')
    }


    function removeLoader(elem) {   
        $(elem).removeClass('processing');
    }


    /** Get Subcategories based on Category | Dashboard */
    $("select[name='talent_category']").trigger("change");
    $("select[name='talent_category']").on("change", function(e){
        var target = $("select[name='talent_sub_category']");
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



    $("#logout_btn").on("click", function(e){
        e.preventDefault();
        var _this = this;
        Swal.fire({
            title: 'Are you sure?',
            text: "You will be logged out.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Logout'
          }).then((result) => {
            if (result.isConfirmed) {
              window.location = $(_this).attr('href');
            }
        })
    })


    $(document).on("click", ".remove_portfolio_item", function(e){
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "This Portfolio Item will be deleted permanently.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Delete'
          }).then((result) => {
            if (result.isConfirmed) {
                $(this).parent().remove();
            }
        })
    })

    $(".datepicker").datepicker({
        minDate: 0
    });



    /** Filter Candidates */
    $("#filterCandidates").on("click", function(){
        var _this = this; 
    })



    
    
})