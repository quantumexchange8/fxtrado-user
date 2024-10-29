@extends('layouts.master')
@section('contents')

<style>
  @media (max-width: 768px) {
    .exchange__widget, .exchange__widget__trading {
      padding: 0px
    }
    .mobileHidden {
      display: none !important;
    }
    .exchange__widget table tbody {
      height: auto;
    }
  }

</style>

    <div class="exchange__wrapper">
        <div class="container-fluid">
            <div class="row sm-gutters">
                @include('layouts.topbar')

                {{-- content --}}
                <div class="col-lg-8 col-xl-8">
                    <div class="exchange__widget">
                      <h2 class="exchange__widget-title" style="margin-bottom: 10px">{{ __('order') }}</h2>
                      {{-- <div style="color:white;font-weight:700">Floating Profit: <span id="floatingProfit"></span> </div> --}}
                      <table class="table">
                        <thead>
                          <tr>
                            <th class="mobileHidden">{{ __('open_time') }}</th>
                            <th style="width: 115px">{{ __('symbol2') }}</th>
                            <th class="mobileHidden" style="width: 115px">{{ __('order_id') }}</th>
                            <th style="width: 150px">{{ __('open_price') }}</th>
                            <th style="width: 115px">{{ __('lot_size') }}</th>
                            <th style="width: 115px" style="min-width:80px">{{ __('type') }}</th>
                            <th style="width: 115px">{{ __('profit') }}</th>
                          </tr>
                        </thead>
                        <tbody class="exchange__widget__table">
                          @foreach ($openOrders as $openOrder)
                            <tr onclick="window.innerWidth <= 768 ? showMobileModal({{ json_encode($openOrder) }}) : selectOpenOrders({{ json_encode($openOrder) }})">
                              <td class="mobileHidden">{{ $openOrder->open_time }}</td>
                              <td style="width: 115px">{{ $openOrder->symbol }}</td>
                              <td class="mobileHidden" style="width: 115px">{{ $openOrder->order_id }}</td>
                              <td style="width: 150px">{{ $openOrder->price }}</td>
                              <td style="width: 115px">{{ $openOrder->volume }}</td>
                              @if ($openOrder->type === 'buy')
                                <td style="color:green; width: 115px">Buy</td>
                              @else
                                <td style="color:red; width: 115px">Sell</td>
                              @endif
                              <td id="floatingProfit-{{ $openOrder->order_id }}" style="width: 115px">0.00</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <div class="exchange__widget">
                        <h2 class="exchange__widget-title">{{ __('order_order_history') }}</h2>
                        <table class="table" style="overflow-x:auto;">
                          <thead>
                            <tr>
                              <th class="mobileHidden">{{ __('close_date') }}</th>
                              <th>{{ __('symbol2') }}</th>
                              <th class="mobileHidden">{{ __('order_id') }}</th>
                              <th class="mobileHidden">{{ __('lot_size') }}</th>
                              <th >{{ __('profit') }}</th>
                              <th>{{ __('type') }}</th>
                            </tr>
                          </thead>
                          <tbody class="exchange__widget__table">
                            @foreach ($orders as $order) 
                              <tr onclick="window.innerWidth <= 768 ? showMobileOrderModal({{ json_encode($order) }}) : selectOrders({{ json_encode($order) }})">
                                <td class="mobileHidden">{{ $order->close_time }}</td>
                                <td>{{ $order->symbol }}</td>
                                <td class="mobileHidden">{{ $order->order_id }}</td>
                                <td class="mobileHidden">{{ $order->volume }}</td>
                                @if ($order->profit > 0)
                                  <td style="color: green">${{ $order->closed_profit }}</td>
                                @else
                                  <td style="color: red">${{ $order->closed_profit }}</td>
                                @endif
                                @if ($order->type === 'buy')
                                  <td style="color:green">Buy</td>
                                @else
                                  <td style="color:red">Sell</td>
                                @endif
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                    </div>
                </div>
                <div style="display: flex;justify-content: center;background:#171717" class="col-lg-4 col-xl-4">
                    <div class="mobileHidden" style="color: white;display:flex;justify-content: center;font-size:20px">
                      <p><strong id="selected-symbol">Choose Orders to view details..</strong></p>
                    </div>
                    <div class="exchange__widget mobileHidden" style="width: 100%; display: none" id="symbol-order">
                        <ul class="nav mb-3" id="pills-tab" role="tablist">
                          <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="pills-market-order-tab" style="padding: 0px; color:white;font-size:18px;font-weight:600" data-toggle="pill" href="#pills-market-order"
                              role="tab" aria-controls="pills-market-order" aria-selected="true">{{ __('order_detail') }}</a>
                          </li>
                          {{-- <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-limite-order-tab" data-toggle="pill" href="#pills-limite-order"
                              role="tab" aria-controls="pills-limite-order" aria-selected="false">Edit</a>
                          </li> --}}
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            {{-- Info --}}
                            <div class="tab-pane fade show active" id="pills-market-order" role="tabpanel"
                                aria-labelledby="pills-market-order-tab">
                                <div class="text-white">
                                    <h2 class="exchange__widget-title" style="margin-bottom: 0px;font-weight:600">{{ __('symbol2') }}: <span id="selSym" >sym</span></h2>
                                    <h2 class="exchange__widget-title">{{ __('position_id') }}: <span style="font-weight:600" id="positionID" ></span></h2>
                                    {{-- <h2 class="exchange__widget-title">Margin: <span id="marginData" ></span></h2> --}}
                                    <h2 class="exchange__widget-title">{{ __('open_time') }}: <span style="font-weight:600" id="openTimeData" ></span></h2>
                                    <h2 class="exchange__widget-title">{{ __('type') }}: <span style="font-weight:600" id="typeData" ></span></h2>
                                    <h2 class="exchange__widget-title">{{ __('lot_size') }}: <span style="font-weight:600" id="lotSizeData" ></span></h2>
                                    <h2 class="exchange__widget-title">{{ __('open_price') }}: <span style="font-weight:600" id="openPriceData" ></span></h2>
                                    <h2 class="exchange__widget-title">{{ __('current_price') }}: <span style="font-weight:600" id="marketPrice" >0.00000</span></h2>
                                    <h2 class="exchange__widget-title">{{ __('profit') }}: $<span style="font-weight:600" id="profitData" >0.00</span></h2>

                                    <div>
                                        
                                        <div>
                                            
                                        </div>

                                        <button id="closeButton" class="btn-blue" type="button" style="width: 100%" onclick="closeOrder()">
                                          {{ __('close_order') }}
                                            {{-- <span id="ask-price">0.0000</span> --}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            {{-- Edit --}}
                            <div class="tab-pane fade" id="pills-limite-order" role="tabpanel"
                                aria-labelledby="pills-limite-order-tab">
                                <div class="text-white">
                                    2
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="exchange__widget" style="width: 100%; display: none" id="order-history">
                      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="pills-market-order-tab" data-toggle="pill" href="#pills-market-order"
                            role="tab" aria-controls="pills-market-order" aria-selected="true">{{ __('info') }}</a>
                        </li>
                      </ul>
                      <div class="tab-content" id="pills-tabContent">
                          {{-- Info --}}
                          <div class="tab-pane fade show active" id="pills-market-order" role="tabpanel"
                              aria-labelledby="pills-market-order-tab">
                              <div class="text-white">
                                  <h2 class="exchange__widget-title">{{ __('symbol2') }}: <span id="selSymHistory" style="font-weight: 600" >sym</span></h2>
                                  <h2 class="exchange__widget-title">{{ __('position_id') }}: <span id="positionIDHistory" style="font-weight: 600"></span></h2>
                                  <h2 class="exchange__widget-title">{{ __('open_time') }}: <span id="openTimeDataHistory" style="font-weight: 600"></span></h2>
                                  <h2 class="exchange__widget-title">{{ __('close_date') }}: <span id="closeTimeDataHistory" style="font-weight: 600"></span></h2>
                                  <h2 class="exchange__widget-title">{{ __('type') }}: <span id="typeDataHistory" style="font-weight: 600"></span></h2>
                                  <h2 class="exchange__widget-title">{{ __('open_price') }}: $ <span id="openPriceDataHistory" style="font-weight: 600"></span></h2>
                                  <h2 class="exchange__widget-title">{{ __('close_price') }}: $ <span id="closePriceDataHistory" style="font-weight: 600"></span></h2>
                                  <h2 class="exchange__widget-title">{{ __('lot_size') }}: <span id="lotSizeDataHistory" style="font-weight: 600"></span></h2>
                                  <h2 class="exchange__widget-title">{{ __('profit') }}: <span id="profitDataHistory" style="font-weight: 600"></span></h2>
                                  <h2 class="exchange__widget-title">{{ __('remark') }}: <span id="remarkData" style="font-weight: 600"></span></h2>
                              </div>
                          </div>
                      </div>
                    </div>
                </div>
                {{-- end content --}}
            </div>
        </div>
    </div>

    <div class="modal fade" id="mobileModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="orderModalLabel">{{ __('info') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="display: flex; flex-direction:column;gap:8px">
            <div>
              {{ __('symbol2') }}: <span id="modalSymbol"></span>
            </div>
           
            <div>
              {{ __('position_id') }}: <span id="modalOrderId"></span>
            </div>
            <div>
              {{ __('open_time') }}: <span id="modalOpenTime"></span>
            </div>
            <div>
              {{ __('open_price') }}: <span id="modalPrice"></span>
            </div>
            <div>
              {{ __('lot_size') }}: <span id="modalVolume"></span>
            </div>
            <div>
              {{ __('type') }}: <span id="modalType"></span>
            </div>
            <div>
              {{ __('profit') }}: $ <span id="modalProfit"></span>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeMobileModal()" data-dismiss="modal">{{ __('close') }}</button>
            <button type="button" id="closeButton" class="btn btn-primary" onclick="closeOrder()">{{ __('close_order') }}</button>
            
          </div>
        </div>

      </div>
    </div>

    <div class="modal fade" id="mobileOrderModal" tabindex="-1" role="dialog" aria-labelledby="orderHistoryModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="orderHistoryModalLabel">{{ __('order_order_history') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="display: flex; flex-direction:column;gap:8px">
            <div>
              {{ __('symbol2') }}: <span id="symbol2Modal"></span>
            </div>
           
            <div>
              {{ __('position_id') }}: <span id="position_idModal"></span>
            </div>
            <div>
              {{ __('open_time') }}: <span id="open_timeModal"></span>
            </div>
            <div>
              {{ __('close_date') }}: <span id="close_dateModal"></span>
            </div>
            <div>
              {{ __('type') }}: <span id="typeModal"></span>
            </div>
            <div>
              {{ __('open_price') }}: <span id="open_priceModal"></span>
            </div>
            <div>
              {{ __('close_price') }}: <span id="close_priceModal"></span>
            </div>
            <div>
              {{ __('lot_size') }}: <span id="lot_sizeModal"></span>
            </div>
            <div>
              {{ __('profit') }}: $<span id="profitModal"></span>
            </div>
            <div>
              {{ __('remark') }}: <span id="remarkModal"></span>
            </div>
          </div>

        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    @if(count($openOrders) > 0)
      <script>
          document.addEventListener('DOMContentLoaded', function() {
              // Check if the screen width is greater than 768px
              if (window.innerWidth > 768) {
                  const firstOrder = @json($openOrders[0]);
                  selectOpenOrders(firstOrder);
              }
          });

          // Re-run this logic if the window is resized, so it only applies `selectOpenOrders` when width > 768px
          window.addEventListener('resize', function() {
              if (window.innerWidth > 768) {
                  const firstOrder = @json($openOrders[0]);
                  selectOpenOrders(firstOrder);
              }
          });

          function showMobileModal(order) {
            $('#mobileModal').modal('show');

              selectedOrderId = order.order_id;

              // Populate modal with order data
              document.getElementById('modalSymbol').innerText = `${order.symbol}`;
              document.getElementById('modalOrderId').innerText = `${order.order_id}`;
              document.getElementById('modalOpenTime').innerText = ` ${order.open_time}`;
              document.getElementById('modalPrice').innerText = `${order.price}`;
              document.getElementById('modalVolume').innerText = `${order.volume}`;
              document.getElementById('modalType').innerText = `${order.type === 'buy' ? 'Buy' : 'Sell'}`;

              updateProfitDisplay(order.closed_profit || 0);

              // document.getElementById('modalProfit').innerText = `Profit: 0.00`;

              // Display the modal
              document.getElementById('mobileModal').style.display = 'flex';
          }

          function showMobileOrderModal(order) {
            $('#mobileOrderModal').modal('show');

            document.getElementById('symbol2Modal').innerText = `${order.symbol}`;
            document.getElementById('position_idModal').innerText = `${order.order_id}`;
            document.getElementById('open_timeModal').innerText = `${order.open_time}`;
            document.getElementById('close_dateModal').innerText = `${order.close_time}`;
            document.getElementById('typeModal').innerText = `${order.type === 'buy' ? 'Buy' : 'Sell'}`;
            document.getElementById('open_priceModal').innerText = `${order.price}`;
            document.getElementById('close_priceModal').innerText = `${order.close_price}`;
            document.getElementById('lot_sizeModal').innerText = `${order.volume}`;
            document.getElementById('profitModal').innerText = `${order.closed_profit}`;
            document.getElementById('remarkModal').innerText = `${order.remark ? order.remark : '-'}`;
            
          }

          function closeMobileModal() {
              $('#mobileModal').modal('hide');
              document.getElementById('mobileModal').style.display = 'none';
          }

          function updateProfitDisplay(profit) {
            
              const profitElement = document.getElementById('modalProfit');

              if (profit > 0) {
                  profitElement.style.color = 'green';
                  profitElement.innerText = `$ +${profit}`;
              } else {
                  profitElement.style.color = 'red';
                  profitElement.innerText = `$ ${profit}`;
              }
          }
      </script>
    @endif
    <script>
        let socket;
        let reconnectInterval = 5000;
        let selectedSymbol = null;
        let selectedOrder = null;
        // const askPriceElement = document.getElementById('ask-price');
        const marketElement = document.getElementById('marketPrice');
        const selectedSymbolElement = document.getElementById('selected-symbol');
        const symbolOrderElement = document.getElementById('symbol-order');
        const orderHistoryElement = document.getElementById('order-history');
        const selectedSym = document.getElementById('selSym');
        const positionIDElement = document.getElementById('positionID');
        const marketPriceElement = document.getElementById('marketPrice');
        const profitDataElement = document.getElementById('profitData');

        let selectedOrderId = null;

        function getWebSocketUrl() {
          const appEnv = "{{ env('APP_ENV') }}"; // Make sure this is rendered server-side
          return appEnv === 'production' 
              ? 'wss://fxtrado-backend.currenttech.pro/getOrder' 
              : 'ws://localhost:3000/getOrder';
        }

        const userId = window.userID = {{ auth()->id() }};

        const selectOpenOrders = (order) => {
            // Store the selected order's ID
            selectedOrderId = order.order_id;

            // Find the hidden div and message container
            const symbolOrderDiv = document.getElementById('symbol-order');

            const positionID = document.getElementById('positionID');
            const openTimeData = document.getElementById('openTimeData');
            const typeData = document.getElementById('typeData');
            const lotSizeData = document.getElementById('lotSizeData');
            const openPriceData = document.getElementById('openPriceData');

            // Show the hidden div
            symbolOrderDiv.style.display = 'block';
            selectedSymbolElement.style.display = 'none'
            orderHistoryElement.style.display = 'none'
            selectedSym.innerText = order.symbol;
            positionID.innerText = order.order_id;
            openTimeData.innerText = order.open_time;
            
            if (order.type === 'buy') {
              typeData.innerText = 'Buy';
              typeData.style.color = '#16a34a';
            } else {
              typeData.innerText = 'Sell';
              typeData.style.color = '#dc2626';
            }
            lotSizeData.innerText = order.volume;
            openPriceData.innerText = order.price;
        };
        
        function connectWebSocket() {
            if (socket && (socket.readyState === WebSocket.OPEN || socket.readyState === WebSocket.CONNECTING)) {
              return;
            }

            const wsUrl = getWebSocketUrl();
            socket = new WebSocket(wsUrl);

            // console.log(wsUrl) // for testing purpose

            socket.onopen = function() {
              socket.send(JSON.stringify({ userId: userId }));
              console.log('WebSocket connection established');
            };

            socket.onmessage = function(event) {
                const data = JSON.parse(event.data);
                const orderData = data.pOrders;
                
                const matchedOrder = orderData.find(order => order.order_id === selectedOrderId);
                
                orderData.forEach((matchedOrder) => {
                  const floatingProfitElement = document.getElementById(`floatingProfit-${matchedOrder.order_id}`);
                  
                  if (floatingProfitElement) {
                    floatingProfitElement.innerText = '$' + matchedOrder.profit;

                    // Set color based on profit being positive or negative
                    floatingProfitElement.style.color = matchedOrder.profit > 0 ? '#16a34a' : '#dc2626';
                  }
                });

                if (matchedOrder) {
                  const profitDataElement = document.getElementById('profitData');
                  const profitModalDataElement = document.getElementById('modalProfit');
                  
                  
                  if (matchedOrder.profit > 0 ) {
                    profitDataElement.innerText = matchedOrder.profit;
                    profitDataElement.style.color = '#16a34a'

                    profitModalDataElement.innerText = matchedOrder.profit;
                    profitModalDataElement.style.color = '#16a34a'
                  } else {
                    profitDataElement.innerText = matchedOrder.profit;
                    profitDataElement.style.color = '#dc2626'

                    profitModalDataElement.innerText = matchedOrder.profit;
                    profitModalDataElement.style.color = '#dc2626'
                  }

                  if (matchedOrder.type === 'buy') {
                    marketElement.innerText = matchedOrder.market_bid;
                  } else {
                    marketElement.innerText = matchedOrder.market_ask;
                  }
                  

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

        window.onload = function() {
            connectWebSocket();
        };

        // Ensure reconnection if the user refreshes the page
        window.onbeforeunload = function() {
            if (socket) {
                socket.close();
            }
        };

        const closeOrder = async () => {
          
          // const askPrice = document.getElementById('ask-price').innerText;
          const orderId = document.getElementById('positionID').innerText;
          const positionId = document.getElementById('modalOrderId').innerText;
          const type = document.getElementById('typeData').innerText;
          const marketPrice = document.getElementById('marketPrice').innerText;
          const openPrice = document.getElementById('openPriceData').innerText;
          const userId = window.userID = {{ auth()->id() }};
          const closeButton = document.getElementById('closeButton');
          
          closeButton.disabled = true;
          closeButton.style.setProperty('background', '#374151', 'important');

          const api = window.appEnv === 'production' ? 'https://fxtrado-backend.currenttech.pro/api/closeOrder' : 'http://localhost:3000/api/closeOrder';

          if (orderId || positionId) {
            const orderData = {
              symbol: selectedSym,
              price: marketPriceElement,
              orderId: orderId,
              userId: userId,
              type: type,
              marketPrice: marketPrice,
              openPrice: openPrice,
            };

            try {

              
              const response = await axios.post('/closeOrder', {
                symbol: selectedSym,
                price: marketPriceElement,
                orderId: orderId || positionId,
                // positionId: positionId,
                userId: userId,
                type: type,
                marketPrice: marketPrice,
                openPrice: openPrice,
              });

              window.location.href = '/orders';

              // Redirect to the orders page after showing the toast
              // setTimeout(() => {
              //     window.location.href = '/orders'; // Change this to your actual route
              // }, 500); // Redirect after 5 miliseconds

              Toastify({
                text: "Order successfully close",
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

              // const response = await fetch(api, {
              //   method: 'POST',
              //   headers: {
              //     'Content-Type': 'application/json',
              //     'Connection': 'keep-alive',
              //   },
              //   body: JSON.stringify(orderData),
              // });

              // const result = await response.json();

              // if (response.ok) {
              //   console.log('Order Closed', result);

              //   Toastify({
              //     text: "Order successfully close",
              //     duration: 3000,
              //     destination: "https://github.com/apvarun/toastify-js",
              //     newWindow: true,
              //     close: true,
              //     gravity: "top", // `top` or `bottom`
              //     position: "right", // `left`, `center` or `right`
              //     stopOnFocus: true, // Prevents dismissing of toast on hover
              //     style: {
              //       background: "linear-gradient(to right, #86efac, #15803d)",
              //     },
              //     onClick: function(){} // Callback after click
              //   }).showToast();
              // } else {
              //   console.error('Error closing order:', result.message);

              //   Toastify({
              //     text: "Error placing order",
              //     duration: 3000,
              //     destination: "https://github.com/apvarun/toastify-js",
              //     newWindow: true,
              //     close: true,
              //     gravity: "top", // `top` or `bottom`
              //     position: "right", // `left`, `center` or `right`
              //     stopOnFocus: true, // Prevents dismissing of toast on hover
              //     style: {
              //       background: "linear-gradient(to right, #f87171, #b91c1c)",
              //     },
              //     onClick: function(){} // Callback after click
              //   }).showToast();
                
              // }
            } catch (error) {
              console.error('Network or server error:', error);

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
              closeButton.disabled = false;
            }
          }
        }

        const selectOrders = (order) => {
          symbolOrderElement.style.display = 'none';
          selectedSymbolElement.style.display = 'none';
          orderHistoryElement.style.display = 'block';

          document.getElementById('selSymHistory').innerText = order.symbol;
          document.getElementById('positionIDHistory').innerText = order.order_id;
          document.getElementById('openTimeDataHistory').innerText = order.open_time;
          document.getElementById('closeTimeDataHistory').innerText = order.close_time ? order.close_time : 'N/A';  // Handling case where close time might not be available
          
          document.getElementById('openPriceDataHistory').innerText = order.price;
          document.getElementById('closePriceDataHistory').innerText = order.close_price ? order.close_price : 'N/A';
          document.getElementById('lotSizeDataHistory').innerText = order.volume;
          document.getElementById('remarkData').innerText = order.remark ? order.remark : ' - ';
          

          const profitElement = document.getElementById('profitDataHistory');
          
          if (order.closed_profit !== null && order.closed_profit !== undefined) {

            // Apply color based on the profit value
            if (order.closed_profit > 0) {
              profitElement.style.color = 'green'; // Green for positive or zero profit
              profitElement.innerText = '$ +' + order.closed_profit;
            } else {
              profitElement.style.color = 'red';   // Red for negative profit
              profitElement.innerText = '$ ' + order.closed_profit;
            }
          } else {
            profitElement.innerText = 'N/A';
            profitElement.style.color = 'black';  // Default color when there's no profit data
          }

          const typeElement = document.getElementById('typeDataHistory');
          if (order.type === 'buy') {
            typeElement.style.color = 'green';
            typeElement.innerText = 'Buy';
          } else {
            typeElement.style.color = 'red';
            typeElement.innerText = 'Sell';
          }
        }
    </script>
@endsection