<?
require ROOT.'/Models/CProducts.php';
class ProductsController
{
 public  function actionIndex()
 {
   $products = CProducts::showTables(5);
   include_once (ROOT.'/Views/productTable.php');
   return true; 
 }

 public  function actionShow($qantity)
 {
    $products = CProducts::showTables((int)$qantity);
      $table = '<table id="products" >
      <thead >
       <tr>
        <td> ID </td>
        <td> PRODUCT_ID </td> 
        <td> PRODUCT_NAME </td> 
        <td> PRODUCT_PRICE </td> 
        <td> PRODUCT_ARTICLE </td> 
        <td> PRODUCT_QUANTITY </td> 
        <td> DATE_CREATE </td> 
        <td> Hide </td> 
       </tr> 
      </thead>
      <tbody >';
    foreach ($products as $row) {

    
         $tbody .= ' <tr id = "'. $row['ID'].'">  <th>'.$row['ID'].'</th>
         <th>'.$row['PRODUCT_ID'].'</th>
         <th>'.$row['PRODUCT_NAME'].'</th>
         <th>'.$row['PRODUCT_PRICE'].'</th>
         <th>'.$row['PRODUCT_ARTICLE'].'</th>
         <th id="buttons"> 
         <button type="button" data-action="sub" data-id = "'.$row['ID'].'"  class="sub form__button "  style="padding: 10px !important;"> - </button>
         <p id="qantity'. $row['ID'].'">'. $row['PRODUCT_QUANTITY'].'</p>
         <button type="button" data-action="add" data-id = "'.$row['ID'].'" class="add form__button" style="padding: 10px !important;"> + </button>
          </th>
         <th>'.$row['DATE_CREATE'].'</th>
         <th id="buttons">
         <button data-action="hide"  data-id = "'.$row['ID'].'" class="hide form__button"> Скрыть <button>
          </th> </tr>';
    
      
   }

  $table .=$tbody.'</tbody> </table>';

  echo $table;
 }

 public function actionHide($id)
 {
   $result = CProducts::hideRow($id);
   echo 'Элемент скрыт';
 }

 public function actionAdd($add)
 {
   $qantity = CProducts::getQantity($add);
   $qantity_new = $qantity["PRODUCT_QUANTITY"] + 1 ;
   $updated = CProducts::updateQantity($add,$qantity_new );
   $result =  CProducts::getQantity($add);
   echo  $result["PRODUCT_QUANTITY"];
 }

 
 public function actionSub($sub)
 {
   $qantity = CProducts::getQantity($sub);
   $qantity_new  = $qantity["PRODUCT_QUANTITY"] - 1;
   $updated =  CProducts::updateQantity($sub,$qantity_new );
   $result =  CProducts::getQantity($sub);
   echo  $result["PRODUCT_QUANTITY"];
 }


}
