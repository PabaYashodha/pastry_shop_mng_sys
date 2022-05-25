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
        $sql = "SELECT  * FROM `item_release` `i`, `item_release_list` `li`";
         $getStockReleaseData = $conn->query($sql) or die($conn->error);
        return  $getStockReleaseData;
    }
}