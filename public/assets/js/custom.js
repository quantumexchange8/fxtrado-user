(function ($) {
  // svg inject
  SVGInject(document.querySelectorAll('img.svgInject'));

  let chart, candleSeries, volumeSeries;

  $('.exchange__widget__order-buy-coin .dropdown-menu a').on(
    'click',
    function () {
      $(this)
        .parents('.exchange__widget__order-buy-coin')
        .find('.dropdown-toggle')
        .html($(this).html());
    }
  );

  // header bar toggle
  $('.header__sidebar-icon').on('click', function () {
    $('body').toggleClass('mobile-nav');
  });

  let socket;
  let reconnectInterval = 1000; // Retry after 5 seconds
  let reconnectAttempts = 0;
  let currentSymbol = null;
  window.appEnv = "{{ env('APP_ENV') }}";

  // trading chart version3
  window.selectSymbol = function (currencyPair) {

    const container = document.getElementById('selected-pair-container');
    const forexChart = document.getElementById('symbol-chart');
    const forexOrder = document.getElementById('symbol-order');
    const symbolElement = document.getElementById('selected-symbol');
    
    symbolElement.innerText = currencyPair;
    symbolElement.style.display = 'none';
    const selSym = document.getElementById('selSym'); // Ensure `selSym` is defined
    selSym.innerText = currencyPair;
    
    const currencyImage = document.getElementById('currencyImage');
    currencyImage.src = `/assets/img/symbolIcon/${currencyPair}.png`;

    if (currencyPair) {
      forexChart.style.display = 'block';
      forexOrder.style.display = 'block';
      container.style.display = 'block';
    }

    document.getElementById('ask-price').innerText = '0.0000';
    document.getElementById('bid-price').innerText = '0.0000';

    currentSymbol = currencyPair;

    // Check if chart div exists and initialize chart
    if ($('#trading-chart-transparent').length) {
      let selector = document.getElementById('trading-chart-transparent');

      if (chart) {
        chart.remove();  // Remove the existing chart instance
      }
      
      initializeChart();
      
    } else {
      console.error('Chart container not found');
    }
     
    function initializeChart() {
      let selector = document.getElementById('trading-chart-transparent');
      chart = LightweightCharts.createChart(selector, {
        width: window.innerWidth,
        height: window.innerHeight,
        layout: {
          backgroundColor: '#ffffff05',
          textColor: '#ffffff',
        },
        grid: {
          vertLines: {
            color: '#ffffff0d',
          },
          horzLines: {
            color: '#ffffff0d',
          },
        },
        crosshair: {
          mode: LightweightCharts.CrosshairMode.Normal,
        },
        priceScale: {
          borderColor: '#46495d',
        },
        timeScale: {
          borderColor: '#46495d',
          timeVisible: true,
          tickMarkFormatter: (time) => {
            const date = new Date(time * 1000); // Convert to milliseconds
            return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }); // Format as HH:MM
        },
        },
      });

      candleSeries = chart.addCandlestickSeries({
        upColor: '#05c46b',
        downColor: '#ff3f34',
        borderDownColor: '#ff3f34',
        borderUpColor: '#05c46b',
        wickDownColor: '#ff3f34',
        wickUpColor: '#05c46b',
        priceFormat: {
          type: 'custom', // Use custom formatting
          formatter: price => price.toFixed(5), // Show 5 decimal places, adjust as needed
        },
      });
      
      volumeSeries = chart.addHistogramSeries({
        color: '#385263',
        lineWidth: 2,
        priceFormat: {
          type: 'volume',
          formatter: volume => volume.toFixed(0),
        },
        overlay: true,
        scaleMargins: {
          top: 0.9,
          bottom: 0,
        },
      });

      window.addEventListener('resize', () => {
        chart.applyOptions({
            width: $('#trading-chart-transparent').width(),
            height: 600,
        });
        setTimeout(() => chart.timeScale().fitContent(), 0);
      });
    }

    // WebSocket logic to receive live candlestick updates
    // function connectWebSocket() {
    //   if (socket && (socket.readyState === WebSocket.OPEN || socket.readyState === WebSocket.CONNECTING)) {
    //     return;
    //   }

    //   const wsUrl = window.appEnv === 'production' ? 'wss://fxtrado-backend.currenttech.pro/getChartData' : 'ws://localhost:3000/getChartData';

    //   socket = new WebSocket(wsUrl);

    //   socket.onopen = function() {
    //     console.log('WebSocket connection established');
    //     reconnectAttempts = 0;
    //   }

    //   socket.onmessage = function(event) {
    //     const data = JSON.parse(event.data);
    //     const chartData = data.chartData[0];
        
    //     const filteredData = chartData.filter(candle => candle.Symbol === currentSymbol);
        
    //     candleSeries.setData([]); // Clear old candlestick data
    //     volumeSeries.setData([]); // Clear old volume data

    //     filteredData.forEach(candleData => {
    //       const candleTime = new Date(candleData.Date).getTime() / 1000;

    //       const candle = {
    //         time: candleTime,  // Convert Date to UNIX timestamp
    //         open: parseFloat(candleData.Open),
    //         high: parseFloat(candleData.High),
    //         low: parseFloat(candleData.Low),
    //         close: parseFloat(candleData.Close)
    //       };

    //       const volume = {
    //         time: candleTime,  // Convert Date to UNIX timestamp
    //         value: candleData.volume ? parseFloat(candleData.volume) : 0, // Default to 0 if volume is null
    //         color: candle.close < candle.open ? 'rgba(255, 128, 159, 0.25)' : 'rgba(107, 255, 193, 0.25)',
    //       };

    //       candleSeries.update(candle);
    //       volumeSeries.update(volume);
    //     });
    //   }

    //   socket.onerror = (error) => {
    //     console.error('WebSocket error:', error);
    //   };

    //   socket.onclose = () => {
    //     console.log('WebSocket closed');
    //   };
    // }

    async function loadCandleStickData(currentSymbol) {
      try {
         const response = await fetch(`/getCandles?symbol=${currentSymbol}`);
         const data = await response.json();

          const candles = data.map(candle => ({
            
            time: new Date(candle.Date).getTime() / 1000,
            open: parseFloat(candle.Open),
            high: parseFloat(candle.High),
            low: parseFloat(candle.Low),
            close: parseFloat(candle.Close)
          }));

          const volumes = data.map(candle => ({
            time: new Date(candle.Date).getTime() / 1000,
            value: candle.volume,
            color: candle.close < candle.open ? 'rgba(255, 128, 159, 0.25)' : 'rgba(107, 255, 193, 0.25)'
          }));

          candleSeries.setData(candles);
          volumeSeries.setData(volumes);
          
      } catch (error) {
        console.error("Error loading candlestick data:", error);
      }

    }

    const updateInterval = 60 * 1000; // 60 seconds
    setInterval(() => {
        loadCandleStickData(currentSymbol);
    }, updateInterval);
    
    loadCandleStickData(currentSymbol);
  };

  // $('.navigation').on('hover', function () {
  //   $(this).toggleClass('navigation--open');
  // });

  // make tr linkable
  $('.markets-pair-list tr').on('click', function () {
    window.location = $(this).data('href');
  });

  $(
    '.exchange__widget__table, .exchange__widget__order-note-item .dropdown-menu'
  ).each(function () {
    new PerfectScrollbar(this, {
      maxScrollbarLength: 50,
    });
  });

  // if (document.getElementById('marketItem1')) {
  //   am4core.ready(function () {
  //     // Create chart
  //     var chart = am4core.create('marketItem1', am4charts.XYChart);

  //     chart.data = generateChartData();

  //     var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
  //     dateAxis.baseInterval = {
  //       timeUnit: 'minute',
  //       count: 1,
  //     };
  //     dateAxis.tooltip.disabled = true;
  //     dateAxis.renderer.grid.template.disabled = true;
  //     dateAxis.renderer.labels.template.disabled = true;
  //     dateAxis.renderer.ticks.template.disabled = true;
  //     dateAxis.renderer.paddingBottom = 15;

  //     var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
  //     valueAxis.tooltip.disabled = true;
  //     valueAxis.renderer.grid.template.disabled = true;
  //     valueAxis.renderer.labels.template.disabled = true;
  //     valueAxis.renderer.ticks.template.disabled = true;

  //     var series = chart.series.push(new am4charts.LineSeries());
  //     series.dataFields.dateX = 'date';
  //     series.dataFields.valueY = 'prices';
  //     series.tooltipText = 'prices: [bold]{valueY}[/]';
  //     series.fillOpacity = 0.1;
  //     series.fill = am4core.color('#00cc93');
  //     series.stroke = am4core.color('#00cc93');
  //     series.tooltip.getFillFromObject = false;
  //     series.tooltip.background.fill = am4core.color('#1a1736');
  //     series.tooltip.background.stroke = am4core.color('#1a1736');

  //     chart.cursor = new am4charts.XYCursor();
  //     chart.cursor.lineY.opacity = 1;
  //     dateAxis.start = 0;
  //     dateAxis.keepSelection = true;
  //     chart.zoomOutButton.background.fill = am4core.color(
  //       'rgba(255, 255, 255, 0.11)'
  //     );
  //     chart.zoomOutButton.icon.stroke = am4core.color('#ebebeb');
  //     chart.zoomOutButton.background.states.getKey(
  //       'hover'
  //     ).properties.fill = am4core.color('#00cc93');

  //     function generateChartData() {
  //       var chartData = [];
  //       // current date
  //       var firstDate = new Date();
  //       // now set 500 minutes back
  //       firstDate.setMinutes(firstDate.getDate() - 500);

  //       // and generate 500 data items
  //       var prices = 500;
  //       for (var i = 0; i < 500; i++) {
  //         var newDate = new Date(firstDate);
  //         // each time we add one minute
  //         newDate.setMinutes(newDate.getMinutes() + i);
  //         // some random number
  //         prices += Math.round(
  //           (Math.random() < 0.5 ? 1 : -1) * Math.random() * 10
  //         );
  //         // add data item to the array
  //         chartData.push({
  //           date: newDate,
  //           prices: prices,
  //         });
  //       }
  //       return chartData;
  //     }
  //   });
  // }
  // if (document.getElementById('marketItem2')) {
  //   am4core.ready(function () {
  //     // Create chart
  //     var chart = am4core.create('marketItem2', am4charts.XYChart);

  //     chart.data = generateChartData();

  //     var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
  //     dateAxis.baseInterval = {
  //       timeUnit: 'minute',
  //       count: 1,
  //     };
  //     dateAxis.tooltip.disabled = true;
  //     dateAxis.renderer.grid.template.disabled = true;
  //     dateAxis.renderer.labels.template.disabled = true;
  //     dateAxis.renderer.ticks.template.disabled = true;
  //     dateAxis.renderer.paddingBottom = 15;

  //     var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
  //     valueAxis.tooltip.disabled = true;
  //     valueAxis.renderer.grid.template.disabled = true;
  //     valueAxis.renderer.labels.template.disabled = true;
  //     valueAxis.renderer.ticks.template.disabled = true;

  //     var series = chart.series.push(new am4charts.LineSeries());
  //     series.dataFields.dateX = 'date';
  //     series.dataFields.valueY = 'prices';
  //     series.tooltipText = 'prices: [bold]{valueY}[/]';
  //     series.fillOpacity = 0.1;
  //     series.fill = am4core.color('#00cc93');
  //     series.stroke = am4core.color('#00cc93');
  //     series.tooltip.getFillFromObject = false;
  //     series.tooltip.background.fill = am4core.color('#1a1736');
  //     series.tooltip.background.stroke = am4core.color('#1a1736');

  //     chart.cursor = new am4charts.XYCursor();
  //     chart.cursor.lineY.opacity = 1;
  //     dateAxis.start = 0;
  //     dateAxis.keepSelection = true;
  //     chart.zoomOutButton.background.fill = am4core.color(
  //       'rgba(255, 255, 255, 0.11)'
  //     );
  //     chart.zoomOutButton.icon.stroke = am4core.color('#ebebeb');
  //     chart.zoomOutButton.background.states.getKey(
  //       'hover'
  //     ).properties.fill = am4core.color('#00cc93');

  //     function generateChartData() {
  //       var chartData = [];
  //       // current date
  //       var firstDate = new Date();
  //       // now set 500 minutes back
  //       firstDate.setMinutes(firstDate.getDate() - 500);

  //       // and generate 500 data items
  //       var prices = 500;
  //       for (var i = 0; i < 500; i++) {
  //         var newDate = new Date(firstDate);
  //         // each time we add one minute
  //         newDate.setMinutes(newDate.getMinutes() + i);
  //         // some random number
  //         prices += Math.round(
  //           (Math.random() < 0.5 ? 1 : -1) * Math.random() * 10
  //         );
  //         // add data item to the array
  //         chartData.push({
  //           date: newDate,
  //           prices: prices,
  //         });
  //       }
  //       return chartData;
  //     }
  //   });
  // }
  // if (document.getElementById('marketItem3')) {
  //   am4core.ready(function () {
  //     // Create chart
  //     var chart = am4core.create('marketItem3', am4charts.XYChart);

  //     chart.data = generateChartData();

  //     var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
  //     dateAxis.baseInterval = {
  //       timeUnit: 'minute',
  //       count: 1,
  //     };
  //     dateAxis.tooltip.disabled = true;
  //     dateAxis.renderer.grid.template.disabled = true;
  //     dateAxis.renderer.labels.template.disabled = true;
  //     dateAxis.renderer.ticks.template.disabled = true;
  //     dateAxis.renderer.paddingBottom = 15;

  //     var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
  //     valueAxis.tooltip.disabled = true;
  //     valueAxis.renderer.grid.template.disabled = true;
  //     valueAxis.renderer.labels.template.disabled = true;
  //     valueAxis.renderer.ticks.template.disabled = true;

  //     var series = chart.series.push(new am4charts.LineSeries());
  //     series.dataFields.dateX = 'date';
  //     series.dataFields.valueY = 'prices';
  //     series.tooltipText = 'prices: [bold]{valueY}[/]';
  //     series.fillOpacity = 0.1;
  //     series.fill = am4core.color('#00cc93');
  //     series.stroke = am4core.color('#00cc93');
  //     series.tooltip.getFillFromObject = false;
  //     series.tooltip.background.fill = am4core.color('#1a1736');
  //     series.tooltip.background.stroke = am4core.color('#1a1736');

  //     chart.cursor = new am4charts.XYCursor();
  //     chart.cursor.lineY.opacity = 1;
  //     dateAxis.start = 0;
  //     dateAxis.keepSelection = true;
  //     chart.zoomOutButton.background.fill = am4core.color(
  //       'rgba(255, 255, 255, 0.11)'
  //     );
  //     chart.zoomOutButton.icon.stroke = am4core.color('#ebebeb');
  //     chart.zoomOutButton.background.states.getKey(
  //       'hover'
  //     ).properties.fill = am4core.color('#00cc93');

  //     function generateChartData() {
  //       var chartData = [];
  //       // current date
  //       var firstDate = new Date();
  //       // now set 500 minutes back
  //       firstDate.setMinutes(firstDate.getDate() - 500);

  //       // and generate 500 data items
  //       var prices = 500;
  //       for (var i = 0; i < 500; i++) {
  //         var newDate = new Date(firstDate);
  //         // each time we add one minute
  //         newDate.setMinutes(newDate.getMinutes() + i);
  //         // some random number
  //         prices += Math.round(
  //           (Math.random() < 0.5 ? 1 : -1) * Math.random() * 10
  //         );
  //         // add data item to the array
  //         chartData.push({
  //           date: newDate,
  //           prices: prices,
  //         });
  //       }
  //       return chartData;
  //     }
  //   });
  // }
  // if (document.getElementById('marketItem4')) {
  //   am4core.ready(function () {
  //     // Create chart
  //     var chart = am4core.create('marketItem4', am4charts.XYChart);

  //     chart.data = generateChartData();

  //     var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
  //     dateAxis.baseInterval = {
  //       timeUnit: 'minute',
  //       count: 1,
  //     };
  //     dateAxis.tooltip.disabled = true;
  //     dateAxis.renderer.grid.template.disabled = true;
  //     dateAxis.renderer.labels.template.disabled = true;
  //     dateAxis.renderer.ticks.template.disabled = true;
  //     dateAxis.renderer.paddingBottom = 15;

  //     var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
  //     valueAxis.tooltip.disabled = true;
  //     valueAxis.renderer.grid.template.disabled = true;
  //     valueAxis.renderer.labels.template.disabled = true;
  //     valueAxis.renderer.ticks.template.disabled = true;

  //     var series = chart.series.push(new am4charts.LineSeries());
  //     series.dataFields.dateX = 'date';
  //     series.dataFields.valueY = 'prices';
  //     series.tooltipText = 'prices: [bold]{valueY}[/]';
  //     series.fillOpacity = 0.1;
  //     series.fill = am4core.color('#00cc93');
  //     series.stroke = am4core.color('#00cc93');
  //     series.tooltip.getFillFromObject = false;
  //     series.tooltip.background.fill = am4core.color('#1a1736');
  //     series.tooltip.background.stroke = am4core.color('#1a1736');

  //     chart.cursor = new am4charts.XYCursor();
  //     chart.cursor.lineY.opacity = 1;
  //     dateAxis.start = 0;
  //     dateAxis.keepSelection = true;
  //     chart.zoomOutButton.background.fill = am4core.color(
  //       'rgba(255, 255, 255, 0.11)'
  //     );
  //     chart.zoomOutButton.icon.stroke = am4core.color('#ebebeb');
  //     chart.zoomOutButton.background.states.getKey(
  //       'hover'
  //     ).properties.fill = am4core.color('#00cc93');

  //     function generateChartData() {
  //       var chartData = [];
  //       // current date
  //       var firstDate = new Date();
  //       // now set 500 minutes back
  //       firstDate.setMinutes(firstDate.getDate() - 500);

  //       // and generate 500 data items
  //       var prices = 500;
  //       for (var i = 0; i < 500; i++) {
  //         var newDate = new Date(firstDate);
  //         // each time we add one minute
  //         newDate.setMinutes(newDate.getMinutes() + i);
  //         // some random number
  //         prices += Math.round(
  //           (Math.random() < 0.5 ? 1 : -1) * Math.random() * 10
  //         );
  //         // add data item to the array
  //         chartData.push({
  //           date: newDate,
  //           prices: prices,
  //         });
  //       }
  //       return chartData;
  //     }
  //   });
  // }

  // if (document.getElementById('analysisHeatMap')) {
  //   function generateData(count, yrange) {
  //     var i = 0;
  //     var series = [];
  //     while (i < count) {
  //       var x = (i + 1).toString() + ' week';
  //       var y =
  //         Math.floor(Math.random() * (yrange.max - yrange.min + 1)) +
  //         yrange.min;

  //       series.push({
  //         x: x,
  //         y: y,
  //       });
  //       i++;
  //     }
  //     return series;
  //   }
  //   var options = {
  //     series: [
  //       {
  //         name: 'BDL',
  //         data: generateData(7, {
  //           min: 0,
  //           max: 90,
  //         }),
  //       },
  //       {
  //         name: 'BAB',
  //         data: generateData(7, {
  //           min: 0,
  //           max: 90,
  //         }),
  //       },
  //       {
  //         name: 'CDN',
  //         data: generateData(7, {
  //           min: 0,
  //           max: 90,
  //         }),
  //       },
  //       {
  //         name: 'CVC',
  //         data: generateData(7, {
  //           min: 0,
  //           max: 90,
  //         }),
  //       },
  //       {
  //         name: 'BCH',
  //         data: generateData(7, {
  //           min: 0,
  //           max: 90,
  //         }),
  //       },
  //       {
  //         name: 'BDL',
  //         data: generateData(7, {
  //           min: 0,
  //           max: 90,
  //         }),
  //       },
  //       {
  //         name: 'ADD',
  //         data: generateData(7, {
  //           min: 0,
  //           max: 90,
  //         }),
  //       },
  //       {
  //         name: 'ABT',
  //         data: generateData(7, {
  //           min: 0,
  //           max: 90,
  //         }),
  //       },
  //       {
  //         name: 'BTC',
  //         data: generateData(7, {
  //           min: 0,
  //           max: 90,
  //         }),
  //       },
  //     ],
  //     chart: {
  //       height: 400,
  //       type: 'heatmap',
  //       toolbar: {
  //         show: false,
  //       },
  //     },
  //     xaxis: {
  //       axisTicks: {
  //         show: false,
  //       },
  //     },
  //     dataLabels: {
  //       enabled: false,
  //     },
  //     colors: ['#26a69a'],
  //   };

  //   new ApexCharts(
  //     document.querySelector('#analysisHeatMap'),
  //     options
  //   ).render();
  // }
  // if (document.getElementById('analysisHeatMap2')) {
  //   function generateData(count, yrange) {
  //     var i = 0;
  //     var series = [];
  //     while (i < count) {
  //       var x = (i + 1).toString() + ' week';
  //       var y =
  //         Math.floor(Math.random() * (yrange.max - yrange.min + 1)) +
  //         yrange.min;

  //       series.push({
  //         x: x,
  //         y: y,
  //       });
  //       i++;
  //     }
  //     return series;
  //   }
  //   var options = {
  //     series: [
  //       {
  //         name: 'AGI',
  //         data: generateData(7, {
  //           min: 0,
  //           max: 90,
  //         }),
  //       },
  //       {
  //         name: 'ELF',
  //         data: generateData(7, {
  //           min: 0,
  //           max: 90,
  //         }),
  //       },
  //       {
  //         name: 'BDL',
  //         data: generateData(7, {
  //           min: 0,
  //           max: 90,
  //         }),
  //       },
  //       {
  //         name: 'BAB',
  //         data: generateData(7, {
  //           min: 0,
  //           max: 90,
  //         }),
  //       },
  //       {
  //         name: 'CDN',
  //         data: generateData(7, {
  //           min: 0,
  //           max: 90,
  //         }),
  //       },
  //       {
  //         name: 'AMP',
  //         data: generateData(7, {
  //           min: 0,
  //           max: 90,
  //         }),
  //       },
  //       {
  //         name: 'COB',
  //         data: generateData(7, {
  //           min: 0,
  //           max: 90,
  //         }),
  //       },
  //       {
  //         name: 'DEW',
  //         data: generateData(7, {
  //           min: 0,
  //           max: 90,
  //         }),
  //       },
  //       {
  //         name: 'EMC',
  //         data: generateData(7, {
  //           min: 0,
  //           max: 90,
  //         }),
  //       },
  //     ],
  //     chart: {
  //       height: 400,
  //       type: 'heatmap',
  //       toolbar: {
  //         show: false,
  //       },
  //     },
  //     xaxis: {
  //       axisTicks: {
  //         show: false,
  //       },
  //     },
  //     dataLabels: {
  //       enabled: false,
  //     },
  //     colors: ['#ef5350'],
  //   };

  //   new ApexCharts(
  //     document.querySelector('#analysisHeatMap2'),
  //     options
  //   ).render();
  // }

  // if (document.getElementById('coinShare')) {
  //   var options = {
  //     series: [
  //       {
  //         name: 'Bitcoin (BTC)',
  //         data: [66, 53, 48, 72, 80, 86],
  //       },
  //       {
  //         name: 'Ethereum (ETH)',
  //         data: [44, 36, 33, 22, 24, 55],
  //       },
  //       {
  //         name: 'Binance (XRP)',
  //         data: [22, 34, 55, 22, 66, 18],
  //       },
  //       {
  //         name: 'Tether (LTC)',
  //         data: [66, 22, 33, 16, 44, 22],
  //       },
  //       {
  //         name: 'Cardano (ADA)',
  //         data: [22, 66, 22, 66, 21, 77],
  //       },
  //       {
  //         name: 'Others',
  //         data: [33, 22, 33, 33, 23, 35],
  //       },
  //     ],
  //     chart: {
  //       type: 'bar',
  //       height: 400,
  //       toolbar: {
  //         show: false,
  //       },
  //     },
  //     plotOptions: {
  //       bar: {
  //         horizontal: false,
  //         columnWidth: '50%',
  //         endingShape: 'rounded',
  //       },
  //     },
  //     dataLabels: {
  //       enabled: false,
  //     },
  //     legend: {
  //       offsetY: 10,
  //       height: 20,
  //     },
  //     xaxis: {
  //       categories: ['2020', '2019', '2018', '2017', '2016', '2015'],
  //     },

  //     tooltip: {
  //       y: {
  //         formatter: function (val) {
  //           return val + '%';
  //         },
  //       },
  //     },
  //   };
  //   new ApexCharts(document.querySelector('#coinShare'), options).render();
  // }

  // if (document.getElementById('walletVolume')) {
  //   var options = {
  //     series: [52, 45, 47],
  //     chart: {
  //       width: 370,
  //       type: 'polarArea',
  //     },
  //     labels: ['BTC', 'ETH', 'CVC'],
  //     fill: {
  //       opacity: 1,
  //     },
  //     stroke: {
  //       width: 1,
  //       colors: undefined,
  //     },
  //     yaxis: {
  //       show: false,
  //     },
  //     legend: {
  //       position: 'bottom',
  //     },
  //     fill: {
  //       type: 'gradient',
  //       gradient: {
  //         shade: 'light',
  //         stops: [0, 100],
  //       },
  //     },
  //     colors: ['#F9CF22', '#0224FF', '#22D304'],
  //     plotOptions: {
  //       pie: {
  //         customScale: 1.1,
  //       },
  //       polarArea: {
  //         rings: {
  //           strokeWidth: 0,
  //         },
  //       },
  //     },
  //   };

  //   new ApexCharts(document.querySelector('#walletVolume'), options).render();
  // }

})(jQuery);
