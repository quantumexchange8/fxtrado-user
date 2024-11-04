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


let currentSymbol = null;
window.appEnv = "{{ env('APP_ENV') }}";
let fetchInterval = null;
let latestCandleTime = 0;
let currentCandle = { open: 0, high: 0, low: Infinity, close: 0, time: 0 };


// trading chart version3
window.selectSymbol = async function (currencyPair) {
  
  // Check if the selected currency pair is the same as the current one
  if (currencyPair === currentSymbol) {
    console.log('Same symbol selected, no action taken.');
    return;
  }


  // Reset for the new symbol
  currentSymbol = currencyPair;
  latestCandleTime = 0;
  currentCandle = { open: 0, high: 0, low: Infinity, close: 0, time: 0 };

  const container = document.getElementById('selected-pair-container');
  const forexChart = document.getElementById('symbol-chart');
  const forexOrder = document.getElementById('symbol-order');
  const symbolElement = document.getElementById('selected-symbol');

  symbolElement.innerText = currencyPair;
  symbolElement.style.display = 'none';
  const selSym = document.getElementById('selSym');
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

  // Clear any existing fetch intervals
  if (fetchInterval) {
    clearInterval(fetchInterval);
    fetchInterval = null;
  }

  // Check if chart div exists and initialize chart
  if ($('#trading-chart-transparent').length) {
    if (chart) {
      chart.remove(); // Remove the existing chart instance
    }
    await initializeChart(); // Ensure chart is initialized
  } else {
    console.error('Chart container not found');
    return; // Exit if the chart container is not found
  }

  // Load candlestick data and wait for it to finish
  await loadCandleStickData(currentSymbol); // Initial load

  // Fetch real-time data and set interval
  await fetchRealTimeData(currentSymbol);

};

async function fetchRealTimeData(symbol) {
  // console.log('fetch real-time symbol', symbol);

  // Initial fetch
  // await fetchRealTimeOHLC(symbol);

  // Set an interval for fetching real-time OHLC data every second
  // fetchInterval = setInterval(async () => {
  //   // console.log('interval real-time symbol', symbol);
  //   await fetchRealTimeOHLC(symbol);
  // }, 1000);
}

function initializeChart() {
  let selector = document.getElementById('trading-chart-transparent');
  if (!selector) {
    console.error('Chart container not found');
    return;
  }

  const width = selector.clientWidth;
  const height = selector.clientHeight;

  chart = LightweightCharts.createChart(selector, {
    width: width,
    height: height,
    layout: {
      backgroundColor: '#ffffff05',
      textColor: '#ffffff',
    },
    grid: {
      vertLines: {
        color: '#444',
      },
      horzLines: {
        color: '#444',
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
        const date = new Date(time * 1000);
        const formattedTime = date.toUTCString().split(' ')[4]; // Gets "HH:MM:SS GMT"
        return `${formattedTime.split(' GMT')[0]}`; // Excludes GMT part
      },
    }
  });

  candleSeries = chart.addCandlestickSeries({
    upColor: '#05c46b',
    downColor: '#ff3f34',
    borderDownColor: '#ff3f34',
    borderUpColor: '#05c46b',
    wickDownColor: '#ff3f34',
    wickUpColor: '#05c46b',
    priceFormat: {
      type: 'custom',
      formatter: price => price.toFixed(5),
    },
  });

  volumeSeries = chart.addHistogramSeries({
    color: '#385263',
    lineWidth: 2,
    priceFormat: {
      type: 'volume',
    },
    overlay: true,
    scaleMargins: {
      top: 0.9,
      bottom: 0,
    },
  });

  window.addEventListener('orientationchange', () => {
    if (chart) {
      chart.applyOptions({
        width: selector.clientWidth,
        height: selector.clientHeight,
      });
      setTimeout(() => chart.timeScale().fitContent(), 0);
    }
  });
}

