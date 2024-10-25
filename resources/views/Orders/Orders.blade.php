@extends('layouts.master')
@section('contents')
    <div class="exchange__wrapper">
        <div class="container-fluid">
            <div class="row sm-gutters">
                @include('layouts.topbar')

                {{-- content --}}
                <div class="col-lg-8 col-xl-8">
                    <div class="exchange__widget">
                      <h2 class="exchange__widget-title" style="margin-bottom: 10px">Order</h2>
                      {{-- <div style="color:white;font-weight:700">Floating Profit: <span id="floatingProfit"></span> </div> --}}
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Open Time</th>
                            <th>Symbol</th>
                            <th>Order ID</th>
                            <th>Open Price</th>
                            <th>Lot</th>
                            <th style="min-width:80px">Type</th>
                            <th>P/L</th>
                          </tr>
                        </thead>
                        <tbody class="exchange__widget__table">
                          @foreach ($openOrders as $openOrder)
                            <tr onclick="selectOpenOrders({{ json_encode($openOrder) }})">
                              <td>{{ $openOrder->open_time }}</td>
                              <td>{{ $openOrder->symbol }}</td>
                              <td>{{ $openOrder->order_id }}</td>
                              <td>{{ $openOrder->price }}</td>
                              <td>{{ $openOrder->volume }}</td>
                              @if ($openOrder->type === 'buy')
                                <td style="color:green">Buy</td>
                              @else
                                <td style="color:red">Sell</td>
                              @endif
                              <td id="floatingProfit-{{ $openOrder->order_id }}">0.00</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <div class="exchange__widget">
                        <h2 class="exchange__widget-title">Order History</h2>
                        <table class="table" style="overflow-x:auto;">
                          <thead>
                            <tr>
                              <th>Close Date</th>
                              <th>Symbol</th>
                              <th>Order ID</th>
                              <th>Lot</th>
                              <th>P/L</th>
                              <th>Type</th>
                            </tr>
                          </thead>
                          <tbody class="exchange__widget__table">
                            @foreach ($orders as $order) 
                              <tr onclick="selectOrders({{ json_encode($order) }})">
                                <td>{{ $order->close_time }}</td>
                                <td>{{ $order->symbol }}</td>
                                <td>{{ $order->order_id }}</td>
                                <td>{{ $order->volume }}</td>
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
                    <div style="color: white;display:flex;justify-content: center;font-size:20px">
                      <p><strong id="selected-symbol">Choose Orders to view details..</strong></p>
                    </div>
                    <div class="exchange__widget" style="width: 100%; display: none" id="symbol-order">
                        <ul class="nav mb-3" id="pills-tab" role="tablist">
                          <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="pills-market-order-tab" style="padding: 0px; color:white;font-size:18px;font-weight:600" data-toggle="pill" href="#pills-market-order"
                              role="tab" aria-controls="pills-market-order" aria-selected="true">Order Details</a>
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
                                    <h2 class="exchange__widget-title" style="margin-bottom: 0px;font-weight:600">Symbol: <span id="selSym" >sym</span></h2>
                                    <h2 class="exchange__widget-title">Position ID: <span style="font-weight:600" id="positionID" ></span></h2>
                                    {{-- <h2 class="exchange__widget-title">Margin: <span id="marginData" ></span></h2> --}}
                                    <h2 class="exchange__widget-title">Open Time: <span style="font-weight:600" id="openTimeData" ></span></h2>
                                    <h2 class="exchange__widget-title">Type: <span style="font-weight:600" id="typeData" ></span></h2>
                                    <h2 class="exchange__widget-title">Lot Size: <span style="font-weight:600" id="lotSizeData" ></span></h2>
                                    <h2 class="exchange__widget-title">Open Price: <span style="font-weight:600" id="openPriceData" ></span></h2>
                                    <h2 class="exchange__widget-title">Current Price: <span style="font-weight:600" id="marketPrice" >0.00000</span></h2>
                                    <h2 class="exchange__widget-title">Profit / Loss: $<span style="font-weight:600" id="profitData" >0.00</span></h2>

                                    <div>
                                        
                                        <div>
                                            
                                        </div>

                                        <button id="closeButton" class="btn-blue" type="button" style="width: 100%" onclick="closeOrder()">
                                            Close Order 
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
                            role="tab" aria-controls="pills-market-order" aria-selected="true">Info</a>
                        </li>
                      </ul>
                      <div class="tab-content" id="pills-tabContent">
                          {{-- Info --}}
                          <div class="tab-pane fade show active" id="pills-market-order" role="tabpanel"
                              aria-labelledby="pills-market-order-tab">
                              <div class="text-white">
                                  <h2 class="exchange__widget-title">Symbol: <span id="selSymHistory" style="font-weight: 600" >sym</span></h2>
                                  <h2 class="exchange__widget-title">Order ID: <span id="positionIDHistory" style="font-weight: 600"></span></h2>
                                  <h2 class="exchange__widget-title">Open Time: <span id="openTimeDataHistory" style="font-weight: 600"></span></h2>
                                  <h2 class="exchange__widget-title">Close Time: <span id="closeTimeDataHistory" style="font-weight: 600"></span></h2>
                                  <h2 class="exchange__widget-title">Type: <span id="typeDataHistory" style="font-weight: 600"></span></h2>
                                  <h2 class="exchange__widget-title">Open Price: $ <span id="openPriceDataHistory" style="font-weight: 600"></span></h2>
                                  <h2 class="exchange__widget-title">Close Price: $ <span id="closePriceDataHistory" style="font-weight: 600"></span></h2>
                                  <h2 class="exchange__widget-title">Lot Size: <span id="lotSizeDataHistory" style="font-weight: 600"></span></h2>
                                  <h2 class="exchange__widget-title">Profit/Loss: <span id="profitDataHistory" style="font-weight: 600"></span></h2>
                                  <h2 class="exchange__widget-title">Remark: <span id="remarkData" style="font-weight: 600"></span></h2>
                              </div>
                          </div>
                      </div>
                    </div>
                </div>
                {{-- end content --}}
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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

            console.log(wsUrl) // for testing purpose

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
                  
                  if (matchedOrder.profit > 0 ) {
                    profitDataElement.innerText = matchedOrder.profit;
                    profitDataElement.style.color = '#16a34a'
                  } else {
                    profitDataElement.innerText = matchedOrder.profit;
                    profitDataElement.style.color = '#dc2626'
                  }

                  if (matchedOrder.type === 'buy') {
                    marketElement.innerText = matchedOrder.market_bid;
                  } else {
                    marketElement.innerText = matchedOrder.market_ask;
                  }
                  

                }
                
                // if (gotData) {
                //   if (gotData.type === 'buy') {
                //     marketPriceElement.innerText = gotData.market_bid;
                //   } else {
                //     marketPriceElement.innerText = gotData.market_ask;
                //   }

                //   if (gotData.profit > 0) {
                //     profitDataElement.innerText = gotData.profit;
                //     profitDataElement.style.color  = '#16a34a'
                //   } else {
                //     profitDataElement.innerText = gotData.profit;
                //     profitDataElement.style.color  = '#dc2626'
                //   }
                // }
                
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
          const type = document.getElementById('typeData').innerText;
          const marketPrice = document.getElementById('marketPrice').innerText;
          const openPrice = document.getElementById('openPriceData').innerText;
          const userId = window.userID = {{ auth()->id() }};
          const closeButton = document.getElementById('closeButton');
          
          closeButton.disabled = true;
          closeButton.style.background = '#374151'

          const api = window.appEnv === 'production' ? 'https://fxtrado-backend.currenttech.pro/api/closeOrder' : 'http://localhost:3000/api/closeOrder';

          if (orderId) {
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
                orderId: orderId,
                userId: userId,
                type: type,
                marketPrice: marketPrice,
                openPrice: openPrice,
              });

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

              // Redirect to the orders page after showing the toast
              setTimeout(() => {
                  window.location.href = '/orders'; // Change this to your actual route
              }, 3000); // Redirect after 3 seconds

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