$(function () {
    var Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
    });

    var success_msg = $("body").data("success-msg");
    var error_msg = $("body").data("error-msg");

    if (success_msg != "") {
        Toast.fire({
            icon: "success",
            title: success_msg,
        });
    }

    if (error_msg != "") {
        Toast.fire({
            icon: "error",
            title: error_msg,
        });
    }

    $(".custom-file-input").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $(this)
            .siblings(".custom-file-label")
            .addClass("selected")
            .html(fileName);
    });
});

$(".custom-file-input").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

$(document).ready(function () {
    var maxField = 10; //Input fields increment limitation
    var addButton = $(".add_button"); //Add button selector
    var wrapper = $(".field_wrapper"); //Input field wrapper
    var fieldHTML =
        ' <div class="row my-2 size-row">' +
        '<div class="col-md-4">' +
        '<input type="text" placeholder="Enter size" class="form-control" name="sizeField[]" value="" />' +
        "</div>" +
        '<div class="col-md-4">' +
        '<select class="form-control" name="sizeAvailability[]">' +
        '<option value="1">Available</option>' +
        '<option value="0">Not Available</option>' +
        "</select>" +
        "</div>" +
        '<div class="col-md-4">' +
        '<but/ton class="btn btn-danger remove_button" type="button">Remove</button>' +
        "</div>" +
        "</div>"; //New input field html
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function () {
        //Check maximum number of input fields
        if (x < maxField) {
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on("click", ".remove_button", function (e) {
        e.preventDefault();
        $(this).parents(".size-row").remove(); //Remove field html
        x--; //Decrement field counter
    });

    $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      });
});
