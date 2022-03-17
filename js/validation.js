$(document).ready(()=>{
    // const deliveryPersonName = $('#deliveryPersonName');
    // const deliveryPersonAge = $('#deliveryPersonAge');
    // const deliveryPersonContact = $('#deliveryPersonContact');
    // const deliveryPersonEmail = $('#deliveryPersonEmail');
    // const deliveryPersonAdd1 = $('#deliveryPersonAdd1');
    // const deliveryPersonAdd2 = $('#deliveryPersonAdd2');
    // const deliveryPersonAdd3 = $('#deliveryPersonAdd3');

    const patName = /^[a-zA-Z\.\s]+$/; //validation rgx for text
    const patEmail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z]{2,6})+$/; //validation rgx for email
    const patCon = /^(07)([0-9]){8}$/; //validation rgx for contact
    const patNIC = /^([0-9]{9}[x|X|v|V]|[0-9]{12})+$/; //validation rgx for nic
    const allowImagePattern = /(\.jpg|\.jpeg|\.png)$/i; //image validation

    const firstName = $("#firstName"); //first name of user form
    const lastName = $("#lastName"); //last name of user form
    const contact = $("#contact"); //contact no of user form
    const birthday = $("#birthday"); //birthday of user form
    const nic = $("#nic"); //nic of user form
    const email = $("#email"); //email of user form
    const role = $("#role"); //role of user form
    const add1 = $("#add1"); //address no of user form
    const add2 = $("#add2"); //street of user form 
    const add3 = $("#add3"); //lane of user form
    const image = $("#image"); //image of user form

    contact.blur(() => {
        const url = "../controller/UserController.php?status=checkContactIsExist";
        let contactVal = contact.val();
        $.post(url, {
            contact: contactVal
        }, (result) => {
            if (result == 1) {
                addInvalidClass(contact, "Contact is already exist");
                return false;
            }
        })
    })

    email.blur(() => {
        const url = "../controller/UserController.php?status=checkEmailIsExist";
        let emailVal = email.val();
        $.post(url, {
            email: emailVal
        }, (result) => {
            if (result == 1) {
                addInvalidClass(email, "Email is already exist");
                return false;
            }
        })
    })

    nic.blur(() => {
        const url = "../controller/UserController.php?status=checkNicIsExist";
        let nicVal = nic.val();
        $.post(url, {
            nic: nicVal
        }, (result) => {
            if (result == 1) {
                addInvalidClass(nic, "NIC is already exist");
                return false;
            }
        })
    })

    $("#userFormSubmit").click(() => { //user form submit validation

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
            $([firstName, lastName, contact, birthday, nic, email, role, add1, add2, add3, image]).each(function () {
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

        swal({ //user form submit using ajax
            title: 'Are You Sure',
            text: 'Do you want to submit this form',
            icon: 'warning',
            buttons: true, //cancel btn
            dangerMode: true, //ok btn red color
            allowOutsideClick: false,
            allowEscapeKey: false,
            closeOnClickOutside: false,
            closeOnEsc: false,
        }).then((willOUT) => {
            if (willOUT) {
                $.ajax({
                    method: "POST",
                    url: "../controller/UserController.php?status=addUser",
                    data: new FormData($('#userForm')[0]),
                    dataType: "json",
                    enctype: "multipart/form-data",
                    processData: false,
                    contentType: false,
                    async: true,
                    cache: false,
                    beforeSend: function () {
                        swal({
                            title: "Loading...",
                            text: " ",
                            icon: "../../images/96x96.gif",
                            buttons: false,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                        });
                    },
                    success: function (result) {
                        if (result[0] == 1) {
                            swal({
                                title: "Good Job !",
                                text: "User Successfully Added",
                                icon: "success",
                                buttons: false,
                                timer: 1000,
                            });
                            userTableBody(result[1]);
                        }
                        if (result[0] == 2) {
                            swal({
                                title: "Warning !",
                                text: result[1],
                                icon: "warning",
                            });
                        }
                    },
                    error: function (error) {
                        console.log(error)
                    }
                });
            } else {
                swal({
                    title: "Warning !",
                    text: 'User not added ',
                    icon: "warning",
                    buttons: false,
                    timer: 1000,
                });
            }
        })
    });

    const editFirstName = $('#editFirstName');
    const editLastName = $('#editLastName');
    const editContact = $('#editContact');
    const editBirthday = $('#editBirthday');
    // const editGender =  $('#editGender');
    const editNic = $('#editNic');
    const editEmail = $('#editEmail');
    const editRole = $('#editRole');
    const editAdd1 = $('#editAdd1');
    const editAdd2 = $('#editAdd2');
    const editAdd3 = $('#editAdd3');
    $("#saveEditForm").click(() => { //user edit form submit validation

        let editFirstNameVal = editFirstName.val()
        let editLastNameVal = editLastName.val()
        let editContactVal = editContact.val()
        let editBirthdayVal = editBirthday.val()
        let editNicVal = editNic.val()
        let editEmailVal = editEmail.val()
        let editRoleVal = editRole.val()
        let editAdd1Val = editAdd1.val()
        let editAdd2Val = editAdd2.val()
        let editAdd3Val = editAdd3.val()


        if (editFirstNameVal == "" && editLastNameVal == "" && editContactVal == "" && editBirthdayVal == "" && editNicVal == "" && editEmailVal == "" && editRoleVal == "" && editAdd1Val == "" && editAdd2Val == "" && editAdd3Val == "") {
            toastr.error("Please fill the form");
            $([editFirstName, editLastName, editContact, editBirthday, editNic, editEmail, editRole, editAdd1, editAdd2, editAdd3]).each(function () {
                $(this).removeClass("is-valid").addClass("is-invalid");
            });
            editFirstName.focus();
            return false;
        }

        if (editFirstNameVal == "" || !editFirstNameVal.match(patName)) {
            addInvalidClass(editFirstName, "please enter first name");
            return false;
        }

        if (editLastNameVal == "" || !editLastNameVal.match(patName)) {
            addInvalidClass(editLastName, "Please enter last name");
            return false;
        }

        if (editContactVal == "" || !editContactVal.match(patCon)) {
            addInvalidClass(editContact, "Please enter contact");
            return false;
        }

        if (editBirthdayVal == "") {
            addInvalidClass(editBirthday, "Please enter birthday");
            return false;
        }

        if (editNicVal == "" || !editNicVal.match(patNIC)) {
            addInvalidClass(editNic, "Please enter NIC");
            return false;
        }

        if (editEmailVal == "" || !editEmailVal.match(patEmail)) {
            addInvalidClass(editEmail, "Please enter email");
            return false;
        }

        if (editRoleVal == "") {
            addInvalidClass(editRole, "Please enter role");
            return false;
        }

        if (editAdd1Val == "") {
            addInvalidClass(editAdd1, "Please enter address no");
            return false;
        }

        if (editAdd2Val == "") {
            addInvalidClass(editAdd2, "Please enter lane");
            return false;
        }

        if (editAdd3Val == "") {
            addInvalidClass(editAdd3, "Please enter street");
            return false;
        }

        swal({ //user edit form submit using ajax
            title: 'Are You Sure',
            text: 'Do you want to submit this form',
            icon: 'warning',
            buttons: true, //cancel btn
            dangerMode: true, //ok btn red color
            allowOutsideClick: false,
            allowEscapeKey: false,
            closeOnClickOutside: false,
            closeOnEsc: false,
        }).then((willOUT) => {
            if (willOUT) {
                $('#editUser').modal('hide');
                $.ajax({
                    method: "POST",
                    url: "../controller/UserController.php?status=editUser",
                    data: new FormData($('#editUserForm')[0]),
                    dataType: "json",
                    enctype: "multipart/form-data",
                    processData: false,
                    contentType: false,
                    async: true,
                    cache: false,
                    beforeSend: function () {
                        swal({
                            title: "Loading...",
                            text: " ",
                            icon: "../../images/96x96.gif",
                            buttons: false,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                        });
                    },
                    success: function (result) {
                        if (result[0] == 1) {
                            swal({
                                title: "Good Job !",
                                text: "User Successfully Added",
                                icon: "success",
                                buttons: false,
                                timer: 1000,
                            });
                            userTableBody(result[1]);
                        }
                        if (result[0] == 2) {
                            swal({
                                title: "Warning !",
                                text: result[1],
                                icon: "warning",
                            });
                        }
                    },
                    error: function (error) {
                        console.log(error)
                    }
                });
            }
        })
    });

    $("#userLogin").click(() => {
        let userName = $("#userName").val();
        let password = $("#password").val();
    });

    const supplierName = $('#supplierName');
    const supplierContactName = $('#supplierContactName');
    const supplierEmail = $('#supplierEmail');
    const supplierContact = $('#supplierContact');
    const supplierAdd1 = $('#supplierAdd1');
    const supplierAdd2 = $('#supplierAdd2');
    const supplierAdd3 = $('#supplierAdd3');
    $("#supplierFormSubmit").click(() => { //supplier form submit

        let supplierNameVal = supplierName.val()
        let supplierContactNameVal = supplierContactName.val()
        let supplierEmailVal = supplierEmail.val()
        let supplierContactVal = supplierContact.val()
        let supplierAdd1Val = supplierAdd1.val()
        let supplierAdd2Val = supplierAdd2.val()
        let supplierAdd3Val = supplierAdd3.val()

        if (supplierNameVal == "" && supplierContactNameVal == "" && supplierEmailVal == "" && supplierContactVal == "" && supplierAdd1Val == "" && supplierAdd2Val == "" && supplierAdd3Val == "") {
            toastr.error("Please fill the form");
            $([supplierName, supplierContactName, supplierEmail, supplierContact, supplierAdd1, supplierAdd2, supplierAdd3]).each(function () {
                $(this).removeClass("is-valid").addClass("is-invalid")
            })
            supplierName.focus();
            return false;
        }
        if (supplierNameVal == "" || !supplierNameVal.match(patName)) {
            addInvalidClass(supplierName, "Please enter name");
            return false;
        }
        if (supplierContactNameVal == "" || !supplierContactNameVal.match(patName)) {
            addInvalidClass(supplierContactName, "Please enter contact name");
            return false;
        }
        if (supplierEmailVal == "" || !supplierEmailVal.match(patEmail)) {
            addInvalidClass(supplierEmail, "Please enter email");
            return false;
        }
        if (supplierContactVal == "" || !supplierContactVal.match(patCon)) {
            addInvalidClass(supplierContact, "Please enter contact");
            return false;
        }
        if (supplierAdd1Val == "") {
            addInvalidClass(add1, "Please enter address no");
            return false;
        }
        if (supplierAdd2Val == "") {
            addInvalidClass(add2, "Please enter lane");
            return false;
        }
        if (supplierAdd3Val == "") {
            addInvalidClass(add3, "Please enter address street");
            return false;
        }
        swal({
            title: 'Are you sure',
            text: 'Do you want to submit this form',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            allowEscapeKey: false,
            allowOutsideClick: false,
            closeOnClickOutside: false,
            closeOnEsc: false,
        }).then((willOUT) => {
            if (willOUT) {
                $("#addSupplier").modal('hide')
                $.ajax({
                    method: "POST",
                    url: "../controller/SupplierController.php?status=addSupplier",
                    data: new FormData($('#supplierForm')[0]),
                    dataType: "json",
                    enctype: "multipart/form-data",
                    processData: false,
                    contentType: false,
                    async: true,
                    cache: false,
                    beforeSend: function () {
                        swal({
                            title: "Loading...",
                            text: " ",
                            icon: "../../images/96x96.gif",
                            buttons: false,
                            allowOutsideClick: false,
                            closeOnEsc: false,
                            closeOnClickOutside: false,
                        });
                    },
                    success: function (result) {
                        if (result[0] == 1) {
                            swal({
                                title: "Good Job !",
                                text: "Supplier Successfully Added",
                                icon: "success",
                                buttons: false,
                                timer: 1000,
                            });
                            supplierTableBody(result[1]);
                            $("#supplierForm").trigger('reset');
                            $(".is-valid").removeClass('is-valid');
                        }
                        if (result[0] == 2) {
                            swal({
                                title: "Warning !",
                                text: result[1],
                                icon: "warning",
                            });
                        }
                    },
                    error: function (error) {
                        console.log(error)
                    }
                });
            } else {
                swal({
                    title: "Warning!",
                    text: "Supplier Not Added",
                    icon: "warning",
                    timer: 1000,
                });
            }
        })
    });

    const editSupplierName = $('#editSupplierName');
    const editSupplierContactName = $('#editSupplierContactName');
    const editSupplierEmail = $('#editSupplierEmail');
    const editSupplierContact = $('#editSupplierContact');
    const editSupplierAdd1 = $('#editSupplierAdd1');
    const editSupplierAdd2 = $('#editSupplierAdd2');
    const editSupplierAdd3 = $('#editSupplierAdd3');
    $("#saveEditSupplierForm").click(() => { //supplier edit form submit

        let editSupplierNameVal = editSupplierName.val()
        let editSupplierContactNameVal = editSupplierContactName.val()
        let editSupplierEmailVal = editSupplierEmail.val()
        let editSupplierContactVal = editSupplierContact.val()
        let editSupplierAdd1Val = editSupplierAdd1.val()
        let editSupplierAdd2Val = editSupplierAdd2.val()
        let editSupplierAdd3Val = editSupplierAdd3.val()

        if (editSupplierNameVal == "" && editSupplierContactNameVal == "" && editSupplierEmailVal == "" && editSupplierContactVal == "" && editSupplierAdd1Val == "" && editSupplierAdd2Val == "" && editSupplierAdd3Val == "") {
            toastr.error("Please fill the form");
            $([editSupplierName, editSupplierContactName, editSupplierEmail, editSupplierContact, editSupplierAdd1, editSupplierAdd2, editSupplierAdd3]).each(function () {
                $(this).removeClass("is-valid").addClass("is-invalid")
            })
            editSupplierName.focus();
            return false;
        }

        if (editSupplierNameVal == "" || !editSupplierNameVal.match(patName)) {
            addInvalidClass(editSupplierName, "Please enter name");
            return false;
        }
        if (editSupplierContactNameVal == "" || !editSupplierContactNameVal.match(patName)) {
            addInvalidClass(editSupplierContactName, "Please enter contact name");
            return false;
        }
        if (editSupplierEmailVal == "" || !editSupplierEmailVal.match(patEmail)) {
            addInvalidClass(editSupplierEmail, "Please enter email");
            return false;
        }
        if (editSupplierContactVal == "" || !editSupplierContactVal.match(patCon)) {
            addInvalidClass(editSupplierContact, "Please enter contact");
            return false;
        }
        if (editSupplierAdd1Val == "") {
            addInvalidClass(editSupplierAdd1, "Please enter address no");
            return false;
        }
        if (editSupplierAdd2Val == "") {
            addInvalidClass(editSupplierAdd2, "Please enter lane");
            return false;
        }
        if (editSupplierAdd3Val == "") {
            addInvalidClass(editSupplierAdd3, "Please enter address street");
            return false;
        }
        swal({
            title: 'Are you sure',
            text: 'Do you want to submit this form',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            allowEscapeKey: false,
            allowOutsideClick: false,
            closeOnClickOutside: false,
            closeOnEsc: false,
        }).then((willOUT) => {
            if (willOUT) {
                $("#editSupplier").modal('hide')
                $.ajax({
                    method: "POST",
                    url: "../controller/SupplierController.php?status=editSupplier",
                    data: new FormData($('#editSupplierForm')[0]),
                    dataType: "json",
                    enctype: "multipart/form-data",
                    processData: false,
                    contentType: false,
                    async: true,
                    cache: false,
                    beforeSend: function () {
                        swal({
                            title: "Loading...",
                            text: " ",
                            icon: "../../images/96x96.gif",
                            buttons: false,
                            allowOutsideClick: false,
                            closeOnEsc: false,
                            closeOnClickOutside: false,
                        });
                    },
                    success: function (result) {
                        if (result[0] == 1) {
                            swal({
                                title: "Good Job !",
                                text: "Supplier Successfully Added",
                                icon: "success",
                                buttons: false,
                                timer: 1000,
                            });
                            supplierTableBody(result[1]);
                        }
                        if (result[0] == 2) {
                            swal({
                                title: "Warning !",
                                text: result[1],
                                icon: "warning",
                            });
                        }
                    },
                    error: function (error) {
                        console.log(error)
                    }
                });
            } else {
                swal({
                    title: "Warning!",
                    text: "Supplier Not Added",
                    icon: "warning",
                    timer: 1000,
                });
            }
        })
    });

    const customerFirstName = $('#customerFirstName');
    const customerLastName = $('#customerLastName');
    const customerContact = $('#customerContact');
    const customerEmail = $('#customerEmail');
    // const customerGender = $('#customerGender');
    const customerBirthday = $('#customerBirthday');
    const customerAdd1 = $('#customerAdd1');
    const customerAdd2 = $('#customerAdd2');
    const customerAdd3 = $('#customerAdd3');
    const customerPostalCode = $('#customerPostalCode');
    const customerNic = $('#customerNic');
    $("#customerFormSubmit").click(() => { //customer form submit validation

        let customerFirstNameVal = customerFirstName.val()
        let customerLastNameVal = customerLastName.val()
        let customerContactVal = customerContact.val()
        let customerEmailVal = customerEmail.val()
        let customerBirthdayVal = customerBirthday.val()
        let customerAdd1Val = customerAdd1.val()
        let customerAdd2Val = customerAdd2.val()
        let customerAdd3Val = customerAdd3.val()
        let customerPostalCodeVal = customerPostalCode.val()
        let customerNicVal = customerNic.val()

        if (customerFirstNameVal == "" && customerLastNameVal == "" && customerContactVal == "" && customerEmailVal == "" && customerBirthdayVal == "" && customerAdd1Val == "" && customerAdd2Val == "" && customerAdd3Val == "" && customerPostalCodeVal == "" && customerNicVal == "") {
            toastr.error("Please fill the form");
            $([customerFirstName, customerLastName, customerContact, customerEmail, customerBirthday, customerAdd1, customerAdd2, customerAdd3, customerPostalCode, customerNic]).each(function () {
                $(this).removeClass("is-valid").addClass("is-invalid");
            });
            firstName.focus();
            return false;
        }

        if (customerFirstNameVal == "" || !customerFirstNameVal.match(patName)) {
            addInvalidClass(customerFirstName, "please enter first name");
            return false;
        }

        if (customerLastNameVal == "" || !customerLastNameVal.match(patName)) {
            addInvalidClass(customerLastName, "Please enter last name");
            return false;
        }

        if (customerContactVal == "" || !customerContactVal.match(patCon)) {
            addInvalidClass(customerContact, "Please enter contact");
            return false;
        }

        if (customerBirthdayVal == "") {
            addInvalidClass(customerBirthday, "Please enter birthday");
            return false;
        }

        if (customerNicVal == "" || !customerNicVal.match(patNIC)) {
            addInvalidClass(customerNic, "Please enter NIC");
            return false;
        }

        if (customerEmailVal == "" || !customerEmailVal.match(patEmail)) {
            addInvalidClass(customerEmail, "Please enter email");
            return false;
        }
        if (customerAdd1Val == "") {
            addInvalidClass(customerAdd1, "Please enter address no");
            return false;
        }

        if (customerAdd2Val == "") {
            addInvalidClass(customerAdd2, "Please enter lane");
            return false;
        }

        if (customerAdd3Val == "") {
            addInvalidClass(customerAdd3, "Please enter street");
            return false;
        }
        if (customerPostalCodeVal == "") {
            addInvalidClass(customerPostalCode, "Please enter postal code");
            return false;
        }

        swal({
            title: 'Are You Sure',
            text: 'Do you want to submit this form',
            icon: 'warning',
            buttons: true, //cancel btn
            dangerMode: true, //ok btn red color
            allowOutsideClick: false,
            allowEscapeKey: false,
            closeOnClickOutside: false,
            closeOnEsc: false,
        }).then((willOUT) => {
            if (willOUT) {
                $.ajax({
                    method: "POST",
                    url: "../controller/CustomerController.php?status=addCustomer",
                    data: new FormData($('#customerForm')[0]),
                    dataType: "json",
                    enctype: "multipart/form-data",
                    processData: false,
                    contentType: false,
                    async: true,
                    cache: false,
                    beforeSend: function () {
                        swal({
                            title: "Loading...",
                            text: " ",
                            icon: "../../images/96x96.gif",
                            buttons: false,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                        });
                    },
                    success: function (result) {
                        if (result[0] == 1) {
                            swal({
                                title: "Good Job !",
                                text: "User Successfully Added",
                                icon: "success",
                                buttons: false,
                                timer: 1000,
                            });
                            userTableBody(result[1]);
                        }
                        if (result[0] == 2) {
                            swal({
                                title: "Warning !",
                                text: result[1],
                                icon: "warning",
                            });
                        }
                    },
                    error: function (error) {
                        console.log(error)
                    }
                });
            } else {
                swal({
                    title: "Warning !",
                    text: 'User not added ',
                    icon: "warning",
                    buttons: false,
                    timer: 1000,
                });
            }
        })
    });

    const editCustomerFirstName = $('#editCustomerFirstName');
    const editCustomerLastName = $('#editCustomerLastName');
    const editCustomerContact = $('#editCustomerContact');
    const editCustomerEmail = $('#editCustomerEmail');
    // const editCustomerGender = $('#editCustomerGender');
    const editCustomerBirthday = $('#editCustomerBirthday');
    const editCustomerAdd1 = $('#editCustomerAdd1');
    const editCustomerAdd2 = $('#editCustomerAdd2');
    const editCustomerAdd3 = $('#editCustomerAdd3');
    const editCustomerPostalCode = $('#editCustomerPostalCode');
    const editCustomerNic = $('#editCustomerNic');
    $("#saveEditCustomerForm").click(() => { //customer form submit validation

        let editCustomerFirstNameVal = editCustomerFirstName.val()
        let editCustomerLastNameVal = editCustomerLastName.val()
        let editCustomerContactVal = editCustomerContact.val()
        let editCustomerEmailVal = editCustomerEmail.val()
        let editCustomerBirthdayVal = editCustomerBirthday.val()
        let editCustomerAdd1Val = editCustomerAdd1.val()
        let editCustomerAdd2Val = editCustomerAdd2.val()
        let editCustomerAdd3Val = editCustomerAdd3.val()
        let editCustomerPostalCodeVal = editCustomerPostalCode.val()
        let editCustomerNicVal = editCustomerNic.val()

        if (editCustomerFirstNameVal == "" && editCustomerLastNameVal == "" && editCustomerContactVal == "" && editCustomerEmailVal == "" && editCustomerBirthdayVal == "" && editCustomerAdd1Val == "" && editCustomerAdd2Val == "" && editCustomerAdd3Val == "" && editCustomerPostalCodeVal == "" && editCustomerNicVal == "") {
            toastr.error("Please fill the form");
            $([editCustomerFirstName, editCustomerLastName, editCustomerContact, editCustomerEmail, editCustomerBirthday, editCustomerAdd1, editCustomerAdd2, editCustomerAdd3, editCustomerPostalCode, editCustomerNic]).each(function () {
                $(this).removeClass("is-valid").addClass("is-invalid");
            });
            firstName.focus();
            return false;
        }

        if (editCustomerFirstNameVal == "" || !editCustomerFirstNameVal.match(patName)) {
            addInvalidClass(editCustomerFirstName, "please enter first name");
            return false;
        }

        if (editCustomerLastNameVal == "" || !editCustomerLastNameVal.match(patName)) {
            addInvalidClass(editCustomerLastName, "Please enter last name");
            return false;
        }

        if (editCustomerContactVal == "" || !editCustomerContactVal.match(patCon)) {
            addInvalidClass(editCustomerContact, "Please enter contact");
            return false;
        }

        if (editCustomerBirthdayVal == "") {
            addInvalidClass(editCustomerBirthday, "Please enter birthday");
            return false;
        }

        if (editCustomerNicVal == "" || !editCustomerNicVal.match(patNIC)) {
            addInvalidClass(editCustomerNic, "Please enter NIC");
            return false;
        }

        if (editCustomerEmailVal == "" || !editCustomerEmailVal.match(patEmail)) {
            addInvalidClass(editCustomerEmail, "Please enter email");
            return false;
        }
        if (editCustomerAdd1Val == "") {
            addInvalidClass(editCustomerAdd1, "Please enter address no");
            return false;
        }

        if (editCustomerAdd2Val == "") {
            addInvalidClass(editCustomerAdd2, "Please enter lane");
            return false;
        }

        if (editCustomerAdd3Val == "") {
            addInvalidClass(editCustomerAdd3, "Please enter street");
            return false;
        }
        if (editCustomerPostalCodeVal == "") {
            addInvalidClass(editCustomerPostalCode, "Please enter postal code");
            return false;
        }

        swal({
            title: 'Are You Sure',
            text: 'Do you want to submit this form',
            icon: 'warning',
            buttons: true, //cancel btn
            dangerMode: true, //ok btn red color
            allowOutsideClick: false,
            allowEscapeKey: false,
            closeOnClickOutside: false,
            closeOnEsc: false,
        }).then((willOUT) => {
            if (willOUT) {
                $("#editCustomer").modal('hide')
                $.ajax({
                    method: "POST",
                    url: "../controller/CustomerController.php?status=editCustomer",
                    data: new FormData($('#editCustomerForm')[0]),
                    dataType: "json",
                    enctype: "multipart/form-data",
                    processData: false,
                    contentType: false,
                    async: true,
                    cache: false,
                    beforeSend: function () {
                        swal({
                            title: "Loading...",
                            text: " ",
                            icon: "../../images/96x96.gif",
                            buttons: false,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                        });
                    },
                    success: function (result) {
                        if (result[0] == 1) {
                            swal({
                                title: "Good Job !",
                                text: "User Successfully Added",
                                icon: "success",
                                buttons: false,
                                timer: 1000,
                            });
                            customerTableBody(result[1]);
                        }
                        if (result[0] == 2) {
                            swal({
                                title: "Warning !",
                                text: result[1],
                                icon: "warning",
                            });
                        }
                    },
                    error: function (error) {
                        console.log(error)
                    }
                });
            } else {
                swal({
                    title: "Warning !",
                    text: 'User not added ',
                    icon: "warning",
                    buttons: false,
                    timer: 1000,
                });
            }
        })
    });

    const tableName = $('#tableName');
    const tableCapacity = $('#tableCapacity');
    //submit dining table form 
    $('#tableFormSubmit').click(() => {
        let tableNameVal = tableName.val();
        let tableCapacityVal = tableCapacity.val();

        if (tableNameVal == "" && tableCapacityVal == "") {
            toastr.error("Please fill the form");
            $([tableName, tableCapacity]).each(function () {
                $(this).removeClass("is-valid").addClass("is-invalid")
            })
            tableName.focus();
            return false;
        }
        if (tableNameVal == "") {
            addInvalidClass(tableName, "Please enter table name");
            return false;
        }
        if (tableCapacityVal == "") {
            addInvalidClass(tableCapacity, 'Please enter capacity');
            return false;
        }
        swal({
            title: 'Are you sure',
            text: 'Do you want to submit this form',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            allowEscapeKey: false,
            allowOutsideClick: false,
            closeOnClickOutside: false,
            closeOnEsc: false,
        }).then((willOUT) => {
            if (willOUT) {
                $.ajax({
                    method: "POST",
                    url: "../controller/DiningTableController.php?status=addDiningTable",
                    data: new FormData($('#diningTableForm')[0]),
                    dataType: "json",
                    enctype: "multipart/form-data",
                    processData: false,
                    contentType: false,
                    async: true,
                    beforeSend: function () {
                        swal({
                            title: "Loading...",
                            text: " ",
                            icon: "../../images/96x96.gif",
                            buttons: false,
                            allowOutsideClick: false,
                            closeOnEsc: false,
                            closeOnClickOutside: false,
                        });
                    },
                    success: function (result) {
                        if (result[0] == 1) {
                            $("#diningTableForm").trigger('reset');
                            $(".is-valid").removeClass('is-valid');
                            $("#addDiningTable").modal('hide')
                            swal({
                                title: "Good Job!",
                                text: "Dining Table Successfully Added",
                                icon: "success",
                                buttons: false,
                                timer: 1000,
                            });
                        }
                        if (result[0] == 2) {
                            swal({
                                title: "Warning!",
                                text: result[1],
                                icon: "warning",
                            });
                        }
                    },
                    error: function (error) {
                        console.log(error)
                    }
                });
            } else {
                swal({
                    title: "Warning!",
                    text: "Dining Table Not Added",
                    icon: "warning",
                    timer: 1000,
                });
            }
        })
    });

    const editTableName = $('#editTableName');
    const editTableCapacity = $('#editTableCapacity');
    $("#saveEditTableFormSubmit").click(() => {
        let editTableNameVal = editTableName.val();
        let editTableCapacityVal = editTableCapacity.val();

        if (editTableNameVal == "" && editTableCapacityVal == "") {
            toastr.error("Please fill the form");
            $([editTableName, editTableCapacity]).each(function () {
                $(this).removeClass("is-valid").addClass("is-invalid")
            })
            editTableName.focus();
            return false;
        }

        if (editTableName == "") {
            addInvalidClass(editTableName, "Please enter table name");
            return false;
        }
        if (editTableCapacity == "") {
            addInvalidClass(editTableCapacity, "Please enter table capacity");
            return false;
        }
        swal({
            title: 'Are you sure',
            text: 'Do you want to submit this form',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            allowEscapeKey: false,
            allowOutsideClick: false,
            closeOnClickOutside: false,
            closeOnEsc: false,
        }).then((willOUT) => {
            if (willOUT) {
                $("#editDiningTable").modal('hide')
                $.ajax({
                    method: "POST",
                    url: "../controller/DiningTableController.php?status=editDiningTable",
                    data: new FormData($('#editDiningTableForm')[0]),
                    dataType: "json",
                    enctype: "multipart/form-data",
                    processData: false,
                    contentType: false,
                    async: true,
                    beforeSend: function () {
                        swal({
                            title: "Loading...",
                            text: " ",
                            icon: "../../images/96x96.gif",
                            buttons: false,
                            allowOutsideClick: false,
                            closeOnEsc: false,
                            closeOnClickOutside: false,
                        });
                    },
                    success: function (result) {
                        if (result[0] == 1) {
                            swal({
                                title: "Good Job!",
                                text: "Dining Table Successfully Updated",
                                icon: "success",
                                buttons: false,
                                timer: 1000,
                            });
                            diningTableBody(result[1]);
                            $("#editDiningTableForm").trigger('reset');
                            $(".is-valid").removeClass('is-valid');
                        }
                        if (result[0] == 2) {
                            swal({
                                title: "Warning!",
                                text: result[1],
                                icon: "warning",
                            });
                        }
                    },
                    error: function (error) {
                        console.log(error)
                    }
                });
            } else {
                swal({
                    title: "Warning!",
                    text: "Dining Table Not Added",
                    icon: "warning",
                    timer: 1000,
                });
            }
        })
    });

    const foodItemName = $('#foodItemName');
    const unitPrice = $('#unitPrice');
    const foodItemCategory = $('#foodItemCategory');
    const foodItemSubCategory = $('foodItemSubCategory');
    const foodItemImage = $('foodItemImage');
    $("#foodItemFormSubmit").click(() => {
        let foodItemNameVal = foodItemName.val()
        let unitPriceVal = unitPrice.val()
        let foodItemCategoryVal = foodItemCategory.val()
        let foodItemSubCategoryVal = foodItemSubCategory.val()
        let foodItemImageVal = foodItemImage.val()

        if (foodItemNameVal == "" && unitPriceVal == "" && foodItemCategoryVal == "" && foodItemSubCategoryVal == "" && foodItemImageVal == "") {
            toastr.error("Please fill the form");
            $([foodItemName, unitPrice, category, subCategory, foodItemImage]).each(function () {
                $(this).removeClass("is-valid").addClass("is-invalid")
            });
            foodItemName.focus();
            return false;
        }
        if (foodItemNameVal == "") {
            addInvalidClass(foodItemName, "Please enter food item name");
            return false;
        }
        if (unitPriceVal == "") {
            addInvalidClass(unitPrice, "Please add unit price");
            return false;
        }
        if (foodItemCategoryVal == "") {
            addInvalidClass(foodItemCategory, "Please enter category");
            return false;
        }
        if (foodItemSubCategoryVal == "") {
            addInvalidClass(foodItemSubCategory, "Please enter subcategory");
            return false;
        }
        if (foodItemImageVal == "") {
            addInvalidClass(foodItemImage, "Please add an image");
            return false;
        }
        swal({
            title: 'Are you sure',
            text: 'Do you want to submit this form',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            allowOutsideClick: false,
            closeOnClickOutside: false,
            closeOnEsc: false,
        }).then((willOUT) => {
            if (willOUT) {
                $.ajax({
                    method: "POST",
                    url: "../controller/FoodItemController.php?status=addFoodItem",
                    data: new FormData($('#foodItemForm')[0]),
                    dataType: "json",
                    enctype: "multipart/form-data",
                    processData: false,
                    contentType: false,
                    async: true,
                    cache: false,
                    beforeSend: function () {
                        swal({
                            title: "Loading...",
                            text: " ",
                            icon: "../../images/96x96.gif",
                            buttons: false,
                            allowOutsideClick: false,
                            closeOnEsc: false,
                            closeOnClickOutside: false,
                        });
                    },
                    success: function (result) {
                        if (result[0] == 1) {
                            swal({
                                title: "Good Job !",
                                text: "Food Item Successfully Added",
                                icon: "success",
                                buttons: false,
                                timer: 1000,
                            });
                            foodItemTableBody(result[1]);
                            $("#foodItemForm").trigger('reset');
                            $(".is-valid").removeClass('is-valid');
                        }
                        if (result[0] == 2) {
                            swal({
                                title: "Warning !",
                                text: result[1],
                                icon: "warning",
                            });
                        }
                    },
                    error: function (error) {
                        console.log(error)
                    }
                });
            } else {
                swal({
                    title: "Warning !",
                    text: 'Food Item not added',
                    icon: "warning",
                    buttons: false,
                    timer: 1000,
                })
            }
        })
    });

    const editFoodItemName = $('#editFoodItemName');
    const editUnitPrice = $('#editUnitPrice');
    const editFoodItemCategory = $('#editFoodItemCategory');
    const editFoodItemSubCategory = $('#editFoodItemSubCategory');
    const editFoodItemImage = $('#editFoodItemImage');
    $("#editFoodItemFormSubmit").click(() => {
        let editFoodItemNameVal = editFoodItemName.val()
        let editUnitPriceVal = editUnitPrice.val()
        let editFoodItemCategoryVal = editFoodItemCategory.val()
        let editFoodItemSubCategoryVal = editFoodItemSubCategory.val()
        let editFoodItemImageVal = editFoodItemImage.val()

        if (editFoodItemNameVal == "" && editUnitPriceVal == "" && editFoodItemCategoryVal == "" && editFoodItemSubCategoryVal == "" && editFoodItemImageVal == "") {
            toastr.error("Please fill the form");
            $([editFoodItemName, editUnitPrice, editCategory, editCategory, editFoodItemImage]).each(function () {
                $(this).removeClass("is-valid").addClass("is-invalid")
            });
            editFoodItemName.focus();
            return false;
        }
        if (editFoodItemNameVal == "") {
            addInvalidClass(editFoodItemName, "Please enter food item name");
            return false;
        }
        if (editUnitPriceVal == "") {
            addInvalidClass(editUnitPrice, "Please enter unit price");
            return false;
        }
        if (editFoodItemCategoryVal == "") {
            addInvalidClass(editCategory, "Please enter category name");
            return false;
        }
        if (editFoodItemSubCategoryVal == "") {
            addInvalidClass(editCategoryVal, "Please add sub category name");
            return false;
        }
        if (editFoodItemImageVal == "") {
            addInvalidClass(editFoodItemImage, "Please add image");
            return false;
        }
        if (!allowImagePattern.exec(editFoodItemImageVal)) {
            addInvalidClass(editFoodItemImage, "Please select an image");
            return false;
        }
        swal({
            title: 'Are you sure',
            text: 'Do you want to submit this form',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
            closeOnClickOutside: false,
            closeOnEsc: false,
        }).then((willOUT) => {
            if (willOUT) {
                $.ajax({
                    method: "POST",
                    url: "../controller/FoodItemController.php?status=editFoodItem",
                    data: new FormData($('#editFoodItem')[0]),
                    dataType: "json",
                    enctype: "multipart/form-data",
                    processData: false,
                    contentType: false,
                    async: true,
                    cache: false,
                    beforeSend: function () {
                        swal({
                            title: "Loading..",
                            text: " ",
                            icon: "../../images/96x96.gif",
                            buttons: false,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                        });
                    },
                    success: function (result) {
                        if (result[0] == 1) {
                            swal({
                                title: "Good Job!",
                                text: "Food Item Successfully changed ",
                                icon: "success",
                                buttons: false,
                                timer: 1000,
                            });
                            foodItemTableBody(result[1]);
                        }
                        if (result[0] == 2) {
                            swal({
                                title: "Warning !",
                                text: result[1],
                                icon: "warning",
                            });
                        }
                    },
                    error: function (error) {
                        console.log(error)
                    }
                });
            }
        })
    });

    const categoryName = $('#categoryName');
    $("#categoryFormSubmit").click(() => {
        let categoryNameVal = categoryName.val();

        if (categoryNameVal == "") {
            toastr.error("Please fill the form");
            $([categoryName]).each(function () {
                $(this).removeClass("is-valid").addClass("is-invalid")
            })
            categoryName.focus();
            return false;
        }
        if (categoryName == "") {
            addInvalidClass(categoryName, "Please enter category name");
            return false;
        }
        swal({
            title: 'Are you sure',
            text: 'Do you want to submit this form',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            allowEscapeKey: false,
            allowOutsideClick: false,
            closeOnClickOutside: false,
            closeOnEsc: false,
        }).then((willOUT) => {
            if (willOUT) {
                $.ajax({
                    method: "POST",
                    url: "../controller/CategoryController.php?status=addCategory",
                    data: new FormData($('#categoryForm')[0]),
                    dataType: "json",
                    enctype: "multipart/form-data",
                    processData: false,
                    contentType: false,
                    async: true,
                    beforeSend: function () {
                        swal({
                            title: "Loading...",
                            text: " ",
                            icon: "../../images/96x96.gif",
                            buttons: false,
                            allowOutsideClick: false,
                            closeOnEsc: false,
                            closeOnClickOutside: false,
                        });
                    },
                    success: function (result) {
                        if (result[0] == 1) {
                            swal({
                                title: "Good Job!",
                                text: "Category name Successfully Added",
                                icon: "success",
                                buttons: false,
                                timer: 1000,
                            });
                            categoryTableBody(result[1]);
                            $("#categoryForm").trigger('reset');
                            $(".is-valid").removeClass('is-valid');
                            $("#addCategory").modal('hide')
                        }
                        if (result[0] == 2) {
                            swal({
                                title: "Warning!",
                                text: result[1],
                                icon: "warning",
                            });
                        }
                    },
                    error: function (error) {
                        console.log(error)
                    }
                });
            } else {
                swal({
                    title: "Warning!",
                    text: "Category Not Added",
                    icon: "warning",
                    timer: 1000,
                })
            }
        })
    });

    const editCategoryName = $('#editCategoryName');
    $("#editCategoryFormSubmit").click(() => {
        let editCategoryNameVal = editCategoryName.val();

        if (editCategoryNameVal == "") {
            toastr.error("Please fill the form");
            $([editCategoryName]).each(function () {
                $(this).removeClass("is-valid").addClass("is-invalid");
            })
            editCategoryName.focus();
            return false;
        }
        if (editCategoryName == "") {
            addInvalidClass(editCategoryName, "Please enter category name");
            return false;
        }
        swal({
            title: 'Are you sure',
            text: 'Do you want to submit this form',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            allowEscapeKey: false,
            allowOutsideClick: false,
            closeOnClickOutside: false,
            closeOnEsc: false,
        }).then((willOUT) => {
            if (willOUT) {
                $("editCategory").modal('hide')
                $.ajax({
                    method: "POST",
                    url: "../controller/CategoryController.php?status=editCategory",
                    data: new FormData($('#editCategoryForm')[0]),
                    dataType: "json",
                    enctype: "multipart/form-data",
                    processData: false,
                    contentType: false,
                    async: true,
                    beforeSend: function () {
                        swal({
                            title: "Loading...",
                            text: " ",
                            icon: "../../images/96x96.gif",
                            buttons: false,
                            allowOutsideClick: false,
                            closeOnEsc: false,
                            closeOnClickOutside: false,
                        });
                    },
                    success: function (result) {
                        if (result[0] == 1) {
                            swal({
                                title: "Good Job!",
                                text: "Category Successfully Updated",
                                icon: "success",
                                buttons: false,
                                timer: 1000,
                            });
                            categoryTableBody(result[1]);
                            $("#editCategoryForm").trigger('reset');
                            $(".is-valid").removeClass('is-valid');
                            $('#editCategory').modal('hide')
                        }
                        if (result[0] == 2) {
                            swal({
                                title: "Warning!",
                                text: result[1],
                                icon: "warning",
                            });
                        }
                    },
                    error: function (error) {
                        console.log(error)
                    }
                });
            } else {
                swal({
                    title: "Warning!",
                    text: "Dining Table Not Updated",
                    icon: "warning",
                    timer: 1000,
                });
            }
        })
    });

    const subCategoryName = $('#subCategoryName');
    const subCategoryCategoryItem = $('#subCategoryCategoryItem');
    $("#subCategoryFormSubmit").click(() => {
        let subCategoryNameVal = subCategoryName.val();
        let subCategoryCategoryItemVal = subCategoryCategoryItem.val();

        if (subCategoryNameVal == "" && subCategoryCategoryItemVal == "") {
            toastr.error("Please fill the form");
            $([subCategoryName, subCategoryCategoryItem]).each(function () {
                $(this).removeClass("is-valid").addClass("is-invalid")
            })
            subCategoryName.focus();
            return false;
        }
        if (subCategoryName == "") {
            addInvalidClass(subCategoryName, "Please enter sub category name");
            return false;
        }
        if (subCategoryCategoryItem == "") {
            addInvalidClass(subCategoryCategoryItem, "Please enter category name");
            return false;
        }
        swal({
            title: 'Are you sure',
            text: 'Do you want to submit this form',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            allowEscapeKey: false,
            allowOutsideClick: false,
            closeOnClickOutside: false,
            closeOnEsc: false,
        }).then((willOUT) => {
            if (willOUT) {
                $.ajax({
                    method: "POST",
                    url: "../controller/SubCategoryController.php?status=addSubCategory",
                    data: new FormData($('#subCategoryForm')[0]),
                    dataType: "json",
                    enctype: "multipart/form-data",
                    processData: false,
                    contentType: false,
                    async: true,
                    beforeSend: function () {
                        swal({
                            title: "Loading...",
                            text: " ",
                            icon: "../../images/96x96.gif",
                            buttons: false,
                            allowOutsideClick: false,
                            closeOnEsc: false,
                            closeOnClickOutside: false,
                        });
                    },
                    success: function (result) {
                        if (result[0] == 1) {
                            swal({
                                title: "Good Job!",
                                text: "Category name Successfully Added",
                                icon: "success",
                                buttons: false,
                                timer: 1000,
                            });
                            subCategoryTableBody(result[1]);
                            $("#subCategoryForm").trigger('reset');
                            $(".is-valid").removeClass('is-valid');
                            $('#addSubCategory').modal('hide')
                        }
                        if (result[0] == 2) {
                            swal({
                                title: "Warning!",
                                text: result[1],
                                icon: "warning",
                            });
                        }
                    },
                    error: function (error) {
                        console.log(error)
                    }
                });
            } else {
                swal({
                    title: "Warning!",
                    text: "Category Not Added",
                    icon: "warning",
                    timer: 1000,
                })
            }
        })
    });

    const editSubCategoryName = $('#editSubCategoryName');
    const editSubCategoryCategoryItem = $('#editSubCategoryCategoryItem');
    $('#editSubCategoryFormSubmit').click(() => {
        let editSubCategoryNameVal = editSubCategoryName.val();
        let editSubCategoryCategoryItemVal = editSubCategoryCategoryItem.val();

        if (editSubCategoryNameVal == "" && editSubCategoryCategoryItemVal == "") {
            toastr.error("Please fill the form");
            $([editSubCategoryName, editSubCategoryCategoryItem]).each(function () {
                $(this).removeClass("is-valid").addClass("is-invalid")
            })
            editSubCategoryName.focus();
            return false;
        }
        if (editSubCategoryName == "") {
            addInvalidClass(editSubCategoryName, "Please enter sub category name");
            return false;
        }
        if (editSubCategoryCategoryItem == "") {
            addInvalidClass(editSubCategoryCategoryItems, "Please enter category name");
            return false;
        }
        swal({
            title: 'Are you sure',
            text: 'Do you want to submit this form',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            allowEscapeKey: false,
            allowOutsideClick: false,
            closeOnClickOutside: false,
            closeOnEsc: false,
        }).then((willOUT) => {
            if (willOUT) {
                $.ajax({
                    method: "POST",
                    url: "../controller/SubCategoryController.php?status=editSubCategory",
                    data: new FormData($('#editSubCategoryForm')[0]),
                    dataType: "json",
                    enctype: "multipart/form-data",
                    processData: false,
                    contentType: false,
                    async: true,
                    beforeSend: function () {
                        swal({
                            title: "Loading...",
                            text: " ",
                            icon: "../../images/96x96.gif",
                            buttons: false,
                            allowOutsideClick: false,
                            closeOnEsc: false,
                            closeOnClickOutside: false,
                        });
                    },
                    success: function (result) {
                        if (result[0] == 1) {
                            swal({
                                title: "Good Job!",
                                text: "Category name Successfully Changed",
                                icon: "success",
                                buttons: false,
                                timer: 1000,
                            });
                            subCategoryTableBody(result[1]);
                            $("#editSubCategoryForm").trigger('reset');
                            $(".is-valid").removeClass('is-valid');
                            $('#editSubCategory').modal('hide')
                        }
                        if (result[0] == 2) {
                            swal({
                                title: "Warning!",
                                text: result[1],
                                icon: "warning",
                            });
                        }
                    },
                    error: function (error) {
                        console.log(error)
                    }
                });
            } else {
                swal({
                    title: "Warning!",
                    text: "Sub Category Not Changed",
                    icon: "warning",
                    timer: 1000,
                })
            }
        })
    });

    const rowItemName = $('#rowItemName');
    $('#rowItemFormSubmit').click(() => {
        let rowItemNameVal = rowItemName.val();

        if (rowItemNameVal == "") {
            toastr.error("Please fill the form");
            $([rowItemName]).each(function () {
                $(this).removeClass("is-valid").addClass("is-invalid")
            })
            rowItemName.focus();
            return false;
        }
        if (rowItemName == "") {
            addInvalidClass(rowItemName, "Please enter row item");
            return false;
        }
        swal({
            title: 'Are you sure',
            text: 'Do you want to submit this form',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            allowEscapeKey: false,
            allowOutsideClick: false,
            closeOnClickOutside: false,
            closeOnEsc: false,
        }).then((willOUT) => {
            if (willOUT) {
                $.ajax({
                    method: "POST",
                    url: "../controller/RowItemController.php?status=addRowItem",
                    data: new FormData($('#rowItemForm')[0]),
                    dataType: "json",
                    enctype: "multipart/form-data",
                    processData: false,
                    contentType: false,
                    async: true,
                    beforeSend: function () {
                        swal({
                            title: "Loading...",
                            text: " ",
                            icon: "../../images/96x96.gif",
                            buttons: false,
                            allowOutsideClick: false,
                            closeOnEsc: false,
                            closeOnClickOutside: false,
                        });
                    },
                    success: function (result) {
                        if (result[0] == 1) {
                            swal({
                                title: "Good Job!",
                                text: "Row Item successfully added",
                                icon: "success",
                                buttons: false,
                                timer: 1000,
                            });
                            rowItemTableBody(result[1]);
                            $("#rowItemForm").trigger('reset');
                            $(".is-valid").removeClass('is-valid');
                            $('#addRowItems').modal('hide')
                        }
                        if (result[0] == 2) {
                            swal({
                                title: "Warning!",
                                text: result[1],
                                icon: "warning",
                            });
                        }
                    },
                    error: function (error) {
                        console.log(error)
                    }
                });
            } else {
                swal({
                    title: "Warning!",
                    text: "Row item not added",
                    icon: "warning",
                    timer: 1000,
                })
            }
        })
    });

    const editRowItemName = $('#editRowItemName');
    $("#editRowItemFormSubmit").click(() => {
        let editRowItemNameVal = editRowItemName.val();

        if (editRowItemNameVal == "") {
            toastr.error("Please fill the form");
            $([editRowItemName]).each(function () {
                $(this).removeClass("is-valid").addClass("is-invalid");
            })
            editRowItemName.focus();
            return false;
        }
        if (editRowItemNameVal == "") {
            addInvalidClass(editRowItemName, "Please enter row item name");
            return false;
        }
        swal({
            title: 'Are you sure',
            text: 'Do you want to submit this form',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            allowEscapeKey: false,
            allowOutsideClick: false,
            closeOnClickOutside: false,
            closeOnEsc: false,
        }).then((willOUT) => {
            if (willOUT) {
                // $("editRowItem").modal('hide')
                $.ajax({
                    method: "POST",
                    url: "../controller/RowItemController.php?status=editRowItem",
                    data: new FormData($('#editRowItemForm')[0]),
                    dataType: "json",
                    enctype: "multipart/form-data",
                    processData: false,
                    contentType: false,
                    async: true,
                    beforeSend: function () {
                        swal({
                            title: "Loading...",
                            text: " ",
                            icon: "../../images/96x96.gif",
                            buttons: false,
                            allowOutsideClick: false,
                            closeOnEsc: false,
                            closeOnClickOutside: false,
                        });
                    },
                    success: function (result) {
                        if (result[0] == 1) {
                            swal({
                                title: "Good Job!",
                                text: "row item Successfully Updated",
                                icon: "success",
                                buttons: false,
                                timer: 1000,
                            });
                            rowItemTableBody(result[1]);
                            $("#editRowItemForm").trigger('reset');
                            $(".is-valid").removeClass('is-valid');
                            $("#editRowItem").modal('hide')
                        }
                        if (result[0] == 2) {
                            swal({
                                title: "Warning!",
                                text: result[1],
                                icon: "warning",
                            });
                        }
                    },
                    error: function (error) {
                        console.log(error)
                    }
                });
            } else {
                swal({
                    title: "Warning!",
                    text: "Row Item  Not Updated",
                    icon: "warning",
                    timer: 1000,
                });
            }
        })
    });
    

     // add stock page
     const stockRowItemName = $('#stockRowItemName');
     const stockMnfDate = $('#stockMnfDate');
     const stockExpDate = $('#stockExpDate');
     const stockReceivedQuantity = $('#stockReceivedQuantity');
     const stockCostPerUnit = $('#stockCostPerUnit');
     const stockNetCost = $('#stockNetCost');
     const stockDiscount = $('#stockDiscount');
     const stockTotalCost = $('#stockTotalCost');
     const stockTotalDiscount = $('#stockTotalDiscount');
    $("#addRow").click(() => {
        let stockRowItemNameVal = stockRowItemName.val();
        let stockMnfDateVal = stockMnfDate.val();
        let stockExpDateVal = stockExpDate.val();
        let stockReceivedQuantityVal = stockReceivedQuantity.val();
        let stockCostPerUnitVal = stockCostPerUnit.val();
        let stockNetCostVal = parseFloat(stockNetCost.val());
        let stockDiscountVal = +stockDiscount.val();
        let stockTotalCostVal = parseFloat(stockTotalCost.val());
        let stockTotalDiscountVal = +(stockTotalDiscount.val());
       
        if (stockRowItemNameVal == "" || stockMnfDateVal == "" || stockExpDateVal == "" || stockReceivedQuantityVal == "" || stockCostPerUnitVal == "" || stockNetCostVal<0 || stockDiscountVal<0) {
            toastr.error("Fill the fields");
            $([stockRowItemName, stockMnfDate, stockExpDate, stockReceivedQuantity, stockCostPerUnit, stockNetCost, stockDiscount]).each(function () {
                $(this).removeClass("is-valid").addClass("is-invalid")
            })
            stockRowItemName.focus();
            return false;
        }
        if (stockRowItemNameVal == "") {
            addInvalidClass(stockRowItemName,"Add row item name");
            return false;
        }
        if (stockMnfDateVal == "") {
            addInvalidClass(stockMnfDate, "Add manufacture date");
            return false;
        }
        if (stockExpDateVal == "") {
            addInvalidClass(stockExpDate, "Add expire date");
            return false;
        }
        if (stockReceivedQuantityVal=="") {
            addInvalidClass(stockReceivedQuantity, "Add received quantity");
            return false;
        }
        if (stockCostPerUnitVal=="") {
            addInvalidClass(stockCostPerUnit, "Add cost per unit");
            return false;
        } 
        if (stockDiscountVal<0) {
            addInvalidClass(stockDiscount, "Add discount");
            return false;
        }
        if (stockNetCostVal<0) {
            addInvalidClass(stockNetCost, "Add net cost");
            return false;
        }else {
            markup = '<tr>' +
                '<td scope="row"><button type="button" class="btn btn-outline-danger btnDelete ">&cross;</button></i></td>' +
                '<td>' +
                '<input list="stockRowItemNames" class="form-control" type="text"  readonly value="'+stockRowItemNameVal+'">' +
                '<input type="hidden" list="stockRowItemId" class="form-control"  name="stockTableRowItemId[]" readonly value="'+stockRowItemNameVal+'">' +
                '</td>' +
                '<td><input name="stockTableMnfDate[]" type="text" class="form-control" readonly value="'+stockMnfDateVal+'"></td>' +
                '<td><input name="stockTableExpDate[]" type="text" class="form-control" readonly value="'+stockExpDateVal+'"></td>' +
                '<td><input name="stockTableReceivedQuantity[]"  type="number" class="form-control text-end" readonly value="'+stockReceivedQuantityVal+'"></td>' +
                '<td><input name="stockTableCostPerUnit[]"  type="number" class="form-control text-end" readonly value="'+stockCostPerUnitVal+'"></td>' +
                '<td><input name="stockTableDiscount[]"  type="number" class="form-control text-end" readonly value="'+stockDiscountVal+'"></td>' +
                '<td><input name="stockTableNetCost[]" readonly type="number" class="form-control netCost text-end" readonly value="'+stockNetCostVal+'"></td>' +
                '</tr>';
            tableBody = $("#stockTbody");
            tableBody.append(markup);
            
            //new total add and fill the net cost and net total input fields
            let newTotal = stockNetCostVal + stockTotalCostVal;
            $('#stockTotalCost').val(newTotal.toFixed(2));
            if (stockTotalDiscountVal==""){
                $('#stockTotalCost').val(""); //empty the current value
                $('#stockTotalCost , #stockNetTotal').val(newTotal.toFixed(2));
            }else{
                let netTotal = newTotal - (newTotal * stockTotalDiscountVal)/100
                $('#stockNetTotal').val(netTotal.toFixed(2));
            }
            stockRowItemName.val(""); //empty the input fields values 
            stockMnfDate.val("");
            stockExpDate.val("");
            stockReceivedQuantity.val("");
            stockCostPerUnit.val("");
            stockDiscount.val("");
            stockNetCost.val("");

            //remove valid  mark n empty fields
            $([stockRowItemName, stockMnfDate, stockExpDate, stockReceivedQuantity, stockCostPerUnit, stockDiscount, stockNetCost]).each(function(){
                $(this).removeClass("is-valid");
            }); 
        }
    });


    //get the net cost with discount
    $('#stockReceivedQuantity, #stockCostPerUnit').keyup(()=>{
        let stockReceivedQuantityVal = +stockReceivedQuantity.val();//change the string value to integer by +
        let stockCostPerUnitVal = parseFloat(stockCostPerUnit.val()); // change the value string to float  
        let stockDiscountVal = +stockDiscount.val();
        let stockCostVal = stockReceivedQuantityVal * stockCostPerUnitVal;
        let stockNetCostVal = stockCostVal - (stockCostVal * stockDiscountVal)/100;//before add received quantity an cost per unit, insert discount nd get value
        $('#stockNetCost').val(stockNetCostVal.toFixed(2)); //net cost value for one item
    });
   
    //after add received quantity an cost per unit, insert discount nd get value
    $('#stockDiscount').keyup(()=>{
        let stockReceivedQuantityVal = +stockReceivedQuantity.val();//change the string value to integer by +
        let stockCostPerUnitVal = parseFloat(stockCostPerUnit.val()); // change the value string to float  
        let stockDiscountVal = +stockDiscount.val();
        let stockCostVal = stockReceivedQuantityVal * stockCostPerUnitVal;
        let stockNetCostVal = stockCostVal - (stockCostVal * stockDiscountVal)/100;//after add received quantity an cost per unit, insert discount nd get value
        $('#stockNetCost').val(stockNetCostVal.toFixed(2)); //net cost value for one item
    });

    // find the discount using net cost
    $('#stockNetCost').keyup(()=>{
        let stockReceivedQuantityVal = +stockReceivedQuantity.val();//change the string value to integer by +
        let stockCostPerUnitVal = parseFloat(stockCostPerUnit.val()); // change the value string to float  
        let stockNetCostVal = +stockNetCost.val();
        let stockCostVal = stockReceivedQuantityVal * stockCostPerUnitVal;
        let stockDiscountVal = ((stockCostVal - stockNetCostVal)*100)/stockCostVal;
        $('#stockDiscount').val(stockDiscountVal.toFixed(0)); //net cost value for one item
    });

    //remove row in add stock table
    $('#stockTbody').on("click",'.btnDelete',function(){
        let stockTotalCostVal = parseFloat(stockTotalCost.val());
        let deleteRowValueVal = +$(this).parents("tr").find(".netCost").val();
        stockTotalCostVal = stockTotalCostVal- deleteRowValueVal;
        $('#stockTotalCost , #stockNetTotal').val(stockTotalCostVal.toFixed(2)); //stock total net cost
        $(this).closest('tr').remove(); 
    });

    //when add discount auto change the value
    $('#stockTotalDiscount').keyup(()=>{
        let stockTotalDiscountVal = +(stockTotalDiscount.val());
        let stockTotalCostVal = parseFloat(stockTotalCost.val());
        let netTotal = stockTotalCostVal - (stockTotalCostVal * stockTotalDiscountVal)/100;
        $('#stockNetTotal').val(netTotal.toFixed(2));
    });


  const stockSupplierName = $('#stockSupplierName');
    const stockCreteDate = $('#stockCreteDate');
    const stockReferenceNumber = $('#stockReferenceNumber');
    $("#stockFormSubmit").click(()=>{
        let stockSupplierNameVal = stockSupplierName.val();
        let stockCreteDateVal = stockCreteDate.val();
        let stockReferenceNumberVal =stockReferenceNumber.val();

        if (stockSupplierNameVal=="" || stockCreteDateVal=="" || stockReferenceNumberVal=="" ) {
            toastr.error("Please fll ");
            $([stockSupplierName, stockCreteDate, stockReferenceNumber]).each(function() {
                $(this).removeClass("is-valid").addClass("is-invalid");
            })
            stockSupplierName.focus();
            return false;
        }
        if (stockSupplierNameVal == "") {
            addInvalidClass(stockSupplierName, "Add supplier name");
            return false;
        }
        if (stockCreteDateVal=="") {
            addInvalidClass(stockCreteDate, "Add date");
            return false;
        }
        if (stockReferenceNumberVal=="") {
            addInvalidClass(stockReferenceNumber, "add reference number");
            return false;
        }swal({
            title: 'Are you sure',
            text: 'Do you want to submit this form',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            allowEscapeKey: false,
            allowOutsideClick: false,
            closeOnClickOutside: false,
            closeOnEsc: false,
        }).then((willOUT)=>{
            if (willOUT) {
                $.ajax({
                    method: "POST",
                    url: "../controller/StockController.php?status=addStock",
                    data: new FormData($('#addStockForm')[0]),
                    dataType: "json",
                    enctype: "multipart/form-data",
                    processData: false,
                    contentType: false,
                    async: true,
                    beforeSend: function() {
                        swal({
                            title: "Loading...",
                            text: " ",
                            icon: "../../images/96x96.gif",
                            buttons: false,
                            allowOutsideClick: false,
                            closeOnEsc: false,
                            closeOnClickOutside: false,
                        });
                    },success: function(result) {
                        if (result[0]==1) {
                            swal({
                                title: "Good Job!",
                                text: "Stock Successfully Added",
                                icon: "success",
                                buttons: false,
                                timer: 1000,
                            });
                            stockTableBody(result[1]);
                            $("#addStockForm").trigger('reset');
                        }
                        if (result[0]==2) {
                            swal({
                                title: "Warning!",
                                text: result[1],
                                icon: "warning",
                            });
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }else{
                swal({
                    title: "Warning!",
                    text: "Stock Not Added",
                    icon: "warning",
                    timer: 1000,
                })
            }
        })
    });
    let addInvalidClass = (Id, message) => {
        let id = Id
        toastr.error(message);
        id.removeClass("is-valid").addClass("is-invalid").focus();
    }

    let removeInvalidClass = (Id) => {
        let id = Id
        id.removeClass("is-invalid").addClass("is-valid");
    }


    firstName.change(() => {removeInvalidClass(firstName)});
    lastName.change(() => {removeInvalidClass(lastName)});
    contact.change(() => {removeInvalidClass(contact)});
    birthday.change(() => {removeInvalidClass(birthday)});
    nic.change(() => {removeInvalidClass(nic)});
    email.change(() => {removeInvalidClass(email)});
    role.change(() => {removeInvalidClass(role)});
    add1.change(() => {removeInvalidClass(add1)});
    add2.change(() => {removeInvalidClass(add2)});
    add3.change(() => {removeInvalidClass(add3) });
    image.change(() => { removeInvalidClass(image)});

    editFirstName.change(() => {removeInvalidClass(editFirstName)});
    editLastName.change(() => {removeInvalidClass(editLastName)});
    editContact.change(() => {removeInvalidClass(editContact)});
    editBirthday.change(() => {removeInvalidClass(editBirthday)});
    editNic.change(() => {removeInvalidClass(editNic)});
    editEmail.change(() => {removeInvalidClass(editEmail)});
    editRole.change(() => {removeInvalidClass(editRole)});
    editAdd1.change(() => {removeInvalidClass(editAdd1)});
    editAdd2.change(() => {removeInvalidClass(editAdd2)});
    editAdd3.change(() => {removeInvalidClass(editAdd3)});

    supplierName.change(() => {removeInvalidClass(supplierName)});
    supplierContactName.change(() => {removeInvalidClass(supplierContactName)});
    supplierEmail.change(() => {removeInvalidClass(supplierEmail)});
    supplierContact.change(() => {removeInvalidClass(supplierContact)});
    supplierAdd1.change(() => {removeInvalidClass(supplierAdd1)});
    supplierAdd2.change(() => {removeInvalidClass(supplierAdd2)});
    supplierAdd3.change(() => {removeInvalidClass(supplierAdd3)});

    editSupplierName.change(() => {removeInvalidClass(editSupplierName)});
    editSupplierContactName.change(() => {removeInvalidClass(editSupplierContactName)});
    editSupplierEmail.change(() => {removeInvalidClass(editSupplierEmail)});
    editSupplierContact.change(() => {removeInvalidClass(editSupplierContact)});
    editSupplierAdd1.change(() => {removeInvalidClass(editSupplierAdd1)});
    editSupplierAdd2.change(() => {removeInvalidClass(editSupplierAdd2)});
    editSupplierAdd3.change(() => {removeInvalidClass(editSupplierAdd3)});

    customerFirstName.change(() => {removeInvalidClass(customerFirstName)});
    customerLastName.change(() => {removeInvalidClass(customerLastName)});
    customerContact.change(() => {removeInvalidClass(customerContact)});
    customerEmail.change(() => {removeInvalidClass(customerEmail)});
    customerBirthday.change(() => {removeInvalidClass(customerBirthday)});
    customerAdd1.change(() => {removeInvalidClass(customerAdd1)});
    customerAdd2.change(() => {removeInvalidClass(customerAdd2)});
    customerAdd3.change(() => {removeInvalidClass(customerAdd3)});
    customerPostalCode.change(() => {removeInvalidClass(customerPostalCode)});
    customerNic.change(() => {removeInvalidClass(customerNic)});

    editCustomerFirstName.change(() => {removeInvalidClass(editCustomerFirstName)});
    editCustomerLastName.change(() => {removeInvalidClass(editCustomerLastName)});
    editCustomerContact.change(() => {removeInvalidClass(editCustomerContact)});
    editCustomerEmail.change(() => {removeInvalidClass(editCustomerEmail)});
    editCustomerBirthday.change(() => {removeInvalidClass(editCustomerBirthday)});
    editCustomerAdd1.change(() => {removeInvalidClass(editCustomerAdd1)});
    editCustomerAdd2.change(() => {removeInvalidClass(editCustomerAdd2)});
    editCustomerAdd3.change(() => {removeInvalidClass(editCustomerAdd3)});
    editCustomerPostalCode.change(() => {removeInvalidClass(editCustomerPostalCode)});
    editCustomerNic.change(() => {removeInvalidClass(editCustomerNic)});

    tableName.change(() => {removeInvalidClass(tableName)});
    tableCapacity.change(() => {removeInvalidClass(tableCapacity)});

    editTableName.change(() => {removeInvalidClass(editTableName)});
    editTableCapacity.change(() => {removeInvalidClass(editTableCapacity)});

    foodItemName.change(() => {removeInvalidClass(foodItemName)});
    unitPrice.change(() => {removeInvalidClass(unitPrice)});
    foodItemCategory.change(() => {removeInvalidClass(foodItemCategory)});
    foodItemSubCategory.change(() => {removeInvalidClass(foodItemSubCategory)});
    foodItemImage.change(() => {removeInvalidClass(foodItemImage)});

    editFoodItemName.change(() => {removeInvalidClass(editFoodItemName)});
    editUnitPrice.change(() => {removeInvalidClass(editUnitPrice)});
    editFoodItemCategory.change(() => {removeInvalidClass(editFoodItemCategory)});
    editFoodItemSubCategory.change(() => {removeInvalidClass(editFoodItemSubCategory)});
    editFoodItemImage.change(() => {removeInvalidClass(editFoodItemImage)});

    categoryName.change(() => {removeInvalidClass(categoryName)});

    editCategoryName.change(() => {removeInvalidClass(editCategoryName)});

    subCategoryName.change(() => {removeInvalidClass(subCategoryName)});
    subCategoryCategoryItem.change(() => {removeInvalidClass(subCategoryCategoryItem)});

    editSubCategoryName.change(() => {removeInvalidClass(editSubCategoryName)});
    editSubCategoryCategoryItem.change(() => {removeInvalidClass(editSubCategoryCategoryItem)});

    rowItemName.change(() => {removeInvalidClass(rowItemName)});

    editRowItemName.change(() => {removeInvalidClass(editRowItemName)});

    stockRowItemName.change(()=>{removeInvalidClass(stockRowItemName)});
    stockMnfDate.change(()=>{removeInvalidClass(stockMnfDate)});
    stockExpDate.change(()=>{removeInvalidClass(stockExpDate)});
    stockReceivedQuantity.change(()=>{removeInvalidClass(stockReceivedQuantity)});
    stockCostPerUnit.change(()=>{removeInvalidClass(stockCostPerUnit)});

    

    // grnDate.change(()=>{removeInvalidClass(grnDate)});
    // grnPrice.change(()=>{removeInvalidClass(grnPrice)});
    // grnSupplierName.change(()=>{removeInvalidClass(grnSupplierName)});

    // editGrnDate.change(()=>{removeInvalidClass(editGrnDate)});
    // editGrnPrice.change(()=>{removeInvalidClass(editGrnPrice)});
    // editGrnSupplierName.change(()=>{removeInvalidClass(editGrnSupplierName)});

});


// let userTableBody = (result) =>{
//     let row = '';
//         for (let index = 0; index < result.length; index++) {
//             // console.log( result[index].user_id);
//             row += '<tr>' +
//                 '<th scope="row">' + result[index].user_id + '</th>' +
//                 '<td><img src="../../images/user-images/' + result[index].user_image + '" width="40" height="40"></td>' +
//                 '<td>' + result[index].user_fname + ' ' + result[index].user_lname + '</td>' +
//                 '<td>' + result[index].user_email + '</td>' +
//                 '<td>' + result[index].user_contact + '</td><td>';
//             if ((result[index].user_status) == 1) {
//                 row += '<button class="btn btn-outline-success rounded shadow" onclick="deactivateUser(\'' + btoa(result[index].user_id) + '\')">Active</button>';
//             } else {
//                 row += '<button class="btn btn-outline-danger rounded shadow" onclick="activateUser(\'' + btoa(result[index].user_id) + '\')">Deactivate</button>';
//             }
//             row += '</td>' +
//                 '<td>' +
//                 '<div class="d-inline-flex justify-content-start">' +
//                 '<button class="btn  btn-info" data-bs-toggle="modal" data-bs-target="#viewUser" onclick="viewUserDetails(\'' + btoa(result[index].user_id) + '\')"><i class="fal fa-eye"></i></button>&nbsp;&nbsp;&nbsp;' +
//                 '<button class="btn  btn-warning" data-bs-toggle="modal" data-bs-target="#editUser" onclick="editUserDetails(\'' + btoa(result[index].user_id) + '\')"><i class="fad fa-edit"></i></button>&nbsp;&nbsp;&nbsp;' +
//                 '</tr>';
//         }
//         // console.log(row)
//         $('#userTable').html(row).show()
// }