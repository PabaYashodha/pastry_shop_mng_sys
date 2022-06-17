<?php 
include_once '../../config/dbConnection.php';

class stockRelease
{
    private $db;

    public function __construct()
    {
        $this->db = new dbConnection();
    }

    public function getStockReleaseNo()
    {
        $conn = $this->db->connection();
        $sql = "SELECT COUNT(`item_release_id`) as `count` FROM `item_release`";
        $getStockReleaseNo = $conn->query($sql);
        return $getStockReleaseNo;
    }

    public function addStockRelease($stockReleaseDate,$stockReleaseNo,$stockReleaseTo,$stockReleaseMadeBy)
    {
        $conn = $this->db->connection();
        $sql = "INSERT INTO `item_release`(`item_release_date`, `item_reference_no`, `item_release_to`, `item_release_made_by`) 
        VALUES('$stockReleaseDate','$stockReleaseNo','$stockReleaseTo','$stockReleaseMadeBy')";
         $conn->query($sql) or die($conn->error);
         return $conn->insert_id;
    }

    public function addStockReleaseItem($stockReleaseQuantity ,$value, $addStockRelease)
    {
        $conn = $this->db->connection();
        $sql = "INSERT INTO `item_release_list`(`item_release_quantity`, `item_release_item_id`, `item_release_item_release_id`)
        VALUES('$stockReleaseQuantity' ,'$value', '$addStockRelease')";
        $addStockReleaseItem = $conn->query($sql) or die($conn->error);
        return  $addStockReleaseItem;
    }

    public function getStockReleaseData()
    {
        $conn = $this->db->connection();
        //$sql =  "SELECT `i`.`item_release_date`, `li`.item_release_item_id`, `li`.`item_release_quantity` FROM `item_release` `i`, `item_release_list` `li`";
        $sql = "SELECT  * FROM `item_release` `i`, `item_release_list` `li` ORDER BY `item_release_id` DESC";
         $getStockReleaseData = $conn->query($sql) or die($conn->error);
        return  $getStockReleaseData;
    }

    public function getAvailableStockById($value)
    {
        $conn = $this->db->connection();
        $sql = "SELECT `stock_current_count` , `stock_id` FROM `stock` WHERE `row_item_row_item_id` ='$value' AND `stock_status`=1";
        $result = $conn->query($sql);
        return $result;
    }

    public function currentCountGraterThanReleaseCount($stock_id, $qty)
    {
        $conn = $this->db->connection();
        $sql = "UPDATE `stock` SET `stock_current_count`=`stock_current_count`-'$qty' WHERE `stock_id`= '$stock_id'";
        $result = $conn->query($sql);
        return $result;
    }

    public function currentCountEqualTOReleaseCount($stock_id)
    {
        $conn = $this->db->connection();
        $sql = "UPDATE `stock` SET `stock_current_count`=0, `stock_status`=0  WHERE `stock_id`= '$stock_id'";
        $result = $conn->query($sql);
        return $result;
    }

    public function availableStock()
    {
        $conn = $this->db->connection();
        $sql = "SELECT `r`.`row_item_name` , `r`.`row_item_id`  FROM `stock` `s`, `row_item` `r` WHERE `s`.`stock_status`=1 AND `s`.`row_item_row_item_id` = `r`.`row_item_id` GROUP BY `r`.`row_item_id`";
        $result = $conn->query($sql);
        return $result;
    }
    public function updateRowItemQtyById($qty, $item_id)
    {
        $conn = $this->db->connection();
        $sql = "UPDATE `row_item` SET `row_item_stock_sum` = `row_item_stock_sum` - '$qty' WHERE `row_item_id` = '$item_id'";
        $result = $conn->query($sql);
        return $result;
    }

    public function checkStockReleaseRowItemNamesIsAvailable($stockReleaseRowItemId)
    {
        $conn = $this->db->connection();
        $sql = "SELECT `row_item_stock_sum`, `row_item_id` FROM `row_item` WHERE `row_item_id`='$stockReleaseRowItemId' AND `row_item_stock_sum`= 0 ";
        $result = $conn->query($sql) or die($conn->error);
        return ($result->num_rows>0) ? false : true;  
    }

    public function checkIfTheQuantityMatch($stockReleaseQuantity)
    {
        $conn = $this->db->connection();
        $sql = "SELECT `row_item_stock_sum` FROM `row_item` WHERE `row_item_stock_sum` < '$stockReleaseQuantity'";
        $result = $conn->query($sql) or die($conn->error);
        return ($result->num_rows>0) ? false : true;  
    }
    
}