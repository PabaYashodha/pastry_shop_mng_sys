$(document).ready(()=>{
    

    const patName = /^[a-zA-Z\.\s]+$/; //validation rgx for text
    const patEmail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z]{2,6})+$/; //validation rgx for email
    const patCon = /^(07)([0-9]){8}$/; //validation rgx for contact
    const patNIC = /^([0-9]{9}[x|X|v|V]|[0-9]{12})+$/; //validation rgx for nic
    const allowImagePattern = /(\.jpg|\.jpeg|\.png)$/i; //image validation
    //const patPassword = /^([a-Z]+[0-9]{8}+$)/;

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
    const male = $("#male");
    const female = $("#female");

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
        let maleVal = male.val()
        let femaleVal = female.val()

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
        if (!allowImagePattern.exec(imageVal)) {
            addInvalidClass(image, "Please add an image with valid extensions");
            return false;
        }
        if (maleVal =="" || femaleVal=="") {
            addInvalidClass(male, female,"Please select your gender");
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
                            getUserData(result[1]);
                            $("#userForm").trigger('reset')
                            $(".is-valid").removeClass('is-valid');
                            $("#addUser").modal('hide');
                            $("#pre_image").removeAttr('src style');

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
    const editNic = $('#editNic');
    const editEmail = $('#editEmail');
    const editRole = $('#editRole');
    const editAdd1 = $('#editAdd1');
    const editAdd2 = $('#editAdd2');
    const editAdd3 = $('#editAdd3');
    const editMale = $('#editMale');
    const editFemale = $('#editFemale');
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
        let editMaleVal = editMale.val()
        let editFemaleVal = editFemale.val();

        if (editFirstNameVal == "" && editLastNameVal == "" && editContactVal == "" && editBirthdayVal == "" && editNicVal == "" && editEmailVal == "" && editRoleVal == "" && editAdd1Val == "" && editAdd2Val == "" && editAdd3Val == "" && editMaleVal==""|| editFemaleVal=="") {
            toastr.error("Please fill the form");
            $([editFirstName, editLastName, editContact, editBirthday, editNic, editEmail, editRole, editAdd1, editAdd2, editAdd3, editMale, editFemale]).each(function () {
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
        if (editMaleVal==""|| editFemaleVal=="") {
            add
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
                            getUserData(result[1]);
                            $("#userForm").trigger('reset');
                            $(".is-valid").removeClass('is-valid');
                            $("#addUser").modal('hide');
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
            }else{
                swal({
                    title: "Warning !",
                    text: 'User not added',
                    icon: "warning",
                    buttons: false,
                    timer: 1000,
                })
            }
        })
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
                            getSupplierData(result[1]);
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
                                text: "Customer Successfully Added",
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

    tableName.blur(() => {
        const url = "../controller/DiningTableController.php?status=checkTableIsExist";
        let tableNameVal = tableName.val();
        $.post(url, {
            tableName: tableNameVal
        }, (result) => {
            if (result == 1) {
                addInvalidClass(tableName, "Table is already exist");
                return false;
            }
        })
    })


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
    const foodItemCategoryName = $('#foodItemCategoryName');
    const foodItemSubCategoryName = $('#foodItemSubCategoryName');
    const foodItemImage = $('#foodItemImage');

    foodItemName.blur(()=>{
        const url = "../controller/FoodItemController.php?status=checkFoodItemIsExist";
        let foodItemNameVal = foodItemName.val();
        $.post(url, {
            foodItemName : foodItemNameVal
        },(result)=>{
            if (result == 1 ) {
                addInvalidClass(foodItemName, "Food Item name is already exist");
                return false;
            }
        })
    })

    $("#foodItemFormSubmit").click(() => {
        let foodItemNameVal = foodItemName.val()
        let unitPriceVal = unitPrice.val()
        let foodItemCategoryNameVal = foodItemCategoryName.val()
        let foodItemSubCategoryNameVal = foodItemSubCategoryName.val()
        let foodItemImageVal = foodItemImage.val()

        if (foodItemNameVal == "" && unitPriceVal == "" && foodItemCategoryNameVal == "" && foodItemSubCategoryNameVal == "" && foodItemImageVal == "") {
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
            addInvalidClass(unitPrice, "Food item is already exists");
            return false;
        }
        if (foodItemCategoryNameVal == "") {
            addInvalidClass(foodItemCategoryName, "Please enter category");
            return false;
        }
        if (foodItemSubCategoryNameVal == "") {
            addInvalidClass(foodItemSubCategoryName, "Please enter subcategory");
            return false;
        }
        if (foodItemImageVal == "") {
            addInvalidClass(foodItemImage, "Please add an image");
            return false;
        }
        if (!allowImagePattern.exec(foodItemImageVal)) {
            addInvalidClass(foodItemImage, "Please add an image with valid extensions");
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
                             $("#addFoodItem").modal('hide')
                             $('#food_pre_image').removeAttr('src style');       
                             $("#category_pre_image").removeAttr('src style');
                            $("#sub_category_pre_image").removeAttr('src style')                     
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

        if (editFoodItemNameVal == "" && editUnitPriceVal == "" && editFoodItemCategoryVal == "" && editFoodItemSubCategoryVal == "" ) {
            toastr.error("Please fill the form");
            $([editFoodItemName, editUnitPrice, editCategory, editCategory]).each(function () {
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
        // if (editFoodItemImageVal == "") {
        //     addInvalidClass(editFoodItemImage, "Please add image");
        //     return false;
        // }
        // if (!allowImagePattern.exec(editFoodItemImageVal)) {
        //     addInvalidClass(editFoodItemImage, "Please add an image with valid extensions");
        //     return false;
        // }
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
                    data: new FormData($('#editFoodItemForm')[0]),
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
                            $("#editFoodItemForm").trigger('reset');
                            $(".is-valid").removeClass('is-valid');
                            $('#editFoodItem').modal('hide');
                            $('#food_pre_image').removeAttr('src style');  
                            $("#category_pre_image").removeAttr('src style');
                            $('#sub_category_pre_image').removeAttr('src style')
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
    const categoryImage = $('#categoryImage');

    categoryName.blur(()=>{
        const url = "../controller/CategoryController.php?status=checkCategoryNameIsExist";
        let categoryNameVal = categoryName.val();
        $.post(url, {
            categoryName : categoryNameVal
        },(result)=>{
            if (result==1) {
                addInvalidClass(categoryName, "Category name is already exist");
                return false;
            }
        })
    })

    $("#categoryFormSubmit").click(() => {
        let categoryNameVal = categoryName.val()
        let categoryImageVal = categoryImage.val()

        if (categoryNameVal == "" && categoryImageVal == "") {
            toastr.error("Please fill the form");
            $([categoryName, categoryImage]).each(function () {
                $(this).removeClass("is-valid").addClass("is-invalid")
            });
            categoryName.focus();
            return false;
        }
        if (categoryNameVal == "") {
            addInvalidClass(categoryName, "Please enter category name");
            return false;
        }
        if (categoryImageVal == "") {
            addInvalidClass(categoryImage, "Please add a category image");
            return false;
        }
        if (!allowImagePattern.exec(categoryImageVal)) {
            addInvalidClass(categoryImage, "Please add an image with valid extensions");
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
                            $("#addCategory").modal('hide');
                            $('#food_pre_image').removeAttr('src style');       
                             $("#category_pre_image").removeAttr('src style')
                            $("#sub_category_pre_image").removeAttr('src style')  
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
    const editCategoryImage = $('#editCategoryImage');
    $("#editCategoryFormSubmit").click(() => {
        let editCategoryNameVal = editCategoryName.val();
        let editCategoryImageVal = editCategoryImage.val();

        if (editCategoryNameVal == "" && editCategoryImageVal=="") {
            toastr.error("Please fill the form");
            $([editCategoryName,editCategoryImage]).each(function () {
                $(this).removeClass("is-valid").addClass("is-invalid");
            })
            editCategoryName.focus();
            return false;
        }
        if (editCategoryImageVal == "") {
            addInvalidClass(editCategoryName, "Please enter category name");
            return false;
        }
        if (editCategoryImageVal=="") {
            addInvalidClass(editCategoryImage,"Please add an image");
            return false;
        }
        if (!allowImagePattern.exec(editCategoryImageVal)) {
            addInvalidClass(editCategoryImage, "Please add an image with valid extensions");
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
                            $('#editCategory').modal('hide');
                            $("#category_pre_image").removeAttr('src style')
                            $('#sub_category_pre_image').removeAttr('src style')
                           
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
    const subCategoryImage = $('#subCategoryImage');


    $("#subCategoryFormSubmit").click(() => {
        let subCategoryNameVal = subCategoryName.val();
        let subCategoryCategoryItemVal = subCategoryCategoryItem.val();
        let subCategoryImageVal = subCategoryImage.val();

        if (subCategoryNameVal == "" && subCategoryCategoryItemVal == "" && subCategoryImageVal=="") {
            toastr.error("Please fill the form");
            $([subCategoryName, subCategoryCategoryItem, subCategoryImage]).each(function () {
                $(this).removeClass("is-valid").addClass("is-invalid")
            })
            subCategoryName.focus();
            return false;
        }
        if (subCategoryNameVal == "") {
            addInvalidClass(subCategoryName, "Please enter sub category name");
            return false;
        }
        if (subCategoryCategoryItemVal == "") {
            addInvalidClass(subCategoryCategoryItem, "Please enter category name");
            return false;
        }
        if (subCategoryImageVal=="") {
            addInvalidClass(subCategoryImage,"Please add an image");
            return false;
        }
        if (!allowImagePattern.exec(subCategoryImageVal)) {
            addInvalidClass(subCategoryImage, "Please add an image with valid extensions");
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
                                text: " Sub Category name Successfully Added",
                                icon: "success",
                                buttons: false,
                                timer: 1000,
                            });
                            subCategoryTableBody(result[1]);
                            $("#subCategoryForm").trigger('reset');
                            $(".is-valid").removeClass('is-valid');
                            $('#addSubCategory').modal('hide');
                            $('#food_pre_image').removeAttr('src style');       
                            $("#category_pre_image").removeAttr('src style');
                            $("#sub_category_pre_image").removeAttr('src style');
                            
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
    const editSubCategoryImage = $('#editSubCategoryImage');
    $('#editSubCategoryFormSubmit').click(() => {
        let editSubCategoryNameVal = editSubCategoryName.val();
        let editSubCategoryCategoryItemVal = editSubCategoryCategoryItem.val();
        let editSubCategoryImageVal =editSubCategoryImage.val();

        if (editSubCategoryNameVal == "" && editSubCategoryCategoryItemVal == "" && editSubCategoryImageVal=="") {
            toastr.error("Please fill the form");
            $([editSubCategoryName, editSubCategoryCategoryItem, editSubCategoryImage]).each(function () {
                $(this).removeClass("is-valid").addClass("is-invalid")
            })
            editSubCategoryName.focus();
            return false;
        }
        if (editSubCategoryNameVal == "") {
            addInvalidClass(editSubCategoryName, "Please enter sub category name");
            return false;
        }
        if (editSubCategoryCategoryItemVal == "") {
            addInvalidClass(editSubCategoryCategoryItems, "Please enter category name");
            return false;
        }
        if (editSubCategoryImageVal=="") {
            addInvalidClass(editSubCategoryImage, "Please add an image");
            return false;
        }
        if (!allowImagePattern.exec(editSubCategoryImageVal)) {
            addInvalidClass(editSubCategoryImage, "Please add an image with valid extensions");
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
                            $('#editSubCategory').modal('hide');
                            $("#category_pre_image").removeAttr('src style');
                            $('#sub_category_pre_image').removeAttr('src style')
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
    const rowItemReorderLevel = $("#rowItemReorderLevel");
    $('#rowItemFormSubmit').click(() => {
        let rowItemNameVal = rowItemName.val();
        let rowItemReorderLevelVal = rowItemReorderLevel.val();

        if (rowItemNameVal == "" && rowItemReorderLevelVal=="") {
            toastr.error("Please fill the form");
            $([rowItemName,rowItemReorderLevel]).each(function () {
                $(this).removeClass("is-valid").addClass("is-invalid")
            })
            rowItemName.focus();
            return false;
        }
        if (rowItemNameVal == "") {
            addInvalidClass(rowItemName, "Please enter row item");
            return false;
        }
        if (rowItemReorderLevelVal == "") {
            addInvalidClass(rowItemReorderLevel, "Please enter row item reorder level");
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
                            getRowItemData(result[1]);
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
    const editRowItemReorderLevel = $('#editRowItemReorderLevel');
    $("#editRowItemFormSubmit").click(() => {
        let editRowItemNameVal = editRowItemName.val();
        let editRowItemReorderLevelVal = editRowItemReorderLevel.val();

        if (editRowItemNameVal == "" && editRowItemReorderLevelVal=="") {
            toastr.error("Please fill the form");
            $([editRowItemName,editRowItemReorderLevel]).each(function () {
                $(this).removeClass("is-valid").addClass("is-invalid");
            })
            editRowItemName.focus();
            return false;
        }
        if (editRowItemNameVal == "") {
            addInvalidClass(editRowItemName, "Please enter row item name");
            return false;
        }
        if (editRowItemReorderLevelVal == "") {
            addInvalidClass(editRowItemReorderLevel, "Please enter row item name");
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
                            getRowItemData(result[1]);
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
     const stockRowItemId = $('#stockRowItemId');
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
        let stockRowItemIdVal= stockRowItemId.val();
        let stockMnfDateVal = stockMnfDate.val();
        let stockExpDateVal = stockExpDate.val();
        let stockReceivedQuantityVal = stockReceivedQuantity.val();
        let stockCostPerUnitVal = stockCostPerUnit.val();
        let stockNetCostVal = parseFloat(stockNetCost.val());
        let stockDiscountVal = +stockDiscount.val();
        let stockTotalCostVal = parseFloat(stockTotalCost.val());
        let stockTotalDiscountVal = +(stockTotalDiscount.val());
               
        if (stockRowItemNameVal == "" || stockMnfDateVal == "" || stockExpDateVal == "" || stockReceivedQuantityVal == "" || stockCostPerUnitVal == "" || stockNetCostVal<0 || stockDiscountVal<0) {
            toastr.error("Please fll the fields");
            $([stockRowItemName, stockMnfDate, stockExpDate, stockReceivedQuantity, stockCostPerUnit, stockNetCost, stockDiscount]).each(function () {
                $(this).removeClass("is-valid").addClass("is-invalid")
            })
            stockRowItemName.focus();
            return false;
        }
        if (stockRowItemNameVal == "") {
            addInvalidClass(stockRowItemName,"Please enter row item name");
            return false;
        }
        if (stockMnfDateVal == "") {
            addInvalidClass(stockMnfDate, "Please enter manufacture date");
            return false;
        }
        if (stockExpDateVal == "") {
            addInvalidClass(stockExpDate, "Please enter expire date");
            return false;
        }
        if (stockReceivedQuantityVal=="") {
            addInvalidClass(stockReceivedQuantity, "Please enter received quantity");
            return false;
        }
        if (stockCostPerUnitVal=="") {
            addInvalidClass(stockCostPerUnit, "Please enter cost per unit");
            return false;
        } 
        if (stockDiscountVal<0) {
            addInvalidClass(stockDiscount, "Please enter discount");
            return false;
        }
        if (stockNetCostVal<0) {
            addInvalidClass(stockNetCost, "Please enter net cost");
            return false;
        }else {
            markup = '<tr>' +
                '<td scope="row"><button type="button" class="btn btn-outline-danger btnDelete ">&cross;</button></i></td>' +
                '<td>' +
                '<input list="stockRowItemNames" class="form-control" type="text"  readonly value="'+stockRowItemNameVal+'">' +
                '<input type="hidden" list="stockRowItemId" class="form-control"  name="stockTableRowItemId[]" readonly value="'+stockRowItemIdVal+'">' +
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
   
    //after add received quantity an cost per unit, insert discount and get value
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
        $('#stockDiscount').val(stockDiscountVal.toFixed(0)); //net cost value for one item //get the value for the html ield
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
    const stockSupplierId = $('#stockSupplierId');
    const stockCreteDate = $('#stockCreteDate');
    const stockReferenceNumber = $('#stockReferenceNumber');
    //const stockGrnNumber = $('#stockGrnNumber');
    $("#stockFormSubmit").click(()=>{
        let stockSupplierNameVal = stockSupplierName.val();
        let stockSupplierIdVal = stockSupplierId.val();
        let stockCreteDateVal = stockCreteDate.val();
        let stockReferenceNumberVal =stockReferenceNumber.val();
       
       
        if (stockSupplierNameVal=="" || stockCreteDateVal=="" || stockReferenceNumberVal=="" ) {
            toastr.error("Please fill ");
            $([stockSupplierName, stockCreteDate, stockReferenceNumber]).each(function() {
                $(this).removeClass("is-valid").addClass("is-invalid");
            })
            stockSupplierName.focus();
            return false;
        }
        if (stockSupplierNameVal== "" && stockSupplierIdVal== "") {
            addInvalidClass(stockSupplierName, "Entered supplier not exist");
            return false;
        }
        if (stockCreteDateVal=="") {
            addInvalidClass(stockCreteDate, "Please enter date");
            return false;
        }
        if (stockReferenceNumberVal=="") {
            addInvalidClass(stockReferenceNumber, "Please enter reference number");
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
                            viewStockData(result[1]);
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

    //make an order page
    const invoiceFoodItemId =$('#invoiceFoodItemId');
    const invoiceFoodItemName = $('#invoiceFoodItemName');
    const invoiceFoodItemUnitPrice =$('#invoiceFoodItemUnitPrice');
    const invoiceFoodItemQuantity = $('#invoiceFoodItemQuantity');
    const invoiceDiscount =$('#invoiceDiscount');
    const invoiceTotal = $('#invoiceTotal');
    const invoiceSubAmount = $('#invoiceSubAmount');
    const invoiceTotalDiscount = $('#invoiceTotalDiscount');
    const invoiceNetTotal = $('#invoiceNetTotal');
    const invoiceReceivedAmount = $('#invoiceReceivedAmount');
    const invoiceBalanceAmount = $('#invoiceBalanceAmount');

    $("#addItem").click(()=>{
        let invoiceFoodItemIdVal = invoiceFoodItemId.val();
        let invoiceFoodItemNameVal = invoiceFoodItemName.val();
        let invoiceFoodItemUnitPriceVal= invoiceFoodItemUnitPrice.val();
        let invoiceFoodItemQuantityVal = invoiceFoodItemQuantity.val();
        //let invoiceDiscountVal =+invoiceDiscount.val();
        let invoiceTotalVal =  parseFloat(invoiceTotal.val());
        let invoiceSubAmountVal = parseFloat(invoiceSubAmount.val()) ;
        let invoiceTotalDiscountVal = +invoiceTotalDiscount.val();
        // let invoiceNetTotalVal = parseFloat(invoiceNetTotal.val());
        // let invoiceReceivedAmountVal = parseFloat(invoiceReceivedAmount.val());
        // let invoiceBalanceAmountVal =parseFloat(invoiceBalanceAmount.val());

        if (invoiceFoodItemNameVal=="" || invoiceFoodItemUnitPriceVal==""|| invoiceFoodItemQuantityVal==""|| invoiceTotalVal=="") {
            toastr.error("Please fill the fields");
            $([invoiceFoodItemName,invoiceFoodItemUnitPrice,invoiceFoodItemQuantity,invoiceTotal]).each(function() {
               $(this).removeInvalidClass("is-valid").addClass("is-invalid")
            })
            invoiceFoodItemName.focus();
            return false;
        }
        if (invoiceFoodItemNameVal=="") {
            addInvalidClass(invoiceFoodItemName, "Please enter food item");
            return false;
        }
        if(invoiceFoodItemUnitPriceVal==""){
            addInvalidClass(invoiceFoodItemUnitPrice, "Please add unit price");
        }
        if (invoiceFoodItemQuantityVal=="") {
            addInvalidClass(invoiceFoodItemQuantity, "Please add quantity");
            return false;
        }
        // if (invoiceDiscountVal<0) {
        //     addInvalidClass(invoiceDiscount, "Please add discount if has");
        //     return false;
        // }
        if (invoiceTotalVal=="") {
            addInvalidClass(invoiceTotal, "Pleas enter total");
            return false;
        }else{
            markup = '<tr>'+
            '<td scope="row"><button type="button" class="btn btn-outline-danger btnDelete ">&cross;</button></i></td>'+
            '<td>'+
            '<input name="invoiceFoodItemId[]" type="hidden" class="form-control" readonly value="'+invoiceFoodItemIdVal+'">'+
            '<input name="invoiceFoodItemName[]" type="text" class="form-control" readonly value="'+invoiceFoodItemNameVal+'">'+
            '</td>'+
            '<td><input name="invoiceFoodItemUnitPrice[]" type="text" class="form-control" readonly value="'+invoiceFoodItemUnitPriceVal+'"></td>'+
            '<td><input name="invoiceFoodItemQuantity[]" type="text" class="form-control" readonly value="'+invoiceFoodItemQuantityVal+'"></td>'+
            //'<td><input name="invoiceDiscount[]" type="text" class="form-control" readonly value="'+invoiceDiscountVal+'"></td>'+
            '<td><input name="invoiceTotal[]" type="text" class="form-control total" readonly value="'+invoiceTotalVal+'"></td>'+
            '</tr>';
            tableBody=$("#manualOrderTbody");
            tableBody.append(markup);

            let newInvoiceTotal = invoiceTotalVal + invoiceSubAmountVal;
            $("#invoiceSubAmount").val(newInvoiceTotal.toFixed(2));
            if (invoiceTotalDiscountVal=="") {
                $('#invoiceSubAmount').val("");//empty the current value
                $('#invoiceSubAmount, #invoiceNetTotal').val(newInvoiceTotal.toFixed(2));
            }else{
                let invoiceNetTotal = newInvoiceTotal-(newInvoiceTotal*invoiceTotalDiscount)/100;
                $('#invoiceNetTotal').val(invoiceNetTotal.toFixed(2));
            }

            invoiceFoodItemName.val("");
            invoiceFoodItemUnitPrice.val("");
            invoiceFoodItemQuantity.val("");
            //invoiceDiscount.val("");
            invoiceTotal.val("");

            $([invoiceFoodItemName, invoiceFoodItemUnitPrice, invoiceFoodItemQuantity,invoiceTotal]).each(function() {
                $(this).removeClass("is-valid");
            });
        }
    });

    //get the total without discount
    $('#invoiceFoodItemQuantity,#invoiceFoodItemUnitPrice').keyup(()=>{
        let invoiceFoodItemQuantityVal = +invoiceFoodItemQuantity.val(); //declare quantity variable
        let invoiceFoodItemUnitPriceVal = parseFloat(invoiceFoodItemUnitPrice.val()); // declare unit price variable
       // let invoiceDiscountVal = +invoiceDiscount.val(); //declare one ite discount variable
        //let invoiceTotalWithoutDiscountVal = invoiceFoodItemQuantityVal * invoiceFoodItemUnitPriceVal; // get the total value without discount 
       // let invoiceTotalVal = invoiceTotalWithoutDiscountVal-(invoiceTotalWithoutDiscountVal*invoiceDiscountVal)/100; //calculate the value with discount
       let invoiceTotalVal= invoiceFoodItemQuantityVal * invoiceFoodItemUnitPriceVal;
        $('#invoiceTotal').val(invoiceTotalVal.toFixed(2));
    });
    
    //insert discount and find the total value
    $('#invoiceDiscount').keyup(()=>{
        let invoiceFoodItemQuantityVal = +invoiceFoodItemQuantity.val(); //declare quantity variable
        let invoiceFoodItemUnitPriceVal = parseFloat(invoiceFoodItemUnitPrice.val()); // declare unit price variable
        let invoiceDiscountVal = +invoiceDiscount.val(); //declare one ite discount variable
        let invoiceTotalWithoutDiscountVal = invoiceFoodItemQuantityVal * invoiceFoodItemUnitPriceVal; // get the total value without discount 
        let invoiceTotalVal = invoiceTotalWithoutDiscountVal-(invoiceTotalWithoutDiscountVal*invoiceDiscountVal)/100; //calculate the value with discount
        $('#invoiceTotal').val(invoiceTotalVal.toFixed(2));
    });


    //remove row in table
    $("#manualOrderTbody").on("click",'.btnDelete',function() {
        let invoiceSubAmountVal = parseFloat(invoiceSubAmount.val());
        let deleteInvoiceRowVal = +$(this).parents("tr").find(".total").val();
        invoiceSubAmountVal = invoiceSubAmountVal - deleteInvoiceRowVal;
        $('#invoiceSubAmount, #invoiceNetTotal').val(invoiceSubAmountVal.toFixed(2));
        $(this).closest('tr').remove();
    });

    //add discount to all the item or all 
    $('#invoiceTotalDiscount').keyup(()=>{
        let invoiceTotalDiscountVal= +(invoiceTotalDiscount.val());
        let invoiceSubAmountVal = parseFloat(invoiceSubAmount.val());
        let invoiceNetTotal = invoiceSubAmountVal-(invoiceSubAmountVal*invoiceTotalDiscountVal)/100;
        $('#invoiceNetTotal').val(invoiceNetTotal.toFixed(2));
    });

    //get the balance
    $('#invoiceReceivedAmount').keyup(()=>{
        let invoiceReceivedAmountVal = parseFloat(invoiceReceivedAmount.val());
        let invoiceNetTotalVal = parseFloat(invoiceNetTotal.val());
        let invoiceBalanceAmountVal = parseFloat(invoiceBalanceAmount.val());
        if (invoiceNetTotalVal<invoiceReceivedAmountVal) {
             invoiceBalanceAmountVal =invoiceReceivedAmountVal- invoiceNetTotalVal;
            $('#invoiceBalanceAmount').val(invoiceBalanceAmountVal.toFixed(2));
        }
    });

    //add discount after received money
    $('#invoiceReceivedAmount').keyup(()=>{
        let invoiceTotalDiscountVal= +(invoiceTotalDiscount.val());
        let invoiceSubAmountVal = parseFloat(invoiceSubAmount.val());
        let invoiceReceivedAmountVal = parseFloat(invoiceReceivedAmount.val());
        let invoiceNewNetTotalVal = invoiceSubAmountVal-(invoiceSubAmountVal*invoiceTotalDiscountVal)/100;
        let invoiceNewBalanceAmountVal = invoiceReceivedAmountVal- invoiceNewNetTotalVal;
        $('#invoiceBalanceAmount').val(invoiceNewBalanceAmountVal.toFixed(2));
    });
    
    $("#invoiceSubmit").click(()=>{
        swal({
            title:'Are you sure',
            text:'Do you wnt to make this order',
            icon:'warning',
            buttons:true,
            dangerMode:true,
            allowEscapeKey:false,
            allowOutsideClick:false,
            closeOnEsc:false,
            closeOnClickOutside:false,
        }).then((willOUT)=>{
            if (willOUT) {
                $.ajax({
                    method: "POST",
                    url:"../controller/OrderController.php?status=addInvoice",
                    data: new FormData($('#makeOrderForm')[0]),
                    dataType: "json",
                    enctype: "multipart/form-data",
                    processData: false,
                    contentType: false,
                    async: true,
                    beforeSend:function() {
                        swal({
                            title: "Loading...",
                            text: " ",
                            icon: "../../images/96x96.gif",
                            buttons: false,
                            allowOutsideClick: false,
                            closeOnEsc: false,
                            closeOnClickOutside: false,
                        });
                    },success:function(result) {
                        if (result[0]==1) {
                            swal({
                                title: "Good Job!",
                                text: "Order Successfully Placed",
                                icon: "success",
                                buttons: false,
                                timer: 1000,
                            })
                            $("#makeOrderForm").trigger('reset')
                            $("#manualOrderTbody").trigger('reset');
                        }
                        if (result[0]==2) {
                            swal({
                                title: "Warning!",
                                text: result[1],
                                icon: "warning",
                            })
                        }
                    },
                    error:function(error) {
                        console.log(error);
                    }                    
                });
            }else{
                swal({
                    title: "Warning!",
                    text: "Order not placed",
                    icon: "warning",
                    timer: 1000,
                })
            }
        })
    });

    //assign deliver person validation
    const deliveryPerson= $("#deliveryPerson");

    $("#assignPersonFormSubmit").click(()=>{
        let deliveryPersonVal = deliveryPerson.val();

        if (deliveryPersonVal=="") {
            addInvalidClass(deliveryPerson ,"Please enter a delivery person");
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
                    url: "../controller/DeliveryController.php?status=addDelivery",
                    data: new FormData($('#assignDeliveryForm')[0]),
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
                                text: "Delivery person successfully assigned",
                                icon: "success",
                                buttons: false,
                                timer: 1000,
                            });
                            readyToDeliveryTableBody()
                            orderAssignPerson()
                            $('#assignDeliveryPerson').modal('hide');
                            $("#assignDeliveryForm").trigger('reset');
                            
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
                    text: "Delivery not assigned",
                    icon: "warning",
                    timer: 1000,
                })
            }
        })

    })

    
    //admin user reset password
    const userResetName= $("#userResetName");
    const userResetId = $("#userResetId");
    $("#adminResetPassword").click(()=>{
        let userResetNameVal = userResetName.val();
        let userResetIdVal = userResetId.val();

        if (userResetNameVal=="") {
            addInvalidClass(userResetName, "Please enter user name");
            return false;
        }swal({
            title: 'Are you sure',
            text: 'Do you want to reset the password',
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
                    url: "../controller/PasswordResetController.php?status=adminResetPassword",
                    data: new FormData($('#adminPasswordResetForm')[0]),
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
                        console.log(result)
                        if (result==1) {
                            swal({
                                title: "Good Job!",
                                text: "Password successfully reset",
                                icon: "success",
                                buttons: false,
                                timer: 1000,
                            });
                            
                            $("#adminPasswordResetForm").trigger('reset');
                            $(".is-valid").removeClass('is-valid');
                            userResetId.val("");
                            
                        }
                        if (result==2) {
                            swal({
                                title: "Warning!",
                                text: result,
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
                    text: "Password not reset",
                    icon: "warning",
                    timer: 1000,
                })
            }
        })
    })

    const username = $("#username");
    const password = $("#password");
    $("#userLogin").click(() => {
        let usernameVal = username.val();
        let passwordVal = password.val();

        if (usernameVal == "" && passwordVal=="") {
            toastr.error("Please fill username and password")
            $([username, password]).each(function() {
                $(this).removeInvalidClass("is-valid").addClass("is-invalid");
            })
            username.focus();
            return false;
        }
        if(usernameVal=="" || !usernameVal.match(patEmail) ){
            addInvalidClass(username, "Please enter username");
            return false;
        }
        if (passwordVal=="") {
            addInvalidClass(password, "Please enter password");
            return false;
        }
        $.ajax({
            method : "POST",
            url: "../controller/LoginController.php?status=login",
            data: new FormData($('#loginForm')[0]),
            dataType: "json",
            enctype: "multipart/form-data",
            processData: false,
            contentType: false,
            async: true,
            success:function(result) {
                //console.log(result);
                if (result==1) {
                    toastr.success("User successfully login");
                    window.location.href="../view/passwordReset.php";
                }else if(result==2){
                    toastr.success("User successfully login");
                    window.location.href="../view/dashboard.php";
                }else{
                    toastr.error(result);
                }
            },error:function(error) {
                console.log(error);
            }
        })

    });

    const currentPassword = $("#currentPassword");
    const newPassword = $("#newPassword");
    const confirmPassword =$("#confirmPassword");

    $("#resetPassword").click(()=>{
        let currentPasswordVal = currentPassword.val();
        let newPasswordVal = newPassword.val();
        let confirmPasswordVal = confirmPassword.val();

        if (currentPasswordVal=="" && newPasswordVal=="" && confirmPasswordVal=="") {
            toastr.error("Please ill the form");
            $([currentPassword, newPassword, confirmPassword]).each(function() {
                $(this).removeInvalidClass("is-valid").addClass("is-invalid");
            })
            currentPassword.focus();
            return false;
        }
        if (currentPasswordVal=="") {
            addInvalidClass(currentPassword,"Please enter current password");
            return false;
        }
        if (newPasswordVal == "") {
            addInvalidClass(newPassword, "Please enter a new password");
            return false;
        }
        if (confirmPasswordVal=="" || confirmPasswordVal!=newPasswordVal ) {
            addInvalidClass(confirmPassword, "Confirm password not match");
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
                    url : "../controller/passwordResetController.php?status=resetPassword",
                    data: new FormData($('#passwordResetForm')[0]),
                    dataType: "json",
                    enctype: "multipart/form-data",
                    processData: false,
                    contentType: false,
                    async: true,
                    beforeSend:function() {
                        swal({
                            title: "Loading...",
                            text: " ",
                            icon: "../../images/96x96.gif",
                            buttons: false,
                            allowOutsideClick: false,
                            closeOnEsc: false,
                            closeOnClickOutside: false,
                        });
                    },success:function(result) {
                        //console.log(result);
                        if (result==1) {
                            swal({
                                title: "Good Job!",
                                text: "Password successfully reset",
                                icon: "success",
                                buttons: false,
                                timer: 1000,
                            });
                            window.location.href="../view/login.php";
                        }
                        if (result==2) {
                            swal({
                                title: "Warning!",
                                text: result,
                                icon: "warning",
                            });
                            window.location.href="../view/PasswordReset.php";
                        }
                    },error : function(error) {
                        console.log(error);
                    }
                });
            }else{
                swal({
                    title: "Warning!",
                    text: "Password not reset",
                    icon: "warning",
                    timer: 1000,
                })
                window.location.href="../view/PasswordReset.php";
            }
        })
    });

    // add release stock row
    const stockReleaseRowItemNames = $('#stockReleaseRowItemNames');
    const stockReleaseRowItemId = $('#stockReleaseRowItemId');
    const stockReleaseQuantity = $('#stockReleaseQuantity');

    $("#addReleaseStockRow").click(()=>{
        let stockReleaseRowItemNamesVal = stockReleaseRowItemNames.val();
        let stockReleaseRowItemIdVal = stockReleaseRowItemId.val();
        let stockReleaseQuantityVal = stockReleaseQuantity.val();

        if (stockReleaseRowItemNamesVal=="" && stockReleaseQuantityVal=="") {
            toastr.error("Please fill the fields");
            $([stockReleaseRowItemNames, stockReleaseQuantity]).each(function() {
                $(this).removeClass("is-valid").addClass("is-invalid")
            })
            stockReleaseRowItemNames.focus();
            return false;
        }
        if (stockReleaseRowItemNamesVal=="") {
            addInvalidClass(stockReleaseRowItemNames,"Please enter row item name");
            return false;
        }
        if (stockReleaseQuantityVal=="") {
            addInvalidClass(stockReleaseQuantity,"Please enter row item name");
            return false;
        }else{
            markup = '<tr>'+
            '<td scope="row"><button type="button" class="btn btn-outline-danger btnDelete ">&cross;</button></i></td>' +
            '<td>' +
            '<input list="stockReleaseRowItemNames" class="form-control" type="text"  readonly value="'+stockReleaseRowItemNamesVal+'">' +
            '<input type="hidden" list="stockReleaseRowItemIdVal" class="form-control"  name="stockReleaseRowItemId[]" readonly value="'+stockReleaseRowItemIdVal+'">' +
            '</td>' +
            '<td><input name="stockReleaseQuantity[]" type="text" class="form-control" readonly value="'+stockReleaseQuantityVal+'"></td>' +
            '</tr>';
            tableBody  = $("#stockReleaseTbody");
            tableBody.append(markup);

            stockReleaseRowItemNames.val("");
            stockReleaseQuantity.val("");

            $([stockReleaseRowItemNames,stockReleaseQuantity]).each(function() {
                $(this).removeClass("is-valid");
            })
        }
    })

    //delete the row
    $('#stockReleaseTbody').on("click",'.btnDelete',function() {
        $(this).closest('tr').remove();
    });

    const stockReleaseDate = $("#stockReleaseDate");
    const stockReleaseNo = $("#stockReleaseNo");
    const stockReleaseTo = $("#stockReleaseTo");
    const stockReleaseMadeBy = $("stockReleaseMadeBy");

    $("#stockReleaseFormSubmit").click(()=>{
        let stockReleaseDateVal = stockReleaseDate.val();
        let stockReleaseNoVal = stockReleaseNo.val();
        let stockReleaseToVal = stockReleaseTo.val();
        let stockReleaseMadeByVal = stockReleaseMadeBy.val();

        if (stockReleaseDateVal=="" && stockReleaseNoVal=="" && stockReleaseToVal==""&& stockReleaseMadeByVal=="") {
            toastr.error("Please fill the form");
            $([stockReleaseDate, stockReleaseNo, stockReleaseTo, stockReleaseMadeBy]).each(function() {
                $(this).removeClass("is-valid").addClass("is-invalid")
            })
            stockReleaseDate.focus();
            return false;
        }
        if (stockReleaseDateVal=="") {
            addInvalidClass(stockReleaseDate, "Please enter stock release date");
            return false;
        }
        if (stockReleaseToVal=="") {
            addInvalidClass(stockReleaseTo, "Please enter stock release to");
            return false;
        }
        if (stockReleaseMadeByVal=="") {
            addInvalidClass(stockReleaseMadeBy, "Please enter your role");
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
                    url: "../controller/StockReleaseController.php?status=addStockRelease",
                    data: new FormData($('#addStockReleaseForm')[0]),
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
                                text: "Stock successfully released",
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
                    }, error: function (error) {
                        console.log(error)
                    }
                });
            }else {
                swal({
                    title: "Warning!",
                    text: "Stock Release Not Added",
                    icon: "warning",
                    timer: 1000,
                })
            }
        })
    });

    //edit user profile
    const userFirstName = $("#userFirstName");
    const userLastName = $("#userLastName");
    const userContact = $("#userContact");
    const userBirthday = $("#userBirthday");
    const userNic = $("#userNic");
    const userEmail = $("#userEmail");
    const userAdd1 = $("#userAdd1");
    const userAdd2 = $("#userAdd2");
    const userAdd3 = $("#userAdd3");
   

    $("#userLoggedFormSubmit").click(()=>{
        let userFirstNameVal = userFirstName.val();
        let userLastNameVal = userLastName.val();
        let userContactVal = userContact.val();
        let userBirthdayVal = userBirthday.val();
        let userNicVal = userNic.val();
        let userEmailVal = userEmail.val();
        let userAdd1Val = userAdd1.val();
        let userAdd2Val = userAdd2.val();
        let userAdd3Val = userAdd3.val();
        
        if (userFirstNameVal == "" && userLastNameVal=="" && userContactVal=="" && userBirthdayVal=="" && userNicVal=="" && userEmailVal=="" && userAdd1Val=="" && userAdd2Val=="" && userAdd3Val) {
            toastr.error("Please fill the form");
            $([userFirstName, userLastName, userContact,userBirthday, userNic, userEmail, userAdd1, userAdd2, userAdd3]).each(function() {
                $(this).removeClass("is-valid").addClass("is-invalid");
            });
            userFirstName.focus();
            return false;
        }
        if (userFirstNameVal== "" || !userFirstNameVal.match(patName)) {
            addInvalidClass(userFirstName, "Please enter first name");
            return false;
        }
        if (userLastNameVal== "" || !userLastNameVal.match(patName)) {
            addInvalidClass(userLastName, "Please enter last name");
            return false;
        }
        if (userContactVal== "" || !userContactVal.match(patCon)) {
            addInvalidClass(userContact, "Please enter contact no");
            return false;
        }
        if (userBirthdayVal== "") {
            addInvalidClass(userBirthday, "Please enter first name");
            return false;
        }
        if (userNicVal == "" || !userNicVal.match(patNIC)) {
            addInvalidClass(userNic, "Please enter NIC");
            return false;
        }
        if (userEmailVal == "" || !userEmailVal.match(patEmail)) {
            addInvalidClass(userEmail, "Please enter email");
            return false;
        }
        if (userAdd1Val == "") {
            addInvalidClass(userAdd1, "Please enter address no");
            return false;
        }
        if (userAdd2Val == "") {
            addInvalidClass(userAdd2, "Please enter address no");
            return false;
        }
        if (userAdd3Val == "") {
            addInvalidClass(userAdd3, "Please enter address no");
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
        }).then((willOUT)=>{
            if (willOUT) {
                $.ajax({
                    method: "POST",
                    url: "../controller/LoggedUserController.php?status=editLoggedUser",
                    data: new FormData($('#myProfileForm')[0]),
                    dataType: "json",
                    enctype: "multipart/form-data",
                    processData: false,
                    contentType: false,
                    async: true,
                    cache: false,
                    beforeSend: function() {
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
                    },success: function(result) {
                        if (result[0]==1) {
                            swal({
                                title: "Good Job !",
                                text: "User Successfully Updated",
                                icon: "success",
                                buttons: false,
                                timer: 1000,
                            });
                            viewLoggedUser(result[1]);
                            $(".is-valid").removeClass('is-valid');
                            $("#editMyProfile").modal('hide');
                        }
                        if (result[0]==2) {
                            swal({
                                title: "Warning !",
                                text: result[1],
                                icon: "warning",
                            });
                        }
                    },error: function(error) {
                        console.log(error)
                    }
                });
            }else{
                swal({
                    title: "Warning !",
                    text: 'User not updated',
                    icon: "warning",
                    buttons: false,
                    timer: 1000,
                })
            }
        })
    });

    $(".report").click(function(){
        // let value = $(this).attr('id');
        $(this).find(".icon").toggleClass("fad fa-folder fad fa-folder-open");
        // $(value).toggleClass("d-none");
        $(this).siblings('ul').toggleClass("d-none");
        $(this).parent().siblings('ul').children('ul').addClass('d-none');
        $(this).parent().siblings('ul').children('a').find("i.icon").removeClass("fad fa-folder-open");
        $(this).parent().siblings('ul').children('a').find("i.icon").addClass("fad fa-folder");
    })
    
    

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
    foodItemCategoryName.change(() => {removeInvalidClass(foodItemCategoryName)});
    foodItemSubCategoryName.change(() => {removeInvalidClass(foodItemSubCategoryName)});
    foodItemImage.change(() => {removeInvalidClass(foodItemImage)});

    editFoodItemName.change(() => {removeInvalidClass(editFoodItemName)});
    editUnitPrice.change(() => {removeInvalidClass(editUnitPrice)});
    editFoodItemCategory.change(() => {removeInvalidClass(editFoodItemCategory)});
    editFoodItemSubCategory.change(() => {removeInvalidClass(editFoodItemSubCategory)});
    //editFoodItemImage.change(() => {removeInvalidClass(editFoodItemImage)});

    categoryName.change(() => {removeInvalidClass(categoryName)});
    categoryImage.change(() => {removeInvalidClass(categoryImage)});
    
    editCategoryName.change(() => {removeInvalidClass(editCategoryName)});
    editCategoryImage.change(()=>{removeInvalidClass(editCategoryImage)});

    subCategoryName.change(() => {removeInvalidClass(subCategoryName)});
    subCategoryCategoryItem.change(() => {removeInvalidClass(subCategoryCategoryItem)});
    subCategoryImage.change(()=>{removeInvalidClass(subCategoryImage)});

    editSubCategoryName.change(() => {removeInvalidClass(editSubCategoryName)});
    editSubCategoryCategoryItem.change(() => {removeInvalidClass(editSubCategoryCategoryItem)});
    editSubCategoryImage.change(()=>{removeInvalidClass(editSubCategoryImage)});

    rowItemName.change(() => {removeInvalidClass(rowItemName)});
    rowItemReorderLevel.change(()=>{removeInvalidClass(rowItemReorderLevel)});

    editRowItemName.change(() => {removeInvalidClass(editRowItemName)});
    editRowItemReorderLevel.change(()=>{removeInvalidClass(editRowItemReorderLevel)});

    stockRowItemName.change(()=>{removeInvalidClass(stockRowItemName)});
    stockMnfDate.change(()=>{removeInvalidClass(stockMnfDate)});
    stockExpDate.change(()=>{removeInvalidClass(stockExpDate)});
    stockReceivedQuantity.change(()=>{removeInvalidClass(stockReceivedQuantity)});
    stockCostPerUnit.change(()=>{removeInvalidClass(stockCostPerUnit)});

    stockSupplierName.change(()=>{removeInvalidClass(stockSupplierName)});
    stockCreteDate.change(()=>{removeInvalidClass(stockCreteDate)});
    stockReferenceNumber.change(()=>{removeInvalidClass(stockReferenceNumber)});

    invoiceFoodItemName.change(()=>removeInvalidClass(invoiceFoodItemName));
    invoiceFoodItemQuantity.change(()=>{removeInvalidClass(invoiceFoodItemQuantity)});
    //invoiceDiscount.change(()=>{removeInvalidClass(invoiceDiscount)});
    invoiceTotal.change(()=>{removeInvalidClass(invoiceTotal)});

    deliveryPerson.change(()=>{removeInvalidClass(deliveryPerson)});

    userResetName.change(()=>{removeInvalidClass(userResetName)});

    username.change(()=>{removeInvalidClass(username)});
    password.change(()=>{removeInvalidClass(password)});

    stockReleaseRowItemNames.change(()=>{removeInvalidClass(stockReleaseRowItemNames)});
    stockReleaseQuantity.change(()=>{removeInvalidClass(stockReleaseQuantity)});

    stockReleaseDate.change(()=>{removeInvalidClass(stockReleaseDate)});
    stockReleaseTo.change(()=>{removeInvalidClass(stockReleaseTo)});
    stockReleaseMadeBy.change(()=>{removeInvalidClass(stockReleaseMadeBy)});




   

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