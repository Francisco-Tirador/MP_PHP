<html>
    <head>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
      <div id="cardPaymentBrick_container"></div>
     
      <script>
        const mp = new MercadoPago('TEST-fac03b79-4b89-466d-8ac8-66ee3dfad7e4', {
          locale: 'es-MX'
        });
        const bricksBuilder = mp.bricks({ theme: 'dark' });
        const renderCardPaymentBrick = async (bricksBuilder) => {
          const settings = {
            initialization: {
              amount: 100, // monto a ser pago
              payer: {
                email: "",
              },
            },
            customization: {
              visual: {
                style: {
                  customVariables: {
                    theme: 'dark', // | 'dark' | 'bootstrap' | 'flat'
                  }
                }
              },
                paymentMethods: {
                  maxInstallments: 1,
                }
            },
            callbacks: {
              onReady: () => {
                // callback llamado cuando Brick esté listo
                console.log("estoy listo")
              },
              onSubmit: (cardFormData) => {
                //  callback llamado cuando el usuario haga clic en el botón enviar los datos
                //  ejemplo de envío de los datos recolectados por el Brick a su servidor
                return new Promise((resolve, reject) => {
                    console.log( JSON.stringify(cardFormData))
                  fetch("https://trackjc.com/sasammr/MercadoPago/proces_pyment.php", {
                    method: "POST",
                    headers: {
                      "Content-Type": "application/json",
                      "Authorization":"Bearer TEST-8971847217814918-011912-8ad91745874530a4ca8b8992d4799fdf-1283156318"
                    },
                    body: JSON.stringify(cardFormData)
                  })
                    .then((response) => {
                      // recibir el resultado del pago
                      console.log(response.body)
                      resolve();
                    })
                    .catch((error) => {
                        console.log(response)
                      // tratar respuesta de error al intentar crear el pago
                      reject();
                    })
                });
              },
              onError: (error) => {
                console.log("aqui hay un error :",error)
                // callback llamado para todos los casos de error de Brick
              },
            },
          };
          window.cardPaymentBrickController = await bricksBuilder.create('cardPayment', 'cardPaymentBrick_container', settings);
        };
        renderCardPaymentBrick(bricksBuilder);
      </script>
      
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
    </html>

