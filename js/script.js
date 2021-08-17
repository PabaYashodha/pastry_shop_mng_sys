
$(document).ready(function () {
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    $('#dataTable').DataTable({
        dom: "<'row'<'col-sm-3'l><'col-sm-6'B><'col-sm-3'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        // dom:'Bfrtip',
        buttons: [{
                extend: 'copy',
                className: 'cusBut'
            },
            {
                extend: 'excel',
                className: 'cusBut'
            },
            {
                extend: 'print',
                className: 'cusBut'
            }
        ],
        bSort: false,
        pageLength: 10,
        pagingType: "full_numbers"
    });

    //     // setInterval(function () {
    $.get("../controller/UserController.php?status=getUserData", (result) => {
        userTableBody(result);      //call userTableBody function  
    }, 'json')
    //     // }, 30000)    

    $.get("../controller/SupplierController.php?status=getSupplierData", (result) => {
        supplierTableBody(result);
    }, 'json')

    $.get("../controller/DashboardController.php?status=getModule", (result) => {
        // console.log(result);
        let li = '';
        for (let index = 0; index < result.length; index++) {
            li += '<li class="list-group-item list-group-item-action"><a href="'+result[index].module_url+'" class="text-decoration-none text-white"><i class="'+result[index].module_logo+'"></i> &nbsp;'+ result[index].module_name +'</a></li>'  
        }
        $('#getModule').append(li);
    }, 'json')
});

