$(document).ready(() => {

    const firstName = $("#firstName");//first name of user form
    const lastName = $("#lastName");//last name of user form
    const contact = $("#contact");//contact no of user form
    const birthday = $("#birthday");//birthday of user form
    const nic = $("#nic");//nic of user form
    const email = $("#email");//email of user form
    const role = $("#role");//role of user form
    const add1 = $("#add1");//address no of user form
    const add2 = $("#add2");//street of user form 
    const add3 = $("#add3");//lane of user form
    const image = $("#image");//image of user form

    const patName = /^[a-zA-Z\.\s]+$/;//validation rgx for text
    const patEmail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z]{2,6})+$/;//validation rgx for email
    const patCon = /^(07)([0-9]){8}$/;//validation rgx for contact
    const patNIC = /^([0-9]{9}[x|X|v|V]|[0-9]{12})+$/;//validation rgx for nic

    contact.blur(() => {
        const url = "../controller/UserController.php?status=checkContactIsExist";
        let contactVal = contact.val();
        $.post(url, {contact:contactVal}, (result) => {
            if (result==1) {
                addInvalidClass(contact, "Contact is already exist");
                return false; 
            }
        })
    })
    
    email.blur(() =>{
        const url = "../controller/UserController.php?status=checkEmailIsExist";
        let emailVal = email.val();
        $.post(url, {email:emailVal}, (result) => {
            if(result==1){
                addInvalidClass(email, "Email is already exist");
                return false;
            }
        })
    })

    nic.blur(() =>{
        const url="../controller/UserController.php?status=checkNicIsExist";
        let nicVal= nic.val();
        $.post(url,{nic:nicVal}, (result) =>{
            if (result==1) {
                addInvalidClass(nic, "NIC is already exist");
                return false;
            }
        })
    })

    $("#userFormSubmit").click(() => {//user form submit validation

        let firstNameVal = firstName.val()
        let lastNameVal = lastName.val()
        let contactVal = contact.val()
        let birthdayVal = birthday.val()
        let nicVal = nic.val()
        let emailVal = email.val()
        let roleVal = role.val()
        let add1Val = add1.val()
        let add2Val = add2.val()
        let add3Val = add3.val()
        let imageVal = image.val()

        if (firstNameVal == "" && lastNameVal == "" && contactVal == "" && birthdayVal == "" && nicVal == "" && emailVal == "" && roleVal == "" && add1Val == "" && add2Val == "" && add3Val == "" && imageVal == "") {
            toastr.error("Please fill the form");
            $([firstName, lastName, contact, birthday, nic, email, role, add1, add2, add3, image]).each(function() {
                $(this).removeClass("is-valid").addClass("is-invalid");
            });
            firstName.focus();
            return false;
        }

        if (firstNameVal == "" || !firstNameVal.match(patName)) {
            addInvalidClass(firstName, "please enter first name");
            return false;
        }

        if (lastNameVal == "" || !lastNameVal.match(patName)) {
            addInvalidClass(lastName, "Please enter last name");
            return false;
        }

        if (contactVal == "" || !contactVal.match(patCon)) {
            addInvalidClass(contact, "Please enter contact");
            return false;
        }

        if (birthdayVal == "") {
            addInvalidClass(birthday, "Please enter birthday");
            return false;
        }

        if (nicVal == "" || !nicVal.match(patNIC)) {
            addInvalidClass(nic, "Please enter NIC");
            return false;
        }

        if (emailVal == "" || !emailVal.match(patEmail)) {
            addInvalidClass(email, "Please enter email");
            return false;
        }

        if (roleVal == "") {
            addInvalidClass(role, "Please enter role");
            return false;
        }

        if (add1Val == "") {
            addInvalidClass(add1, "Please enter address no");
            return false;
        }

        if (add2Val == "") {
            addInvalidClass(add2, "Please enter lane");
            return false;
        }

        if (add3Val == "") {
            addInvalidClass(add3, "Please enter street");
            return false;
        }
        
        if (imageVal == "") {
            addInvalidClass(image, "Please enter image");
            return false;
        }

        swal({//user form submit using ajax
            title : 'Are You Sure',
            text : 'Do you want to submit this form',
            icon : 'warning',
            buttons : true,
            dangerMode : true,
            allowOutsideClick : false,
            allowEscapeKey : false,
            closeOnClickOutside : false,
            closeOnEsc : false,
        }).then((willOUT) => {
            if (willOUT) {
                $.ajax({
                    method : "POST",
                    url : "../controller/UserController.php?status=addUser",
                    data : new FormData($('#userForm')[0]),
                    dataType : "json",
                    enctype : "multipart/form-data",
                    processData : false,
                    contentType : false,
                    async : true,
                    cache : false,
                    beforeSend : function(){
                        swal({
                            title : "Loading...",
                            text : " ",
                            icon : "../../images/96x96.gif",
                            buttons :false,
                            allowOutsideClick : false,
                            allowEscapeKey : false,
                            closeOnClickOutside : false,
                            closeOnEsc : false,
                        });
                    },
                    success : function(result){
                        if (result[0] == 1) {
                            swal({
                                title : "Good Job !",
                                text : "User Successfully Added",
                                icon : "success",
                                buttons :false,
                                time : 1000,
                            });
                        }
                        if (result[0] ==2) {
                            swal({
                                title : "Warning !",
                                text : result[1],
                                icon : "warning",
                            });
                        }
                    },
                    error : function(error){
                        console.log(error)
                    }
                });
            }else{
                swal({
                    title : "Warning !",
                    text : 'User not added ',
                    icon : "warning",
                    buttons :false,
                    time : 1000,
                });
            }
        })  

    });

    let addInvalidClass = (Id, massage) => {
        let id = Id
        toastr.error(massage);
        id.removeClass("is-valid").addClass("is-invalid").focus();
    }
    let removeInvalidClass = (Id) => {
        let id = Id
         id.removeClass("is-invalid").addClass("is-valid");
    }

    firstName.change(() => { removeInvalidClass(firstName) });
    lastName.change(() => { removeInvalidClass(lastName) });
    contact.change(() => { removeInvalidClass(contact) });
    birthday.change(() => { removeInvalidClass(birthday) });
    nic.change(() => { removeInvalidClass(nic) });
    email.change(() => { removeInvalidClass(email) });
    role.change(() => { removeInvalidClass(role) });
    add1.change(() => { removeInvalidClass(add1) });
    add2.change(() => { removeInvalidClass(add2) });
    add3.change(() => { removeInvalidClass(add3) });
    image.change(() => { removeInvalidClass(image) });
});