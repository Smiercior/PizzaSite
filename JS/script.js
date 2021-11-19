function makeOrder(productName, productComposition, productPrice, img)
{
    $.ajax({
        type: 'post',
        url: 'server.php',
        data: { productName: productName, productComposition: productComposition, productPrice: productPrice, productImg: img },
        success: function(){location.href = "order.php"}
    });
}