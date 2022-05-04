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
        buttons: ['copy', 'excel', 'print', 'pdf', 'csv'],
        bSort: false,
        pageLength: 10,
        pagingType: "full_numbers"
    });

    $('.tableCat').DataTable({
        dom: "<'row'<'col-sm-3'l><'col-sm-6'B><'col-sm-3'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        // dom:'Bfrtip',
        buttons: ['copy', 'excel', 'print', 'pdf', 'csv'],
        bSort: false,
        pageLength: 10,
        pagingType: "full_numbers"
    });


    $('#navBTN').click(function () {
        $(this).children().toggleClass("far fa-bars far fa-times")
        $('#brandName, .moduleName').toggleClass("show d-none")
        $('#sidebar').toggleClass("sidebar-expanded sidebar-collapsed")
        $('.nav-link').toggleClass('d-box')
        $('#content').toggleClass("content-expanded content-collapsed")
    })

    $('.sideBTN').click(function () {
        $('.sidebarActive').removeClass('sidebarActive')
        $('.nav-link').removeClass('text-dark').addClass('text-light')
        $(this).addClass('sidebarActive').children().removeClass('text-light').addClass('text-dark')
    })

  $("#stockSupplierName").autocomplete({
      source: function(request, response) {
          $.ajax({
              url: "../controller/SupplierController.php?status=getSupplierBySupplierName",
              dataType: "json",
              data:{
                supplier : request.term
              },
              success: function(data) {
                //   console.log(data)
                  response($.map(data, function(supplier){
                      return{
                          id: supplier.id,
                          value: supplier.value,
                      }
                  }))
              }
          });
      },
      minLength:2,
      select: function (event, ui) {
          console.log(ui)
        $("#stockSupplierId").val(ui.item.id)
         $("#stockSupplierName").val(ui.item.value)
    },
    // close: function () {
    //     / $("#stockSupplierName").val("");
    // }
  })

  $("#stockRowItemName").autocomplete({
    source: function(request, response) {
        $.ajax({
            url: "../controller/RowItemController.php?status=getRowItemByRowItemName",
            dataType: "json",
            data:{
              rowItem : request.term
            },
            success: function(data) {
              //   console.log(data)
                response($.map(data, function(rowItem){
                    return{
                        id: rowItem.id,
                        value: rowItem.value,
                    }
                }))
            }
        });
    },
    minLength:2,
    select: function (event, ui) {
        console.log(ui)
      $("#stockRowItemId").val(ui.item.id)
       $("#stockRowItemName").val(ui.item.value)
  },
})

// $("#foodItemCategory").autocomplete({
//     source: function(request, response) {
//         $.ajax({
//             url: "../controller/RowItemController.php?status=getCategoryName",
//             dataType: "json",
//             data:{
//               category : request.term
//             },
//             success: function(data) {
//               //   console.log(data)
//                 response($.map(data, function(category){
//                     return{
//                         id: category.id,
//                         value: category.value,
//                     }
//                 }))
//             }
//         });
//     },
//     minLength:2,
//     select: function (event, ui) {
//         console.log(ui)
//       $("#stockRowItemId").val(ui.item.id)
//        $("#stockRowItemName").val(ui.item.value)
//   },
// })

});

//dashboard
$.get("../controller/DashboardController.php?status=getModule", (result) => {
    // console.log(result);
    let li = '';
    let path = window.location.pathname;
    let page = path.split("/").pop();
    for (let index = 0; index < result.length; index++) {
        li += '<li class="sideBTN p-0 "><a href="'+result[index].module_url+'" class="nav-link text-light flex-column';
        if (result[index].module_url == page) {
            li += ' active';
        }
        li += '" style="padding:0.73rem; padding-left:1.7rem;" ><i class="'+result[index].module_logo+'"></i><span class="moduleName"> &nbsp;'+ result[index].module_name +'</span></a></li>';  
    }
    $('#getModule').html(li).show();
}, 'json')

// var path = window.location.pathname;
// var page = path.split("/").pop();
// console.log( page );

let preview = (input) => {
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            $('#pre_image').attr('src', e.target.result).height(200).width(200);
            $('#food_pre_image').attr('src', e.target.result).height(150).width(150);
            $('#edit_food_pre_image').attr('src', e.target.result).height(150).width(150);
            $('#category_pre_image').attr('src', e.target.result).height(150).width(150);
            $('#edit_category_pre_image').attr('src', e.target.result).height(150).width(150);
            $('#sub_category_pre_image').attr('src', e.target.result).height(150).width(150);
            $('#edit_sub_category_pre_image').attr('src', e.target.result).height(150).width(150);
            // console.log(e);
        };
        reader.readAsDataURL(input.files[0]);
    }
}


//user
let getUserData = () =>{
    $.get("../controller/UserController.php?status=getUserData", (result) => {
        // userTableBody(result);      //call userTableBody function  
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
                '</td>' +
                '</tr>';
        }
        // console.log(row)
        $('#userTable').html(row).show()
    }, 'json')
}
// let viewUserDetails = (Id) =>{
//     $.post("../controller/UserController.php?status=viewUserDetails", {userId:Id}, (result) => {  
//         $('#viewUserContent').html(result).show();
//     })
// }

