$('#go_there_select,#suggestion_for_select').multipleSelect();

//$("#category").multipleSelect("disable");

// For File uploading

$( "#custom_upload" ).click(function() {

  $( "#file_upload_default" ).click();

});



// For submiting places form.

/*$( ".places-submit" ).click(function(e) {	 

	e.preventDefault();

        var error = false;

        var min_budget = $("#budget_min").val();

        var max_budget = $("#budget_max").val();

        if(!$.isNumeric(min_budget)){

            $("#budget_min").removeClass("error").addClass("error");

            $("#budget_min").next("span.help-block").text("Min budget field required only numeric value.");

            error = true;

        }

        if(!$.isNumeric(max_budget)){

            $("#budget_max").removeClass("error").addClass("error");

            $("#budget_max").next("span.help-block").text("Max budget field required only numeric value.");

            error = true;

        }else

           

        if(max_budget < min_budget){

            $("#budget_max").removeClass("error").addClass("error");

            $("#budget_max").next("span.help-block").text("Max budget field is always greater than min budget field.");

            error = true;

        }

        

        if(error === true){

            return false;

        }

     

	var go_there = $("#go_there_select").next(".ms-parent").find(".ms-choice").find("span").text();

	var suggestion_for = $("#suggestion_for_select").next(".ms-parent").find(".ms-choice").find("span").text();

	var all_transport = "Subway, Airplane, Car, Walking, Bus, Boat, Bicycle"

	if(go_there == "All selected"){

		go_there = all_transport;

	}

	if(suggestion_for == "All selected"){

		suggestion_for = all_transport;

	}

	$("#go_there").val(go_there);

	$("#suggestion_for").val(suggestion_for);

	$( "#places" ).submit();

});*/

$(document).ready(function(){
    /* For register form validation */
    $("#trip-form").validate({
        rules:
        {
            title: {
                required: true,
            },
            description: {
                required: true,
            },
            tags: {
                required: true,
            },
            tips: {
                required: true,
            },
            category: {
                required: true,
            },
            go_there: {
                required: true,
            },
            suggestion_for: {
                required: true,
            },
            nearby_attractions: {
                required: true,
            },
            budget: {
                required: true,
                number: true,
            },
            check_in_date: {
                required: true,
                date: true
            },
            check_out_date: {
                required: true,
                date: true
            },
            budget_min: {
                required: true,
                number: true,
                lessThan: '#budget_max'
            },
            
            budget_max: {
                required: true,
                number: true,
                greaterThan: '#budget_min'
            },
            location: {
                required: true,
            },
            neighbourhood: {
                required: true,
            },
            term_condition: {
                required: true,
            },
        },
        errorPlacement: function(error, element) {
            if (element.attr("name") == "term_condition") {
                element.closest('.form-group').append(error);
            }else if(element.attr("name") == "check_in_date" || element.attr("name") == "check_out_date" || element.attr("name") == "budget_min" || element.attr("name") == "budget_max" || element.attr("name") == "budget"){
                element.closest('.col-lg-6').find('span.help-block').append(error);
            }else{
                error.insertAfter(element);
            }
        },
        messages:
        {
            title: {
                required:"Title field is required.",
            },
            description: {
                required:"Description field is required.",
            },
            tags: {
                required:"Tags field is required.",
            },
            tips: {
                required:"Tips field is required.",
            },
            category: {
                required:"Category field is required.",
            },
            go_there: {
                required:"Go there field is required.",
            },
            suggestion_for: {
                required:"Suggestion for field is required.",
            },
            nearby_attractions: {
                required:"Nearby attraction field is required.",
            },
            budget: {
                required:"Budget field is required.",
                number: "Only numeric value is required for this field."
            },
            check_in_date: {
                required:"Check in field is required.",
            },
            check_out_date: {
                required:"Check out field is required.",
            },
            budget_min: {
                required:"This field is required.",
                number: "Only numeric value is required for this field."
            },
            
            budget_max: {
                required:"This field is required.",
                number: "Only numeric value is required for this field."
            },
            location: {
                required:"Location field is required.",
            },
            neighbourhood: {
                required:"Neighbourhood field is required.",
            },
            term_condition: {
                required:"This field is required.",
            },
        },
        submitHandler: function(form) {
            var go_there = $("#go_there_select").next(".ms-parent").find(".ms-choice").find("span").text();
            var suggestion_for = $("#suggestion_for_select").next(".ms-parent").find(".ms-choice").find("span").text();
            var all_transport = "Subway, Airplane, Car, Walking, Bus, Boat, Bicycle"

            if(go_there == "All selected"){
                go_there = all_transport;
            }

            if(suggestion_for == "All selected"){
                suggestion_for = all_transport;
            }

            $("#go_there").val(go_there);
            $("#suggestion_for").val(suggestion_for);
            form.submit();
        }
    });
    /* End register form validation */

    $.validator.addMethod("greaterThan",function (value, element, param) {
        var $min = $(param);
      if (this.settings.onfocusout) {
        $min.off(".validate-greaterThan").on("blur.validate-greaterThan", function () {
          $(element).valid();
        });
      }
        return parseInt(value) > parseInt($min.val());
    }, "Max budget must be greater than min budget.");

    $.validator.addMethod("lessThan",function (value, element, param) {
        var $min = $(param);
      if (this.settings.onfocusout) {
        $min.off(".validate-lessThan").on("blur.validate-greaterThan", function () {
          $(element).valid();
        });
      }
        return parseInt(value) < parseInt($min.val());
    }, "Min budget must be less than max budget.");

    $(document).on("submit","#subscriber-form", function(event) {
        /* Act on the event */
        event.preventDefault();
        var elem = $(this);
        var _id = elem.attr("id");
        var url = elem.attr("action");
        var subscriber = $('#subscriber').val();

        $.post(url,{'subscriber':subscriber}, function( data ) {
            $('#'+_id)[0].reset();
            if(!data.error){
                var msg = '<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Success!</p>' + data.message + '</div>';
                $("#alert-modal").find(".modal-body").append(msg);
                $("#alert-modal").modal("show");
                setTimeout(function () {
                    $("#alert-modal").find(".alert-success").remove();
                    $("#alert-modal").modal("hide");
                }, 4000);
            }else{
                var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Errors!</p>' + data.message + '</div>';
                $("#alert-modal").find(".modal-body").append(msg);
                $("#alert-modal").modal("show");
                setTimeout(function () {
                    $("#alert-modal").find(".alert-danger").remove();
                    $("#alert-modal").modal("hide");
                }, 4000);
            }
        }, "json");
    });

    /* For signup form validation */
    $("#signup-form").validate({
        rules:
            {
                email: {
                    required: true,
                    email: true
                },

                username: {
                    required: true,
                },
                password: {
                    required: true,
                },
                cpassword: {
                    required: true,
                    equalTo: '#password'
                },
            },
        messages:
            {
                email: "Please enter a valid email.",
                username: "Username field is required.",
                password: "Password field is required.",
                cpassword:{
                    required: "Enter valid new confirm password.",
                    equalTo: "Passwords did not match! retype new confirm password."
                },
            },
        submitHandler: function(form) {
            form.submit();
        }
    });
    /* End Services registration form validation */

    /* For login form validation */
    $("#login-form").validate({
        rules:
            {
                signin_email: {
                    required: true,
                },
                signin_password: {
                    required: true,
                },
            },
        messages:
            {
                signin_email: "Please enter a valid email.",
                signin_password:{
                    required: "Enter valid password.",
                },
            },
        submitHandler: function(form) {
            form.submit();
        }
    });
    /* End login form validation */
});