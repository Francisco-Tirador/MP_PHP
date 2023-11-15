


    <?php 
require 'preference.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<script src="https://sdk.mercadopago.com/js/v2"></script>
<h3>Mercado pago</h3>

<div class="btn-pago"></div>

<script>
const mp = new MercadoPago('TEST-fac03b79-4b89-466d-8ac8-66ee3dfad7e4',{
    locate:'es-MX'
});

mp.checkout({
    preference:{
        id:'<?php echo $preference->id;?>'
    },
    render:{
        container:'.btn-pago',
        label:"Pagar"
    }
})

</script>
</body>
</html>