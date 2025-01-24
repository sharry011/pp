<div class="container mt-5">
    <h2>Invoice #{{ $invoice->id }}</h2>

    <div class="row">
        <div class="col-md-6">
            <p><strong>Client:</strong> {{ $invoice->client_name }}</p>
            <p><strong>Project:</strong> {{ $invoice->project_name }}</p>
        </div>
        <div class="col-md-6 text-right">
            <p><strong>Date:</strong> {{ \Carbon\Carbon::now()->format('Y-m-d') }}</p>
        </div>
    </div>

    <table class="table table-bordered">
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

    <div class="text-right">
        <h3>Total: ${{ $invoice->price }}</h3>
        <a href="{{ route('invoices.download', $invoice->id) }}" class="btn btn-primary">Download PDF</a>
    </div>
</div>