let viewUserDetails = (Id) => {
    $.post("../controller/UserController.php?status=viewUserDetails", {
        userId: Id
    }, (result) => {
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
    $.post("../controller/UserController.php?status=viewUserDetails", {
        userId: Id
    }, (result) => {
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
        let url = "../../images/user-images/" + result.user_image;
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
            $.post('../controller/UserController.php?status=changeUserStatus', {
                userId: Id,
                userStatus: "0"
            }, (result) => {
                // console.log(result);
                if ([result[0]] == 1) {
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
                } else {
                    toastr.success(result[1]);
                }
            }, 'json')
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
            $.post('../controller/UserController.php?status=changeUserStatus', {
                userId: Id,
                userStatus: "1"
            }, (result) => {
                // console.log(result);
                if ([result[0]] == 1) {
                    toastr.success("User status successfully changed");
                    userTableBody(result[1])
                } else {
                    toastr.success(result[1]);
                }
            }, 'json')
        }
    })
}

//supplier 
let getSupplierData = () =>{
    $.get("../controller/SupplierController.php?status=getSupplierData", (result) => {
        let row = '';
    for (let index = 0; index < result.length; index++) {
        row += '<tr>' +
            '<th scope="row">' + result[index].supplier_id + '</th>' +
            '<td>' + result[index].supplier_name + '</td>' +
            '<td>' + result[index].supplier_contact_name + '</td>' +
            '<td>' + result[index].supplier_email + '</td>' +
            '<td>' + result[index].supplier_contact + '</td>' +
            // if ((result[index].supplier_status) == 1) {
            //     row += '<button class="btn btn-outline-success rounded shadow" onclick="deactivateSupplier(\'' + btoa(result[index].supplier_id) + '\')">Active</button>';
            // } else {
            //     row += '<button class="btn btn-outline-danger rounded shadow" onclick="activateSupplier(\'' + btoa(result[index].supplier_id) + '\')">Deactivate</button>';
            // }
            '<td>' +
            '<div class="d-inline-flex justify-content-start">' +
            '<button class="btn  btn-info" data-bs-toggle="modal" data-bs-target="#viewSupplier" onclick="viewSupplierDetails(\'' + btoa(result[index].supplier_id) + '\')"><i class="fal fa-eye"></i></button>&nbsp;&nbsp;&nbsp;' +
            '<button class="btn  btn-warning" data-bs-toggle="modal" data-bs-target="#editSupplier" onclick="editSupplierDetails(\'' + btoa(result[index].supplier_id) + '\')"><i class="fad fa-edit"></i></button>&nbsp;&nbsp;&nbsp;' +
            '</td>' +
            '</tr>';
        //console.log(row)
    }
    $('#supplierTable').html(row).show()
        // supplierTableBody(result);
        // supplierNameOption(result); //get supplier names to the grn form by dropdown
    }, 'json')
}

let viewSupplierDetails = (Id) => {
    $.post("../controller/SupplierController.php?status=viewSupplierDetails", {
        supplierId: Id
    }, (result) => {
        let row = '<div class="row">' +
            '<label for="name" class="col-sm-12 col-form-label"><h2>' + result.supplier_name + '</h2></label>' +
            '<label for="contactName" class="col-sm-4 col-form-label text-end">Contact Name</label>' +
            '<label for="contactName" class="col-sm-8 col-form-label text-start mb-2"> : ' + result.supplier_contact_name + '</label>' +
            '<label for="email" class="col-sm-4 col-form-label text-end">Email</label>' +
            '<label for="email" class="col-sm-8 col-form-label text-start mb-2"> : ' + result.supplier_email + '</label>' +
            '<label for="contact" class="col-sm-4 col-form-label text-end">Contact</label>' +
            '<label for="contact" class="col-sm-8 col-form-label text-start mb-2"> : ' + result.supplier_contact + '</label>' +
            '<label for="address" class="col-sm-4 col-form-label text-end">Address</label>' +
            '<label for="address" class="col-sm-8 col-form-label text-start mb-2"> : ' + result.supplier_add1 + ' ' + result.supplier_add2 + ' ' + result.supplier_add3 + '</label>' +
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
    $.post("../controller/SupplierController.php?status=viewSupplierDetails", {
        supplierId: Id
    }, (result) => {
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

//customer
let getCustomerData = () =>{
    $.get("../controller/CustomerController.php?status=getCustomerData", (result) => {
        // customerTableBody(result);
        let row = '';
        for (let index = 0; index < result.length; index++) {
            row += '<tr>' +
                '<th scope="row">' + result[index].customer_id + '</th>' +
                '<td>' + result[index].customer_fname + ' ' + result[index].customer_lname + '</td>' +
                '<td>' + result[index].customer_contact + '</td>' +
                '<td>' + result[index].customer_email + '</td>' +
                '<td>' + result[index].customer_add1 + ', ' + result[index].customer_add2 + ', ' + result[index].customer_add3 + '</td>' +
    
                '<td>' +
                '<div class="d-inline-flex justify-content-start">' +
                '<button class="btn  btn-info" data-bs-toggle="modal" data-bs-target="#viewCustomer" onclick="viewCustomerDetails(\'' + btoa(result[index].customer_id) + '\')"><i class="fal fa-eye"></i></button>&nbsp;&nbsp;&nbsp;' +
                '<button class="btn  btn-warning" data-bs-toggle="modal" data-bs-target="#editCustomer" onclick="editCustomerDetails(\'' + btoa(result[index].customer_id) + '\')"><i class="fad fa-edit"></i></button>&nbsp;&nbsp;&nbsp;' +
                '</td>'
            '</tr>';
        }
        $('#customerTable').html(row).show()
    },'json')
}

let viewCustomerDetails = (Id) => {
    $.post("../controller/CustomerController.php?status=viewCustomerDetails", {
        customerId: Id
    }, (result) => {
        let row = '<div class="row">' +
            '<label for="name" class="col-sm-12 col-form-label"><h2>' + result.customer_fname + ' ' + result.customer_lname + '</h2></label>' +
            '<label for="email" class="col-sm-4 col-form-label text-end">Email</label>' +
            '<label for="email" class="col-sm-8 col-form-label text-start mb-2"> : ' + result.customer_email + '</label>' +
            '<label for="contact" class="col-sm-4 col-form-label text-end">Contact</label>' +
            '<label for="contact" class="col-sm-8 col-form-label text-start mb-2"> : ' + result.customer_contact + '</label>' +
            '<label for="address" class="col-sm-4 col-form-label text-end">Address</label>' +
            '<label for="address" class="col-sm-8 col-form-label text-start mb-2"> : ' + result.customer_add1 + ' ' + result.customer_add2 + ' ' + result.customer_add3 + '</label>' +
            '<label for="postalCode" class="col-sm-4 col-form-label text-end">Postal Code</label>' +
            '<label for="postalCode" class="col-sm-8 col-form-label text-start mb-2"> : ' + result.customer_postal_code + '</label>' +
            '<label for="nic" class="col-sm-4 col-form-label text-end">NIC</label>' +
            '<label for="nic" class="col-sm-8 col-form-label text-start mb-2"> : ' + result.customer_nic + '</label>' +
            '<label for="gender" class="col-sm-4 col-form-label text-end">Gender</label>';
        if ((result.customer_gender) == 1) {
            row += '<label for="gender" class="col-sm-8 col-form-label text-start mb-2"> : male</label>';
        } else {
            row += '<label for="gender" class="col-sm-8 col-form-label text-start mb-2"> : female</label>';
        }

        row += '<label for="birthday" class="col-sm-4 col-form-label text-end">Birthday</label>' +
            '<label for="birthday" class="col-sm-8 col-form-label text-start mb-2"> : ' + result.customer_dob + '</label>' +
            '<label for="status" class="col-sm-4 col-form-label text-end"> Status </label>';
        if ((result.customer_status) == 1) {
            row += '<label for="status" class="col-sm-8 col-form-label text-start mb-2"> : <span style="color:green">Active</span></label>';
        } else {
            row += '<label for="status" class="col-sm-8 col-form-label text-start mb-2"> : <span style="color:red">Deactivate</span></label>';
        }
        row += '<label for="createDate" class="col-sm-4 col-form-label text-end">Create Date  </label>' +
            '<label for="createDate" class="col-sm-8 col-form-label text-start mb-2"> : ' + result.customer_create_date + '</label>' +

            '</div>'
        $('#viewCustomerContent').html(row).show()
    }, 'json')
}

let editCustomerDetails = (Id) => {
    $.post("../controller/customerController.php?status=viewCustomerDetails", {
        customerId: Id
    }, (result) => {
        $('#editCustomerId').val(btoa(result.customer_id));
        $('#editCustomerFirstName').val(result.customer_fname);
        $('#editCustomerLastName').val(result.customer_lname);
        $('#editCustomerEmail').val(result.customer_email);
        $('#editCustomerContact').val(result.customer_contact);
        $('#editCustomerBirthday').val(result.customer_dob);
        $('#editCustomerGender').val(result.customer_gender);
        $('#editCustomerAdd1').val(result.customer_add1);
        $('#editCustomerAdd2').val(result.customer_add2);
        $('#editCustomerAdd3').val(result.customer_add3);
        $('#editCustomerPostalCode').val(result.customer_postal_code);
        $('#editCustomerNic').val(result.customer_nic);
    }, 'json')
}

//dining table
let getDiningTableData = () =>{
    $.get("../controller/DiningTableController.php?status=getDiningTableData", (result) =>{
        // diningTableBody(result);
        let row = '';
        let count=1;
        for (let index = 0; index < result.length; index++) {
            row += '<tr>' +
                '<th scope="row">' + count+ '</th>' +
                '<td>' + result[index].dining_table_name + '</td>' +
                '<td>' + result[index].dining_table_psn_cnt + '</td><td>';
            if ((result[index].dining_table_status) == 1) {
                row += '<button class="btn btn-outline-success rounded shadow" onclick="deactivateDiningTable(\'' + btoa(result[index].dining_table_id) + '\')">Available</button>';
            } else {
                row += '<button class="btn btn-outline-danger rounded shadow" onclick="activateDiningTable(\'' + btoa(result[index].dining_table_id) + '\')">Booked</button>';
            }
            row += '</td>' +
                '<td>' +
                '<div class="d-inline-flex justify-content-start">' +
                '<button class="btn  btn-info" data-bs-toggle="modal" data-bs-target="#viewDiningTable" onclick="viewDiningTableDetails(\'' + btoa(result[index].dining_table_id) + '\')"><i class="fal fa-eye"></i></button>&nbsp;&nbsp;&nbsp;' +
                '<button class="btn  btn-warning" data-bs-toggle="modal" data-bs-target="#editDiningTable" onclick="editDiningTable(\'' + btoa(result[index].dining_table_id) + '\')"><i class="fad fa-edit"></i></button>&nbsp;&nbsp;&nbsp;' +
                '</td>' +
                '</tr>';
                count++
        }
        $('#diningTable').html(row).show()
    },'json')
}

let viewDiningTableDetails = (Id) => {
    $.post("../controller/DiningTableController.php?status=viewDiningTableDetails", {
        diningTableId: Id
    }, (result) => {
        let row = '<div class="row">' +
            '<label for="name" class="col-sm-12 col-form-label"><h2>' + result.dining_table_name + '</h2></label>' +
            '<label for="tableCapacity" class="col-sm-4 col-form-label text-end">Table Capacity</label>' +
            '<label for="tableCapacity" class="col-sm-8 col-form-label text-start mb-2"> : ' + result.dining_table_psn_cnt + '</label>' +
            '<label for="status" class="col-sm-4 col-form-label text-end"> Status </label>';
        if ((result.dining_table_status) == 1) {
            row += '<label for="status" class="col-sm-8 col-form-label text-start mb-2"> : <span style="color:green">Available</span></label>';
        } else {
            row += '<label for="status" class="col-sm-8 col-form-label text-start mb-2"> : <span style="color:red">Booked</span></label>';

        }
        row += '</div>'
        $('#viewDiningTableContent').html(row).show()
    }, 'json')
}

let editDiningTable = (Id) => {
    $.post("../controller/DiningTableController.php?status=viewDiningTableDetails", {
        diningTableId: Id
    }, (result) => {
        $('#editDiningTableId').val(btoa(result.dining_table_id));
        $('#editTableName').val(result.dining_table_name);
        $('#editTableCapacity').val(result.dining_table_psn_cnt);
    }, 'json')

}

let deactivateDiningTable = (Id) => {
    swal({
        title: 'Are you sure',
        text: 'Do you want to change the status',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
        allowOutsideClick: false,
        closeOnClickOutside: false,
        closeOnEsc: false,
    }).then(willOUT => {
        if (willOUT) {
            $.post('../controller/DiningTableController.php?status=changeDiningTableStatus', {
                diningTableId: Id,
                diningTableStatus: "0"
            }, (result) => {
                if ([result[0] == 1]) {
                    toastr.success("Table is Booked");
                    diningTableBody(result[1])
                } else {
                    toastr.success(result[1]);
                }
            }, 'json')
        }
    })
}

let activateDiningTable = (Id) => {
    swal({
        title: 'Are you sure',
        text: 'Do you want to change the status',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
        allowOutsideClick: false,
        closeOnClickOutside: false,
        closeOnEsc: false,
    }).then(willOUT => {
        if (willOUT) {
            $.post('../controller/DiningTableController.php?status=changeDiningTableStatus', {
                diningTableId: Id,
                diningTableStatus: "1"
            }, (result) => {
                if ([result[0] == 1]) {
                    toastr.success("Dining Table available now");
                    diningTableBody(result[1])
                } else {
                    toastr.success(result[1]);
                }
            }, 'json')
        }
    })
}

//food items
let foodItemTableBody = ()=>{
    $.get("../controller/FoodItemController.php?status=getFoodItemData", (result) =>{
        //foodItemTableBody(result);
        let row = '';
    let count =1;
    for (let index = 0; index < result.length; index++) {
        row += '<tr>' +
            '<th scope="row">' + count + '</th>' +
            '<td><img src="../../images/foodItem-images/' + result[index].food_item_image + '" width="40" height="40"></td>' +
            '<td>' + result[index].food_item_name + '</td>' +
            '<td>' + result[index].food_item_unit_price + '</td><td>';
        if ((result[index].food_item_status) == 1) {
            row += '<button class="btn btn-outline-success rounded shadow" onclick="deactivateFoodItem(\'' + btoa(result[index].food_item_id) + '\')">Available</button>';
        } else {
            row += '<button class="btn btn-outline-danger rounded shadow" onclick="activateFoodItem(\'' + btoa(result[index].food_item_id) + '\')">Out of Stock</button>';

        }
        row += '</td>' +
            '<td>' +
            '<div class="d-inline-flex justify-content-start">' +
            '<button class="btn  btn-info" data-bs-toggle="modal" data-bs-target="#viewFoodItem" onclick="viewFoodItemDetails(\'' + btoa(result[index].food_item_id) + '\')"><i class="fal fa-eye"></i></button>&nbsp;&nbsp;&nbsp;' +
            '<button class="btn  btn-warning" data-bs-toggle="modal" data-bs-target="#editFoodItem" onclick="editFoodItemDetails(\'' + btoa(result[index].food_item_id) + '\')"><i class="fad fa-edit"></i></button>&nbsp;&nbsp;&nbsp;' +
            '</td>' +
            '</tr>';
            count++
    }
    $('#foodItemTable').html(row).show()
    },'json')
}

let viewFoodItemDetails = (Id) => {
    $.post("../controller/FoodItemController.php?status=viewFoodItemDetails", {
        foodItemId: Id
    }, (result) => {
        let row = '<div class ="row">' +
            '<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">' +
            '<img src="../../images/foodItem-images/' + result.food_item_image + '" alt="" width="350px" height="350px" class="m-auto">' +
            '</div>' +
            '<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="padding-left: 8rem;">' +
            '<div class="row">' +
            '<label for="name" class="col-sm-12 col-form-label" ><h2>' + result.food_item_name + '</h2></label>' +
            '<label for="email" class="col-sm-4 col-form-label text-end"> Unit Price </label>' +
            '<label for="email" class="col-sm-8 col-form-label text-start mb-2"> : ' + result.food_item_unit_price + '</label>' +
            '<label for="email" class="col-sm-4 col-form-label text-end"> Category Name </label>' +
            '<label for="email" class="col-sm-8 col-form-label text-start mb-2"> : ' + foodItemCategoryName(result.food_item_category_food_item_category_id).category_name + '</label>' +
            '<label for="email" class="col-sm-4 col-form-label text-end"> Sub Category Name </label>' +
            '<label for="email" class="col-sm-8 col-form-label text-start mb-2"> : ' + foodItemSubCategoryName(result.sub_category_sub_category_id).sub_category_name + '</label>' +
            '<label for="email" class="col-sm-4 col-form-label text-end"> Status </label>';
        if ((result.food_item_status) == 1) {
            row += '<label for="status" class="col-sm-8 col-form-label text-start mb-2"> : <span style="color:green">Available</span></label>';
        } else {
            row += '<label for="status" class="col-sm-8 col-form-label text-start mb-2"> : <span style="color:red">Out of Stock</span></label>';

        }
        row += '</div>' +
            '</div>' +
            '</div>';
        $('#viewFoodItemContent').html(row).show()
    }, 'json')
}

//get food item category name for view food item details
let foodItemCategoryName = (Id) => {
    var result = '';
    $.ajax({
        url: '../controller/CategoryController.php?status=getCategoryById',
        type: 'GET',
        dataType: 'JSON',
        data: {
            categoryId: btoa(Id)
        },
        async: false,
        success: function (data) {
            result = data
        }
    })
    return result;
    // console.log(result)
}

//get food item sub category name for view food item details ajax long form
let foodItemSubCategoryName = (Id) => {
    var result = '';
    $.ajax({
        url: '../controller/SubCategoryController.php?status=getSubCategoryById',
        type: 'GET',
        dataType: 'JSON',
        data: {
            subCategoryId: btoa(Id)
        },
        async: false,
        success: function (data) {
            result = data
        }
    })
    return result;
}

let editFoodItemDetails = (Id) => {
    $.post("../controller/FoodItemController.php?status=viewFoodItemDetails", {
        foodItemId: Id
    }, (result) => {
        $('#editFoodItemId').val(btoa(result.food_item_id));
        $('#editFoodItemName').val(result.food_item_name);
        $('#editUnitPrice').val(result.food_item_unit_price);
        $('#edit_food_pre_image').val(result.food_item_image);

        $.post("../controller/CategoryController.php?status=getCategoryData", (category) => {
            let row = '';
            for (let index = 0; index < category.length; index++) {
                row += '<option value= "' + category[index].category_id + '"';
                if (category[index].category_id == result.food_item_category_food_item_category_id) {
                    row += 'selected';
                }
                row += '>' + category[index].category_name + '</option>';
            }
            $('#editFoodItemCategoryName').html(row).show();
        }, 'json')

        $.post("../controller/SubCategoryController.php?status=getSubCategoryData", (subCategory) => {
            let row = '';
            for (let index = 0; index < subCategory.length; index++) {
                row += '<option value= "' + subCategory[index].sub_category_id + '"';
                if (subCategory[index].sub_category_id == result.sub_category_sub_category_id) {
                    row += 'selected';
                }
                row += '>' + subCategory[index].sub_category_name + '</option>';
            }
            $('#editFoodItemSubCategory').html(row).show()
        }, 'json')

        let url = "../../images/foodItem-images/" + result.food_item_image;
        $('#edit_food_pre_image').attr('src', url).height(150).width(150);
    }, 'json')
}

//deactivate food item
let deactivateFoodItem = (Id) => {
    swal({
        title: 'Are you sure',
        text: 'Do you want to change the status',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
        allowOutsideClick: false,
        closeOnClickOutside: false,
        closeOnEsc: false,
    }).then(willOUT => {
        if (willOUT) {
            $.post('../controller/FoodItemController.php?status=changeFoodItemStatus', {
                foodItemId: Id,
                foodItemStatus: "0"
            }, (result) => {
                if ([result[0] == 1]) {
                    toastr.success("Food Item is Out of Stock");
                    foodItemTableBody(result[1])
                } else {
                    toastr.success(result[1]);
                }
            }, 'json')

        }
    })
}
//activate food item
let activateFoodItem = (Id) => {
    swal({
        title: 'Are you sure',
        text: 'Do you want to change the status',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
        allowOutsideClick: false,
        closeOnClickOutside: false,
        closeOnEsc: false,
    }).then(willOUT => {
        if (willOUT) {
            $.post('../controller/FoodItemController.php?status=changeFoodItemStatus', {
                foodItemId: Id,
                foodItemStatus: "1"
            }, (result) => {
                if ([result[0] == 1]) {
                    toastr.success("Food Item is Now Available");
                    foodItemTableBody(result[1])
                } else {
                    toastr.success(result[1]);
                }
            }, 'json')

        }
    })
}

//Category table 
let categoryTableBody = () => {
    $.get("../controller/CategoryController.php?status=getCategoryData", (result)=>{
        //  categoryTableBody(result);
        //  categoryOption(result);
        let row = '';
        let count = 1;
        for (let index = 0; index < result.length; index++) {
            row += '<tr>' +
                '<th scope="row">' + count + '</th>' +
                '<td><img src="../../images/foodItem-images/' + result[index].category_image + '" width="40" height="40"></td>' +
                '<td>' + result[index].category_name + '</td><td>';
            if ((result[index].category_status) == 1) {
                row += '<button class="btn btn-outline-success rounded shadow" onclick="deactivateCategory(\'' + btoa(result[index].category_id) + '\')">Available</button>';
            } else {
                row += '<button class="btn btn-outline-danger rounded shadow" onclick="activateCategory(\'' + btoa(result[index].category_id) + '\')">Out of Stock</button>';
            }
            row += '</td>' +
                '<td>' +
                '<div class="d-inline-flex justify-content-start">' +
                '<button class="btn  btn-warning" data-bs-toggle="modal" data-bs-target="#editCategory" onclick="editCategoryDetails(\'' + btoa(result[index].category_id) + '\')"><i class="fad fa-edit"></i></button>&nbsp;&nbsp;&nbsp;' +
                '<button class="btn  btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCategory" onclick="deleteCategoryDetails(\'' + btoa(result[index].category_id) + '\')"><i class="fad fa-trash-alt"></i></button>&nbsp;&nbsp;&nbsp;' +
                '</td>' +
                '</tr>';       
            count++;
        }
        $('#categoryTable').html(row).show()
    },'json')
}

//get category data for food item or and sub category form dropdown list
let categoryOption = () => {
    $.get("../controller/CategoryController.php?status=getCategoryData", (result)=>{
        //  categoryTableBody(result);
        //  categoryOption(result);
        let row = '';
        for (let index = 0; index < result.length; index++) {
            row += '<option value="' + result[index].category_id + '">' + result[index].category_name + '</option>';
        }
        $('#subCategoryCategoryItem').html(row).show()
        $('#foodItemCategory').html(row).show()
    },'json')
}

//get sub category name to food item form sub category drop down list
let subCategoryOption = () => {
    $.get("../controller/SubCategoryController.php?status=getSubCategoryData",(result)=>{
        // subCategoryTableBody(result);
        // subCategoryOption(result);
        let row = '';
        for (let index = 0; index < result.length; index++) {
            row += '<option value="' + result[index].sub_category_id + '">' + result[index].sub_category_name + '</option>';
        }
        $('#foodItemSubCategory').html(row).show()
    },'json')
}

//view category details for edit category
let editCategoryDetails = (Id) => {
    $.post("../controller/CategoryController.php?status=viewCategoryDetails", {
        categoryId: Id
    }, (result) => {
        $('#editCategoryId').val(btoa(result.category_id));
        $('#editCategoryName').val(result.category_name);
        $('#edit_category_pre_image').val(result.category_image);

        let url = "../../images/foodItem-images/" + result.category_image;
        $('#edit_category_pre_image').attr('src', url).height(150).width(150);
    }, 'json')

}

let deactivateCategory = (Id) => {
    swal({
        title: 'Are you sure',
        text: 'Do you want to change the status',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
        allowOutsideClick: false,
        closeOnClickOutside: false,
        closeOnEsc: false,
    }).then(willOUT => {
        if (willOUT) {
            $.post('../controller/CategoryController.php?status=changeCategoryStatus', {
                categoryId: Id,
                categoryStatus: "0"
            }, (result) => {
                if ([result[0] == 1]) {
                    toastr.success("Category is Out of Stock");
                    categoryTableBody(result[1])
                } else {
                    toastr.success(result[1]);
                }
            }, 'json')

        }
    })
}

let activateCategory = (Id) => {
    swal({
        title: 'Are you sure',
        text: 'Do you want to change the status',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
        allowOutsideClick: false,
        closeOnClickOutside: false,
        closeOnEsc: false,
    }).then(willOUT => {
        if (willOUT) {
            $.post('../controller/CategoryController.php?status=changeCategoryStatus', {
                categoryId: Id,
                categoryStatus: "1"
            }, (result) => {
                if ([result[0] == 1]) {
                    toastr.success("Category is now Available");
                    categoryTableBody(result[1])
                } else {
                    toastr.success(result[1]);
                }
            }, 'json')
        }
    })
}

let deleteCategoryDetails = (Id) => {
    swal({
        title: 'Are you sure',
        text: 'Do you want to delete this category',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
        allowOutsideClick: false,
        closeOnClickOutside: false,
        closeOnEsc: false,
    }).then(willOUT => {
        if (willOUT) {
            $.post('../controller/CategoryController.php?status=deleteCategory', {
                categoryId: Id
            }, (result) => {
                if ([result[0] == 1]) {
                    toastr.success("Category successfully deleted");
                    categoryTableBody(result[1])
                } else {
                    toastr.success(result[1]);
                }
            }, 'json')
        }
    })
}

//sub category
let subCategoryTableBody = () => {
    $.get("../controller/SubCategoryController.php?status=getSubCategoryData",(result)=>{
        let row = '';
    let count = 1;
    for (let index = 0; index < result.length; index++) {
        // let a = subCategoryCategoryName(result[index].category_category_id)
        // console.log(a)
        row += '<tr>' +
            '<th scope="row">' + count + '</th>' +
            '<td><img src="../../images/foodItem-images/' + result[index].sub_category_image + '" width="40" height="40"></td>' +
            '<td>' + result[index].sub_category_name + '</td>' +
            '<td>' + subCategoryCategoryName(result[index].category_category_id).category_name + '</td><td>';

        if ((result[index].sub_category_status) == 1) {
            row += '<button class="btn btn-outline-success rounded shadow" onclick="deactivateSubCategory(\'' + btoa(result[index].sub_category_id) + '\')">Available</button>';
        } else {
            row += '<button class="btn btn-outline-danger rounded shadow" onclick="activateSubCategory(\'' + btoa(result[index].sub_category_id) + '\')">Out of Stock</button>';
        }
        row += '</td>' +
            '<td>' +
            '<div class="d-inline-flex justify-content-start">' +
            '<button class="btn  btn-warning" data-bs-toggle="modal" data-bs-target="#editSubCategory" onclick="editSubCategoryDetails(\'' + btoa(result[index].sub_category_id) + '\')"><i class="fad fa-edit"></i></button>&nbsp;&nbsp;&nbsp;' +
            '<button class="btn  btn-danger" data-bs-toggle="modal" data-bs-target="#deleteSubCategory" onclick="deleteSubCategoryDetails(\'' + btoa(result[index].sub_category_id) + '\')"><i class="fad fa-trash-alt"></i></button>&nbsp;&nbsp;&nbsp;' +
            '</td>' +
            '</tr>';
        count++;
    }
    $('#subCategoryTable').html(row).show()
    },'json')
}

let subCategoryCategoryName = (Id) => {
    var result = '';
    $.ajax({
        url: '../controller/CategoryController.php?status=getCategoryById',
        type: 'GET',
        dataType: 'JSON',
        data: {
            categoryId: btoa(Id)
        },
        async: false,
        success: function (data) {
            result = data
            //console.log(result);
        }
    })
    return result;
    // console.log(result);
}

let editSubCategoryDetails = (Id) => {
    $.post("../controller/SubCategoryController.php?status=viewSubCategoryDetails", {
        subCategoryId: Id
    }, (result) => {
        $('#editSubCategoryId').val(btoa(result.sub_category_id));
        $('#editSubCategoryName').val(result.sub_category_name); //assign edit sub category name's value
        $('#edit_sub_category_pre_image').val(result.sub_category_image);
        $.post("../controller/CategoryController.php?status=getCategoryData", (data) => {
            // console.log(data.length);
            let row = '';
            for (let index = 0; index < data.length; index++) {
                row += '<option value="' + data[index].category_id + '"';
                if (data[index].category_id == result.category_category_id) {
                    row += 'selected';
                }
                row += '>' + data[index].category_name + '</option>';
            }
            $('#editSubCategoryCategoryItem').html(row).show()
        }, 'json')
        let url = "../../images/foodItem-images/" + result.sub_category_image;
        $('#edit_sub_category_pre_image').attr('src', url).height(150).width(150);
    }, 'json')
}

let deactivateSubCategory = (Id) => {
    swal({
        title: 'Are you sure',
        text: 'Do you want to change the status',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
        allowOutsideClick: false,
        closeOnClickOutside: false,
        closeOnEsc: false,
    }).then(willOUT => {
        if (willOUT) {
            $.post('../controller/SubCategoryController.php?status=changeSubCategoryStatus', {
                subCategoryId: Id,
                subCategoryStatus: "0"
            }, (result) => {
                if ([result[0] == 1]) {
                    toastr.success("Sub Category is out of stock");
                    subCategoryTableBody(result[1])
                } else {
                    toastr.success(result[1]);
                }
            }, 'json')
        }
    })
}

let activateSubCategory = (Id) => {
    swal({
        title: 'Are you sure',
        text: 'Do you want to change the status',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
        allowOutsideClick: false,
        closeOnClickOutside: false,
        closeOnEsc: false,
    }).then(willOUT => {
        if (willOUT) {
            $.post("../controller/SubCategoryController.php?status=changeSubCategoryStatus", {
                subCategoryId: Id,
                subCategoryStatus: "1"
            }, (result) => {
                if ([result[0] == 1]) {
                    toastr.success("Sub Category is now available");
                    subCategoryTableBody(result[1])
                } else {
                    toastr.success(result[1]);
                }
            }, 'json')
        }
    })
}

let deleteSubCategoryDetails = (Id) => {
    swal({
        title: 'Are you sure',
        text: 'Do you want to delete this category',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
        allowOutsideClick: false,
        closeOnClickOutside: false,
        closeOnEsc: false,
    }).then(willOUT => {
        if (willOUT) {
            $.post("../controller/SubCategoryController.php?status=deleteSubCategory", {
                subCategoryId: Id
            }, (result) => {
                if ([result[0] == 1]) {
                    toastr.success("Sub Category successfully deleted");
                    subCategoryTableBody(result[1])
                } else {
                    toastr.success(result[1]);
                }
            }, 'json')
        }
    })
}

let getRowItemData =()=>{
    $.get("../controller/RowItemController.php?status=getRowItemData",(result)=>{
        //rowItemTableBody(result);
        let row = '';
        let count = 1;
        for (let index = 0; index < result.length; index++) {
            row += '<tr>' +
                '<th>'+count+'</th>'+
                '<td>'+result[index].row_item_name+'</td><td>';
            if ((result[index].row_item_status) == 1) {
                row += '<button class="btn btn-outline-success rounded shadow" onclick="deactivateRowItem(\'' + btoa(result[index].row_item_id) + '\')">Available</button>';
            } else {
                row += '<button class="btn btn-outline-danger rounded shadow" onclick="activateRowItem(\'' + btoa(result[index].row_item_id) + '\')">Out of Stock</button>';
            }
            row += '</td>' +
                '<td>' +
                '<div class="d-inline-flex justify-content-start">' +
                '<button class="btn  btn-warning" data-bs-toggle="modal" data-bs-target="#editRowItem" onclick="editRowItemDetails(\'' + btoa(result[index].row_item_id) + '\')"><i class="fad fa-edit"></i></button>&nbsp;&nbsp;&nbsp;' +
                '<button class="btn  btn-danger" data-bs-toggle="modal" data-bs-target="#deleteRowItem" onclick="deleteRowItemDetails(\'' + btoa(result[index].row_item_id) + '\')"><i class="fad fa-trash-alt"></i></button>&nbsp;&nbsp;&nbsp;' +
                '</td>'+
            '</tr>';
            count++;
        }
        $('#rowItemTable').html(row).show()
    },'json')
}

//change the row item status to out of stock status
let  deactivateRowItem =(Id)=>{
    swal({
        title : 'Are you sure',
        text : 'Do you want to change the status',
        icon : 'warning',
        buttons : true,
        dangerMode : true,
        allowOutsideClick : false,
        closeOnEsc : false,
        closeOnClickOutside : false,
    }).then(willOUT=>{
        if (willOUT) {
            $.post('../controller/RowItemController.php?status=changeRowItemStatus',{
                rowItemId : Id,
                rowItemStatus : "0"
            },(result)=>{
                if ([result[0]==1]) {
                    toastr.success("Row item is out of stock");
                    rowItemTableBody(result[1])
                }else{
                    toastr.success(result[1]);
                }
            },'json')
        }
    })
}

//change the row item status to available status
let activateRowItem = (Id) =>{
    swal({
        title : 'Are you sure',
        text : 'Do you want to change the status',
        icon : 'warning',
        buttons : true,
        dangerMode : true,
        allowOutsideClick : false,
        closeOnEsc : false,
        closeOnClickOutside : false,
    }).then(willOUT=>{
        if (willOUT) {
            $.post("../controller/RowItemController.php?status=changeRowItemStatus",{
                rowItemId : Id,
                rowItemStatus : "1"
            },(result)=>{
                if ([result[0]==1]) {
                    toastr.success("Row Item is now available");
                    rowItemTableBody(result[1])
                }else{
                    toastr.success(result[1]);
                }
            },'json')
        }
    })
}

let editRowItemDetails = (Id) =>{
    $.post("../controller/RowItemController.php?status=viewRowItemDetails",{
        rowItemId :Id
    },(result)=>{
        $('#editRowItemId').val(btoa(result.row_item_id));
        $('#editRowItemName').val(result.row_item_name);
    },'json')
}
 
let getGrnNumber = ()=>{
    $.get("../controller/StockController.php?status=getGrnNumber",(result)=>{
        $('#stockGrnNumber').val(result);
    },'json')
}

let getGrnData = ()=>{
    $.get("../controller/GrnController.php?status=getGrnData",(result)=>{
            let row ='';
            let count = 1;
            for (let index = 0; index < result.length; index++) {
                row += '<tr>'+
                '<th>'+count+'</th>'+
                '<td>'+ result[index].grn_ref_id+'</td>'+
                '<td>'+result[index].grn_date+'</td>'+
                '<td>'+result[index].grn_price+'</td>'+
                '<td>'+result[index].grn_total_discount+'</td>'
                '</tr>'
                count++
            }
            $('#grnTable').html(row).show();
    },'json')
}

let getStockData = ()=>{
    $.get("../controller/StockController.php?status=getStockData",(result)=>{
        let row ='';
        let count = 1;
        for (let index = 0; index < result.length; index++) {
            row += '<tr>'+
            '<th>'+ count +'</th>'+
            '<td>'+result[index].stock_count+'</td>'+
            '<td>'+result[index].stock_current_count+'</td>'+
            '<td>'+result[index].stock_cost_per_unit+'</td>'+
            '<td>'+result[index].stock_discount+'</td>'+
            '<td>'+result[index].stock_mnf_date+'</td>'+
            '<td>'+result[index].stock_exp_date+'</td>'+
            '<td>'+result[index].stock_net_cost+'</td><td>';
            if ((result[index].stock_status) == 1) {
                row += '<button class="btn btn-outline-success rounded shadow" onclick="deactivateRowItem(\'' + btoa(result[index].row_item_id) + '\')">Available</button>';
            } else {
                row += '<button class="btn btn-outline-danger rounded shadow" onclick="activateRowItem(\'' + btoa(result[index].row_item_id) + '\')">Out of Stock</button>';
            }
            row+= '</td>'+
            '</tr>'
            count++
        }
        $('#stockTable').html(row).show();
    },'json')
}
 //get supplier name from supplier table by giving id in grn
//  let grnSupplierName = (Id)=>{
//     var result ='';
//     $.ajax({
//         url : '../controller/SupplierController.php?status=getSupplierNameById',
//         type : 'GET',
//         dataType : 'JSON',
//         data:{
//             supplierId :btoa(Id)
//         },
//         async : false,
//         success: function(data) {
//             result = data
//         }
//     })
//     return result;
// }
//  let grnTableBody = (result)=>{
//      let row ='';
//      let count = 1;
//      for (let index = 0; index < result.length; index++) {
//          row += '<tr>'+
//          '<th scope="row">'+ count +'</th>'+
//          '<td>'+ result[index].grn_ref_id+'</td>'+
//          '<td>'+ result[index].grn_date +'</td>'+
//          '<td>'+ result[index].grn_price +'</td>'+
//           '<td>'+ grnSupplierName(result[index].supplier_supplier_id).supplier_contact_name +'</td><td>';
//           if ((result[index].grn_status)==1) {
//               row += '<button class="btn btn-outline-success rounded shadow" onclick="deactivateGrn(\'' + btoa(result[index].grn_id) + '\')">Not Hand Over</button>';
//           }else{
//             row += '<button class="btn btn-outline-danger rounded shadow" onclick="activateGrn(\'' + btoa(result[index].grn_id) + '\')">Hand Over</button>';
//           }
//           row += '</td>'+
//           '<td>'+
//           '<div class="d-inline-flex justify-content-start">' +
//             '<button class="btn  btn-warning" data-bs-toggle="modal" data-bs-target="#editGrn" onclick="editGrnDetails(\'' + btoa(result[index].grn_id) + '\')"><i class="fad fa-edit"></i></button>&nbsp;&nbsp;&nbsp;' +
//             '<button class="btn  btn-danger" data-bs-toggle="modal" data-bs-target="#deleteGrn" onclick="deleteGrnDetails(\'' + btoa(result[index].grn_id) + '\')"><i class="fad fa-trash-alt"></i></button>&nbsp;&nbsp;&nbsp;' +
//           '</td>'+
//          '</tr>';
//          count ++;
//      }
//      $('#grnTable').html(row).show()
//  }

//  //change the row item status to hand over status
//  let deactivateGrn =(Id)=>{
//      swal({
//          title : 'Are you sure',
//          text : 'Do you want to change the status',
//          icon : 'warning',
//          buttons : true,
//          dangerMode : true,
//         allowOutsideClick : false,
//         closeOnEsc : false,
//         closeOnClickOutside : false,
//      }).then(willOUT=>{
//          if (willOUT) {
//              $.post('../controller/GrnController.php?status=changeGrnStatus',{
//                  grnId : Id,
//                  grnStatus : "0"
//              },(result)=>{
//                  if (result[0]==1) {
//                      toastr.success("Grn is hand over");
//                      grnTableBody(result[1])
//                  }else{
//                      toastr.success(result[1]);
//                  }
//              },'json')
//          }
//      })
//  }

//  //change the row item status to not and over status
//  let activateGrn =(Id)=>{
//     swal({
//         title : 'Are you sure',
//         text : 'Do you want to change the status',
//         icon : 'warning',
//         buttons : true,
//         dangerMode : true,
//        allowOutsideClick : false,
//        closeOnEsc : false,
//        closeOnClickOutside : false,
//     }).then(willOUT=>{
//         if (willOUT) {
//             $.post('../controller/GrnController.php?status=changeGrnStatus',{
//                 grnId : Id,
//                 grnStatus : "1"
//             },(result)=>{
//                 if (result[0]==1) {
//                     toastr.success("Grn is not hand over");
//                     grnTableBody(result[1])
//                 }else{
//                     toastr.success(result[1]);
//                 }
//             },'json')
//         }
//     })
//  }

//  let editGrnDetails = (Id)=>{
//      $.post("../controller/GrnController.php?status=viewGrnDetails",{
//          grnId : Id
//      },(result)=>{
//          console.log(result)
//          $('#editGrnId').val(btoa(result.grn_id));
//          $('#editGrnDate').val(result.grn_date);
//          $('#editGrnPrice').val(result.grn_price);
//          $.post("../controller/SupplierController.php?status=getSupplierData",(data)=>{
//              let row ='<option value="" selected>Select Supplier</option>';
//              for (let index = 0; index < data.length; index++) {
//                  row += '<option value="' +data[index].supplier_id+'"';
//                  if (data[index].supplier_id == result.supplier_supplier_id) {
//                      row += 'selected';
//                  }
//                  row += '>'  + data[index].supplier_contact_name +'</option>';
//              }
//              $('#editGrnSupplierName').html(row).show()
//          },'json')
//      },'json')
//  }

//  let getStockNetCost = (tblRowCnt)=>{
//     let stockReceivedQuantity = +$('#stockReceivedQuantity' + tblRowCnt).val();//change the string value to integer by +
//     let stockCostPerUnit = parseFloat($('#stockCostPerUnit' + tblRowCnt).val()); // change the value string to float
//     let stockNetCost = stockReceivedQuantity * stockCostPerUnit;
//     $('#stockNetCost' + tblRowCnt).val(stockNetCost.toFixed(2));
// };
