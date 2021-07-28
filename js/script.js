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
    
    let preview = (input) => {
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $('#pre_image').attr('src', e.target.result).height(200).width(200);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#dataTable').DataTable({
        dom: "<'row'<'col-sm-3'l><'col-sm-6'B><'col-sm-3'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        // dom:'Bfrtip',
        buttons: [
           {extend: 'copy', className:'cusBut'},
           {extend: 'excel', className:'cusBut'},
           {extend: 'print', className:'cusBut'}
        ],
        bSort: false,
        pageLength: 10,
        pagingType: "full_numbers"
    });

//     // setInterval(function () {
//          $.get("../controller/UserController.php?status=getUserData", (result)=>{
//         // console.log(result)
//         let row = '';
//         for (let index = 0; index < result.length; index++) {
//             // console.log( result[index].user_id);
//             row += '<tr>'+
//             '<th scope="row">'+result[index].user_id+'</th>'+            
//             '<td><img src="../../images/user-images/'+result[index].user_image+'" width="40" height="40"></td>'+
//             '<td>'+result[index].user_fname+' '+result[index].user_lname+'</td>'+
//             '<td>'+result[index].user_email+'</td>'+
//             '<td>'+result[index].user_contact+'</td><td>';           
//             if((result[index].user_status)==1){
//                 row +='<button class="btn btn-outline-success rounded shadow" onclick="deactivateUser(\''+btoa(result[index].user_id)+'\')">Active</button>';
//             }else{
//                 row +='<button class="btn btn-outline-danger rounded shadow" onclick="activateUser(\''+btoa(result[index].user_id)+'\')">Deactivate</button>';
//             }
//             row +='</td>'+
//             '<td>'+
//             '<div class="d-inline-flex justify-content-start">'+
//             '<button class="btn  btn-info" data-bs-toggle="modal" data-bs-target="#viewUser" onclick="viewUserDetails(\''+btoa(result[index].user_id)+'\')"><i class="fal fa-eye"></i></button>&nbsp;&nbsp;&nbsp;'+
//             '<button class="btn  btn-warning "><i class="fad fa-edit"></i></button>&nbsp;&nbsp;&nbsp;'+
//             '<button class="btn  btn-danger "><i class="fal fa-trash-alt"></i></button></div></td>&nbsp;&nbsp;&nbsp;'+
//             '</tr>';
//         }
//         // console.log(row)
//         $('#userTable').html(row).show()
//     },'json')
//     // }, 30000)   
});

// let viewUserDetails = (Id) =>{
//     $.post("../controller/UserController.php?status=viewUserDetails", {userId:Id}, (result) => {  
//         $('#viewUserContent').html(result).show();
//     })
// }

let viewUserDetails = (Id) =>{
    $.post("../controller/UserController.php?status=viewUserDetails", {userId:Id}, (result) => {  
        let row = '<div class="row">'+                
        '<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">'+
            '<img src="../../images/user-images/'+result.user_image+'" alt="" width="350px" height="350px" class="m-auto">'+
        '</div>'+
        '<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">'+                    
            '<div class="row">'+
                '<label for="name" class="col-sm-12 col-form-label" style="padding-left: 8rem;"><h2>'+result.user_fname+' '+result.user_lname+'</h2></label>'+
                '<label for="createDate" class="col-sm-4 col-form-label text-end">Create Date  </label>'+
                '<label for="createDate" class="col-sm-8 col-form-label text-start mb-2"> : '+result.user_create_date+'</label>'+
                '<label for="contact" class="col-sm-4 col-form-label text-end">Contact  </label>'+
                '<label for="contact" class="col-sm-8 col-form-label text-start mb-2"> : '+result.user_contact+'</label>'+
                '<label for="email" class="col-sm-4 col-form-label text-end"> Email </label>'+
                '<label for="email" class="col-sm-8 col-form-label text-start mb-2"> : '+result.user_email+'</label>'+
                '<label for="address" class="col-sm-4 col-form-label text-end"> Address </label>'+
                '<label for="address" class="col-sm-8 col-form-label text-start mb-2"> :  '+result.user_add1+' '+result.user_add2+' '+result.user_add3+'</label>'+
                '<label for="gender" class="col-sm-4 col-form-label text-end"> Gender </label>';
                if((result.user_gender)==1){
                    row += '<label for="gender" class="col-sm-8 col-form-label text-start mb-2"> : male</label>';
                }else{
                    row += '<label for="gender" class="col-sm-8 col-form-label text-start mb-2"> : female</label>';
                }
                row += '<label for="birthday" class="col-sm-4 col-form-label text-end"> Birthday </label>'+
                '<label for="birthday" class="col-sm-8 col-form-label text-start mb-2"> : '+result.user_dob+'</label>'+                            
                '<label for="nic" class="col-sm-4 col-form-label text-end"> NIC </label>'+
                '<label for="nic" class="col-sm-8 col-form-label text-start mb-2"> : '+result.user_nic+'</label>'+                                                       
                '<label for="status" class="col-sm-4 col-form-label text-end"> Status </label>';
                if((result.user_status)==1){
                    row += '<label for="status" class="col-sm-8 col-form-label text-start mb-2"> : <span style="color:green">Active</span></label>';
                }else{
                    row += '<label for="status" class="col-sm-8 col-form-label text-start mb-2"> : <span style="color:red">Deactivate</span></label>';
                }                                                     
            row += '</div>'+
        '</div>'+                    
    '</div>';
    $('#viewUserContent').html(row).show()
    },'json')
}