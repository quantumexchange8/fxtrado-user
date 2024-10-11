@extends('layouts.master')
@section('contents')
    <div class="exchange__wrapper">
        <div class="container-fluid">
            <div class="row sm-gutters">
                @include('layouts.topbar')

                {{-- content --}}
                <div class="col-lg-4 col-xl-4">
                    <div class="exchange__widget">
                      <h2 class="exchange__widget-title">Order</h2>
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Symbol</th>
                            <th>Order ID</th>
                            <th>Type</th>
                            <th>P/L</th>
                          </tr>
                        </thead>
                        <tbody class="exchange__widget__table" id="orders-table-body">
                        </tbody>
                      </table>
                    </div>
                    <div class="exchange__widget">
                        <h2 class="exchange__widget-title">Order History</h2>
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Symbol</th>
                              <th>Order ID</th>
                              <th>Type</th>
                              <th>P/L</th>
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
                </div>
                <div style="display: flex;justify-content: center;background:#171717" class="col-lg-8 col-xl-8">
                    <div class="exchange__widget" style="width: 100%" id="symbol-order">
                        <div id="selSym" style="font-size: 18px;font-weight: bold" class="text-lg text-white text-center font-bold mb-2 flex justify-center">sym</div>
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                          <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="pills-market-order-tab" data-toggle="pill" href="#pills-market-order"
                              role="tab" aria-controls="pills-market-order" aria-selected="true">Info</a>
                          </li>
                          <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-limite-order-tab" data-toggle="pill" href="#pills-limite-order"
                              role="tab" aria-controls="pills-limite-order" aria-selected="false">Edit</a>
                          </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            {{-- Info --}}
                            <div class="tab-pane fade show active" id="pills-market-order" role="tabpanel"
                                aria-labelledby="pills-market-order-tab">
                                <div class="text-white">
                                    <h2 class="exchange__widget-title" style="margin-bottom: 0px;font-weight:600">Symbol</h2>
                                    <h2 class="exchange__widget-title">{{ 'Order_id' }}: Details</h2>

                                    <div>
                                        
                                        <div>
                                            
                                        </div>

                                        <button class="btn-blue" type="button" style="width: 100%" onclick="closeOrder()">
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
                </div>
                {{-- end content --}}
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        let socket;
        let reconnectInterval = 5000;
        window.appEnv = "{{ env('APP_ENV') }}";
        const baseUrl = window.appEnv === 'production' ? 'https://fxtrado-backend.currenttech.pro' : 'http://localhost:3000';
        const userId = window.userID = {{ auth()->id() }};

        function connectWebSocket() {
            const wsUrl = window.appEnv === 'production' ? 'wss://fxtrado-backend.currenttech.pro/getOrder' : 'ws://localhost:3000/getOrder';
            socket = new WebSocket(wsUrl);

            socket.onopen = function() {
                console.log('WebSocket connection established');
            };

            socket.onmessage = function(event) {
                const data = JSON.parse(event.data);
                const orderData = data.orders;
                
                const filterUser = orderData.filter(user => user.user_id === userId)

                // Get the table body element
                const ordersTableBody = document.getElementById('orders-table-body');

                // Clear the table body before appending new data
                ordersTableBody.innerHTML = '';

                if (filterUser && filterUser.length > 0) {
                    filterUser.forEach(order => {
                        const row = document.createElement('tr');

                        const symbolCell = document.createElement('td');
                        symbolCell.textContent = order.symbol;

                        const orderIdCell = document.createElement('td');
                        orderIdCell.textContent = order.order_id || 'N/A';

                        const typeCell = document.createElement('td');
                        typeCell.textContent = order.type || 'N/A';

                        const amtCell = document.createElement('td');
                        amtCell.textContent = order.amount || 'N/A'; 

                        row.appendChild(symbolCell);
                        row.appendChild(orderIdCell);
                        row.appendChild(typeCell);
                        row.appendChild(amtCell);

                        ordersTableBody.appendChild(row);
                    });
                } else {
                    const row = document.createElement('tr');
                    const noDataCell = document.createElement('td');
                    noDataCell.colSpan = 3; // Adjust this based on the number of columns
                    noDataCell.textContent = 'No orders available';
                    row.appendChild(noDataCell);
                    ordersTableBody.appendChild(row);
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

        // const getOrders = async () => {

        //     try {
        //         const response = await axios.get(`${baseUrl}/api/getOrders`, {
        //             headers: {
        //                 'Content-Type': 'application/json',
        //             },
        //         });

        //         const result = response.data;

        //         const tableBody = document.getElementById('orders-table-body');
        //         tableBody.innerHTML = ''; // Clear any previous data

        //         result.order.forEach(order => {
        //             const row = document.createElement('tr');
        //             console.log(order);
        //             // Add table cells for each data point you want to display
        //             row.innerHTML = `
        //                 <td>${order.symbol}</td>
        //                 <td>${order.type === 'buy' ? 'Buy' : 'Sell'}</td>
        //                 <td>${order.price || 'N/A'}</td>
        //                 <!-- Add more cells as needed -->
        //             `;

        //             // Append the row to the table body
        //             tableBody.appendChild(row);
        //         });
        //     } catch (error) {
        //         console.error('There was an error fetching the orders:', error);
        //     }
        // }

        // getOrders();
    </script>
@endsection