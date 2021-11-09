function makeOrder(productName,type)
{
    // productName - ceratin product name 'string', type - type of product 'string' eg. MARGARITA,pizza   
    $.ajax({
        type: 'post',
        url: 'server.php',
        data: { productName: productName, type: type },
        success: function(){location.href = "order.php"}
    });
}