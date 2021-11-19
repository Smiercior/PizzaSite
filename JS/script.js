function makeOrder(productName, productComposition, productPrice, img)
{
    // productName - ceratin product name 'string', type - type of product 'string' eg. MARGARITA,pizza  
    $.ajax({
        type: 'post',
        url: 'server.php',
        data: { productName: productName, productComposition: productComposition, productPrice: productPrice, productImg: img },
        success: function(){location.href = "order.php"}
    });
}