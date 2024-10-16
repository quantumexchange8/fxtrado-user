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
                    @elseif($transaction->status === 'Processing')
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

  <script>
    const deposit = () => {
        document.getElementById('depositForm').submit();
    }
  </script>
@endsection