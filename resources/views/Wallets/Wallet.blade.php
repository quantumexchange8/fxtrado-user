@extends('layouts.master')
@section('contents')
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
            <h2 class="exchange__widget-title">Latest Activity</h2>
            <table class="table">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Transaction Number</th>
                  <th>Amount</th>
                  <th>From Wallet</th>
                  <th>To Wallet</th>
                  <th>TxID</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody class="exchange__widget__table">
                @foreach ($transactions as $transaction)
                  <tr>
                    <td>{{ $transaction->created_at }}</td>
                    <td>{{ $transaction->transaction_number }}</td>
                    <td>{{ $transaction->amount ? $transaction->amount : '0.00' }}</td>
                    <td>{{ $transaction->from_wallet ?  $transaction->from_wallet : '-'}}</td>
                    <td>{{ $transaction->to_wallet ?  $transaction->to_wallet : '-'}}</td>
                    <td>{{ $transaction->txid ?  $transaction->txid : '-'}}</td>
                    <td class="red">{{ $transaction->status}}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        {{-- <div class="col-md-5">
          <div class="exchange__widget">
            <h2 class="exchange__widget-title">Wallets</h2>
            <div class="exchange__wallet-card">
              <div class="exchange__wallet-card-item">
                <span>
                  <img src="assets/img/coin/btc.svg" class="svgInject" alt="svg">
                </span>
                <h2>BTC balance</h2>
                <h3>4.373 BTC</h3>
                <p>$94,331.45</p>
                <a href="#"><img src="assets/img/svg-icon/up-arrow.svg" class="svgInject" alt="svg"> Send BTC</a>
                <a href="#"><img src="assets/img/svg-icon/down-arrow.svg" class="svgInject" alt="svg"> Request BTC</a>
              </div>
              <div class="exchange__wallet-card-item">
                <span>
                  <img src="assets/img/coin/eth.svg" class="svgInject" alt="svg">
                </span>
                <h2>ETH balance</h2>
                <h3>22.324 ETH</h3>
                <p>$44,331.45</p>
                <a href="#"><img src="assets/img/svg-icon/up-arrow.svg" class="svgInject" alt="svg"> Send ETH</a>
                <a href="#"><img src="assets/img/svg-icon/down-arrow.svg" class="svgInject" alt="svg"> Request ETH</a>
              </div>
              <div class="exchange__wallet-card-item">
                <span>
                  <img src="assets/img/coin/cvc.svg" class="svgInject" alt="svg">
                </span>
                <h2>CVC balance</h2>
                <h3>4.373 CVC</h3>
                <p>$94,331.45</p>
                <a href="#"><img src="assets/img/svg-icon/up-arrow.svg" class="svgInject" alt="svg"> Send CVC</a>
                <a href="#"><img src="assets/img/svg-icon/down-arrow.svg" class="svgInject" alt="svg"> Request CVC</a>
              </div>
            </div>
            <div class="exchange__widget-card-add">
              <button><img src="assets/img/svg-icon/plus.svg" class="svgInject" alt="svg"> Add new wallet</button>
            </div>
          </div>
        </div> --}}
      </div>
    </div>
  </div>

  <script>
    const deposit = () => {
        document.getElementById('depositForm').submit();
    }
  </script>
@endsection