let preview = (input) => {
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            $('#pre_image').attr('src', e.target.result).height(200).width(200);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

let userTableBody = (result) =>{
    let row = '';
        for (let index = 0; index < result.length; index++) {
            // console.log( result[index].user_id);
            row += '<tr>' +
                '<th scope="row">' + result[index].user_id + '</th>' +
                '<td><img src="../../images/user-images/' + result[index].user_image + '" width="40" height="40"></td>' +
                '<td>' + result[index].user_fname + ' ' + result[index].user_lname + '</td>' +
                '<td>' + result[index].user_email + '</td>' +
                '<td>' + result[index].user_contact + '</td><td>';
            if ((result[index].user_status) == 1) {
                row += '<button class="btn btn-outline-success rounded shadow" onclick="deactivateUser(\'' + btoa(result[index].user_id) + '\')">Active</button>';
            } else {
                row += '<button class="btn btn-outline-danger rounded shadow" onclick="activateUser(\'' + btoa(result[index].user_id) + '\')">Deactivate</button>';
            }
            row += '</td>' +
                '<td>' +
                '<div class="d-inline-flex justify-content-start">' +
                '<button class="btn  btn-info" data-bs-toggle="modal" data-bs-target="#viewUser" onclick="viewUserDetails(\'' + btoa(result[index].user_id) + '\')"><i class="fal fa-eye"></i></button>&nbsp;&nbsp;&nbsp;' +
                '<button class="btn  btn-warning" data-bs-toggle="modal" data-bs-target="#editUser" onclick="editUserDetails(\'' + btoa(result[index].user_id) + '\')"><i class="fad fa-edit"></i></button>&nbsp;&nbsp;&nbsp;' +
                '</tr>';
        }
        // console.log(row)
        $('#userTable').html(row).show()
}

// let viewUserDetails = (Id) =>{
//     $.post("../controller/UserController.php?status=viewUserDetails", {userId:Id}, (result) => {  
//         $('#viewUserContent').html(result).show();
//     })
// }

let viewUserDetails = (Id) => {
    $.post("../controller/UserController.php?status=viewUserDetails", {userId: Id}, (result) => {
        let row = '<div class="row">' +
            '<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">' +
            '<img src="../../images/user-images/' + result.user_image + '" alt="" width="350px" height="350px" class="m-auto">' +
            '</div>' +
            '<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">' +
            '<div class="row">' +
            '<label for="name" class="col-sm-12 col-form-label" style="padding-left: 8rem;"><h2>' + result.user_fname + ' ' + result.user_lname + '</h2></label>' +
            '<label for="createDate" class="col-sm-4 col-form-label text-end">Create Date  </label>' +
            '<label for="createDate" class="col-sm-8 col-form-label text-start mb-2"> : ' + result.user_create_date + '</label>' +
            '<label for="contact" class="col-sm-4 col-form-label text-end">Contact  </label>' +
            '<label for="contact" class="col-sm-8 col-form-label text-start mb-2"> : ' + result.user_contact + '</label>' +
            '<label for="email" class="col-sm-4 col-form-label text-end"> Email </label>' +
            '<label for="email" class="col-sm-8 col-form-label text-start mb-2"> : ' + result.user_email + '</label>' +
            '<label for="address" class="col-sm-4 col-form-label text-end"> Address </label>' +
            '<label for="address" class="col-sm-8 col-form-label text-start mb-2"> :  ' + result.user_add1 + ' ' + result.user_add2 + ' ' + result.user_add3 + '</label>' +
            '<label for="gender" class="col-sm-4 col-form-label text-end"> Gender </label>';
        if ((result.user_gender) == 1) {
            row += '<label for="gender" class="col-sm-8 col-form-label text-start mb-2"> : male</label>';
        } else {
            row += '<label for="gender" class="col-sm-8 col-form-label text-start mb-2"> : female</label>';
        }
        row += '<label for="birthday" class="col-sm-4 col-form-label text-end"> Birthday </label>' +
            '<label for="birthday" class="col-sm-8 col-form-label text-start mb-2"> : ' + result.user_dob + '</label>' +
            '<label for="nic" class="col-sm-4 col-form-label text-end"> NIC </label>' +
            '<label for="nic" class="col-sm-8 col-form-label text-start mb-2"> : ' + result.user_nic + '</label>' +
            '<label for="status" class="col-sm-4 col-form-label text-end"> Status </label>';
        if ((result.user_status) == 1) {
            row += '<label for="status" class="col-sm-8 col-form-label text-start mb-2"> : <span style="color:green">Active</span></label>';
        } else {
            row += '<label for="status" class="col-sm-8 col-form-label text-start mb-2"> : <span style="color:red">Deactivate</span></label>';
        }
        row += '</div>' +
            '</div>' +
            '</div>';
        $('#viewUserContent').html(row).show()
    }, 'json')
}

let editUserDetails = (Id) => {
    $.post("../controller/UserController.php?status=viewUserDetails", {userId: Id}, (result) => {
        //  console.log(result)
        $('#editUserId').val(btoa(result.user_id));
        $('#editFirstName').val(result.user_fname);
        $('#editLastName').val(result.user_lname); 
        $('#editContact').val(result.user_contact);
        $('#editBirthday').val(result.user_dob);
        $('#editGender').val(result.user_gender);
        $('#editNic').val(result.user_nic);
        $('#editEmail').val(result.user_email);
        $('#editRole').val(result.role_role_id);
        $('#editAdd1').val(result.user_add1);
        $('#editAdd2').val(result.user_add2);
        $('#editAdd3').val(result.user_add3);
        let url= "../../images/user-images/"+result.user_image;
        $('#pre_image').attr('src', url).height(200).width(200);
        // $('#editImage').val(result.user_image);
        
    }, 'json')
}

let deactivateUser = (Id) => {
    // alert('are you sure');
    swal({
        title: 'Are you sure',
        text: 'Do you want to change the status',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
        allowOutsideClick: false,
        closeOnEsc: false,
        closeOnClickOutside: false,
        closeOnEsc: false,
    }).then((willOUT) => {
        if (willOUT) {
            $.post('../controller/UserController.php?status=changeUserStatus', {userId: Id,userStatus: "0"}, (result) => {
                // console.log(result);
                if ([result[0]]==1) {
                    toastr.success("User status successfully changed");
                    userTableBody(result[1])
                    // let row = '';
                    // for(let index = 0; index<result[1].length; index++){
                    //    row += '<tr>'+
                    //        '<th scope="row">'+result[1][index].user_id+'</th>'+
                    //        '<td><img src="../../images/user-images/' +result[1][index].user_image+ '"width="40" height="40"></td>'+
                    //        '<td>'+result[1][index].user_fname+''+result[1][index].user_lname+'</td>'+
                    //        '<td>'+result[1][index].user_email+'</td>'+
                    //        '<td>'+result[1][index].user_contact+'</td><td>';
                    //        if ((result[1][index].user_status)==1) {
                    //            row += '<button class="btn btn-outline-success rounded shadow" onclick="deactivateUser(\'' + btoa(result[1][index].user_id) + '\')">Active</button>'
                    //        }else{
                    //         row += '<button class="btn btn-outline-danger rounded shadow" onclick="activateUser(\'' + btoa(result[1][index].user_id) + '\')">Deactivate</button>';
                    //        }
                    //        row += '</td>' +
                    //              '<td>' +
                    //              '<div class="d-inline-flex justify-content-start">' +
                    //              '<button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewUser" onclick="viewUserDetails(\'' + btoa(result[1][index].user_id) + '\')"><i class="fal fa-eye"></i></button>&nbsp;&nbsp;&nbsp;' +
                    //              '<button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editUser" onclick="editUserDetails(\'' + btoa(result[1][index].user_id) + '\')"><i class="fad fa-edit"></i></button>&nbsp;&nbsp;&nbsp;' +
                    //              '<button class="btn btn-danger "><i class="fal fa-trash-alt"></i></button></div></td>&nbsp;&nbsp;&nbsp;' +
                    //              '</tr>';
                    // }console.log(row)
                    // $('#userTable').html(row).show()
                }else{
                    toastr.success(result[1]);
                }
            },'json')
        }
    })
}

let activateUser = (Id) => {
    // alert('are you sure');
    swal({
        title: 'Are you sure',
        text: 'Do you want to change the status',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
        allowOutsideClick: false,
        closeOnEsc: false,
        closeOnClickOutside: false,
        closeOnEsc: false,
    }).then((willOUT) => {
        if (willOUT) {
            $.post('../controller/UserController.php?status=changeUserStatus', {userId: Id,userStatus: "1"}, (result) => {
                // console.log(result);
                if ([result[0]]==1) {
                    toastr.success("User status successfully changed");
                    userTableBody(result[1])
                }else{
                    toastr.success(result[1]);
                }
            },'json')
        }
    })
}

let supplierTableBody = (result) =>{
    let row = '';
    for (let index = 0; index < result.length; index++) {
        row += '<tr>' +
                '<th scope="row">' + result[index].supplier_id + '</th>' +
                '<td>' + result[index].supplier_name + '</td>' +
                '<td>' + result[index].supplier_contact_name + '</td>' +
                '<td>' + result[index].supplier_email + '</td>' +
                '<td>' + result[index].supplier_contact + '</td>'+
            // if ((result[index].supplier_status) == 1) {
            //     row += '<button class="btn btn-outline-success rounded shadow" onclick="deactivateSupplier(\'' + btoa(result[index].supplier_id) + '\')">Active</button>';
            // } else {
            //     row += '<button class="btn btn-outline-danger rounded shadow" onclick="activateSupplier(\'' + btoa(result[index].supplier_id) + '\')">Deactivate</button>';
            // }
                '<td>' +
                '<div class="d-inline-flex justify-content-start">' +
                '<button class="btn  btn-info" data-bs-toggle="modal" data-bs-target="#viewSupplier" onclick="viewSupplierDetails(\'' + btoa(result[index].supplier_id) + '\')"><i class="fal fa-eye"></i></button>&nbsp;&nbsp;&nbsp;' +
                '<button class="btn  btn-warning" data-bs-toggle="modal" data-bs-target="#editSupplier" onclick="editSupplierDetails(\'' + btoa(result[index].supplier_id) + '\')"><i class="fad fa-edit"></i></button>&nbsp;&nbsp;&nbsp;' +
                '</tr>';
        //console.log(row)
    }
    $('#supplierTable').html(row).show()
}

let viewSupplierDetails = (Id) => {
    $.post("../controller/SupplierController.php?status=viewSupplierDetails", {supplierId: Id}, (result) =>{
        let row = '<div class="row">'+
        '<label for="name" class="col-sm-12 col-form-label"><h2>' + result.supplier_name +'</h2></label>' +
        '<label for="contactName" class="col-sm-4 col-form-label text-end">Contact Name</label>' +
        '<label for="contactName" class="col-sm-8 col-form-label text-start mb-2"> : ' + result.supplier_contact_name + '</label>' +
        '<label for="email" class="col-sm-4 col-form-label text-end">Email</label>' +
        '<label for="email" class="col-sm-8 col-form-label text-start mb-2"> : ' + result.supplier_email + '</label>' +
        '<label for="contact" class="col-sm-4 col-form-label text-end">Contact</label>' +
        '<label for="contact" class="col-sm-8 col-form-label text-start mb-2"> : ' + result.supplier_contact + '</label>' +
        '<label for="address" class="col-sm-4 col-form-label text-end">Address</label>' +
        '<label for="address" class="col-sm-8 col-form-label text-start mb-2"> : ' + result.supplier_add1+ ' '+result.supplier_add2+ ' '+result.supplier_add3+ '</label>' +
        '<label for="status" class="col-sm-4 col-form-label text-end"> Status </label>';
        if ((result.supplier_status) == 1) {
            row += '<label for="status" class="col-sm-8 col-form-label text-start mb-2"> : <span style="color:green">Active</span></label>';
        } else {
            row += '<label for="status" class="col-sm-8 col-form-label text-start mb-2"> : <span style="color:red">Deactivate</span></label>';
        }
        row += '<label for="createDate" class="col-sm-4 col-form-label text-end">Create Date  </label>' +
        '<label for="createDate" class="col-sm-8 col-form-label text-start mb-2"> : ' + result.supplier_create_date + '</label>' +
            
        '</div>'
        $('#viewSupplierContent').html(row).show()
    }, 'json')
}

let editSupplierDetails = (Id) => {
    $.post("../controller/SupplierController.php?status=viewSupplierDetails", {supplierId: Id}, (result) =>{
        $('#editSupplierId').val(btoa(result.supplier_id));
        $('#editSupplierName').val(result.supplier_name);
        $('#editSupplierContactName').val(result.supplier_contact_name);
        $('#editSupplierEmail').val(result.supplier_email);
        $('#editSupplierContact').val(result.supplier_contact);
        $('#editSupplierAdd1').val(result.supplier_add1);
        $('#editSupplierAdd2').val(result.supplier_add2);
        $('#editSupplierAdd3').val(result.supplier_add3);
    }, 'json')
}



