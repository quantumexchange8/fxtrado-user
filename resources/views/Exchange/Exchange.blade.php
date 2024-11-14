@extends('layouts.master')
@section('contents')

<style>

    .lotstyle2 {
      display: block;
    }

  @media (max-width: 768px) {
    .mobileHidden {
      display: none !important;
    }

    .h2style {
      margin-bottom: 10px !important;
    }
    .lotstyle {
      margin-bottom: 10px !important;
    }
    .lotstyle2 {
      display: none;
    }
    .gridgapstyle {
      gap: 32px !important;
    }
  }
</style>

<div class="exchange__wrapper">
    <div class="container-fluid">
      <div class="row sm-gutters">
        @include('layouts.topbar')
        <div class="col-lg-4 col-xl-3">
          <div class="exchange__widget">
            <h2 class="exchange__widget-title">{{ __('forex_symbol') }}</h2>
            <div class="tab-content">
              <div class="tab-pane fade show active" id="BTC" role="tabpanel" style="overflow-x:auto;">
                <table class="table">
                  <thead>
                    <tr>
                      <th style="min-width: 125px">{{ __('name') }}</th>
                      <th>{{ __('bid') }}</th>
                      <th>{{ __('ask') }}</th>
                    </tr>
                  </thead>
                  <tbody class="exchange__widget__table">
                    @foreach ($allPairs as $allPair)
                      <tr data-symbol="{{ $allPair->symbol_pair }}" onclick="selectSymbol('{{ $allPair->symbol_pair }}')">
                        <td style="min-width: 115px">
                          {{-- <img id="symbol_icon" src="{{ asset('assets/img/symbolIcon/' . $allPair->symbol_pair . '.png') }}" alt="forex Pair" style="width: 20px; height: auto;">  --}}
                          {{ $allPair->base }}{{ $allPair->quote }}
                        </td>
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
          <div class="exchange__widget mobileHidden">
            <div class="exchange__widget-title" style="display: flex;justify-content:space-between">
              <span>{{ __('order_history') }}</span>
              <a href="{{ route('orders') }}">
                <i class="fa-solid fa-circle-arrow-right" style="color: white"></i>
              </a>
            </div>
            <table class="table">
              <thead>
                <tr>
                  <th>{{ __('symbol') }}</th>
                  <th>{{ __('type') }}</th>
                  <th>{{ __('profit') }}</th>
                  {{-- <th>Status</th> --}}
                </tr>
              </thead>
              <tbody class="exchange__widget__table">
                @foreach ($orderHistories as $orderHistory)
                  <tr>
                    <td>
                      {{ $orderHistory->symbol }}
                    </td>
                    @if ($orderHistory->type === 'buy')
                      <td>
                        Buy
                      </td>
                    @else
                      <td>
                        Sell
                      </td>
                    @endif
                    @if ($orderHistory->closed_profit > 0)
                      <td style="color:#16a34a">
                        $+{{ $orderHistory->closed_profit }}
                      </td>
                    @else
                      <td style="color: #dc2626">
                        ${{ $orderHistory->closed_profit }}
                      </td>
                    @endif
                    {{-- <td style="color: #dc2626">
                      {{ $orderHistory->status }}
                    </td> --}}
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          
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
            <div style="background:#1d4ed8; display:flex; justify-content:center;align-items: center;gap: 20px">
              <div>
                <img id="currencyImage" src="" alt="Currency Pair" style="width: 60px; height: auto;">
              </div>
              <div id="selSym" style="font-size: 20px;font-weight: bold" class="text-2xl text-white text-center font-bold">sym</div>
            </div>
            
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
              {{-- <li class="nav-item" role="presentation">
                <a class="nav-link active" id="pills-market-order-tab" data-toggle="pill" href="#pills-market-order"
                  role="tab" aria-controls="pills-market-order" aria-selected="true">Market order</a>
              </li> --}}
              {{-- <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-limite-order-tab" data-toggle="pill" href="#pills-limite-order"
                  role="tab" aria-controls="pills-limite-order" aria-selected="false">Limit order</a>
              </li> --}}
              {{-- <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-stop-market-tab" data-toggle="pill" href="#pills-stop-market" role="tab"
                  aria-controls="pills-stop-market" aria-selected="false">Stop market</a>
              </li> --}}
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-market-order" role="tabpanel"
                aria-labelledby="pills-market-order-tab">
                <div class="exchange__widget__order gridgapstyle">
                  <div class="exchange__widget__order-note-item lotstyle">
                    <p>{{ __('lot_size') }}</p>
                    <input id="order-amount" type="number" min="0.01" step="0.01" value="0.01" class="form-control" placeholder="Amount">
                  </div>
                  <div class="exchange__widget__order-note-item lotstyle2">
                    
                  </div>
                  <div class="exchange__widget__order-note">
                    <h2 class="h2style"><img src="assets/img/svg-icon/buy.svg" class="svgInject" alt="svg">{{ __('quick_buy') }}  </h2> 
                    
                    <button id="buyButton" class="btn-green" type="button" onclick="buyOrder()">
                      {{ __('buy') }}
                      <span id="ask-price">0.0000</span>
                    </button>
                  </div>
                  <div class="exchange__widget__order-note">
                    <h2 class="h2style"><img src="assets/img/svg-icon/sell.svg" class="svgInject" alt="svg">{{ __('quick_sell') }} </h2>
                    {{-- <div class="exchange__widget__order-note-item" style="height: 52px">
                      
                    </div> --}}
                    
                    <button id="sellButton" class="btn-red" type="button" onclick="sellOrder()"> 
                      {{ __('sell') }}
                      <span id="bid-price">0.0000</span>
                    </button>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="pills-limite-order" role="tabpanel"
                aria-labelledby="pills-limite-order-tab">
                <div class="exchange__widget__order">
                  <div class="exchange__widget__order-note">
                    <h2><img src="assets/img/svg-icon/buy.svg" class="svgInject" alt="svg"> Quick buy </h2>
                    <div class="exchange__widget__order-note-item">
                      <p>Volumn</p>
                      <input type="number" class="form-control" placeholder="Amount">
                      
                    </div>
                    
                    <button class="btn-green">Buy</button>
                  </div>
                  <div class="exchange__widget__order-note">
                    <h2><img src="assets/img/svg-icon/sell.svg" class="svgInject" alt="svg"> Quick sell</h2>
                    <div class="exchange__widget__order-note-item">
                      <p>Volumn</p>
                      <input type="number" class="form-control" placeholder="Amount">
                      
                    </div>
                    
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
                      
                    </div>
                    
                    <button class="btn-green">Buy</button>
                  </div>
                  <div class="exchange__widget__order-note">
                    <h2><img src="assets/img/svg-icon/sell.svg" class="svgInject" alt="svg"> Quick sell</h2>
                    <div class="exchange__widget__order-note-item">
                      <p>Volumn</p>
                      <input type="number" class="form-control" placeholder="Amount">
                      
                    </div>
                    
                    <button class="btn-red">Sell</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        </div>
        {{-- end of chart --}}

      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check if $allPairs is not empty
        @if(count($allPairs) > 0)
            // Delay the selection to ensure everything is ready
            setTimeout(() => {
                selectSymbol("{{ $allPairs[0]->symbol_pair }}");
            }, 100); // Small delay to allow for other scripts to load
        @endif
    });
  </script>

  <script>
    async function fetchGroupSymbols() {
        try {
            const response = await fetch("{{ route('getGroupSymbols') }}");
            const data = await response.json();
            
            // Update the groupSymbols variable or perform any UI updates
            window.groupSymbols = data;

            // If you need to update UI elements, do it here
        } catch (error) {
            console.error('Error fetching group symbols:', error);
        }
    }

    // Call this function whenever you want to refresh groupSymbol data
    fetchGroupSymbols();

    // Optionally, set up an interval to periodically refresh data
    setInterval(fetchGroupSymbols, 5000); // Fetch every 60 seconds
  </script>

  <script>
    let forexSocket;
    let candleSocket;
    let forexReconnectInterval = 1000;
    let candleReconnectInterval = 1000;
    let forexReconnectAttempts = 0;
    let candleReconnectAttempts = 0;

    function getWebSocketUrl(path) {
      const appEnv = "{{ env('APP_ENV') }}";
      return appEnv === 'production' 
          ? `wss://backend.fxtrado.com/${path}`
          : `ws://localhost:3000/${path}`;
    }

    // Function to establish WebSocket connection
    function connectForexWebSocket() {
        if (forexSocket && (forexSocket.readyState === WebSocket.OPEN || forexSocket.readyState === WebSocket.CONNECTING)) {
          return;
        }

        const wsUrl = getWebSocketUrl('forex_pair'); // Use the utility function to get the URL
        forexSocket = new WebSocket(wsUrl); // Update this with your correct WebSocket URL
        
        
        // console.log(wsUrl) // for testing purpose

        forexSocket.onopen = function() {
            console.log('Forex WebSocket connection established');
            forexReconnectAttempts = 0;
        };

        forexSocket.onmessage = function(event) {
            // Parse the incoming data (which should be JSON)
            const data = JSON.parse(event.data);
            handleForexData(data);
        };

        forexSocket.onerror = function(error) {
            console.error('Forex WebSocket error:', error);
        };

        forexSocket.onclose = function() {
            console.warn('Forex WebSocket connection closed, attempting to reconnect...');
            setTimeout(() => {
              forexReconnectAttempts++;
              forexReconnectInterval = Math.min(10000, forexReconnectInterval * 2); // Max wait time of 10 seconds
              connectForexWebSocket();
            }, forexReconnectInterval);
        };
    }

    // Function to establish Candle WebSocket connection
    function connectCandleWebSocket() {
      if (candleSocket && (candleSocket.readyState === WebSocket.OPEN || candleSocket.readyState === WebSocket.CONNECTING)) {
        return;
      }

      const wsUrl = getWebSocketUrl('live_candle');
      candleSocket = new WebSocket(wsUrl);

      candleSocket.onopen = function() {
        console.log('Candle WebSocket connection established');
        candleReconnectAttempts = 0;
      };

      candleSocket.onmessage = function(event) {
          const data = JSON.parse(event.data);
          handleCandleData(data); // New function to handle Candle data updates
      };

      candleSocket.onerror = function(error) {
        console.error('Candle WebSocket error:', error);
      };

      candleSocket.onclose = function() {
          console.warn('Candle WebSocket connection closed, attempting to reconnect...');
          setTimeout(() => {
              candleReconnectAttempts++;
              candleReconnectInterval = Math.min(10000, candleReconnectInterval * 2);
              connectCandleWebSocket();
          }, candleReconnectInterval);
      };
    }

    // Handle Forex Data
    function handleForexData(data) {
      // Your existing logic for handling forex data
      const selectedSymbolElement = document.getElementById('selected-symbol');
      const selectedSymbol = selectedSymbolElement.innerText.trim();
      
      if (window.groupSymbols) {
          const selectedSymbolData = window.groupSymbols.find(item => item.symbol === selectedSymbol);
          if (selectedSymbolData) {
              const spreadAdjustment = selectedSymbolData.spread;
              updateTableRow(data.symbol, data.bid, data.ask, data.digits);
              if (data.symbol === selectedSymbol) {
                  const spreadFactor = spreadAdjustment / Math.pow(10, data.digits);
                  const adjustedAsk = parseFloat(data.ask) + spreadFactor;
                  const adjustedBid = parseFloat(data.bid) + spreadFactor;
                  document.getElementById('ask-price').innerText = adjustedAsk.toFixed(data.digits);
                  document.getElementById('bid-price').innerText = adjustedBid.toFixed(data.digits);
                  // liveUpdateCandlestick(data, spreadFactor);
              }
          }
      } else {
          console.error('groupSymbols is not defined');
      }
    }

    function handleCandleData(data) {
      const selectedSymbolElement = document.getElementById('selected-symbol');
      const selectedSymbol = selectedSymbolElement.innerText.trim();

      if (window.groupSymbols) {
        const selectedSymbolData = window.groupSymbols.find(item => item.symbol === selectedSymbol);

        if (selectedSymbolData) {
          const spreadAdjustment = selectedSymbolData.spread;

          if (data.symbol === selectedSymbol) {
            const spreadFactor = spreadAdjustment / Math.pow(10, data.digits);
            const groupName = selectedSymbolData.group_name;
            if (data.group === groupName) {
              liveUpdateCandlestick(data, spreadFactor, groupName);
            }
          }

        }
      }
    }

    const previousPrices = {};

    // Function to update table rows with the bid/ask values
    function updateTableRow(symbol, bid, ask, digits) {
        // Find the row with the data-symbol attribute matching the symbol (e.g., EUR/USD)
        const row = document.querySelector(`tr[data-symbol='${symbol}']`);
      
        if (row) {
          
          const bidCell = row.querySelector('.bid');
          const askCell = row.querySelector('.ask');
          
          // Check if bid and ask cells are found
          if (bidCell && askCell) {
              const symbolData = groupSymbols.find(item => item.symbol === symbol);
              const spreadAdjustment = symbolData ? symbolData.spread : 0;
              
              // Calculate spread factor based on the symbol's decimal places (digits)
              const spreadFactor = spreadAdjustment / Math.pow(10, digits);
              
              const adjustedBid = parseFloat(bid) + spreadFactor;
              const adjustedAsk = parseFloat(ask) + spreadFactor;

              // console.log('adjustedBid:', adjustedBid, 'bid:', bid, 'spreadFactor:', spreadFactor)

              bidCell.innerText = adjustedBid.toFixed(digits);
              askCell.innerText = adjustedAsk.toFixed(digits);

              // Get previous prices for this symbol
              const prevBid = previousPrices[symbol]?.adjustedBid || 0;
              const prevAsk = previousPrices[symbol]?.adjustedAsk || 0;

              // Update the bid and ask values
              

              // Determine color change for bid
              if (adjustedBid > prevBid || adjustedAsk > prevAsk) {
                  bidCell.style.color = '#16a34a';  // Green for price increase
                  askCell.style.color = '#16a34a';  // Green for price increase

              } else if (adjustedBid < prevBid || adjustedBid < prevBid) {
                  bidCell.style.color = '#dc2626';  // Red for price decrease
                  askCell.style.color = '#dc2626';  // Red for price decrease
              }

              // Store current prices as previous for next update
              previousPrices[symbol] = { adjustedBid, adjustedAsk };
          }
      } else {
          console.error(`Row not found for symbol: ${symbol}`);
      }
    }

    // Initialize WebSocket connection when the page loads
    window.onload = function() {
      connectForexWebSocket();
      connectCandleWebSocket();
    };

    window.addEventListener('beforeunload', () => {
      if (forexSocket) forexSocket.close();
      if (candleSocket) candleSocket.close();
    });

    // const selectSymbol = (currencyPair) => {
    //   const container = document.getElementById('selected-pair-container');
    //   const forexChart = document.getElementById('symbol-chart');
    //   const forexOrder = document.getElementById('symbol-order');
    //   const symbolElement = document.getElementById('selected-symbol');
    //   symbolElement.innerText = currencyPair;
      
    //   symbolElement.style.display = 'none';
    //   selSym.innerText = currencyPair;
    //   const currencyImage = document.getElementById('currencyImage');

    //   currencyImage.src = `/assets/img/symbolIcon/${currencyPair}.png`;

    //   if (currencyPair) {
    //     forexChart.style.display = 'block';
    //     forexOrder.style.display = 'block';
    //     container.style.display = 'block';
    //   }

    //   document.getElementById('ask-price').innerText = '0.0000';
    //   document.getElementById('bid-price').innerText = '0.0000';
    // }

    const buyOrder = async () => {
      const selectedSymbol = document.getElementById('selected-symbol').innerText;
      const askPrice = document.getElementById('ask-price').innerText;
      const userId = window.userID = {{ auth()->id() }};
      let lot = document.getElementById('order-amount').value;
      const buyButton = document.getElementById('buyButton');

      // Disable the button to prevent multiple submissions
      buyButton.disabled = true;
      buyButton.style.setProperty('background', '#1f2937', 'important');

      // Default to 0.01 if the input is empty or less than the minimum value
      if (!lot || parseFloat(lot) < 0.01) {
          lot = 0.01;
      }

      const api = window.appEnv === 'production' ? 'https://fxtrado-backend.currenttech.pro/api/openOrders' : 'http://localhost:3000/api/openOrders';
      // Make sure a symbol is selected before sending the request
      if (selectedSymbol !== 'None') {
        const orderData = {
          symbol: selectedSymbol,
          price: askPrice,
          type: 'buy', // Specify buy order
          quantity: 1, // You can customize the quantity
          user_id: userId,
          status: 'open',
          volume: lot ? lot : '0.01',
        };

        // Post to laravel backend
        try {

          const response = await axios.post('/openOrders', {
            symbol: selectedSymbol,
            price: askPrice,
            type: 'buy', // Specify buy order
            quantity: 1, // You can customize the quantity
            user_id: userId,
            status: 'open',
            volume: lot ? lot : '0.01',
          });

          if (response.data.success) {
            Toastify({
              text: "Order successfully placed",
              duration: 3000,
              destination: "https://github.com/apvarun/toastify-js",
              newWindow: true,
              close: true,
              gravity: "top", // `top` or `bottom`
              position: "right", // `left`, `center` or `right`
              stopOnFocus: true, // Prevents dismissing of toast on hover
              style: {
                background: "linear-gradient(to right, #86efac, #15803d)",
              },
              onClick: function(){} // Callback after click
            }).showToast();
          } else {
            Toastify({
              text: "Failed to place order",
              duration: 3000,
              destination: "https://github.com/apvarun/toastify-js",
              newWindow: true,
              close: true,
              gravity: "top", // `top` or `bottom`
              position: "right", // `left`, `center` or `right`
              stopOnFocus: true, // Prevents dismissing of toast on hover
              style: {
                background: "linear-gradient(to right, #f87171, #b91c1c)",
              },
              onClick: function(){} // Callback after click
            }).showToast();
          }

        }  catch (error) {
          console.error('server error:', error);

          Toastify({
              text: "Error placing order",
              duration: 3000,
              destination: "https://github.com/apvarun/toastify-js",
              newWindow: true,
              close: true,
              gravity: "top", // `top` or `bottom`
              position: "right", // `left`, `center` or `right`
              stopOnFocus: true, // Prevents dismissing of toast on hover
              style: {
                background: "linear-gradient(to right, #f87171, #b91c1c)",
              },
              onClick: function(){} // Callback after click
            }).showToast();
            
          } finally {
            buyButton.disabled = false;
            buyButton.style.setProperty('background', '#05c46b');
          }
        

        // Post the order to the API
        // try {
        //   const response = await fetch(`${api}`, {
        //     method: 'POST',
        //     body: JSON.stringify(orderData),
        //   });

        //   const result = await response.json();

        //   if (response.ok) {
        //     console.log('Order successfully placed', result);

        //     Toastify({
        //       text: "Order successfully placed",
        //       duration: 3000,
        //       destination: "https://github.com/apvarun/toastify-js",
        //       newWindow: true,
        //       close: true,
        //       gravity: "top", // `top` or `bottom`
        //       position: "right", // `left`, `center` or `right`
        //       stopOnFocus: true, // Prevents dismissing of toast on hover
        //       style: {
        //         background: "linear-gradient(to right, #86efac, #15803d)",
        //       },
        //       onClick: function(){} // Callback after click
        //     }).showToast();

        //   } else {
        //     Toastify({
        //       text: "Error placing order",
        //       duration: 3000,
        //       destination: "https://github.com/apvarun/toastify-js",
        //       newWindow: true,
        //       close: true,
        //       gravity: "top", // `top` or `bottom`
        //       position: "right", // `left`, `center` or `right`
        //       stopOnFocus: true, // Prevents dismissing of toast on hover
        //       style: {
        //         background: "linear-gradient(to right, #f87171, #b91c1c)",
        //       },
        //       onClick: function(){} // Callback after click
        //     }).showToast();
        //     console.error('Error placing order:', result.message);
        //   }
        // } catch (error) {
        //   console.error('Network or server error:', error);
        // }
      } else {
        alert('Please select a symbol before placing an order');
      }
    }

    const sellOrder = async () => {
        const selectedSymbol = document.getElementById('selected-symbol').innerText;
        const bidPrice = document.getElementById('bid-price').innerText;
        const userId = window.userID = {{ auth()->id() }};
        let lot = document.getElementById('order-amount').value;
        const sellButton = document.getElementById('sellButton');

        // Disable the button to prevent multiple submissions
        sellButton.disabled = true;
        sellButton.style.setProperty('background', '#1f2937', 'important');

        if (!lot || parseFloat(lot) < 0.01) {
          lot = 0.01;
        }

        const api = window.appEnv === 'production' ? 'https://fxtrado-backend.currenttech.pro/api/openOrders' : 'http://localhost:3000/api/openOrders';

        // Make sure a symbol is selected before sending the request
        if (selectedSymbol !== 'None') {
          const orderData = {
            symbol: selectedSymbol,
            price: bidPrice,
            type: 'sell', // Specify buy order
            quantity: 1, // You can customize the quantity
            user_id: userId,
            status: 'open',
            volume: lot ?? '0.01',
          };

          try {

          const response = await axios.post('/openOrders', {
            symbol: selectedSymbol,
            price: bidPrice,
            type: 'sell', // Specify buy order
            quantity: 1, // You can customize the quantity
            user_id: userId,
            status: 'open',
            volume: lot ? lot : '0.01',
          });

          if (response.data.success) {
            Toastify({
              text: "Order successfully placed",
              duration: 3000,
              destination: "https://github.com/apvarun/toastify-js",
              newWindow: true,
              close: true,
              gravity: "top", // `top` or `bottom`
              position: "right", // `left`, `center` or `right`
              stopOnFocus: true, // Prevents dismissing of toast on hover
              style: {
                background: "linear-gradient(to right, #86efac, #15803d)",
              },
              onClick: function(){} // Callback after click
            }).showToast();
          } else {
            Toastify({
              text: "Failed to place order",
              duration: 3000,
              destination: "https://github.com/apvarun/toastify-js",
              newWindow: true,
              close: true,
              gravity: "top", // `top` or `bottom`
              position: "right", // `left`, `center` or `right`
              stopOnFocus: true, // Prevents dismissing of toast on hover
              style: {
                background: "linear-gradient(to right, #f87171, #b91c1c)",
              },
              onClick: function(){} // Callback after click
            }).showToast();
          }

          }  catch (error) {
            console.error('server error:', error);
            Toastify({
                text: "Error placing order",
                duration: 3000,
                destination: "https://github.com/apvarun/toastify-js",
                newWindow: true,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                  background: "linear-gradient(to right, #f87171, #b91c1c)",
                },
                onClick: function(){} // Callback after click
              }).showToast();

          } finally {
            sellButton.disabled = false;
            sellButton.style.setProperty('background', '#ff3f34');
          }

          // Post the order to the API
          // try {
          //   const response = await fetch(`${api}`, {
          //     method: 'POST',
          //     headers: {
          //       'Content-Type': 'application/json',
          //     },
          //     body: JSON.stringify(orderData),
          //   });

          //   const result = await response.json();

          //   if (response.ok) {
          //     console.log('Order successfully placed', result);

          //     Toastify({
          //       text: "Order successfully placed",
          //       duration: 3000,
          //       destination: "https://github.com/apvarun/toastify-js",
          //       newWindow: true,
          //       close: true,
          //       gravity: "top", // `top` or `bottom`
          //       position: "right", // `left`, `center` or `right`
          //       stopOnFocus: true, // Prevents dismissing of toast on hover
          //       style: {
          //         background: "linear-gradient(to right, #86efac, #15803d)",
          //       },
          //       onClick: function(){} // Callback after click
          //     }).showToast();

          //   } else {
          //     console.error('Error placing order:', result.message);

          //     Toastify({
          //       text: "Error placing order",
          //       duration: 3000,
          //       destination: "https://github.com/apvarun/toastify-js",
          //       newWindow: true,
          //       close: true,
          //       gravity: "top", // `top` or `bottom`
          //       position: "right", // `left`, `center` or `right`
          //       stopOnFocus: true, // Prevents dismissing of toast on hover
          //       style: {
          //         background: "linear-gradient(to right, #f87171, #b91c1c)",
          //       },
          //       onClick: function(){} // Callback after click
          //     }).showToast();
          //   }
          // } catch (error) {
          //   console.error('Network or server error:', error);
          // }
        } else {
          alert('Please select a symbol before placing an order');
        }
    }
  </script>

@endsection