async function loadCandleStickData(currentSymbol) {

  try {
    const response = await fetch(`/getCandles?symbol=${currentSymbol}`);
    if (!response.ok) {
      throw new Error(`Failed to fetch data for symbol ${currentSymbol}. Status: ${response.status}`);
    }
    const data = await response.json();

    if (!data || !data.length) {
      throw new Error("Received invalid or empty data");
    }

    latestCandleTime = new Date(data[data.length - 1].Date).getTime() / 1000;

    const candles = data.map(candle => {
      // Parse the ISO string in UTC and get the timestamp in seconds
      const timestamp = Math.floor(new Date(candle.Date).getTime() / 1000);
    
      return {
        time: timestamp,
        open: parseFloat(candle.Open),
        high: parseFloat(candle.High),
        low: parseFloat(candle.Low),
        close: parseFloat(candle.Close),
      };
    });
    candleSeries.setData(candles);

    // Optionally update volume data if applicable
    // const volumes = data.map(candle => ({
    //   time: new Date(candle.Date).getTime() / 1000,
    //   value: Math.random() * 100,
    //   color: candle.Close < candle.Open ? 'rgba(255, 128, 159, 0.25)' : 'rgba(107, 255, 193, 0.25)',
    // }));
    // volumeSeries.setData(volumes);
  } catch (error) {
    console.error("Error loading candlestick data:", error);
  }
}

window.liveUpdateCandlestick = function(data) {
  // console.log('Updating candlestick with data:', data);
  const currentTime = Math.floor(Date.now() / 1000);
  const startOfMinute = Math.floor(currentTime / 60) * 60;
  
  if (latestCandleTime < startOfMinute) {
    latestCandleTime = startOfMinute;
    currentCandle = {
      open: data.bid,
      high: Math.max(data.bid, data.ask),
      low: Math.min(data.bid, data.ask),
      close: data.bid,
      time: startOfMinute,
    };
  } else {
    // Update the high and low with max/min of current high/low and new bid/ask
    currentCandle.high = Math.max(currentCandle.high, data.bid, data.ask);
    currentCandle.low = Math.min(currentCandle.low, data.bid, data.ask);
    currentCandle.close = data.bid; // Close price updated with the latest bid
  }

  candleSeries.update({
    time: currentCandle.time,
    open: currentCandle.open,
    high: currentCandle.high,
    low: currentCandle.low,
    close: currentCandle.close,
  });
}

// async function fetchRealTimeOHLC(symbol) {

//   try {
//     const response = await fetch(`/getRealTimeOHLC?symbol=${symbol}`);
//     if (!response.ok) {
//       throw new Error(`Failed to fetch data for symbol ${symbol}. Status: ${response.status}`);
//     }

//     const { bid, ask, time } = await response.json();

//     if (!time || bid == null || ask == null) {
//       console.warn("Received incomplete data:", { time, bid, ask });
//       return;
//     }

//     // Assuming time is UNIX timestamp in seconds
//     const candleTime = Math.floor(time / 60) * 60; // Round to the minute

//     if (currentCandle.time === 0 || candleTime !== currentCandle.time) {
//       if (currentCandle.time !== 0 && currentCandle.time !== candleTime) {
//         candleSeries.update(currentCandle); // Finalize last candle
//       }

//       // Start a new candle
//       currentCandle = {
//         open: bid,
//         high: Math.max(bid, ask),
//         low: Math.min(bid, ask),
//         close: bid,
//         time: candleTime,
//       };  
//       latestCandleTime = candleTime;
//     } else {
//       // Update existing candle within the same minute
//       currentCandle.close = bid;
//       currentCandle.high = Math.max(currentCandle.high, bid, ask);
//       currentCandle.low = Math.min(currentCandle.low, bid, ask);
//     }

//     // Visual update of the ongoing candle
//     candleSeries.update(currentCandle);
//     document.getElementById('bid-price').innerText = bid.toFixed(4);
//     document.getElementById('ask-price').innerText = ask.toFixed(4);

//   } catch (error) {
//     console.error("Error fetching real-time OHLC data:", error);
//   }
// }

  

  $('.navigation').hover(
    function () {
      // On hover: hide small logo, show large logo
      $(this).find('.navigation__logo--small').hide();
      $(this).find('.navigation__logo--large').show();
    },
    function () {
      // On hover out: show small logo, hide large logo
      $(this).find('.navigation__logo--small').show();
      $(this).find('.navigation__logo--large').hide();
    }
  );
  

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
