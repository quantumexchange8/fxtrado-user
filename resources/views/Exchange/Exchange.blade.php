@extends('layouts.master')
@section('contents')
    
<div class="exchange__wrapper">
    <div class="container-fluid">
      <div class="row sm-gutters">
        @include('layouts.topbar')
        <div class="col-lg-4 col-xl-3">
          <div class="exchange__widget">
            <h2 class="exchange__widget-title">Forex Symbols</h2>
            <div class="tab-content">
              <div class="tab-pane fade show active" id="BTC" role="tabpanel" style="overflow-x:auto;">
                <table class="table">
                  <thead>
                    <tr>
                      <th style="min-width: 115px">Name</th>
                      <th>Bid</th>
                      <th>Ask</th>
                    </tr>
                  </thead>
                  <tbody class="exchange__widget__table">
                    @foreach ($allPairs as $allPair)
                      <tr data-symbol="{{ $allPair->currency_pair }}" onclick="selectSymbol('{{ $allPair->currency_pair }}')">
                        <td style="min-width: 115px"><img src="assets/img/coin/btc.svg" class="svgInject" alt="svg"> {{ $allPair->base }}/{{ $allPair->quote }}</td>
                        <td class="bid" style="color: #dc2626 !important">0.0000</td> <!-- Bid placeholder -->
                        <td class="ask" style="color: #16a34a !important">0.0000</td> <!-- Ask placeholder -->
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="tab-pane fade show" id="USD" role="tabpanel">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Price</th>
                      <th>Change</th>
                    </tr>
                  </thead>
                  <tbody class="exchange__widget__table">
                    <tr>
                      <td><img src="assets/img/coin/auto.svg" class="svgInject" alt="svg"> auto</td>
                      <td>0.0003</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">3.2%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/bab.svg" class="svgInject" alt="svg"> bab</td>
                      <td>0.0033</td>
                      <td class="green"><img src="assets/img/svg-icon/up.svg" class="svgInject" alt="svg">2.3%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/band.svg" class="svgInject" alt="svg"> band</td>
                      <td>0.0296</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/bch.svg" class="svgInject" alt="svg"> bch</td>
                      <td>0.113</td>
                      <td class="green"><img src="assets/img/svg-icon/up.svg" class="svgInject" alt="svg">3.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/bdl.svg" class="svgInject" alt="svg"> bdl</td>
                      <td>0.2243</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">4.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/beam.svg" class="svgInject" alt="svg"> beam</td>
                      <td>0.0296</td>
                      <td class="green"><img src="assets/img/svg-icon/up.svg" class="svgInject" alt="svg">2.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/bnty.svg" class="svgInject" alt="svg"> bnty</td>
                      <td>0.3423</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/btcd.svg" class="svgInject" alt="svg"> btcd</td>
                      <td>0.0296</td>
                      <td class="green"><img src="assets/img/svg-icon/up.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/btch.svg" class="svgInject" alt="svg"> btch</td>
                      <td>0.0296</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/btcz.svg" class="svgInject" alt="svg"> btcz</td>
                      <td>0.0296</td>
                      <td class="green"><img src="assets/img/svg-icon/up.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/cdn.svg" class="svgInject" alt="svg"> cdn</td>
                      <td>0.0296</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/chain.svg" class="svgInject" alt="svg"> chain</td>
                      <td>0.0296</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/clam.svg" class="svgInject" alt="svg"> clam</td>
                      <td>0.0296</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/cob.svg" class="svgInject" alt="svg"> cob</td>
                      <td>0.0296</td>
                      <td class="green"><img src="assets/img/svg-icon/up.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/comp.svg" class="svgInject" alt="svg"> comp</td>
                      <td>0.0296</td>
                      <td class="green"><img src="assets/img/svg-icon/up.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/coqui.svg" class="svgInject" alt="svg"> coqui</td>
                      <td>0.0296</td>
                      <td class="green"><img src="assets/img/svg-icon/up.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/cvc.svg" class="svgInject" alt="svg"> cvc</td>
                      <td>0.0296</td>
                      <td class="green"><img src="assets/img/svg-icon/up.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/dew.svg" class="svgInject" alt="svg"> dew</td>
                      <td>0.0296</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/elec.svg" class="svgInject" alt="svg"> elec</td>
                      <td>0.0296</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/elf.svg" class="svgInject" alt="svg"> elf</td>
                      <td>0.0296</td>
                      <td class="green"><img src="assets/img/svg-icon/up.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/emc.svg" class="svgInject" alt="svg"> emc</td>
                      <td>0.0296</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane fade show" id="EUR" role="tabpanel">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Price</th>
                      <th>Change</th>
                    </tr>
                  </thead>
                  <tbody class="exchange__widget__table">
                    <tr>
                      <td><img src="assets/img/coin/btcd.svg" class="svgInject" alt="svg"> btcd</td>
                      <td>0.0296</td>
                      <td class="green"><img src="assets/img/svg-icon/up.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/btch.svg" class="svgInject" alt="svg"> btch</td>
                      <td>0.0296</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/btcz.svg" class="svgInject" alt="svg"> btcz</td>
                      <td>0.0296</td>
                      <td class="green"><img src="assets/img/svg-icon/up.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/cdn.svg" class="svgInject" alt="svg"> cdn</td>
                      <td>0.0296</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/chain.svg" class="svgInject" alt="svg"> chain</td>
                      <td>0.0296</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/clam.svg" class="svgInject" alt="svg"> clam</td>
                      <td>0.0296</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/cob.svg" class="svgInject" alt="svg"> cob</td>
                      <td>0.0296</td>
                      <td class="green"><img src="assets/img/svg-icon/up.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/comp.svg" class="svgInject" alt="svg"> comp</td>
                      <td>0.0296</td>
                      <td class="green"><img src="assets/img/svg-icon/up.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/coqui.svg" class="svgInject" alt="svg"> coqui</td>
                      <td>0.0296</td>
                      <td class="green"><img src="assets/img/svg-icon/up.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/cvc.svg" class="svgInject" alt="svg"> cvc</td>
                      <td>0.0296</td>
                      <td class="green"><img src="assets/img/svg-icon/up.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/dew.svg" class="svgInject" alt="svg"> dew</td>
                      <td>0.0296</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/elec.svg" class="svgInject" alt="svg"> elec</td>
                      <td>0.0296</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/elf.svg" class="svgInject" alt="svg"> elf</td>
                      <td>0.0296</td>
                      <td class="green"><img src="assets/img/svg-icon/up.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/emc.svg" class="svgInject" alt="svg"> emc</td>
                      <td>0.0296</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane fade show" id="ETH" role="tabpanel">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Price</th>
                      <th>Change</th>
                    </tr>
                  </thead>
                  <tbody class="exchange__widget__table">
                    <tr>
                      <td><img src="assets/img/coin/bdl.svg" class="svgInject" alt="svg"> bdl</td>
                      <td>0.2243</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">4.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/beam.svg" class="svgInject" alt="svg"> beam</td>
                      <td>0.0296</td>
                      <td class="green"><img src="assets/img/svg-icon/up.svg" class="svgInject" alt="svg">2.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/bnty.svg" class="svgInject" alt="svg"> bnty</td>
                      <td>0.3423</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/btcd.svg" class="svgInject" alt="svg"> btcd</td>
                      <td>0.0296</td>
                      <td class="green"><img src="assets/img/svg-icon/up.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/btch.svg" class="svgInject" alt="svg"> btch</td>
                      <td>0.0296</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/btcz.svg" class="svgInject" alt="svg"> btcz</td>
                      <td>0.0296</td>
                      <td class="green"><img src="assets/img/svg-icon/up.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/cdn.svg" class="svgInject" alt="svg"> cdn</td>
                      <td>0.0296</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/chain.svg" class="svgInject" alt="svg"> chain</td>
                      <td>0.0296</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/clam.svg" class="svgInject" alt="svg"> clam</td>
                      <td>0.0296</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/cob.svg" class="svgInject" alt="svg"> cob</td>
                      <td>0.0296</td>
                      <td class="green"><img src="assets/img/svg-icon/up.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/comp.svg" class="svgInject" alt="svg"> comp</td>
                      <td>0.0296</td>
                      <td class="green"><img src="assets/img/svg-icon/up.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/coqui.svg" class="svgInject" alt="svg"> coqui</td>
                      <td>0.0296</td>
                      <td class="green"><img src="assets/img/svg-icon/up.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/cvc.svg" class="svgInject" alt="svg"> cvc</td>
                      <td>0.0296</td>
                      <td class="green"><img src="assets/img/svg-icon/up.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/dew.svg" class="svgInject" alt="svg"> dew</td>
                      <td>0.0296</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/elec.svg" class="svgInject" alt="svg"> elec</td>
                      <td>0.0296</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/elf.svg" class="svgInject" alt="svg"> elf</td>
                      <td>0.0296</td>
                      <td class="green"><img src="assets/img/svg-icon/up.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/emc.svg" class="svgInject" alt="svg"> emc</td>
                      <td>0.0296</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane fade show" id="LTC" role="tabpanel">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Price</th>
                      <th>Change</th>
                    </tr>
                  </thead>
                  <tbody class="exchange__widget__table">
                    <tr>
                      <td><img src="assets/img/coin/comp.svg" class="svgInject" alt="svg"> comp</td>
                      <td>0.0296</td>
                      <td class="green"><img src="assets/img/svg-icon/up.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/coqui.svg" class="svgInject" alt="svg"> coqui</td>
                      <td>0.0296</td>
                      <td class="green"><img src="assets/img/svg-icon/up.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/cvc.svg" class="svgInject" alt="svg"> cvc</td>
                      <td>0.0296</td>
                      <td class="green"><img src="assets/img/svg-icon/up.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/bdl.svg" class="svgInject" alt="svg"> bdl</td>
                      <td>0.2243</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">4.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/beam.svg" class="svgInject" alt="svg"> beam</td>
                      <td>0.0296</td>
                      <td class="green"><img src="assets/img/svg-icon/up.svg" class="svgInject" alt="svg">2.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/bnty.svg" class="svgInject" alt="svg"> bnty</td>
                      <td>0.3423</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/btcd.svg" class="svgInject" alt="svg"> btcd</td>
                      <td>0.0296</td>
                      <td class="green"><img src="assets/img/svg-icon/up.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/btch.svg" class="svgInject" alt="svg"> btch</td>
                      <td>0.0296</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/btcz.svg" class="svgInject" alt="svg"> btcz</td>
                      <td>0.0296</td>
                      <td class="green"><img src="assets/img/svg-icon/up.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/cdn.svg" class="svgInject" alt="svg"> cdn</td>
                      <td>0.0296</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/chain.svg" class="svgInject" alt="svg"> chain</td>
                      <td>0.0296</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/clam.svg" class="svgInject" alt="svg"> clam</td>
                      <td>0.0296</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/cob.svg" class="svgInject" alt="svg"> cob</td>
                      <td>0.0296</td>
                      <td class="green"><img src="assets/img/svg-icon/up.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/dew.svg" class="svgInject" alt="svg"> dew</td>
                      <td>0.0296</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/elec.svg" class="svgInject" alt="svg"> elec</td>
                      <td>0.0296</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/elf.svg" class="svgInject" alt="svg"> elf</td>
                      <td>0.0296</td>
                      <td class="green"><img src="assets/img/svg-icon/up.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                    <tr>
                      <td><img src="assets/img/coin/emc.svg" class="svgInject" alt="svg"> emc</td>
                      <td>0.0296</td>
                      <td class="red"><img src="assets/img/svg-icon/down.svg" class="svgInject" alt="svg">1.5%</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="exchange__widget">
            <h2 class="exchange__widget-title">Order History</h2>
            <table class="table">
              <thead>
                <tr>
                  <th>Symbol</th>
                  <th>Type</th>
                  <th>Amount</th>
                  <th></th>
                </tr>
              </thead>
              <tbody class="exchange__widget__table">
                <tr>
                  <td><img src="assets/img/coin/btc.svg" class="svgInject" alt="svg"> btc</td>
                  <td>0.0203</td>
                  <td>$50k</td>
                  <td><img src="assets/img/svg-icon/cart.svg" class="svgInject" alt="svg"></td>
                </tr>
                <tr>
                  <td><img src="assets/img/coin/act.svg" class="svgInject" alt="svg"> act</td>
                  <td>0.0203</td>
                  <td>$24k</td>
                  <td><img src="assets/img/svg-icon/cart.svg" class="svgInject" alt="svg"></td>
                </tr>
                <tr>
                  <td><img src="assets/img/coin/actn.svg" class="svgInject" alt="svg"> actn</td>
                  <td>0.0203</td>
                  <td>$22k</td>
                  <td><img src="assets/img/svg-icon/cart.svg" class="svgInject" alt="svg"></td>
                </tr>
                
              </tbody>
            </table>
          </div>
          {{-- <div class="exchange__widget exchange__widget__transaction">
            <h2 class="exchange__widget-title">Latest Transactions</h2>
            <table class="table">
              <thead>
                <tr>
                  <th>Rate</th>
                  <th>Amount</th>
                  <th>When</th>
                </tr>
              </thead>
              <tbody class="exchange__widget__table">
                <tr>
                  <td class="green"><img src="assets/img/svg-icon/up-arrow.svg" class="svgInject" alt="svg">14343</td>
                  <td>$1.33k</td>
                  <td>52 sec</td>
                </tr>
                <tr>
                  <td class="red"><img src="assets/img/svg-icon/down-arrow.svg" class="svgInject" alt="svg">3221</td>
                  <td>$2.13k</td>
                  <td>21 sec</td>
                </tr>
                <tr>
                  <td class="green"><img src="assets/img/svg-icon/up-arrow.svg" class="svgInject" alt="svg">25432</td>
                  <td>$13.43k</td>
                  <td>33 sec</td>
                </tr>
                <tr>
                  <td class="red"><img src="assets/img/svg-icon/down-arrow.svg" class="svgInject" alt="svg">42322</td>
                  <td>$1.54k</td>
                  <td>23 sec</td>
                </tr>
                <tr>
                  <td class="green"><img src="assets/img/svg-icon/up-arrow.svg" class="svgInject" alt="svg">33422</td>
                  <td>$1.33k</td>
                  <td>6 sec</td>
                </tr>
                <tr>
                  <td class="red"><img src="assets/img/svg-icon/down-arrow.svg" class="svgInject" alt="svg">14343</td>
                  <td>$4.11k</td>
                  <td>22 sec</td>
                </tr>
                <tr>
                  <td class="green"><img src="assets/img/svg-icon/up-arrow.svg" class="svgInject" alt="svg">5232</td>
                  <td>$21.33k</td>
                  <td>11 sec</td>
                </tr>
                <tr>
                  <td class="red"><img src="assets/img/svg-icon/down-arrow.svg" class="svgInject" alt="svg">5533</td>
                  <td>$41.32k</td>
                  <td>41 sec</td>
                </tr>
                <tr>
                  <td class="green"><img src="assets/img/svg-icon/up-arrow.svg" class="svgInject" alt="svg">3333</td>
                  <td>$2.33k</td>
                  <td>24 sec</td>
                </tr>
                <tr>
                  <td class="red"><img src="assets/img/svg-icon/down-arrow.svg" class="svgInject" alt="svg">14343</td>
                  <td>$4.43k</td>
                  <td>52 sec</td>
                </tr>
                <tr>
                  <td class="green"><img src="assets/img/svg-icon/up-arrow.svg" class="svgInject" alt="svg">23222</td>
                  <td>$1.33k</td>
                  <td>44 sec</td>
                </tr>
                <tr>
                  <td class="red"><img src="assets/img/svg-icon/down-arrow.svg" class="svgInject" alt="svg">14343</td>
                  <td>$1.33k</td>
                  <td>33 sec</td>
                </tr>
              </tbody>
            </table>
          </div> --}}
        </div>

        {{-- chart --}}
        
        <div id="selected-pair-container" style="display: flex;justify-content: center;align-items: center;background:#171717" class="col-lg-8 col-xl-9">
          <div style="color: white;display:flex;justify-content: center;font-size:20px">
            <p><strong id="selected-symbol">Choose forex symbol to view chart..</strong></p>
          </div>
          <div class="exchange__widget__trading" style="display: none" id="symbol-chart">
            <div id="trading-chart-transparent"></div>
          </div>
          <div class="exchange__widget" style="display: none" id="symbol-order">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" id="pills-market-order-tab" data-toggle="pill" href="#pills-market-order"
                  role="tab" aria-controls="pills-market-order" aria-selected="true">Market order</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-limite-order-tab" data-toggle="pill" href="#pills-limite-order"
                  role="tab" aria-controls="pills-limite-order" aria-selected="false">Limit order</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-stop-market-tab" data-toggle="pill" href="#pills-stop-market" role="tab"
                  aria-controls="pills-stop-market" aria-selected="false">Stop market</a>
              </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-market-order" role="tabpanel"
                aria-labelledby="pills-market-order-tab">
                <div class="exchange__widget__order">
                  <div class="exchange__widget__order-note">
                    <h2><img src="assets/img/svg-icon/buy.svg" class="svgInject" alt="svg"> Quick buy</h2>
                    <div class="exchange__widget__order-note-item">
                      <p>Volumn</p>
                      <input type="number" class="form-control" placeholder="Amount">
                      {{-- <div class="exchange__widget__order-buy-coin"> --}}
                        {{-- <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                          BTC
                        </button> --}}
                        {{-- <div class="dropdown-menu">
                          <a class="dropdown-item" href="#!">btc</a>
                          <a class="dropdown-item" href="#!">abt</a>
                          <a class="dropdown-item" href="#!">act</a>
                          <a class="dropdown-item" href="#!">actn</a>
                          <a class="dropdown-item" href="#!">add</a>
                          <a class="dropdown-item" href="#!">agi</a>
                          <a class="dropdown-item" href="#!">amp</a>
                          <a class="dropdown-item" href="#!">auto</a>
                          <a class="dropdown-item" href="#!">bab</a>
                          <a class="dropdown-item" href="#!">band</a>
                          <a class="dropdown-item" href="#!">bch</a>
                          <a class="dropdown-item" href="#!">bdl</a>
                          <a class="dropdown-item" href="#!">beam</a>
                          <a class="dropdown-item" href="#!">bnty</a>
                          <a class="dropdown-item" href="#!">btcd</a>
                          <a class="dropdown-item" href="#!">btch</a>
                          <a class="dropdown-item" href="#!">btcz</a>
                          <a class="dropdown-item" href="#!">cdn</a>
                          <a class="dropdown-item" href="#!">chain</a>
                          <a class="dropdown-item" href="#!">clam</a>
                          <a class="dropdown-item" href="#!">cob</a>
                          <a class="dropdown-item" href="#!">cvc</a>
                          <a class="dropdown-item" href="#!">dew</a>
                        </div> --}}
                      {{-- </div> --}}
                    </div>
                    {{-- <div class="exchange__widget__order-note-item">
                      <p>I will pay</p>
                      <input type="number" class="form-control" placeholder="Amount">
                      <div class="exchange__widget__order-buy-coin">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                          BTC
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#!">btc</a>
                          <a class="dropdown-item" href="#!">abt</a>
                          <a class="dropdown-item" href="#!">act</a>
                          <a class="dropdown-item" href="#!">actn</a>
                          <a class="dropdown-item" href="#!">add</a>
                          <a class="dropdown-item" href="#!">agi</a>
                          <a class="dropdown-item" href="#!">amp</a>
                          <a class="dropdown-item" href="#!">auto</a>
                          <a class="dropdown-item" href="#!">bab</a>
                          <a class="dropdown-item" href="#!">band</a>
                          <a class="dropdown-item" href="#!">bch</a>
                          <a class="dropdown-item" href="#!">bdl</a>
                          <a class="dropdown-item" href="#!">beam</a>
                          <a class="dropdown-item" href="#!">bnty</a>
                          <a class="dropdown-item" href="#!">btcd</a>
                          <a class="dropdown-item" href="#!">btch</a>
                          <a class="dropdown-item" href="#!">btcz</a>
                          <a class="dropdown-item" href="#!">cdn</a>
                          <a class="dropdown-item" href="#!">chain</a>
                          <a class="dropdown-item" href="#!">clam</a>
                          <a class="dropdown-item" href="#!">cob</a>
                          <a class="dropdown-item" href="#!">cvc</a>
                          <a class="dropdown-item" href="#!">dew</a>
                        </div>
                      </div>
                    </div> --}}
                    <button class="btn-green" type="button" onclick="buyOrder()">
                      Buy
                      <span id="ask-price">0.0000</span>
                    </button>
                  </div>
                  <div class="exchange__widget__order-note">
                    <h2><img src="assets/img/svg-icon/sell.svg" class="svgInject" alt="svg"> Quick sell</h2>
                    <div class="exchange__widget__order-note-item">
                      <p>Volumn</p>
                      <input type="number" class="form-control" placeholder="Amount">
                      {{-- <div class="exchange__widget__order-buy-coin">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                          BTC
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#!">btc</a>
                          <a class="dropdown-item" href="#!">abt</a>
                          <a class="dropdown-item" href="#!">act</a>
                          <a class="dropdown-item" href="#!">actn</a>
                          <a class="dropdown-item" href="#!">add</a>
                          <a class="dropdown-item" href="#!">agi</a>
                          <a class="dropdown-item" href="#!">amp</a>
                          <a class="dropdown-item" href="#!">auto</a>
                          <a class="dropdown-item" href="#!">bab</a>
                          <a class="dropdown-item" href="#!">band</a>
                          <a class="dropdown-item" href="#!">bch</a>
                          <a class="dropdown-item" href="#!">bdl</a>
                          <a class="dropdown-item" href="#!">beam</a>
                          <a class="dropdown-item" href="#!">bnty</a>
                          <a class="dropdown-item" href="#!">btcd</a>
                          <a class="dropdown-item" href="#!">btch</a>
                          <a class="dropdown-item" href="#!">btcz</a>
                          <a class="dropdown-item" href="#!">cdn</a>
                          <a class="dropdown-item" href="#!">chain</a>
                          <a class="dropdown-item" href="#!">clam</a>
                          <a class="dropdown-item" href="#!">cob</a>
                          <a class="dropdown-item" href="#!">cvc</a>
                          <a class="dropdown-item" href="#!">dew</a>
                        </div>
                      </div> --}}
                    </div>
                    {{-- <div class="exchange__widget__order-note-item">
                      <p>I will pay</p>
                      <input type="number" class="form-control" placeholder="Amount">
                      <div class="exchange__widget__order-buy-coin">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                          BTC
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#!">btc</a>
                          <a class="dropdown-item" href="#!">abt</a>
                          <a class="dropdown-item" href="#!">act</a>
                          <a class="dropdown-item" href="#!">actn</a>
                          <a class="dropdown-item" href="#!">add</a>
                          <a class="dropdown-item" href="#!">agi</a>
                          <a class="dropdown-item" href="#!">amp</a>
                          <a class="dropdown-item" href="#!">auto</a>
                          <a class="dropdown-item" href="#!">bab</a>
                          <a class="dropdown-item" href="#!">band</a>
                          <a class="dropdown-item" href="#!">bch</a>
                          <a class="dropdown-item" href="#!">bdl</a>
                          <a class="dropdown-item" href="#!">beam</a>
                          <a class="dropdown-item" href="#!">bnty</a>
                          <a class="dropdown-item" href="#!">btcd</a>
                          <a class="dropdown-item" href="#!">btch</a>
                          <a class="dropdown-item" href="#!">btcz</a>
                          <a class="dropdown-item" href="#!">cdn</a>
                          <a class="dropdown-item" href="#!">chain</a>
                          <a class="dropdown-item" href="#!">clam</a>
                          <a class="dropdown-item" href="#!">cob</a>
                          <a class="dropdown-item" href="#!">cvc</a>
                          <a class="dropdown-item" href="#!">dew</a>
                        </div>
                      </div>
                    </div> --}}
                    <button class="btn-red" type="button" onclick="sellOrder()"> 
                      Sell
                      <span id="bid-price">0.0000</span>
                    </button>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="pills-limite-order" role="tabpanel"
                aria-labelledby="pills-limite-order-tab">
                <div class="exchange__widget__order">
                  <div class="exchange__widget__order-note">
                    <h2><img src="assets/img/svg-icon/buy.svg" class="svgInject" alt="svg"> Quick buy</h2>
                    <div class="exchange__widget__order-note-item">
                      <p>Volumn</p>
                      <input type="number" class="form-control" placeholder="Amount">
                      {{-- <div class="exchange__widget__order-buy-coin">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                          BTC
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#!">btc</a>
                          <a class="dropdown-item" href="#!">abt</a>
                          <a class="dropdown-item" href="#!">act</a>
                          <a class="dropdown-item" href="#!">actn</a>
                          <a class="dropdown-item" href="#!">add</a>
                          <a class="dropdown-item" href="#!">agi</a>
                          <a class="dropdown-item" href="#!">amp</a>
                          <a class="dropdown-item" href="#!">auto</a>
                          <a class="dropdown-item" href="#!">bab</a>
                          <a class="dropdown-item" href="#!">band</a>
                          <a class="dropdown-item" href="#!">bch</a>
                          <a class="dropdown-item" href="#!">bdl</a>
                          <a class="dropdown-item" href="#!">beam</a>
                          <a class="dropdown-item" href="#!">bnty</a>
                          <a class="dropdown-item" href="#!">btcd</a>
                          <a class="dropdown-item" href="#!">btch</a>
                          <a class="dropdown-item" href="#!">btcz</a>
                          <a class="dropdown-item" href="#!">cdn</a>
                          <a class="dropdown-item" href="#!">chain</a>
                          <a class="dropdown-item" href="#!">clam</a>
                          <a class="dropdown-item" href="#!">cob</a>
                          <a class="dropdown-item" href="#!">cvc</a>
                          <a class="dropdown-item" href="#!">dew</a>
                        </div>
                      </div> --}}
                    </div>
                    {{-- <div class="exchange__widget__order-note-item">
                      <p>I will pay</p>
                      <input type="number" class="form-control" placeholder="Amount">
                      <div class="exchange__widget__order-buy-coin">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                          BTC
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#!">btc</a>
                          <a class="dropdown-item" href="#!">abt</a>
                          <a class="dropdown-item" href="#!">act</a>
                          <a class="dropdown-item" href="#!">actn</a>
                          <a class="dropdown-item" href="#!">add</a>
                          <a class="dropdown-item" href="#!">agi</a>
                          <a class="dropdown-item" href="#!">amp</a>
                          <a class="dropdown-item" href="#!">auto</a>
                          <a class="dropdown-item" href="#!">bab</a>
                          <a class="dropdown-item" href="#!">band</a>
                          <a class="dropdown-item" href="#!">bch</a>
                          <a class="dropdown-item" href="#!">bdl</a>
                          <a class="dropdown-item" href="#!">beam</a>
                          <a class="dropdown-item" href="#!">bnty</a>
                          <a class="dropdown-item" href="#!">btcd</a>
                          <a class="dropdown-item" href="#!">btch</a>
                          <a class="dropdown-item" href="#!">btcz</a>
                          <a class="dropdown-item" href="#!">cdn</a>
                          <a class="dropdown-item" href="#!">chain</a>
                          <a class="dropdown-item" href="#!">clam</a>
                          <a class="dropdown-item" href="#!">cob</a>
                          <a class="dropdown-item" href="#!">cvc</a>
                          <a class="dropdown-item" href="#!">dew</a>
                        </div>
                      </div>
                    </div> --}}
                    <button class="btn-green">Buy</button>
                  </div>
                  <div class="exchange__widget__order-note">
                    <h2><img src="assets/img/svg-icon/sell.svg" class="svgInject" alt="svg"> Quick sell</h2>
                    <div class="exchange__widget__order-note-item">
                      <p>Volumn</p>
                      <input type="number" class="form-control" placeholder="Amount">
                      {{-- <div class="exchange__widget__order-buy-coin">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                          BTC
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#!">btc</a>
                          <a class="dropdown-item" href="#!">abt</a>
                          <a class="dropdown-item" href="#!">act</a>
                          <a class="dropdown-item" href="#!">actn</a>
                          <a class="dropdown-item" href="#!">add</a>
                          <a class="dropdown-item" href="#!">agi</a>
                          <a class="dropdown-item" href="#!">amp</a>
                          <a class="dropdown-item" href="#!">auto</a>
                          <a class="dropdown-item" href="#!">bab</a>
                          <a class="dropdown-item" href="#!">band</a>
                          <a class="dropdown-item" href="#!">bch</a>
                          <a class="dropdown-item" href="#!">bdl</a>
                          <a class="dropdown-item" href="#!">beam</a>
                          <a class="dropdown-item" href="#!">bnty</a>
                          <a class="dropdown-item" href="#!">btcd</a>
                          <a class="dropdown-item" href="#!">btch</a>
                          <a class="dropdown-item" href="#!">btcz</a>
                          <a class="dropdown-item" href="#!">cdn</a>
                          <a class="dropdown-item" href="#!">chain</a>
                          <a class="dropdown-item" href="#!">clam</a>
                          <a class="dropdown-item" href="#!">cob</a>
                          <a class="dropdown-item" href="#!">cvc</a>
                          <a class="dropdown-item" href="#!">dew</a>
                        </div>
                      </div> --}}
                    </div>
                    {{-- <div class="exchange__widget__order-note-item">
                      <p>I will pay</p>
                      <input type="number" class="form-control" placeholder="Amount">
                      <div class="exchange__widget__order-buy-coin">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                          BTC
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#!">btc</a>
                          <a class="dropdown-item" href="#!">abt</a>
                          <a class="dropdown-item" href="#!">act</a>
                          <a class="dropdown-item" href="#!">actn</a>
                          <a class="dropdown-item" href="#!">add</a>
                          <a class="dropdown-item" href="#!">agi</a>
                          <a class="dropdown-item" href="#!">amp</a>
                          <a class="dropdown-item" href="#!">auto</a>
                          <a class="dropdown-item" href="#!">bab</a>
                          <a class="dropdown-item" href="#!">band</a>
                          <a class="dropdown-item" href="#!">bch</a>
                          <a class="dropdown-item" href="#!">bdl</a>
                          <a class="dropdown-item" href="#!">beam</a>
                          <a class="dropdown-item" href="#!">bnty</a>
                          <a class="dropdown-item" href="#!">btcd</a>
                          <a class="dropdown-item" href="#!">btch</a>
                          <a class="dropdown-item" href="#!">btcz</a>
                          <a class="dropdown-item" href="#!">cdn</a>
                          <a class="dropdown-item" href="#!">chain</a>
                          <a class="dropdown-item" href="#!">clam</a>
                          <a class="dropdown-item" href="#!">cob</a>
                          <a class="dropdown-item" href="#!">cvc</a>
                          <a class="dropdown-item" href="#!">dew</a>
                        </div>
                      </div>
                    </div> --}}
                    <button class="btn-red">Sell</button>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="pills-stop-market" role="tabpanel"
                aria-labelledby="pills-stop-market-tab">
                <div class="exchange__widget__order">
                  <div class="exchange__widget__order-note">
                    <h2><img src="assets/img/svg-icon/buy.svg" class="svgInject" alt="svg"> Quick buy</h2>
                    <div class="exchange__widget__order-note-item">
                      <p>Volumn</p>
                      <input type="number" class="form-control" placeholder="Amount">
                      {{-- <div class="exchange__widget__order-buy-coin">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                          BTC
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#!">btc</a>
                          <a class="dropdown-item" href="#!">abt</a>
                          <a class="dropdown-item" href="#!">act</a>
                          <a class="dropdown-item" href="#!">actn</a>
                          <a class="dropdown-item" href="#!">add</a>
                          <a class="dropdown-item" href="#!">agi</a>
                          <a class="dropdown-item" href="#!">amp</a>
                          <a class="dropdown-item" href="#!">auto</a>
                          <a class="dropdown-item" href="#!">bab</a>
                          <a class="dropdown-item" href="#!">band</a>
                          <a class="dropdown-item" href="#!">bch</a>
                          <a class="dropdown-item" href="#!">bdl</a>
                          <a class="dropdown-item" href="#!">beam</a>
                          <a class="dropdown-item" href="#!">bnty</a>
                          <a class="dropdown-item" href="#!">btcd</a>
                          <a class="dropdown-item" href="#!">btch</a>
                          <a class="dropdown-item" href="#!">btcz</a>
                          <a class="dropdown-item" href="#!">cdn</a>
                          <a class="dropdown-item" href="#!">chain</a>
                          <a class="dropdown-item" href="#!">clam</a>
                          <a class="dropdown-item" href="#!">cob</a>
                          <a class="dropdown-item" href="#!">cvc</a>
                          <a class="dropdown-item" href="#!">dew</a>
                        </div>
                      </div> --}}
                    </div>
                    {{-- <div class="exchange__widget__order-note-item">
                      <p>I will pay</p>
                      <input type="number" class="form-control" placeholder="Amount">
                      <div class="exchange__widget__order-buy-coin">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                          BTC
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#!">btc</a>
                          <a class="dropdown-item" href="#!">abt</a>
                          <a class="dropdown-item" href="#!">act</a>
                          <a class="dropdown-item" href="#!">actn</a>
                          <a class="dropdown-item" href="#!">add</a>
                          <a class="dropdown-item" href="#!">agi</a>
                          <a class="dropdown-item" href="#!">amp</a>
                          <a class="dropdown-item" href="#!">auto</a>
                          <a class="dropdown-item" href="#!">bab</a>
                          <a class="dropdown-item" href="#!">band</a>
                          <a class="dropdown-item" href="#!">bch</a>
                          <a class="dropdown-item" href="#!">bdl</a>
                          <a class="dropdown-item" href="#!">beam</a>
                          <a class="dropdown-item" href="#!">bnty</a>
                          <a class="dropdown-item" href="#!">btcd</a>
                          <a class="dropdown-item" href="#!">btch</a>
                          <a class="dropdown-item" href="#!">btcz</a>
                          <a class="dropdown-item" href="#!">cdn</a>
                          <a class="dropdown-item" href="#!">chain</a>
                          <a class="dropdown-item" href="#!">clam</a>
                          <a class="dropdown-item" href="#!">cob</a>
                          <a class="dropdown-item" href="#!">cvc</a>
                          <a class="dropdown-item" href="#!">dew</a>
                        </div>
                      </div>
                    </div> --}}
                    <button class="btn-green">Buy</button>
                  </div>
                  <div class="exchange__widget__order-note">
                    <h2><img src="assets/img/svg-icon/sell.svg" class="svgInject" alt="svg"> Quick sell</h2>
                    <div class="exchange__widget__order-note-item">
                      <p>Volumn</p>
                      <input type="number" class="form-control" placeholder="Amount">
                      {{-- <div class="exchange__widget__order-buy-coin">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                          BTC
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#!">btc</a>
                          <a class="dropdown-item" href="#!">abt</a>
                          <a class="dropdown-item" href="#!">act</a>
                          <a class="dropdown-item" href="#!">actn</a>
                          <a class="dropdown-item" href="#!">add</a>
                          <a class="dropdown-item" href="#!">agi</a>
                          <a class="dropdown-item" href="#!">amp</a>
                          <a class="dropdown-item" href="#!">auto</a>
                          <a class="dropdown-item" href="#!">bab</a>
                          <a class="dropdown-item" href="#!">band</a>
                          <a class="dropdown-item" href="#!">bch</a>
                          <a class="dropdown-item" href="#!">bdl</a>
                          <a class="dropdown-item" href="#!">beam</a>
                          <a class="dropdown-item" href="#!">bnty</a>
                          <a class="dropdown-item" href="#!">btcd</a>
                          <a class="dropdown-item" href="#!">btch</a>
                          <a class="dropdown-item" href="#!">btcz</a>
                          <a class="dropdown-item" href="#!">cdn</a>
                          <a class="dropdown-item" href="#!">chain</a>
                          <a class="dropdown-item" href="#!">clam</a>
                          <a class="dropdown-item" href="#!">cob</a>
                          <a class="dropdown-item" href="#!">cvc</a>
                          <a class="dropdown-item" href="#!">dew</a>
                        </div>
                      </div> --}}
                    </div>
                    {{-- <div class="exchange__widget__order-note-item">
                      <p>I will pay</p>
                      <input type="number" class="form-control" placeholder="Amount">
                      <div class="exchange__widget__order-buy-coin">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                          BTC
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#!">btc</a>
                          <a class="dropdown-item" href="#!">abt</a>
                          <a class="dropdown-item" href="#!">act</a>
                          <a class="dropdown-item" href="#!">actn</a>
                          <a class="dropdown-item" href="#!">add</a>
                          <a class="dropdown-item" href="#!">agi</a>
                          <a class="dropdown-item" href="#!">amp</a>
                          <a class="dropdown-item" href="#!">auto</a>
                          <a class="dropdown-item" href="#!">bab</a>
                          <a class="dropdown-item" href="#!">band</a>
                          <a class="dropdown-item" href="#!">bch</a>
                          <a class="dropdown-item" href="#!">bdl</a>
                          <a class="dropdown-item" href="#!">beam</a>
                          <a class="dropdown-item" href="#!">bnty</a>
                          <a class="dropdown-item" href="#!">btcd</a>
                          <a class="dropdown-item" href="#!">btch</a>
                          <a class="dropdown-item" href="#!">btcz</a>
                          <a class="dropdown-item" href="#!">cdn</a>
                          <a class="dropdown-item" href="#!">chain</a>
                          <a class="dropdown-item" href="#!">clam</a>
                          <a class="dropdown-item" href="#!">cob</a>
                          <a class="dropdown-item" href="#!">cvc</a>
                          <a class="dropdown-item" href="#!">dew</a>
                        </div>
                      </div>
                    </div> --}}
                    <button class="btn-red">Sell</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {{-- <div class="exchange__widget__purchase" >
            <div class="row sm-gutters">
              <div class="col-md-6">
                <div class="exchange__widget">
                  <h2 class="exchange__widget-title">Buy orders</h2>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Rate</th>
                        <th>Amount</th>
                        <th>Price</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="exchange__widget__table">
                      <tr>
                        <td><img src="assets/img/coin/btc.svg" class="svgInject" alt="svg"> btc</td>
                        <td class="green">0.0203</td>
                        <td>1.2342</td>
                        <td>$150k</td>
                        <td><img src="assets/img/svg-icon/cart.svg" class="svgInject" alt="svg"></td>
                      </tr>
                      <tr>
                        <td><img src="assets/img/coin/abt.svg" class="svgInject" alt="svg"> abt</td>
                        <td class="green">0.0203</td>
                        <td>1.2342</td>
                        <td>$150k</td>
                        <td><img src="assets/img/svg-icon/cart.svg" class="svgInject" alt="svg"></td>
                      </tr>
                      <tr>
                        <td><img src="assets/img/coin/agi.svg" class="svgInject" alt="svg"> agi</td>
                        <td class="green">0.0203</td>
                        <td>1.2342</td>
                        <td>$150k</td>
                        <td><img src="assets/img/svg-icon/cart.svg" class="svgInject" alt="svg"></td>
                      </tr>
                      <tr>
                        <td><img src="assets/img/coin/amp.svg" class="svgInject" alt="svg"> amp</td>
                        <td class="green">0.0203</td>
                        <td>1.2342</td>
                        <td>$150k</td>
                        <td><img src="assets/img/svg-icon/cart.svg" class="svgInject" alt="svg"></td>
                      </tr>
                      <tr>
                        <td><img src="assets/img/coin/bdl.svg" class="svgInject" alt="svg"> bdl</td>
                        <td class="green">0.0203</td>
                        <td>1.2342</td>
                        <td>$150k</td>
                        <td><img src="assets/img/svg-icon/cart.svg" class="svgInject" alt="svg"></td>
                      </tr>
                      <tr>
                        <td><img src="assets/img/coin/bnty.svg" class="svgInject" alt="svg"> bnty</td>
                        <td class="green">0.0203</td>
                        <td>1.2342</td>
                        <td>$150k</td>
                        <td><img src="assets/img/svg-icon/cart.svg" class="svgInject" alt="svg"></td>
                      </tr>
                      <tr>
                        <td><img src="assets/img/coin/bch.svg" class="svgInject" alt="svg"> bch</td>
                        <td class="green">0.0203</td>
                        <td>1.2342</td>
                        <td>$150k</td>
                        <td><img src="assets/img/svg-icon/cart.svg" class="svgInject" alt="svg"></td>
                      </tr>
                      <tr>
                        <td><img src="assets/img/coin/clam.svg" class="svgInject" alt="svg"> clam</td>
                        <td class="green">0.0203</td>
                        <td>1.2342</td>
                        <td>$150k</td>
                        <td><img src="assets/img/svg-icon/cart.svg" class="svgInject" alt="svg"></td>
                      </tr>
                      <tr>
                        <td><img src="assets/img/coin/cdn.svg" class="svgInject" alt="svg"> cdn</td>
                        <td class="green">0.0203</td>
                        <td>1.2342</td>
                        <td>$150k</td>
                        <td><img src="assets/img/svg-icon/cart.svg" class="svgInject" alt="svg"></td>
                      </tr>
                      <tr>
                        <td><img src="assets/img/coin/btcz.svg" class="svgInject" alt="svg"> btcz</td>
                        <td class="green">0.0203</td>
                        <td>1.2342</td>
                        <td>$150k</td>
                        <td><img src="assets/img/svg-icon/cart.svg" class="svgInject" alt="svg"></td>
                      </tr>
                      <tr>
                        <td><img src="assets/img/coin/cvc.svg" class="svgInject" alt="svg"> cvc</td>
                        <td class="green">0.0203</td>
                        <td>1.2342</td>
                        <td>$150k</td>
                        <td><img src="assets/img/svg-icon/cart.svg" class="svgInject" alt="svg"></td>
                      </tr>
                      <tr>
                        <td><img src="assets/img/coin/dew.svg" class="svgInject" alt="svg"> dew</td>
                        <td class="green">0.0203</td>
                        <td>1.2342</td>
                        <td>$150k</td>
                        <td><img src="assets/img/svg-icon/cart.svg" class="svgInject" alt="svg"></td>
                      </tr>
                      <tr>
                        <td><img src="assets/img/coin/cob.svg" class="svgInject" alt="svg"> cob</td>
                        <td class="green">0.0203</td>
                        <td>1.2342</td>
                        <td>$150k</td>
                        <td><img src="assets/img/svg-icon/cart.svg" class="svgInject" alt="svg"></td>
                      </tr>
                      <tr>
                        <td><img src="assets/img/coin/emc.svg" class="svgInject" alt="svg"> emc</td>
                        <td class="green">0.0203</td>
                        <td>1.2342</td>
                        <td>$150k</td>
                        <td><img src="assets/img/svg-icon/cart.svg" class="svgInject" alt="svg"></td>
                      </tr>
                      <tr>
                        <td><img src="assets/img/coin/dew.svg" class="svgInject" alt="svg"> dew</td>
                        <td class="green">0.0203</td>
                        <td>1.2342</td>
                        <td>$150k</td>
                        <td><img src="assets/img/svg-icon/cart.svg" class="svgInject" alt="svg"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="col-md-6">
                <div class="exchange__widget">
                  <h2 class="exchange__widget-title">Sell orders</h2>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Rate</th>
                        <th>Amount</th>
                        <th>Price</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="exchange__widget__table">
                      <tr>
                        <td><img src="assets/img/coin/amp.svg" class="svgInject" alt="svg"> amp</td>
                        <td class="red">0.0203</td>
                        <td>1.2342</td>
                        <td>$150k</td>
                        <td><img src="assets/img/svg-icon/cart.svg" class="svgInject" alt="svg"></td>
                      </tr>
                      <tr>
                        <td><img src="assets/img/coin/bdl.svg" class="svgInject" alt="svg"> bdl</td>
                        <td class="red">0.0203</td>
                        <td>1.2342</td>
                        <td>$150k</td>
                        <td><img src="assets/img/svg-icon/cart.svg" class="svgInject" alt="svg"></td>
                      </tr>
                      <tr>
                        <td><img src="assets/img/coin/bnty.svg" class="svgInject" alt="svg"> bnty</td>
                        <td class="red">0.0203</td>
                        <td>1.2342</td>
                        <td>$150k</td>
                        <td><img src="assets/img/svg-icon/cart.svg" class="svgInject" alt="svg"></td>
                      </tr>
                      <tr>
                        <td><img src="assets/img/coin/bch.svg" class="svgInject" alt="svg"> bch</td>
                        <td class="red">0.0203</td>
                        <td>1.2342</td>
                        <td>$150k</td>
                        <td><img src="assets/img/svg-icon/cart.svg" class="svgInject" alt="svg"></td>
                      </tr>
                      <tr>
                        <td><img src="assets/img/coin/clam.svg" class="svgInject" alt="svg"> clam</td>
                        <td class="red">0.0203</td>
                        <td>1.2342</td>
                        <td>$150k</td>
                        <td><img src="assets/img/svg-icon/cart.svg" class="svgInject" alt="svg"></td>
                      </tr>
                      <tr>
                        <td><img src="assets/img/coin/cdn.svg" class="svgInject" alt="svg"> cdn</td>
                        <td class="red">0.0203</td>
                        <td>1.2342</td>
                        <td>$150k</td>
                        <td><img src="assets/img/svg-icon/cart.svg" class="svgInject" alt="svg"></td>
                      </tr>
                      <tr>
                        <td><img src="assets/img/coin/btcz.svg" class="svgInject" alt="svg"> btcz</td>
                        <td class="red">0.0203</td>
                        <td>1.2342</td>
                        <td>$150k</td>
                        <td><img src="assets/img/svg-icon/cart.svg" class="svgInject" alt="svg"></td>
                      </tr>
                      <tr>
                        <td><img src="assets/img/coin/cvc.svg" class="svgInject" alt="svg"> cvc</td>
                        <td class="red">0.0203</td>
                        <td>1.2342</td>
                        <td>$150k</td>
                        <td><img src="assets/img/svg-icon/cart.svg" class="svgInject" alt="svg"></td>
                      </tr>
                      <tr>
                        <td><img src="assets/img/coin/dew.svg" class="svgInject" alt="svg"> dew</td>
                        <td class="red">0.0203</td>
                        <td>1.2342</td>
                        <td>$150k</td>
                        <td><img src="assets/img/svg-icon/cart.svg" class="svgInject" alt="svg"></td>
                      </tr>
                      <tr>
                        <td><img src="assets/img/coin/cob.svg" class="svgInject" alt="svg"> cob</td>
                        <td class="red">0.0203</td>
                        <td>1.2342</td>
                        <td>$150k</td>
                        <td><img src="assets/img/svg-icon/cart.svg" class="svgInject" alt="svg"></td>
                      </tr>
                      <tr>
                        <td><img src="assets/img/coin/emc.svg" class="svgInject" alt="svg"> emc</td>
                        <td class="red">0.0203</td>
                        <td>1.2342</td>
                        <td>$150k</td>
                        <td><img src="assets/img/svg-icon/cart.svg" class="svgInject" alt="svg"></td>
                      </tr>
                      <tr>
                        <td><img src="assets/img/coin/dew.svg" class="svgInject" alt="svg"> dew</td>
                        <td class="red">0.0203</td>
                        <td>1.2342</td>
                        <td>$150k</td>
                        <td><img src="assets/img/svg-icon/cart.svg" class="svgInject" alt="svg"></td>
                      </tr>
                      <tr>
                        <td><img src="assets/img/coin/btc.svg" class="svgInject" alt="svg"> btc</td>
                        <td class="red">0.0203</td>
                        <td>1.2342</td>
                        <td>$150k</td>
                        <td><img src="assets/img/svg-icon/cart.svg" class="svgInject" alt="svg"></td>
                      </tr>
                      <tr>
                        <td><img src="assets/img/coin/abt.svg" class="svgInject" alt="svg"> abt</td>
                        <td class="red">0.0203</td>
                        <td>1.2342</td>
                        <td>$150k</td>
                        <td><img src="assets/img/svg-icon/cart.svg" class="svgInject" alt="svg"></td>
                      </tr>
                      <tr>
                        <td><img src="assets/img/coin/agi.svg" class="svgInject" alt="svg"> agi</td>
                        <td class="red">0.0203</td>
                        <td>1.2342</td>
                        <td>$150k</td>
                        <td><img src="assets/img/svg-icon/cart.svg" class="svgInject" alt="svg"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div> --}}
        </div>
        {{-- end of chart --}}

      </div>
    </div>
  </div>

  <script>
    let socket;
    let reconnectInterval = 5000; // Retry after 5 seconds

    // Function to establish WebSocket connection
    function connectWebSocket() {
        socket = new WebSocket('wss://fxtrado-backend.currenttech.pro/forex_pair'); // Update this with your correct WebSocket URL
        
        socket.onopen = function() {
            console.log('WebSocket connection established');
        };

        socket.onmessage = function(event) {
            // Parse the incoming data (which should be JSON)
            const data = JSON.parse(event.data);
            
            // Call the function to update the corresponding table row
            updateTableRow(data.symbol, data.bid, data.ask);

            const selectedSymbol = document.getElementById('selected-symbol').innerText;
    
            if (data.symbol === selectedSymbol) {
              // Update the ask price in the selected-pair-container div
              document.getElementById('ask-price').innerText = data.ask;
              document.getElementById('bid-price').innerText = data.bid;
            }
        };

        socket.onerror = function(error) {
            console.error('WebSocket error:', error);
        };

        socket.onclose = function() {
            console.warn('WebSocket connection closed, attempting to reconnect...');
            setTimeout(connectWebSocket, reconnectInterval); // Attempt to reconnect
        };
    }

    // Function to update table rows with the bid/ask values
    function updateTableRow(symbol, bid, ask) {
        // Find the row with the data-symbol attribute matching the symbol (e.g., EUR/USD)
        const row = document.querySelector(`tr[data-symbol='${symbol}']`);
      
        if (row) {
            // Update the bid and ask values in the corresponding table cells
            row.querySelector('.bid').innerText = bid;
            row.querySelector('.ask').innerText = ask;
        }
    }

    // Initialize WebSocket connection when the page loads
    window.onload = function() {
        connectWebSocket();
    };

    // Ensure reconnection if the user refreshes the page
    window.onbeforeunload = function() {
        if (socket) {
            socket.close();
        }
    };

    const selectSymbol = (currencyPair) => {
      const container = document.getElementById('selected-pair-container');
      const forexChart = document.getElementById('symbol-chart');
      const forexOrder = document.getElementById('symbol-order');
      const symbolElement = document.getElementById('selected-symbol');
      symbolElement.innerText = currencyPair;
      
      if (currencyPair) {
        forexChart.style.display = 'block';
        forexOrder.style.display = 'block';
        container.style.display = 'block'
      }

      document.getElementById('ask-price').innerText = '0.0000';
      document.getElementById('bid-price').innerText = '0.0000';
    }

    const buyOrder = async () => {
      const selectedSymbol = document.getElementById('selected-symbol').innerText;
      const askPrice = document.getElementById('ask-price').innerText;
      const userId = window.userID = {{ auth()->id() }};
    
      // Make sure a symbol is selected before sending the request
      if (selectedSymbol !== 'None') {
        const orderData = {
          symbol: selectedSymbol,
          price: askPrice,
          type: 'buy', // Specify buy order
          quantity: 1, // You can customize the quantity
          user_id: userId,
          status: 'open',
        };

        // Post the order to the API
        try {
          const response = await fetch('https://fxtrado-backend.currenttech.pro/api/openOrders', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify(orderData),
          });

          const result = await response.json();

          if (response.ok) {
            console.log('Order successfully placed', result);
          } else {
            console.error('Error placing order:', result.message);
          }
        } catch (error) {
          console.error('Network or server error:', error);
        }
      } else {
        alert('Please select a symbol before placing an order');
      }
  }

  const sellOrder = async () => {
      const selectedSymbol = document.getElementById('selected-symbol').innerText;
      const bidPrice = document.getElementById('bid-price').innerText;
      const userId = window.userID = {{ auth()->id() }};
    
      // Make sure a symbol is selected before sending the request
      if (selectedSymbol !== 'None') {
        const orderData = {
          symbol: selectedSymbol,
          price: bidPrice,
          type: 'sell', // Specify buy order
          quantity: 1, // You can customize the quantity
          user_id: userId,
          status: 'open',
        };

        // Post the order to the API
        try {
          const response = await fetch('https://fxtrado-backend.currenttech.pro/api/openOrders', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify(orderData),
          });

          const result = await response.json();

          if (response.ok) {
            console.log('Order successfully placed', result);
          } else {
            console.error('Error placing order:', result.message);
          }
        } catch (error) {
          console.error('Network or server error:', error);
        }
      } else {
        alert('Please select a symbol before placing an order');
      }
  }
  </script>


@endsection