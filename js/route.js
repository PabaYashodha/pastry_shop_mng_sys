$.get("../controller/DashboardController.php?status=getModule", (result) => {
    // console.log(result);
    let li = '';
    for (let index = 0; index < result.length; index++) {
        li += '<li class="sideBTN p-0 "><a href="#" class="nav-link text-light flex-column" style="padding:0.73rem; padding-left:1.7rem" ><i class="'+result[index].module_logo+'"></i><span class="moduleName"> &nbsp;'+ result[index].module_name +'</span></a></li>'  
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

let getFoodItemData = () =>{
    $.get("../controller/FoodItemController.php?status=getFoodItemData", (result) =>{
        foodItemTableBody(result);
    },'json')
}

let getDiningTableData = () =>{
    $.get("../controller/DiningTableController.php?status=getDiningTableData", (result) =>{
        diningTableBody(result);
    },'json')
}