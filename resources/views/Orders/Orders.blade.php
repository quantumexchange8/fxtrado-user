@extends('layouts.master')
@section('contents')
    <div class="exchange__wrapper">
        <div class="container-fluid">
            <div class="row sm-gutters">
                @include('layouts.topbar')

                {{-- content --}}
                <div class="col-lg-4 col-xl-4">
                    <div class="exchange__widget">
                      <h2 class="exchange__widget-title" style="margin-bottom: 10px">Order</h2>
                      {{-- <div style="color:white;font-weight:700">Floating Profit: <span id="floatingProfit"></span> </div> --}}
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Symbol</th>
                            {{-- <th>Order ID</th> --}}
                            <th style="min-width:80px">Type</th>
                            <th style="min-width:120px">P/L</th>
                          </tr>
                        </thead>
                        <tbody class="exchange__widget__table" id="orders-table-body">
                        </tbody>
                      </table>
                    </div>
                    <div class="exchange__widget">
                        <h2 class="exchange__widget-title">Order History</h2>
                        <table class="table" style="overflow-x:auto;">
                          <thead>
                            <tr>
                              <th>Symbol</th>
                              <th>Order ID</th>
                              <th>Type</th>
                              <th>P/L</th>
                            </tr>
                          </thead>
                          <tbody class="exchange__widget__table">
                            @foreach ($orders as $order) 
                              <tr onclick="selectOrders({{ json_encode($order) }})">
                                <td>{{ $order->symbol }}</td>
                                <td>{{ $order->order_id }}</td>
                                @if ($order->type === 'buy')
                                  <td style="color:green">Buy</td>
                                @else
                                  <td style="color:red">Sell</td>
                                @endif
                                @if ($order->profit > 0)
                                  <td style="color: green">${{ $order->profit }}</td>
                                @else
                                  <td style="color: red">${{ $order->profit }}</td>
                                @endif
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                    </div>
                </div>
                <div style="display: flex;justify-content: center;background:#171717" class="col-lg-8 col-xl-8">
                    <div style="color: white;display:flex;justify-content: center;font-size:20px">
                      <p><strong id="selected-symbol">Choose Orders to view details..</strong></p>
                    </div>
                    <div class="exchange__widget" style="width: 100%; display: none" id="symbol-order">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                          <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="pills-market-order-tab" data-toggle="pill" href="#pills-market-order"
                              role="tab" aria-controls="pills-market-order" aria-selected="true">Info</a>
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
                                    <h2 class="exchange__widget-title">Position ID: <span id="positionID" ></span></h2>
                                    {{-- <h2 class="exchange__widget-title">Margin: <span id="marginData" ></span></h2> --}}
                                    <h2 class="exchange__widget-title">Open Time: <span id="openTimeData" ></span></h2>
                                    <h2 class="exchange__widget-title">Type: <span id="typeData" ></span></h2>
                                    <h2 class="exchange__widget-title">Lot Size: <span id="lotSizeData" ></span></h2>
                                    <h2 class="exchange__widget-title">Open Price: <span id="openPriceData" ></span> -> <span id="marketPrice" ></span></h2>
                                    {{-- <h2 class="exchange__widget-title">Current Price: <span id="currentPriceData" ></span></h2> --}}

                                    <div>
                                        
                                        <div>
                                            
                                        </div>

                                        <button id="closeButton" class="btn-blue" type="button" style="width: 100%" onclick="closeOrder()">
                                            Close Order 
                                            <span id="ask-price">0.0000</span>
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
                                  <h2 class="exchange__widget-title">Symbol: <span id="selSymHistory" >sym</span></h2>
                                  <h2 class="exchange__widget-title">Order ID: <span id="positionIDHistory" ></span></h2>
                                  <h2 class="exchange__widget-title">Open Time: <span id="openTimeDataHistory" ></span></h2>
                                  <h2 class="exchange__widget-title">Close Time: <span id="closeTimeDataHistory" ></span></h2>
                                  <h2 class="exchange__widget-title">Type: <span id="typeDataHistory" ></span></h2>
                                  <h2 class="exchange__widget-title">Open Price: $ <span id="openPriceDataHistory" ></span></h2>
                                  <h2 class="exchange__widget-title">Close Price: $ <span id="closePriceDataHistory" ></span></h2>
                                  <h2 class="exchange__widget-title">Lot Size: <span id="lotSizeDataHistory" ></span></h2>
                                  <h2 class="exchange__widget-title">P/L: $ <span id="profitDataHistory" ></span></h2>
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
        const askPriceElement = document.getElementById('ask-price');
        const marketElement = document.getElementById('marketPrice');
        const selectedSymbolElement = document.getElementById('selected-symbol');
        const symbolOrderElement = document.getElementById('symbol-order');
        const orderHistoryElement = document.getElementById('order-history');

        window.appEnv = "{{ env('APP_ENV') }}";
        const baseUrl = window.appEnv === 'production' ? 'https://fxtrado-backend.currenttech.pro' : 'http://localhost:3000';
        const userId = window.userID = {{ auth()->id() }};

        function connectWebSocket() {
            const wsUrl = window.appEnv === 'production' ? 'wss://fxtrado-backend.currenttech.pro/getOrder' : 'ws://localhost:3000/getOrder';
            socket = new WebSocket(wsUrl);

            socket.onopen = function() {
              socket.send(JSON.stringify({ userId: userId }));
              console.log('WebSocket connection established');
            };

            socket.onmessage = function(event) {
                const data = JSON.parse(event.data);
                const orderData = data.pOrders;
                
                // const filterUser = orderData.filter(user => user.user_id === userId)

                // Get the table body element
                const ordersTableBody = document.getElementById('orders-table-body');

                // Clear the table body before appending new data
                ordersTableBody.innerHTML = '';
                if (orderData && orderData.length > 0) {
                    orderData.forEach(order => {
                        const row = document.createElement('tr');

                        const symbolCell = document.createElement('td');
                        symbolCell.textContent = order.symbol;
                        row.appendChild(symbolCell);

                        row.onclick = () => {
                            if (order.symbol) {
                                selSym.innerText = order.symbol;
                                positionID.innerText = order.order_id;
                                typeData.innerText = order.type;
                                lotSizeData.innerText = order.volume;
                                openPriceData.innerText = order.price;
                                
                                // currentPriceData.innerText = order.price;

                                const openTimeElement = document.getElementById('openTimeData');

                                // Convert the ISO string to a JavaScript Date object
                                const openTime = new Date(order.open_time);

                                // Get the date components
                                const year = openTime.getFullYear();
                                const month = String(openTime.getMonth() + 1).padStart(2, '0');  // Months are zero-based
                                const day = String(openTime.getDate()).padStart(2, '0');

                                // Get the time components
                                const hours = String(openTime.getHours()).padStart(2, '0');
                                const minutes = String(openTime.getMinutes()).padStart(2, '0');
                                const seconds = String(openTime.getSeconds()).padStart(2, '0');

                                // Format the date and time as "YYYY-MM-DD HH:MM:SS"
                                const formattedOpenTime = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;

                                // Set the formatted date and time in the HTML element
                                openTimeElement.innerText = formattedOpenTime;

                                // Update the selectedSymbol to the clicked symbol
                                selectedSymbol = order.symbol;
                                selectedOrder = order; 

                                // If the symbol exists, update the symbol-order and hide the selected-symbol
                                symbolOrderElement.style.display = 'block';
                                selectedSymbolElement.style.display = 'none';
                                orderHistoryElement.style.display = 'none';

                                // You can add code here to load the chart or details for the selected symbol

                                askPriceElement.innerText = order.profit || '0.0000';
                                if (order.type === 'buy') {
                                  marketElement.innerText = order.market_ask || '0.0000';
                                } else if (order.type === 'sell') {
                                  marketElement.innerText = order.market_bid || '0.0000';
                                }
                            }
                        };

                        // const orderIdCell = document.createElement('td');
                        // orderIdCell.textContent = order.order_id || 'N/A';

                        const typeCell = document.createElement('td');

                        const icon = document.createElement('i');
                        if (order.type === 'buy') {
                            icon.classList.add('fa-solid', 'fa-caret-up');  // Buy = caret up
                            typeCell.style.color = 'green';
                        } else {
                            icon.classList.add('fa-solid', 'fa-caret-down');  // Sell = caret down
                            typeCell.style.color = 'red';
                        }
                        typeCell.appendChild(icon);  // Append icon to the typeCell

                        // Append type text
                        const typeText = document.createTextNode(' ' + (order.type || 'N/A'));  // Add space before type
                        typeCell.appendChild(typeText);

                        const amtCell = document.createElement('td');
                        
                        // Format profit/loss with +US$ or -US$ based on the value
                        let formattedProfit;
                        if (order.profit < 0) {
                            formattedProfit = `-US$${Math.abs(order.profit).toFixed(2)}`;  // Ensure no double negative, and show two decimal places
                            amtCell.style.color = 'red';  // Red color for negative profit
                        } else {
                            formattedProfit = `+US$${order.profit}`;  // Positive profit with two decimal places
                            amtCell.style.color = 'green';  // Green color for positive profit
                        }
                        
                        amtCell.textContent = formattedProfit || 'N/A';

                        // row.appendChild(orderIdCell);
                        row.appendChild(typeCell);
                        row.appendChild(amtCell);

                        ordersTableBody.appendChild(row);
                    });

                    if (selectedSymbol && selectedOrder) {
                      // Check if the selected symbol is still in the latest filtered data
                      const updatedOrder = orderData.find(order => order.symbol === selectedSymbol);

                      if (updatedOrder) {
                          // Keep the symbol-order visible and update the ask-price with the latest profit
                          symbolOrderElement.style.display = 'block';
                          selectedSymbolElement.style.display = 'none';
                          orderHistoryElement.style.display = 'none';

                          askPriceElement.innerText = updatedOrder.profit || '0.0000';
                          if (updatedOrder.type === 'buy') {
                            marketElement.innerText = updatedOrder.market_ask || '0.0000';
                          } else if (updatedOrder.type === 'sell') {
                            marketElement.innerText = updatedOrder.market_bid || '0.0000';
                          }
                      } else {
                          // If the symbol no longer exists in the data, reset to default
                          selectedSymbol = null;
                          symbolOrderElement.style.display = 'none';
                          orderHistoryElement.style.display = 'none';
                          selectedSymbolElement.style.display = 'block';
                          selectedSymbolElement.textContent = 'Choose forex symbol to view chart..';
                          askPriceElement.innerText = '0.0000';
                          marketElement.innerText = '0.0000';
                      }
                    } 

                } else {
                    const row = document.createElement('tr');
                    const noDataCell = document.createElement('td');
                    noDataCell.colSpan = 3; // Adjust this based on the number of columns
                    noDataCell.textContent = 'No orders available';
                    row.appendChild(noDataCell);
                    ordersTableBody.appendChild(row);
                    selectedSymbol = null;
                    symbolOrderElement.style.display = 'none';
                    orderHistoryElement.style.display = 'none';
                    selectedSymbolElement.style.display = 'block';
                    selectedSymbolElement.textContent = 'Choose forex symbol to view chart..';
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
          const selectedSymbol = document.getElementById('selSym').innerText;
          const askPrice = document.getElementById('ask-price').innerText;
          const orderId = document.getElementById('positionID').innerText;
          const type = document.getElementById('typeData').innerText;
          const marketPrice = document.getElementById('marketPrice').innerText;
          const openPrice = document.getElementById('openPriceData').innerText;
          const userId = window.userID = {{ auth()->id() }};
          const closeButton = document.getElementById('closeButton');

          const api = window.appEnv === 'production' ? 'https://fxtrado-backend.currenttech.pro/api/closeOrder' : 'http://localhost:3000/api/closeOrder';

          if (orderId) {
            const orderData = {
              symbol: selectedSymbol,
              price: askPrice,
              orderId: orderId,
              userId: userId,
              type: type,
              marketPrice: marketPrice,
              openPrice: openPrice,
            };

            try {

              const response = await axios.post('/closeOrder', {
                symbol: selectedSymbol,
                price: askPrice,
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
              sellButton.disabled = false;
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
          document.getElementById('typeDataHistory').innerText = order.type;
          document.getElementById('openPriceDataHistory').innerText = order.price;
          document.getElementById('closePriceDataHistory').innerText = order.close_price ? order.close_price : 'N/A';
          document.getElementById('lotSizeDataHistory').innerText = order.volume;
          document.getElementById('profitDataHistory').innerText = order.profit ? order.profit : 'N/A';

        }
    </script>
@endsection