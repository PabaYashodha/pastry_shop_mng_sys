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

    const supplierName = $('#supplierName');
    const supplierContactName = $('#supplierContactName');
    const supplierEmail = $('#supplierEmail');
    const supplierContact = $('#supplierContact');
    const supplierAdd1 = $('#supplierAdd1');
    const supplierAdd2 = $('#supplierAdd2');
    const supplierAdd3 = $('#supplierAdd3');
   
    const editSupplierName = $('#editSupplierName');
    const editSupplierContactName = $('#editSupplierContactName');
    const editSupplierEmail = $('#editSupplierEmail');
    const editSupplierContact = $('#editSupplierContact');
    const editSupplierAdd1 = $('#editSupplierAdd1');
    const editSupplierAdd2 = $('#editSupplierAdd2');
    const editSupplierAdd3 = $('#editSupplierAdd3');

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

    const foodItemName = $('#foodItemName');
    const unitPrice = $('#unitPrice');
    const categoryName =$('#categoryName');
    const subCategoryName = $('#subCategoryName');
    const foodItemImage = $('#foodItemImage');

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
            buttons : true,//cancel btn
            dangerMode : true,//ok btn red color
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
                                timer : 1000,
                            });
                            userTableBody(result[1]);
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
                    timer : 1000,
                });
            }
        })  
    });

    $("#saveEditForm").click(() => {//user edit form submit validation

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
            $([editFirstName, editLastName, editContact, editBirthday, editNic, editEmail, editRole, editAdd1, editAdd2, editAdd3]).each(function() {
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
        
        swal({//user edit form submit using ajax
            title : 'Are You Sure',
            text : 'Do you want to submit this form',
            icon : 'warning',
            buttons : true,//cancel btn
            dangerMode : true,//ok btn red color
            allowOutsideClick : false,
            allowEscapeKey : false,
            closeOnClickOutside : false,
            closeOnEsc : false,
        }).then((willOUT) => {
            if (willOUT) {
                $('#editUser').modal('hide');
                $.ajax({
                    method : "POST",
                    url : "../controller/UserController.php?status=editUser",
                    data : new FormData($('#editUserForm')[0]),
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
                                timer : 1000,
                            });
                            userTableBody(result[1]);
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
            }
        })  
    });

    $("#userLogin").click(() => {
        let userName = $("#userName").val();
        let password = $("#password").val();
    });

    $("#supplierFormSubmit").click(() => {//supplier form submit
       
        let supplierNameVal = supplierName.val()
        let supplierContactNameVal = supplierContactName.val()
        let supplierEmailVal = supplierEmail.val()
        let supplierContactVal = supplierContact.val()
        let supplierAdd1Val = supplierAdd1.val()
        let supplierAdd2Val = supplierAdd2.val()
        let supplierAdd3Val = supplierAdd3.val()

        if (supplierNameVal  == "" && supplierContactNameVal == "" &&  supplierEmailVal == "" && supplierContactVal == "" && supplierAdd1Val == "" && supplierAdd2Val == "" && supplierAdd3Val == "") {
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
            title : 'Are you sure',
            text : 'Do you want to submit ti form',
            icon : 'warning',
            buttons : true,
            dangerMode : true,
            allowEscapeKey : false,
            allowOutsideClick : false,
            closeOnClickOutside : false,
            closeOnEsc : false,
        }).then((willOUT) => {
            if (willOUT) {
                $("#addSupplier").modal('hide')
                $.ajax({
                    method : "POST",
                    url : "../controller/SupplierController.php?status=addSupplier",
                    data : new FormData($('#supplierForm')[0]),
                    dataType : "json",
                    enctype : "multipart/form-data",
                    processData : false,
                    contentType : false,
                    async : true,
                    cache : false,
                    beforeSend : function() {
                        swal({
                            title : "Loading...",
                            text : " ",
                            icon :"../../images/96x96.gif",
                            buttons : false,
                            allowOutsideClick : false,
                            closeOnEsc : false,
                            closeOnClickOutside : false,
                        });
                    },
                    success : function(result){
                        if (result[0] == 1) {
                            swal({
                                title : "Good Job !",
                                text : "Supplier Successfully Added",
                                icon : "success",
                                buttons : false,
                                timer : 1000,
                            });
                            supplierTableBody(result[1]);
                            $("#supplierForm").trigger('reset');
                            $(".is-valid").removeClass('is-valid');
                        }
                        if (result[0] == 2) {
                            swal({
                                title : "Warning !",
                                text : result[1],
                                icon : "warning",
                            });
                        }
                    },
                    error : function(error) {
                        console.log(error)
                    }
                });
            }else{
                swal({
                    title : "Warning!",
                    text : "Supplier Not Added",
                    icon : "warning",
                    timer : 1000,
                });
            }
        })
    });

    $("#saveEditSupplierForm").click(() => { //supplier edit form submit
       
        let editSupplierNameVal = editSupplierName.val()
        let editSupplierContactNameVal = editSupplierContactName.val()
        let editSupplierEmailVal = editSupplierEmail.val()
        let editSupplierContactVal = editSupplierContact.val()
        let editSupplierAdd1Val = editSupplierAdd1.val()
        let editSupplierAdd2Val = editSupplierAdd2.val()
        let editSupplierAdd3Val = editSupplierAdd3.val()
        
        if (editSupplierNameVal  == "" && editSupplierContactNameVal == "" &&  editSupplierEmailVal == "" && editSupplierContactVal == "" && editSupplierAdd1Val == "" && editSupplierAdd2Val == "" && editSupplierAdd3Val == "") {
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
            addInvalidClass(add1, "Please enter address no");
            return false;
        }
        if (editSupplierAdd2Val == "") {
            addInvalidClass(add2, "Please enter lane");
            return false;
        }
        if (editSupplierAdd3Val == "") {
            addInvalidClass(add3, "Please enter address street");
            return false;
        }
        swal({
            title : 'Are you sure',
            text : 'Do you want to submit this form',
            icon : 'warning',
            buttons : true,
            dangerMode : true,
            allowEscapeKey : false,
            allowOutsideClick : false,
            closeOnClickOutside : false,
            closeOnEsc : false,
        }).then((willOUT) => {
            if (willOUT) {
                $("#editSupplier").modal('hide')
                $.ajax({
                    method : "POST",
                    url : "../controller/SupplierController.php?status=editSupplier",
                    data : new FormData($('#editSupplierForm')[0]),
                    dataType : "json",
                    enctype : "multipart/form-data",
                    processData : false,
                    contentType : false,
                    async : true,
                    cache : false,
                    beforeSend : function() {
                        swal({
                            title : "Loading...",
                            text : " ",
                            icon :"../../images/96x96.gif",
                            buttons : false,
                            allowOutsideClick : false,
                            closeOnEsc : false,
                            closeOnClickOutside : false,
                        });
                    },
                    success : function(result){
                        if (result[0] == 1) {
                            swal({
                                title : "Good Job !",
                                text : "Supplier Successfully Added",
                                icon : "success",
                                buttons : false,
                                timer : 1000,
                            });
                            supplierTableBody(result[1]);
                        }
                        if (result[0] == 2) {
                            swal({
                                title : "Warning !",
                                text : result[1],
                                icon : "warning",
                            });
                        }
                    },
                    error : function(error) {
                        console.log(error)
                    }
                });
            }else{
                swal({
                    title : "Warning!",
                    text : "Supplier Not Added",
                    icon : "warning",
                    timer : 1000,
                });
            }
        })
    });

    $("#customerFormSubmit").click(() => {//customer form submit validation

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

        if (customerFirstNameVal == "" && customerLastNameVal == "" && customerContactVal == "" && customerEmailVal == "" && customerBirthdayVal == "" &&  customerAdd1Val == "" && customerAdd2Val == "" && customerAdd3Val == "" && customerPostalCodeVal == "" &&  customerNicVal == "") {
            toastr.error("Please fill the form");
            $([customerFirstName, customerLastName, customerContact,  customerEmail, customerBirthday,  customerAdd1, customerAdd2, customerAdd3, customerPostalCode, customerNic]).each(function() {
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
            title : 'Are You Sure',
            text : 'Do you want to submit this form',
            icon : 'warning',
            buttons : true,//cancel btn
            dangerMode : true,//ok btn red color
            allowOutsideClick : false,
            allowEscapeKey : false,
            closeOnClickOutside : false,
            closeOnEsc : false,
        }).then((willOUT) => {
            if (willOUT) {
                $.ajax({
                    method : "POST",
                    url : "../controller/CustomerController.php?status=addCustomer",
                    data : new FormData($('#customerForm')[0]),
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
                                timer : 1000,
                            });
                            userTableBody(result[1]);
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
                    timer : 1000,
                });
            }
        })  
    });

    $("#saveEditCustomerForm").click(() => {//customer form submit validation

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

        if (editCustomerFirstNameVal == "" && editCustomerLastNameVal == "" && editCustomerContactVal == "" && editCustomerEmailVal == "" && editCustomerBirthdayVal == "" &&  editCustomerAdd1Val == "" && editCustomerAdd2Val == "" && editCustomerAdd3Val == "" && editCustomerPostalCodeVal == "" &&  editCustomerNicVal == "") {
            toastr.error("Please fill the form");
            $([editCustomerFirstName, editCustomerLastName, editCustomerContact,  editCustomerEmail, editCustomerBirthday,  editCustomerAdd1, editCustomerAdd2, editCustomerAdd3, editCustomerPostalCode, editCustomerNic]).each(function() {
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
            title : 'Are You Sure',
            text : 'Do you want to submit this form',
            icon : 'warning',
            buttons : true,//cancel btn
            dangerMode : true,//ok btn red color
            allowOutsideClick : false,
            allowEscapeKey : false,
            closeOnClickOutside : false,
            closeOnEsc : false,
        }).then((willOUT) => {
            if (willOUT) {
                $("#editCustomer").modal('hide')
                $.ajax({
                    method : "POST",
                    url : "../controller/CustomerController.php?status=editCustomer",
                    data : new FormData($('#editCustomerForm')[0]),
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
                                timer : 1000,
                            });
                           customerTableBody(result[1]);
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
                    timer : 1000,
                });
            }
        })  
    });
    
    $("#addItemSubmit").click(() => {
        let foodItemNameVal = foodItemName.val()
        let unitPriceVal = unitPrice.val()
        let categoryNameVal =categoryName.val()
        let subCategoryNameVal = subCategoryName.val()
        let foodItemImageVal = foodItemImage.val()

        if (foodItemNameVal=="" && unitPriceVal == "" && categoryNameVal == "" && subCategoryNameVal=="" && foodItemImageVal =="") {
            toastr.error("Please fill the form");
            $([foodItemName, unitPrice, categoryName, subCategoryName, foodItemImage]).each(function() {
                $(this).removeClass("is-valid").addClass("is-invalid")
            });
            foodItemName.focus();
            return false;
        }
        if (foodItemNameVal == "") {
            addInvalidClass(foodItemName, "Please fill the item name");
            return false;
        }
        if (unitPriceVal == "") {
            addInvalidClass(unitPrice, "Please add price");
            return false;
        }
        if (categoryNameVal == "") {
            addInvalidClass(categoryName, "Please add price");
            return false;
        }
        if (subCategoryNameVal == "") {
            addInvalidClass(subCategoryName, "Please add price");
            return false;
        }
        if (foodItemImageVal == "") {
            addInvalidClass(foodItemImage, "Please add price");
            return false;
        }
        swal({
            title : 'Are You Sure',
            text : 'Do you want to submit this form',
            icon : 'warning',
            buttons : true,
            dangerMode : true,
            allowEscapeKey : false,
            allowOutsideClick : false,
            closeOnClickOutside : false,
            closeOnEsc : false,
        }).then((willOUT) =>{
            if(willOUT) {
                $.ajax({
                    method : "POST",
                    url : "../controller/FoodItemController.php?status=addFoodItem",
                    data : new FormData($('#FoodItemForm')[0]),
                    dataType : "json",
                    enctype : "multipart/form-data",
                    processData : false,
                    contentType : false,
                    async :true,
                    cache : false,
                    beforeSend : function() {
                       swal({
                           title : "Loading..",
                           text : " ",
                           icon : "../../images/96x96.gif",
                           buttons :false,
                           allowOutsideClick : false,
                           allowEscapeKey : false,
                           closeOnClickOutside : false,
                           closeOnEsc : false,
                       });
                    },
                    success : function(result) {
                        if (result[0] ==1) {
                            swal({
                                title : "Good Job !",
                                text : "User Successfully Added",
                                icon : "success",
                                buttons :false,
                                timer : 1000,
                            });
                            // userTableBody(result[1]);
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
                    timer : 1000,
                });
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

    editFirstName.change(() => { removeInvalidClass(editFirstName) });
    editLastName.change(() => { removeInvalidClass(editLastName) });
    editContact.change(() => { removeInvalidClass(editContact) });
    editBirthday.change(() => { removeInvalidClass(editBirthday) });
    editNic.change(() => { removeInvalidClass(editNic) });
    editEmail.change(() => { removeInvalidClass(editEmail) });
    editRole.change(() => { removeInvalidClass(editRole) });
    editAdd1.change(() => { removeInvalidClass(editAdd1) });
    editAdd2.change(() => { removeInvalidClass(editAdd2) });
    editAdd3.change(() => { removeInvalidClass(editAdd3) });
    
    supplierName.change(() => {removeInvalidClass(supplierName)});
    supplierContactName.change(() => {removeInvalidClass(supplierContactName)});
    supplierEmail.change(() => {removeInvalidClass(supplierEmail)});
    supplierContact.change(() => {removeInvalidClass(supplierContact)});
    supplierAdd1.change(() => {removeInvalidClass(supplierAdd1)});
    supplierAdd2.change(() => {removeInvalidClass(supplierAdd2)});
    supplierAdd3.change(() => {removeInvalidClass(supplierAdd3)});

    editSupplierName.change(() => {removeInvalidClass( editSupplierName)});
    editSupplierContactName.change(() => {removeInvalidClass( editSupplierContactName)});
    editSupplierEmail.change(() => {removeInvalidClass( editSupplierEmail)});
    editSupplierContact.change(() => {removeInvalidClass( editSupplierContact)});
    editSupplierAdd1.change(() => {removeInvalidClass( editSupplierAdd1)});
    editSupplierAdd2.change(() => {removeInvalidClass( editSupplierAdd2)});
    editSupplierAdd3.change(() => {removeInvalidClass( editSupplierAdd3)});

    customerFirstName.change(()=> {removeInvalidClass(customerFirstName)});
    customerLastName.change(()=> {removeInvalidClass(customerLastName)});
    customerContact.change(()=> {removeInvalidClass(customerContact)});
    customerEmail.change(()=> {removeInvalidClass(customerEmail)});
    customerBirthday.change(()=> {removeInvalidClass(customerBirthday)});
    customerAdd1.change(()=> {removeInvalidClass(customerAdd1)});
    customerAdd2.change(()=> {removeInvalidClass(customerAdd2)});
    customerAdd3.change(()=> {removeInvalidClass(customerAdd3)});
    customerPostalCode.change(()=> {removeInvalidClass(customerPostalCode)});
    customerNic.change(()=> {removeInvalidClass(customerNic)});

    editCustomerFirstName.change(()=> {removeInvalidClass(editCustomerFirstName)});
    editCustomerLastName.change(()=> {removeInvalidClass(editCustomerLastName)});
    editCustomerContact.change(()=> {removeInvalidClass(editCustomerContact)});
    editCustomerEmail.change(()=> {removeInvalidClass(editCustomerEmail)});
    editCustomerBirthday.change(()=> {removeInvalidClass(editCustomerBirthday)});
    editCustomerAdd1.change(()=> {removeInvalidClass(editCustomerAdd1)});
    editCustomerAdd2.change(()=> {removeInvalidClass(editCustomerAdd2)});
    editCustomerAdd3.change(()=> {removeInvalidClass(editCustomerAdd3)});
    editCustomerPostalCode.change(()=> {removeInvalidClass(editCustomerPostalCode)});
    editCustomerNic.change(()=> {removeInvalidClass(editCustomerNic)});

    foodItemName.change(()=> {removeInvalidClass(foodItemName)});
    unitPrice.change(()=> {removeInvalidClass(unitPrice)});
    categoryName.change(()=> {removeInvalidClass(categoryName)});
    subCategoryName.change(()=> {removeInvalidClass(subCategoryName)});
    foodItemImage.change(()=> {removeInvalidClass(foodItemImage)});
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
