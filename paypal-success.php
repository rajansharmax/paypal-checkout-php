<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Paypal - payment</title>
    <link href="assets/style.css?v=<?php rand(999, 9999) ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <meta name="theme-color" content="#7952b3">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

</head>

<body class="bg-light">
    <?php
    session_start();
    // Print the data on the success page
    if (isset($_SESSION['paypal_data']) && isset($_GET['code']) && strlen($_GET['code']) == 13) {
        $data = $_SESSION['paypal_data'];
        ?>
        <div class="container-sm">
            <div class="col-lg-10 mx-auto">
                <main>
                    <div class="px-4 py-5 my-5 text-center">
                        <h1 class="display-5 fw-bold">successful payment</h1>
                        <h1 class="display-5 fw-bold">
                            <?php echo $data['currency'] ?>
                            <?php echo $data['amount'] ?>
                        </h1>
                        <div class="col-lg-6 mx-auto card-success">
                            <p class="lead mb-4">Iphone 14 Pro</p>
                            <div class="iphone">
                                <header class="header">
                                    <div>
                                        <img class="img_product" src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone-14-pro-model-unselect-gallery-2-202209?wid=5120&hei=2880&fmt=p-jpg&qlt=80&.v=1660753617559">
                                    </div>
                                </header>
                                <header class="header">
                                    <h1 style="font-size: 17px;">successful payment</h1>
                                </header>
                                <hr class="my-4">

                                <div>
                                    <h2>Iphone 14 <strong>Pro</strong></h2>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="buyer">Buyer Name</td>
                                                <td align="right">
                                                    <?php echo $data['data']['payer']['name']['given_name'] . ' ' . $data['data']['payer']['name']['surname'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="buyer">Buyer Email</td>
                                                <td align="right">
                                                    <?php echo $data['data']['payer']['email_address'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="buyer">Payer id</td>
                                                <td align="right">
                                                    <?php echo $data['data']['payer']['payer_id'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="buyer">Address</td>
                                                <td align="right">
                                                    <?php echo $data['data']['purchase_units'][0]['shipping']['name']['full_name'] ?>
                                                    <br>
                                                    <?php echo $data['data']['purchase_units'][0]['shipping']['address']['address_line_1'] . '<br>' .
                                                        $data['data']['purchase_units'][0]['shipping']['address']['admin_area_2'] . '<br>' .
                                                        $data['data']['purchase_units'][0]['shipping']['address']['admin_area_1'] . '<br>' .
                                                        $data['data']['purchase_units'][0]['shipping']['address']['postal_code'] . '<br>' .
                                                        $data['data']['purchase_units'][0]['shipping']['address']['country_code'] . '<br>'
                                                        ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="buyer">Status</td>
                                                <td align="right">
                                                    <?php echo $data['status'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="buyer">Price Total</td>
                                                <td align="right" id="amount" data-amount="5100">
                                                    <?php echo $data['currency'] ?>
                                                    <?php echo $data['amount'] ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td>Total</td>
                                                <td align="right">
                                                    <?php echo $data['currency'] ?>
                                                    <?php echo $data['amount'] ?>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div>
                                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                                    <a href="index.php" class="btn btn-primary btn-lg px-4 gap-3">Home</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">&copy; 2023 Paypal checkout payment</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Support</a></li>
            </ul>
        </footer>
        </div>
        <?php
    } else {
        ?>
        <div>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <a href="index.php" class="btn btn-primary btn-lg px-4 gap-3">Home</a>
            </div>
        </div>
        <?php
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>


</body>

</html>