@extends('layouts.master')
@section('contents')

<style>
  .ellipse {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    max-width: 200px;
  }

  @media (max-width: 768px) {
    .mobileHidden {
      display: none !important;
    }
  }
</style>

<div class="exchange__wrapper">
    <div class="container-fluid">
      <div class="row sm-gutters">

        @include('layouts.topbar')

        @if ( Auth::user()->email_verified_at == null)
          <div class="col-md-12">
            <div class="exchange__widget" style="background: #ca8a04;border-radius:6px">
              <div style="display: flex; gap:8px; align-items:center">
                <i class="fa fa-exclamation-circle" style="color: white" aria-hidden="true"></i> <span class="text-white text-xs" style="font-size:16px; font-weight:600">{{ __('verify_your_acc') }}.</span>
              </div>
            </div>
          </div>
        @endif
        <div class="col-md-12">
          <div class="exchange__widget">
            <h2 class="exchange__widget-title">{{ __('account') }}</h2>
            <div class="exchange__wallet-account">
              <div class="row">
                <div class="col-lg-12 col-xl-6">
                  <div class="exchange__widget-account-info">
                    <h3>{{ __('available_balance') }}</h3>
                    <h2>$ {{ Auth::user()->wallet->balance ?? '0.00' }}</h2>
                  </div>

                    {{-- deposit --}}
                    <button class="btn-green my-3" id="depositButton" type="button" onclick="deposit()">{{ __('deposit') }}</button>
                    <form id="depositForm" action="{{ route('wallet.deposit') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                    {{-- withdrawal --}}
                    @if ( Auth::user()->email_verified_at == null )
                      <button class="btn-red" disabled>{{ __('withdraw') }}</button>
                    @else
                      <button class="btn-red">{{ __('withdraw') }}</button>
                    @endif
                    
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
                {{ __('latest_activity') }}
              </div>
              <div class="text-white">
                
              </div>
            </div>
            <table class="table">
              <thead>
                <tr>
                  <th class="mobileHidden" style="max-width: 200px">{{ __('date') }}</th>
                  <th class="mobileHidden">{{ __('position_id') }}</th>
                  <th>{{ __('type') }}</th>
                  <th>{{ __('amount') }}</th>
                  {{-- <th>From Wallet</th>
                  <th>To Wallet</th> --}}
                  <th>{{ __('txid') }}</th>
                  <th>{{ __('status') }}</th>
                </tr>
              </thead>
              <tbody class="exchange__widget__table">
                @foreach ($transactions as $transaction)
                  <tr class="transaction-row" data-id="{{ $transaction->id }}" data-created-at="{{ $transaction->created_at }}" data-details="{{ $transaction }}">
                    <td class="mobileHidden" style="max-width: 200px">{{ $transaction->created_at }}</td>
                    <td class="mobileHidden">{{ $transaction->transaction_number }}</td>
                    @if ($transaction->transaction_type === 'Deposit')
                      <td>{{ __('deposit') }}</td>
                    @else
                      <td>{{ __('withdraw') }}</td>
                    @endif
                    
                    <td>{{ number_format($transaction->amount ?? 0, 2) }}</td>
                    {{-- <td class="ellipse">{{ $transaction->from_wallet ?  $transaction->from_wallet : '-'}}</td>
                    <td class="ellipse">{{ $transaction->to_wallet ?  $transaction->to_wallet : '-'}}</td> --}}
                    <td class="ellipse">{{ $transaction->txid ?  $transaction->txid : '-'}}</td>
                    
                    @if ($transaction->status === 'successful')
                      <td class="green">
                        {{ __('successfull') }}
                      </td>
                    @elseif($transaction->status === 'processing')
                      <td class="blue">
                        {{ __('processing') }}
                      </td>
                    @else
                      <td class="red">
                        {{ __('failed1') }}
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
            <h5 class="modal-title" id="withdrawModalLabel">{{ __('withdraw2') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="border:none">X</button>
        </div>
        <div class="modal-body">
            <form id="withdrawForm">
                <!-- Your form fields go here -->
                <div class="mb-3">
                  <label for="wallet_address" class="form-label">{{ __('wallet_address') }}</label>
                  <input type="text" class="form-control" id="wallet_address" required>
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">{{ __('amount') }}</label>
                    <input type="number" class="form-control" id="amount" required max="{{ Auth::user()->wallet->balance }}">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-close" data-bs-dismiss="modal">{{ __('close') }}</button>
            <button type="submit" class="btn btn-primary" id="submitWithdraw">{{ __('withdraw') }}</button>
        </div>
      </div>
  </div>
</div>

<!-- Transaction Modal -->
<div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-labelledby="transactionModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="transactionModalLabel">{{ __('transaction_detail') }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <div style="display: flex;flex-direction:column; gap:8px; padding:1px">
              <div style="display: flex; align-items: center;gap:8px">
                <span>{{ __('requested_date') }}: </span>
                <span style="font-weight: 600" id="modalCreatedAt"></span>
              </div>
              <div style="display: flex; align-items: center;gap:8px">
                <span>{{ __('position_id') }}: </span>
                <span style="font-weight: 600" id="transactionNumber"></span>
              </div>
              <div style="display: flex; align-items: center;gap:8px">
                <span>{{ __('transaction_type') }}: </span>
                <span style="font-weight: 600" id="type"></span>
              </div>
              <div style="display: flex; align-items: center;gap:8px">
                <span>{{ __('amount') }}: </span>
                <span style="font-weight: 600" id="amountData"></span>
              </div>
              <div style="display: flex; align-items: center;gap:8px">
                <span>{{ __('txid') }}: </span>
                <span style="font-weight: 600; max-width: 400px" class="ellipse" id="txid" ></span>
              </div>
              <div style="display: flex; align-items: center;gap:8px">
                <span>{{ __('from_wallet') }}: </span>
                <span style="font-weight: 600" id="sendAddress"></span>
              </div>
              <div style="display: flex; align-items: center;gap:8px">
                <span>{{ __('to_wallet') }}: </span>
                <span style="font-weight: 600" id="receiveAddress"></span>
              </div>
              <div style="display: flex; align-items: center;gap:8px">
                <span>{{ __('status') }}: </span>
                <span style="font-weight: 600" id="status"></span>
              </div>
              <div style="display: flex; align-items: center;gap:8px">
                <span>{{ __('remark') }}: </span>
                <span style="font-weight: 600" id="remark"></span>
              </div>
            </div>
              <!-- Add more fields as needed -->
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('close') }}</button>
          </div>
      </div>
  </div>
