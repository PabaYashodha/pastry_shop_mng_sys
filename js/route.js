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
        li += '" style="padding:0.73rem; padding-left:1.7rem" ><i class="'+result[index].module_logo+'"></i><span class="moduleName"> &nbsp;'+ result[index].module_name +'</span></a></li>';  
    }
    $('#getModule').html(li).show();
}, 'json')

// var path = window.location.pathname;
// var page = path.split("/").pop();
// console.log( page );

let getUserData = () =>{
    $.get("../controller/UserController.php?status=getUserData", (result) => {
        userTableBody(result);      //call userTableBody function  
    }, 'json')
}
    
let getSupplierData = () =>{
    $.get("../controller/SupplierController.php?status=getSupplierData", (result) => {
        supplierTableBody(result);
        supplierNameOption(result); //get supplier names to the grn form by dropdown
    }, 'json')
}

let getCustomerData = () =>{
    $.get("../controller/CustomerController.php?status=getCustomerData", (result) => {
        customerTableBody(result);
    },'json')
}

let getDiningTableData = () =>{
    $.get("../controller/DiningTableController.php?status=getDiningTableData", (result) =>{
        diningTableBody(result);
    },'json')
}

let getFoodItemData = ()=>{
    $.get("../controller/FoodItemController.php?status=getFoodItemData", (result) =>{
        foodItemTableBody(result);
    },'json')
}

let getCategoryData = () =>{
    $.get("../controller/CategoryController.php?status=getCategoryData", (result)=>{
         categoryTableBody(result);
         categoryOption(result);
    },'json')
}

let getSubCategoryData = () =>{
    $.get("../controller/SubCategoryController.php?status=getSubCategoryData",(result)=>{
        subCategoryTableBody(result);
        subCategoryOption(result);
    },'json')
}

let getRowItemData =()=>{
    $.get("../controller/RowItemController.php?status=getRowItemData",(result)=>{
        rowItemTableBody(result);
        rowItemOption(result);
    },'json')
}

let getGrnData= ()=>{
    $.get("../controller/GrnController.php?status=getGrnData",(result)=>{
        grnTableBody(result);
    },'json')
}


