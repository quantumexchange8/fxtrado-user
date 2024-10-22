@extends('layouts.master')
@section('contents')

<style>
  .ellipse {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    max-width: 200px;
  }
</style>

<div class="exchange__wrapper">
    <div class="container-fluid">
      <div class="row sm-gutters">

        @include('layouts.topbar')

        <div class="col-md-12">
          <div class="exchange__widget">
            <h2 class="exchange__widget-title">Account</h2>
            <div class="exchange__wallet-account">
              <div class="row">
                <div class="col-lg-12 col-xl-6">
                  <div class="exchange__widget-account-info">
                    <h3>Available balance</h3>
                    <h2>$ {{ Auth::user()->wallet->balance ?? '0.00' }}</h2>
                  </div>

                    {{-- deposit --}}
                    <button class="btn-green my-3" type="button" onclick="deposit()">Deposit</button>
                    <form id="depositForm" action="{{ route('wallet.deposit') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                    {{-- withdrawal --}}
                    <button class="btn-red">Withdraw</button>

                </div>
                {{-- <div class="col-lg-12 col-xl-6">
                  <div id="walletVolume"></div>
                </div> --}}
              </div>
            </div>
          </div>
          <div class="exchange__widget">
            <div class="">
              <div class="text-white text-sm w-10">
                Latest Activity
              </div>
              <div class="text-white">
                
              </div>
            </div>
            <table class="table">
              <thead>
                <tr>
                  <th style="max-width: 200px">Date</th>
                  <th>Transaction Number</th>
                  <th>Amount</th>
                  {{-- <th>From Wallet</th>
                  <th>To Wallet</th> --}}
                  <th>TxID</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody class="exchange__widget__table">
                @foreach ($transactions as $transaction)
                  <tr>
                    <td style="max-width: 200px">{{ $transaction->created_at }}</td>
                    <td>{{ $transaction->transaction_number }}</td>
                    <td>{{ $transaction->amount ? $transaction->amount : '0.00' }}</td>
                    {{-- <td class="text-ellipsis overflow-hidden">{{ $transaction->from_wallet ?  $transaction->from_wallet : '-'}}</td>
                    <td>{{ $transaction->to_wallet ?  $transaction->to_wallet : '-'}}</td> --}}
                    <td class="ellipse">{{ $transaction->txid ?  $transaction->txid : '-'}}</td>
                    
                    @if ($transaction->status === 'successful')
                      <td class="green">
                        {{ $transaction->status}}
                      </td>
                    @elseif($transaction->status === 'processing')
                      <td class="blue">
                        {{ $transaction->status}}
                      </td>
                    @else
                      <td class="red">
                        {{ $transaction->status}}
                      </td>
                    @endif
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- Withdraw Modal -->
<div class="modal fade" id="withdrawModal" tabindex="-1" aria-labelledby="withdrawModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="withdrawModalLabel">Withdraw</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="border:none">X</button>
        </div>
        <div class="modal-body">
            <form id="withdrawForm">
                <!-- Your form fields go here -->
                <div class="mb-3">
                  <label for="wallet_address" class="form-label">Wallet Address</label>
                  <input type="text" class="form-control" id="wallet_address" required>
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" class="form-control" id="amount" required max="{{ Auth::user()->wallet->balance }}">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-close" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="submitWithdraw">Withdraw</button>
        </div>
      </div>
  </div>
</div>


  <script>
    const deposit = () => {
        document.getElementById('depositForm').submit();
    }
  </script>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script>
    $(document).ready(function() {
        $('.btn-red').on('click', function() {
            $('#withdrawModal').modal('show');
        });

        $('.btn-close').on('click', function() {
            $('#withdrawModal').modal('hide');
        });
    
        $('#submitWithdraw').on('click', function() {
            // Get the values from the form
            const amount = $('#amount').val();
            const wallet_address = $('#wallet_address').val();
    
            // Make an API call to your Laravel backend to process the withdrawal
            axios.post('/withdrawal', {
                amount: amount,
                wallet_address: wallet_address,
            })
            .then(response => {
                // Handle success (e.g., show a success message)
                Toastify({
                    text: "Withdrawal successful!",
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "green",
                }).showToast();
                // Optionally close the modal
                $('#withdrawModal').modal('hide');
            })
            .catch(error => {
                // Handle error (e.g., show an error message)
                const errorMessage = error.response && error.response.data.error 
                  ? error.response.data.error 
                  : 'Withdrawal failed!';

                Toastify({
                    text: errorMessage,
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "red",
                }).showToast();
            });
        });
    });
  </script>
  
@endsection