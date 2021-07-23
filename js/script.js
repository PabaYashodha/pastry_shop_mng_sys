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

    // setInterval(function () {
         $.get("../controller/UserController.php?status=getUserData", (result)=>{
        // console.log(result)
        let row = '';
        for (let index = 0; index < result.length; index++) {
            // console.log( result[index].user_id);
            row += '<tr>'+
            '<th scope="row">'+result[index].user_id+'</th>'+            
            '<td><img src="../../images/user-images/'+result[index].user_image+'" width="40" height="40"></td>'+
            '<td>'+result[index].user_fname+' '+result[index].user_lname+'</td>'+
            '<td>'+result[index].user_email+'</td>'+
            '<td>'+result[index].user_contact+'</td><td>';           
            if((result[index].user_status)==1){
                row +='<button class="btn btn-outline-success rounded shadow" onclick="deactivateUser('+btoa(result[index].user_id)+')">Active</button>';
            }else{
                row +='<button class="btn btn-outline-danger rounded shadow" onclick="activateUser('+result[index].user_id+')">Deactivate</button>';
            }
            row +='</td>'+
            '<td><div class="d-inline-flex justify-content-start"><button class="btn btn-pill btn-info">View</button>&nbsp;&nbsp;&nbsp;'+
            '<button class="btn btn-pill btn-warning">Edit</button>&nbsp;&nbsp;&nbsp;'+
            '<button class="btn btn-pill btn-danger">Delete</button></div></td>&nbsp;&nbsp;&nbsp;'+
            '</tr>';
        }
        // console.log(row)
        $('#userTable').html(row).show()
    },'json')
    // }, 30000)
   
    
});