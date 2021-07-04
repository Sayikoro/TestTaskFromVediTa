<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Продукты</title>
    <link rel="stylesheet" href="<?ROOT?>/Views/Template/productTable1.css">
  </head>
<body>
    <header class = 'center'> 
    <h2>Введите количество строк</h2>
    <div class="form center">
      <input type="text" id='qantity_rows' class="form__input" placeholder="Количество отображаемых строк">
      <button class='form__button' id='button_show'> Показать</button>
    </div>

    </header>
    <section class='container '> 
        <section id='content'>
        <table id="products" >
      <thead >
       <tr>
        <td> ID </td>
        <td> PRODUCT_ID </td> 
        <td> PRODUCT_NAME </td> 
        <td> PRODUCT_PRICE </td> 
        <td> PRODUCT_ARTICLE </td> 
        <td> PRODUCT_QUANTITY </td> 
        <td> DATE_CREATE </td> 
        <td> VISIBILITY </td> 
       </tr> 
      </thead>
      <tbody >
         
      <?foreach ($products as $row):?>
  
     <tr id = '<? echo $row['ID']?>'> <th> <? echo $row['ID']?></th>
        <th><? echo $row['PRODUCT_ID']?></th>
        <th><? echo $row['PRODUCT_NAME']?></th>
        <th><? echo $row['PRODUCT_PRICE']?></th>
        <th><? echo $row['PRODUCT_ARTICLE']?></th>
        <th id='buttons'> 
            <button type="button" data-action='sub' data-id ='<?echo $row['ID']?>'  class="form__button sub"  style="padding: 10px !important;"> - </button>
         <p id='qantity<?echo $row['ID']?>'><? echo $row['PRODUCT_QUANTITY']?></p> 
         <button type="button" data-action='add' data-id = '<?echo $row['ID']?>'class="form__button add" style="padding: 10px !important;"> + </button>
        </th>
        <th><? echo $row['DATE_CREATE']?></th>
        <th id='buttons'> <button data-action='hide'  data-id = '<? echo $row['ID']?>' class="form__button hide"> Скрыть <button></th> </tr>
   
        <?endforeach;?>
    
        </tbody> </table>


    </section>  
</section>

    

<style>




 </style>
<script src="<?ROOT?>/Views/Template/jquery.js"></script>
<script>

 


 $(document).ready(function() {
    $('#button_show').on('click',  Show);
});

$( document ).on( "click", 'button', function() {
id = $(this).data('id');
action = $(this).data('action');

switch (action) {
    case "hide":
        postoservhide(id);
        break;
    case "add":
        postoservadd(id)
        break;
    case "sub":
        postoservsub(id)
        break;
}
});

    function postoservhide(id) {
        $("#"+id).hide();
        $.ajax({
            url: "hide/"+id,
            type: "POST",
            success: (function( respond ) { console.log(respond) }),
    });
    }

    function postoservadd(id) {
        $.ajax({
            url: "/add/"+id,
            type: "POST",
            success: (function( respond ) {  addtohtml(respond,id); })
            });}
    function postoservsub(id) {
        $.ajax({
            url: "/sub/"+id,
            type: "POST",
            success: (function( respond ) {  addtohtml(respond,id); })
            });
            }
    function addtohtml(respond,id) {
        $('#qantity'+id ).empty();
        $('#qantity'+id ).html(respond);
        console.log(respond)
        
    }



function Show() {

    qantity = $('#qantity_rows').val();
    if (qantity == '')
    {
    alert('Введите число строк');
    }
    else {
    qantity = Number(qantity)
     if (isNaN(qantity))
     { alert('Введите число строк');   }
     else {

        $.ajax({
            url: '/show/'+ qantity,
            type: "POST",
            cache       : false,
            processData : false,
            contentType : false,
            success: (function( respond ) {   
                $('#content').html('');
                $('#content').html(respond); })
            });
    }
}

}


</script>
</body>
</html>