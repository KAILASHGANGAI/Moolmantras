<!-- resources/views/bill.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Checkout Bill</title>
    <style>
        /* Add your styles for the bill content */
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        #printButton {
            display: inline-block;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
        }

        @media print {
            #printButton {
                display: none;
                /* Hide the print button when printing */
            }

            .link {
                display: none;
            }

            #container {
                width: 100%;
                /* Expand container to full width when printing */
                margin: 0;
                /* Remove margins when printing */
            }
        }

        /* Add more styles as needed */
    </style>
</head>

<body>
    <a class="link" href="{{ url('/') }}">Go Home</a>
    <a class="link" href="{{ url()->previous() }}">Go Back</a>

    <!-- Company Logo and Details -->
    <div class="company-details text-center">
        <img src="{{ asset('path-to-your-company-logo.png') }}" alt="Company Logo" class="company-logo">
        <h4>Your Company Name</h4>
        <span>Your Company Address</span> <br>
        <span>Your Company Phone</span>
        <!-- Add more company details as needed -->
    </div>


    <!-- Bill Content -->
    <div class="bill-content">
        <!-- Include the actual content of the bill -->
        <h6 class="text-center">Checkout Bill</h6>
        <!-- Add bill details here -->
        <div class="d-flex justify-content-between flex-row px-4">
            <div>
                <span>Order ID:{{ $order->id }}</span> <br>
                <span>Customer Name:{{ $order->customer }}</span> <br>
                <span>Customer ID:{{ $order->customer }}</span>
            </div>
            <div class="">
                <span>Payed Amount:{{ $order->pay_amount }}</span> <br>
                <span>Due Amount :{{ $order->due }}</span> <br>
                <span>Payed By :{{ $order->payby }}</span>
            </div>
        </div>
        <!-- Include more details as needed -->

        <!-- Example: Display items in the order -->
        <table>
            <thead>
                <tr>
                    <th>S.N</th>
                    <th>Products</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>SubTotal</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($order->orderDetails as $key => $item)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $item->product->product_name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rs. {{ $item->price }}</td>
                        <td>Rs.{{ $item->quantity * $item->price }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2" class="text-center"> Total </td>
                    <td>{{ $order->quantity }}</td>
                    <td colspan="2" class="text-center">Rs. {{ $order->total }}</td>
                </tr> --}}
            </tbody>

        </table>
        <div class="py-5">
            <span>_______________</span> <br>
            <span>Signature</span>
        </div>
        <div>
            <div class="text-center">
                Thank you for your business!<br />
                Please come again!
            </div>

        </div>
        <button type="submit" id="printButton" onclick="printBill()" class="btn btn-success mt-2">
            Make Print
        </button>
        <hr>
    </div>

    </div>

    <!-- Add more bill content as needed -->
    </div>

    <!-- Add your JavaScript if necessary (e.g., for triggering print) -->
    <script>
        function printBill() {
            // Hide the print button before printing
            document.getElementById('printButton').style.display = 'none';

            // Trigger the browser's print functionality
            window.print();

            // Show the print button after printing is done
            document.getElementById('printButton').style.display = 'block';
        }
    </script>
</body>

</html>
