<div>
    @foreach($totalBalance as $row)
       <label class="alert alert-secondary fw-bold fs-5 text-uppercase" role="alert">Balance : {{ $row['total_amount'] }} {{ $row['transaction_currency'] }}</label>
    @endforeach
</div>