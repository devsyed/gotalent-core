document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("multi-step-form");
    if(!form) return;
    
      const steps = form.querySelectorAll(".step");
      const stepButtons = form.querySelector(".step-btns");
      const prevButton = stepButtons.querySelector(".prev");
      const nextButton = stepButtons.querySelector(".next");
      const submitButton = stepButtons.querySelector(".submit");
      const stepIndicator = document.querySelectorAll(".step-indicator-item");
      let currentStep = 0;
        steps[currentStep].classList.add("active");
        stepIndicator[currentStep].classList.add("active");


        prevButton.addEventListener("click", function () {
          if (currentStep > 0) {
            showStep(currentStep - 1);
          }
        });
      
        nextButton.addEventListener("click", function () {
          if (currentStep < steps.length - 1) {
            showStep(currentStep + 1);
          }
        });
      
        form.addEventListener("submit", function (e) {
          e.preventDefault();
          form.classList.add('processing');
          jQuery.ajax({
            url: gotalent_ajax.ajax_url,
            method:"POST", 
            data:{
              action:"gotalent_create_invitation",
              formData:jQuery(form).serialize(),
            },
            success:function(res){
              form.classList.remove('processing');
              jQuery(form).html(`<p>A Booking Invitation has been sent to the Talent, You will now be able to chat with them in your Dashboard. A Booking will be created as soon as they accept your request.</p>`);
              
            },
            error:function(res){
              console.log(res)
            }
          })
        });
    
    

  
    function showStep(step) {
      if (validateStep(currentStep)) {
        steps[currentStep].classList.remove("active");
        stepIndicator[currentStep].classList.remove("active");
  
        steps[step].classList.add("active");
        stepIndicator[step].classList.add("active");

        if (step === 2 && currentStep === 1) {
          storeSession();
          return;
        }else{
          currentStep = step;
  
          prevButton.disabled = currentStep === 0;
          nextButton.disabled = currentStep === steps.length - 1;
    
        }
        
        markPreviousStepsAsCompleted(currentStep);
        
      }
    }
  
    function validateStep(step) {
      switch (step) {
        case 0:
          const step1Fields = steps[0].querySelectorAll(
            "input[type='text'], input[type='date'], input[type='time'], select, textarea"
          );
          for (const field of step1Fields) {
            if (field.value.trim() === "") {
              return false;
            }
          }
          break;
        case 1:
          const step2Fields = steps[1].querySelectorAll(
            "input[type='text'], input[type='date'], input[type='time'], select, textarea"
          );
          for (const field of step2Fields) {
            if (field.value.trim() === "") {
              return false;
            }
          }
          break;
        case 2: // Step 3
          const step3Fields = steps[2].querySelectorAll(
            "input[type='text'], input[type='date'], input[type='time'], select, textarea"
          );
          for (const field of step3Fields) {
            if (field.value.trim() === "") {
              return false;
            }
          }
          break;
      }
      return true;
    }
  
    function markPreviousStepsAsCompleted(currentStep) {
      for (let i = 0; i < currentStep; i++) {
        stepIndicator[i].classList.add("completed-step");
      }
    }
  
    

    function storeSession()
    {
      form.classList.add('processing');
      var formData = jQuery(form).serializeArray();
      for (var i = 0; i < formData.length; i++) {
        var field = formData[i].name;
        var value = formData[i].value;
        var element = document.querySelector(`p#${field}`);
        if (element) {
            element.innerText = value;
        }
      }
      jQuery.ajax({
        url: gotalent_ajax.ajax_url,
        method:"POST", 
        data:{
          action:"gotalent_store_package_session",
          session:jQuery(form).serialize(),
        },
        success:function(res){
          form.classList.remove('processing');
        },
        error:function(res){
          console.log(res)
        }
      })
    }

  });
  