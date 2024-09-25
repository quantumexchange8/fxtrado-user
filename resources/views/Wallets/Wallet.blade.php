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
                  <th>Name</th>
                  <th>Date</th>
                  <th>Amount</th>
                  <th>Price</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody class="exchange__widget__table">
                <tr>
                  <td><img src="assets/img/coin/btc.svg" class="svgInject" alt="svg"> Btc</td>
                  <td>21.02.2021</td>
                  <td>0.543</td>
                  <td>$458.33</td>
                  <td class="red">Withdraw</td>
                </tr>
                <tr>
                  <td><img src="assets/img/coin/act.svg" class="svgInject" alt="svg"> act</td>
                  <td>12.02.2021</td>
                  <td>0.223</td>
                  <td>$432.33</td>
                  <td class="green">Deposit</td>
                </tr>
                <tr>
                  <td><img src="assets/img/coin/add.svg" class="svgInject" alt="svg"> add</td>
                  <td>21.02.2021</td>
                  <td>0.543</td>
                  <td>$458.33</td>
                  <td class="red">Withdraw</td>
                </tr>
                <tr>
                  <td><img src="assets/img/coin/agi.svg" class="svgInject" alt="svg"> agi</td>
                  <td>12.02.2021</td>
                  <td>0.223</td>
                  <td>$432.33</td>
                  <td class="green">Deposit</td>
                </tr>
                <tr>
                  <td><img src="assets/img/coin/amp.svg" class="svgInject" alt="svg"> amp</td>
                  <td>21.02.2021</td>
                  <td>0.543</td>
                  <td>$458.33</td>
                  <td class="red">Withdraw</td>
                </tr>
                <tr>
                  <td><img src="assets/img/coin/bab.svg" class="svgInject" alt="svg"> bab</td>
                  <td>12.02.2021</td>
                  <td>0.223</td>
                  <td>$432.33</td>
                  <td class="green">Deposit</td>
                </tr>
                <tr>
                  <td><img src="assets/img/coin/bdl.svg" class="svgInject" alt="svg"> bdl</td>
                  <td>21.02.2021</td>
                  <td>0.543</td>
                  <td>$458.33</td>
                  <td class="red">Withdraw</td>
                </tr>
                <tr>
                  <td><img src="assets/img/coin/bch.svg" class="svgInject" alt="svg"> bch</td>
                  <td>12.02.2021</td>
                  <td>0.223</td>
                  <td>$432.33</td>
                  <td class="green">Deposit</td>
                </tr>
                <tr>
                  <td><img src="assets/img/coin/cdn.svg" class="svgInject" alt="svg"> cdn</td>
                  <td>21.02.2021</td>
                  <td>0.543</td>
                  <td>$458.33</td>
                  <td class="red">Withdraw</td>
                </tr>
                <tr>
                  <td><img src="assets/img/coin/cob.svg" class="svgInject" alt="svg"> cob</td>
                  <td>12.02.2021</td>
                  <td>0.223</td>
                  <td>$432.33</td>
                  <td class="green">Deposit</td>
                </tr>
                <tr>
                  <td><img src="assets/img/coin/dew.svg" class="svgInject" alt="svg"> dew</td>
                  <td>21.02.2021</td>
                  <td>0.543</td>
                  <td>$458.33</td>
                  <td class="red">Withdraw</td>
                </tr>
                <tr>
                  <td><img src="assets/img/coin/cvc.svg" class="svgInject" alt="svg"> cvc</td>
                  <td>12.02.2021</td>
                  <td>0.223</td>
                  <td>$432.33</td>
                  <td class="green">Deposit</td>
                </tr>
                <tr>
                  <td><img src="assets/img/coin/elf.svg" class="svgInject" alt="svg"> elf</td>
                  <td>21.02.2021</td>
                  <td>0.543</td>
                  <td>$458.33</td>
                  <td class="red">Withdraw</td>
                </tr>
                <tr>
                  <td><img src="assets/img/coin/beam.svg" class="svgInject" alt="svg"> beam</td>
                  <td>12.02.2021</td>
                  <td>0.223</td>
                  <td>$432.33</td>
                  <td class="green">Deposit</td>
                </tr>
                <tr>
                  <td><img src="assets/img/coin/bnty.svg" class="svgInject" alt="svg"> bnty</td>
                  <td>21.02.2021</td>
                  <td>0.543</td>
                  <td>$458.33</td>
                  <td class="red">Withdraw</td>
                </tr>
                <tr>
                  <td><img src="assets/img/coin/btcz.svg" class="svgInject" alt="svg"> btcz</td>
                  <td>12.02.2021</td>
                  <td>0.223</td>
                  <td>$432.33</td>
                  <td class="green">Deposit</td>
                </tr>
                <tr>
                  <td><img src="assets/img/coin/chain.svg" class="svgInject" alt="svg"> chain</td>
                  <td>21.02.2021</td>
                  <td>0.543</td>
                  <td>$458.33</td>
                  <td class="red">Withdraw</td>
                </tr>
                <tr>
                  <td><img src="assets/img/coin/clam.svg" class="svgInject" alt="svg"> clam</td>
                  <td>12.02.2021</td>
                  <td>0.223</td>
                  <td>$432.33</td>
                  <td class="green">Deposit</td>
                </tr>
                <tr>
                  <td><img src="assets/img/coin/comp.svg" class="svgInject" alt="svg"> comp</td>
                  <td>21.02.2021</td>
                  <td>0.543</td>
                  <td>$458.33</td>
                  <td class="red">Withdraw</td>
                </tr>
                <tr>
                  <td><img src="assets/img/coin/coqui.svg" class="svgInject" alt="svg"> coqui</td>
                  <td>12.02.2021</td>
                  <td>0.223</td>
                  <td>$432.33</td>
                  <td class="green">Deposit</td>
                </tr>
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