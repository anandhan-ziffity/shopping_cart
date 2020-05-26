
<script>
// Quantity spin buttons
            $(document).ready(function(){
                $('.input-text.qty').on('blur keydown keypress keyup', function(e){
                if($(this).val().match(/^0/)){
                    $(this).val(1);
                    return false;
                }

                if($(this).val() == '') {
                    $(this).val(1);
                    return false;
                }
                if($(this).val() > 1000) {                    
                    return false;
                }
            });
            $('.qtyplus').on('click',function (e) {
                console.log("anandha");
                e.preventDefault();
                var qty = 1;
                $(this).prev().val(
                    parseInt($(this).prev().val()) + qty
                );
            });
            $(".qtyminus").unbind().click(function (e) {
                e.preventDefault();
                var qty = 1;
                if(parseInt($(this).next().val()) > qty) {
                    $(this).next().val(
                        parseInt($(this).next().val()) - qty
                    );                    
                } else {
                    $(this).next().val(1);
                }
            });
        

            })
         

</script>

<?php

function component($productname, $productprice, $productimg,$productsku, $productid){
    
    $element = "
    
            <tr>                              
                <td class=\"item\"><img src=\"$productimg\" /><span>$productname</span></td>                        
                <td>$productsku</td>
                <td>$$productprice</td>
                <td class=\"action\">  
                <form action=\"index.php\" method=\"post\">                         
                <div class=\"col-md-3 py-5\">
                    <div class=\"qty-section\">
                        <button type=\"button\"  name=\"decrement\"  class=\"btn bg-light border qtyminus\"><i class=\"fas fa-minus\"></i></button>
                        <input type=\"text\" name=\"qty\" value=\"1\" min=\"1\" max=\"1000\" class=\"input-text qty form-control d-inline\" id=\"qty1\"/>
                        <button type=\"button\"   name=\"increment\" class=\"btn bg-light border qtyplus\"><i class=\"fas fa-plus\"></i></button>
                    </div>             
                
                </div>          
                    <button type=\"submit\" class=\"btn btn-warning my-3\" name=\"add\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button>
                    <input type='hidden' name='product_id' value='$productid'>                    
                 
                </form>                                                    
                  </td>                
            </tr> 
        
    ";
    echo $element;
   
    
}


function cartElement($productimg, $productname, $productprice, $productsku,$productid){    

    $element = "
    
    <form action=\"cart.php?action=remove&id=$productid\" method=\"post\" class=\"cart-items\">
                    <div class=\"border rounded\">
                        <div class=\"row bg-white\">
                            <div class=\"col-md-3 pl-0\">
                                <img src=$productimg alt=\"Image1\" class=\"img-fluid\">
                            </div>
                            <div class=\"col-md-6\">
                                <h5 class=\"pt-2\">$productname</h5>                               
                                <h5 class=\"pt-2\">$$productprice</h5>                               
                                <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
                            </div>
                           
                        </div>
                    </div>
                </form>
    
    ";
    echo  $element;
}

















