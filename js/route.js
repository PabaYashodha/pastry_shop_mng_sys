$.get("../controller/DashboardController.php?status=getModule", (result) => {
    // console.log(result);
    let li = '';
    for (let index = 0; index < result.length; index++) {
        li += '<li class="list-group-item sideBTN p-0 "><a href="#" class="nav-link text-light list-group-item flex-column"><i class="'+result[index].module_logo+'"></i> &nbsp;<span class="moduleName">'+ result[index].module_name +'</span></a></li>'  
    }
    $('#getModule').html(li).show();
}, 'json')

let getUserData = () =>{
    $.get("../controller/UserController.php?status=getUserData", (result) => {
        userTableBody(result);      //call userTableBody function  
    }, 'json')
}
    
let getSupplierData = () =>{
    $.get("../controller/SupplierController.php?status=getSupplierData", (result) => {
        supplierTableBody(result);
    }, 'json')
}

let getCustomerData = () =>{
    $.get("../controller/CustomerController.php?status=getCustomerData", (result) => {
        customerTableBody(result);
    },'json')
}