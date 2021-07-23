$(document).ready(() => {

    $("#userFormSubmit").click(() => {
        
        let firstName = $("#firstName").val();
        let lastName = $("#lastName").val();
        let contact = $("#contact").val();
        let birthday = $("#birthday").val();
        let nic = $("#nic").val();
        let email = $("#email").val();
        let role = $("#role").val();
        let add1 = $("#add1").val();
        let add2 = $("#add2").val();
        let add3 = $("#add3").val();
        let image = $("#image").val();

        let patname = /^[a-zA-Z\.\s]+$/;
        let patEmail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z]{2,6})+$/;
        let patCon = /^(07)([0-9]){8}$/;
        let patNIC = /^([0-9]{9}[x|X|v|V]|[0-9]{12})+$/;

        if (
            firstName == "" &&
            lastName == "" &&
            contact == "" &&
            birthday == "" &&
            nic == "" &&
            email == "" &&
            role == "" &&
            add1 == "" &&
            add2 == "" &&
            add3 == "" &&
            image == ""
        ) {
            toastr.error("Please fill the form");
            $("#firstName,#lastName,#contact,#birthday,#nic,#email, #role, #add1,#add2,#add3,#image").removeClass("is-valid")
                .addClass("is-invalid");
            $("#firstName").focus();
            return false;
        }
        if (firstName == "" || !firstName.match(patname)) {
            toastr.error("Please fill");
            $("#firstName").removeClass("is-valid").addClass("is-invalid").focus();
            return false;
        }
        if (lastName == "" || !lastName.match(patname)) {
            toastr.error("Please fill");
            $("#lastName").removeClass("is-valid").addClass("is-invalid").focus();
            return false;
        }
        if (contact == "" || !contact.match(patCon)) {
            toastr.error("Please fill");
            $("#contact").removeClass("is-valid").addClass("is-invalid").focus();
            return false;
        }
        if (birthday == "") {
            toastr.error("Please fill");
            $("#birthday").removeClass("is-valid").addClass("is-invalid").focus();
            return false;
        }
        if (nic == "" || !nic.match(patNIC)) {
            toastr.error("Please fill");
            $("#nic").removeClass("is-valid").addClass("is-invalid").focus();
            return false;
        }
        if (email == "" || !email.match(patEmail)) {
            toastr.error("Please fill");
            $("#email").removeClass("is-valid").addClass("is-invalid").focus();
            return false;
        }
        if (role == "") {
            toastr.error("Please fill");
            $("#role").removeClass("is-valid").addClass("is-invalid").focus();
            return false;
        }
        if (add1 == "") {
            toastr.error("Please fill");
            $("#add1").removeClass("is-valid").addClass("is-invalid").focus();
            return false;
        }
        if (add2 == "") {
            toastr.error("Please fill");
            $("#add2").removeClass("is-valid").addClass("is-invalid").focus();
            return false;
        }
        if (add3 == "") {
            toastr.error("Please fill");
            $("#add3").removeClass("is-valid").addClass("is-invalid").focus();
            return false;
        }
        if (image == "") {
            toastr.error("Please fill");
            $("#image").removeClass("is-valid").addClass("is-invalid").focus();
            return false;
        }
    });

    $("#firstName").change(() => {
        $("#firstName").removeClass("is-invalid").addClass("is-valid");
    });
    $("#lastName").change(() => {
        $("#lastName").removeClass("is-invalid").addClass("is-valid");
    });
    $("#contact").change(() => {
        $("#contact").removeClass("is-invalid").addClass("is-valid");
    });
    $("#birthday").change(() => {
        $("#birthday").removeClass("is-invalid").addClass("is-valid");
    });
    $("#nic").change(() => {
        $("#nic").removeClass("is-invalid").addClass("is-valid");
    });
    $("#email").change(() => {
        $("#email").removeClass("is-invalid").addClass("is-valid");
    });
    $("#role").change(() => {
        $("#role").removeClass("is-invalid").addClass("is-valid");
    });
    $("#add1").change(() => {
        $("#add1").removeClass("is-invalid").addClass("is-valid");
    });
    $("#add2").change(() => {
        $("#add2").removeClass("is-invalid").addClass("is-valid");
    });
    $("#add3").change(() => {
        $("#add3").removeClass("is-invalid").addClass("is-valid");
    });
    $("#image").change(() => {
        $("#image").removeClass("is-invalid").addClass("is-valid");
    });
});