</div>


  <script>
    const deposit = () => {
        const depositButton = document.getElementById('depositButton');
        
        // Disable the button and change its background color
        depositButton.disabled = true;
        depositButton.style.setProperty('background', '#1f2937', 'important');
        
        // Optionally, you can change the button text to indicate processing
        depositButton.innerText = 'Processing...';

        // Submit the form
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

            const submitButton = $('#submitWithdraw');
            submitButton.prop('disabled', true);

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

                window.location.href = '/wallet';

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
            })
            .finally(() => {
                // Re-enable the button after processing (in case of success or error)
                submitButton.prop('disabled', false);
            });
        });
    });
  </script>

  <script>
    const translations = {
        transactionType: {
            Deposit: '{{ __('deposit') }}',
            Withdrawal: '{{ __('withdraw') }}',
            // Add more types as necessary
        },
        transactionStatus: {
          successful: '{{ __('successfull') }}',
          processing: '{{ __('processing') }}',
          failed: '{{ __('failed1') }}',
        }
    };
  </script>

  <script>
    document.querySelectorAll('.transaction-row').forEach(row => {
        row.addEventListener('click', () => {
            // Get data attributes from the clicked row
            const createdAt = row.getAttribute('data-created-at');
            const detailsString = row.getAttribute('data-details');
            const details = JSON.parse(detailsString);

            // Populate the modal with the data
            document.getElementById('modalCreatedAt').textContent = `${createdAt}`;
            document.getElementById('transactionNumber').textContent = `${details.transaction_number}`;
            document.getElementById('type').textContent = translations.transactionType[details.transaction_type] || details.transaction_type;
            document.getElementById('amountData').textContent = `${details.amount ? details.amount.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) : '0.00'}`;
            document.getElementById('txid').textContent = `${details.txid ? details.txid : '-'}`;
            document.getElementById('sendAddress').textContent = `${details.from_wallet ? details.from_wallet : '-'}`;
            document.getElementById('receiveAddress').textContent = `${details.to_wallet ? details.to_wallet : '-'}`;
            document.getElementById('status').textContent = translations.transactionStatus[details.status] || details.status;
            document.getElementById('remark').textContent = `${details.remark ? details.remark : '-' }`;

            // Show the modal
            $('#transactionModal').modal('show');
        });
    });
  </script>
  
@endsection