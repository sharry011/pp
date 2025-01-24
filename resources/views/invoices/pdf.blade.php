<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .invoice-table th, .invoice-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .invoice-total {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="invoice-header">
        <h2>Invoice #{{ $invoice->id }}</h2>
        <p><strong>Client:</strong> {{ $invoice->client_name }}</p>
        <p><strong>Project:</strong> {{ $invoice->project_name }}</p>
        <p><strong>Date:</strong> {{ \Carbon\Carbon::now()->format('Y-m-d') }}</p>
    </div>

    <table class="invoice-table">
        <thead>
            <tr>
                <th>Category</th>
                <th>Description</th>
                <th>Price ($)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $invoice->category }}</td>
                <td>{{ $invoice->description }}</td>
                <td>${{ $invoice->price }}</td>
            </tr>
        </tbody>
    </table>

    <div class="invoice-total">
        <h3>Total: ${{ $invoice->price }}</h3>
    </div>
</body>
</html>
