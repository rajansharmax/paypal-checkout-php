<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Paypal - payment integration</title>
    <link href="assets/style.css?v=1.0" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="theme-color" content="#7952b3">
</head>

<body>
    <div class="container-sm">
        <div class="col-lg-10 mx-auto">
            <main>
                <div class="text-center">
                    <img class="d-block mx-auto mb-4" src="assets/paypal.png" width="72">

                </div>
            </main>
        </div>
    </div>
    <div class="iphone">
        <header class="header">
            <h1 style="font-size: 17px;">Checkout</h1>
        </header>

        <div>
            <img class="img_product"
                src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone-14-pro-model-unselect-gallery-2-202209?wid=5120&hei=2880&fmt=p-jpg&qlt=80&.v=1660753617559">

        </div>
        <hr class="my-4">

        <div>
            <h2>Iphone 14 <strong>Pro</strong></h2>

            <table>
                <tbody>
                    <tr>
                        <td>Shipping fee</td>
                        <td align="right">$20.00</td>
                    </tr>
                    <tr>
                        <td>Discount 10%</td>
                        <td align="right">-$80.00</td>
                    </tr>
                    <tr>
                        <td>Price Total</td>
                        <td align="right" id="amount" data-amount="510">$510</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td>Total</td>
                        <td align="right">$510</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div>
            <!-- Paypal payment button -->
            <div class="text-center w-100">
                <fieldset class="field-set-wrapper">
                    <legend>Paypal Checkout</legend>
                    <!-- Set up a container element for the button -->
                    <div id="paypal-button-container"></div>
                </fieldset>
            </div>
        </div>
        </form>
    </div>
    <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">&copy; 2023 Paypal checkout payment</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Support</a></li>
            </ul>
        </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.2.min.js"></script>
    <!-- Paypal JavaScript library -->
    <script
        src="https://www.paypal.com/sdk/js?client-id=AQaydG9IRngJq-6Fw-zxRp0fp--Y5fKozNfUvlGrLMep-FYwJ1ONK_BwqZu2Lqg2WPVQAS1g-hREVpQB&buyer-country=US&currency=USD&enable-funding=paylater"></script>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script>
        const amount = $('#amount').data('amount');
        paypal.Buttons({
            style: {
                layout: 'vertical',
                 label:  'paypal',
                height: 50,
                margin: 'auto',
            },
            createOrder: function (data, actions) {
                // Set up the details of the transaction, including the amount and line item details.
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: amount
                        }
                    }]
                }).catch(function (error) {
                    console.log('An error occurred while creating the order:', error);
                    // Add code to handle the error, such as displaying an error message to the user.
                });
            },
            onApprove: function (data, actions) {
                // Capture the funds from the transaction.
                return actions.order.capture().then(function (details) {
                    console.log('Transaction completed:', details);
                    paypalResponseHandler(details);
                }).catch(function (error) {
                    console.log('An error occurred while capturing the funds:', error);
                    // Add code to handle the error, such as displaying an error message to the user.
                });
            },
        }).render('#paypal-button-container');


        $('#meuModal').on('shown.bs.modal', function () {
            $('#meuInput').trigger('focus')
        })

        function paypalResponseHandler(paypal_data) {
            console.log('paypal success', paypal_data);
            // Get the data from the POST request and store in session
            $.ajax({
                url: 'store-data-in-session.php',
                type: 'post',
                data: {
                    id: paypal_data.id,
                    payer: paypal_data.payer.payer_id,
                    intent: paypal_data.intent,
                    status: paypal_data.status,
                    currency: paypal_data.purchase_units[0].amount.currency_code,
                    amount: paypal_data.purchase_units[0].amount.value,
                    data: JSON.stringify(paypal_data)
                },
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if (response.success) {
                        // Redirect to the success page
                        window.location.href = 'paypal-success.php?code=' + paypal_data.payer.payer_id;
                    } else {
                        // Show error message
                        alert(response.error);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log('xhr error', xhr);
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    if (xhr.status == 0) {
                        alert("No internet");
                    }
                }
            });


        }
    </script>
</body>

</html>