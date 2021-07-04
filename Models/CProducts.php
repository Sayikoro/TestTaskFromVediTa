<?php
class CProducts
{
   
    public static function showTables($qantity_row){

        $db = Db::getConnection();
        $sql = '  SELECT * FROM `products` WHERE  `VISIBILITY` = 1 ORDER BY `DATE_CREATE` DESC LIMIT  :limit';
        $result = $db->prepare($sql);
        $result->bindParam(':limit', $qantity_row, PDO::PARAM_INT);
        $result->execute(); 
        $res = $result->fetchAll();
        return $res;
    }
    public static function hideRow($row_id){

        $db = Db::getConnection();
        $sql = 'UPDATE `products` SET VISIBILITY = 0 WHERE ID = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $row_id, PDO::PARAM_INT);
        $result->execute(); 
        $res = $result->fetchAll();
        return $res;
}

public static  function getQantity($id)
{
    
        $db = Db::getConnection();
        $sql = 'SELECT `PRODUCT_QUANTITY` FROM `products` WHERE `ID`= :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute(); 
        $res = $result->fetch();
        return $res;
}
public static  function updateQantity($id,$new_qantity)
{
    
        $db = Db::getConnection();
        $sql = "UPDATE `products` SET PRODUCT_QUANTITY = :qantity WHERE ID =:id";
        $result = $db->prepare($sql);
        $result->bindParam(':qantity', $new_qantity, PDO::PARAM_INT);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute(); 
        $res = $result->fetch();
        return $res;
}

}

