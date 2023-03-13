@extends('layouts.template')

@section('content') 
    <div class="row d-flex justify-content-center mt-5 me-3 ms-3">       
            <div class='col-xl-2 bar-container mt-2'>
            <div class="bar-card">
                <div class="percent" id="voltPercent"; style="--clr:#043efc;--num:{{($tegangan/240)*100}};">
                    <div class="dot"></div>
                    <svg>
                        <circle cx="70" cy="70" r="70"></circle>
                        <circle cx="70" cy="70" r="70"></circle>
                    </svg>
                    <div class="number">
                        <h2 id="volt">{{$tegangan}} <span>V</span></h2>
                        <p>volt</p>
                    </div>
                </div>
            </div>
        </div>
        <div class='col-xl-2 bar-container mt-2'>
            <div class="bar-card">
                <div class="percent" id="amperePercent"; style="--clr:#fc0404;--num:{{($arus/20)*100}}";>
                    <div class="dot"></div>
                    <svg>
                        <circle cx="70" cy="70" r="70"></circle>
                        <circle cx="70" cy="70" r="70"></circle>
                    </svg>
                    <div class="number">
                        <h2 id="ampere">{{$arus}} <span>A</span></h2>
                        <p>Ampere</p>
                    </div>
                </div>
            </div>
        </div>
        <div class='col-xl-2 bar-container mt-2'>
            <div class="bar-card">
                <div class="percent" id="wattPercent"; style="--clr:#04fc43;--num:{{($daya/4800)*100}}";>
                    <div class="dot"></div>
                        <svg>
                            <circle cx="70" cy="70" r="70"></circle>
                            <circle cx="70" cy="70" r="70"></circle>
                        </svg>
                    <div class="number">
                        <h2 id="watt">{{$daya}} <span>W</span></h2>
                        <p>Watt</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="tegangan-chart" class="container mt-5" style="height: 400px; min-width: 310px"></div>
    <div id="arus-chart" class="container card mt-5" style="height: 400px; min-width: 310px"></div>
    <div id="daya-chart" class="container card mt-5" style="height: 400px; min-width: 310px"></div>
    
    <script src="https://code.highcharts.com/stock/highstock.js"></script>
    <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/stock/modules/export-data.js"></script>
    <script type="text/javascript">
        Highcharts.stockChart('tegangan-chart', {
            chart: {
                // backgroundColor: '#000000ad',
                events: {
                    load: function () {
                        // set up the updating of the chart each second
                        var series = this.series[0];
                        var series2 = this.series[1];
                        setInterval(function () {                                
                            var httpxml = new XMLHttpRequest();       
                            function stateck() {
                                if(httpxml.readyState == 4){
                                    const obj = JSON.parse(httpxml.responseText);                         
                                    var x = (new Date()).getTime(), // current time
                                    // y = Math.round(Math.random() * 100);
                                    y = parseFloat(obj.kamar1.tegangan),    
                                    y2 = parseFloat(obj.kamar2.tegangan);    
                                    series.addPoint([x, y], false, false);
                                    series2.addPoint([x, y2], true, true);
                                    
                                    document.getElementById("volt").innerHTML = obj.tegangan+" <span>V</span>";
                                    document.getElementById("voltPercent").style.setProperty('--num', (obj.tegangan/240)*100);
                                }
                            }
                            httpxml.onreadystatechange = stateck;
                            httpxml.open("GET", "/api/kamar", true);
                            httpxml.send(null);

                        }, 1000);
                    }
                }
            },

            time: {
                useUTC: false
            },

            rangeSelector: {
                buttons: [{
                    count: 1,
                    type: 'minute',
                    text: '1M'
                }, 
                {
                    count: 5,
                    type: 'minute',
                    text: '5M'
                }, {
                    type: 'all',
                    text: 'All'
                }],
                inputEnabled: false,
                selected: 0
            },

            title: {
                text: '<b>TEGANGAN</b>'
            },

            exporting: {
                enabled: false
            },

            tooltip: {
                valueSuffix: ' V'
            },
            series: [
            {
                name: 'Kamar 1',
                data: (
                    function () {
                    // generate an array of random data
                    var data = [],
                        time = (new Date()).getTime(),
                        i;

                    for (i = -999; i <= 0; i += 1) {
                        data.push([
                            time + i * 1000,
                            0
                        ]);
                    }
                    return data;
                }()
                )
            },
            {
                name: 'Kamar 2',
                data: (
                    function () {
                    // generate an array of random data
                    var data = [],
                        time = (new Date()).getTime(),
                        i;

                    for (i = -999; i <= 0; i += 1) {
                        data.push([
                            time + i * 1000,
                            0
                        ]);
                    }
                    return data;
                }()
                )
            },
        ]
        });

        Highcharts.stockChart('arus-chart', {
            chart: {
                // backgroundColor: '#000000ad',
                events: {
                    load: function () {
                        // set up the updating of the chart each second
                        var series = this.series[0];
                        var series2 = this.series[1];
                        setInterval(function () {                                
                            var httpxml = new XMLHttpRequest();       
                            function stateck() {
                                if(httpxml.readyState == 4){
                                    const obj = JSON.parse(httpxml.responseText);                         
                                    var x = (new Date()).getTime(), // current time
                                    // y = Math.round(Math.random() * 100);
                                    y = parseFloat(obj.kamar1.arus),    
                                    y2 = parseFloat(obj.kamar2.arus);    
                                    series.addPoint([x, y], false, false);
                                    series2.addPoint([x, y2], true, true);
                                    
                                    document.getElementById("ampere").innerHTML = obj.arus+" <span>A</span>";
                                    document.getElementById("amperePercent").style.setProperty('--num', (obj.arus/20)*100);
                                }
                            }
                            httpxml.onreadystatechange = stateck;
                            httpxml.open("GET", "/api/kamar", true);
                            httpxml.send(null);

                        }, 1000);
                    }
                }
            },

            time: {
                useUTC: false
            },

            rangeSelector: {
                buttons: [{
                    count: 1,
                    type: 'minute',
                    text: '1M'
                }, 
                {
                    count: 5,
                    type: 'minute',
                    text: '5M'
                }, {
                    type: 'all',
                    text: 'All'
                }],
                inputEnabled: false,
                selected: 0
            },

            title: {
                text: '<b>ARUS</b>'
            },

            exporting: {
                enabled: false
            },

            tooltip: {
                valueSuffix: ' A'
            },
            series: [
            {
                name: 'Kamar 1',
                data: (
                    function () {
                    // generate an array of random data
                    var data = [],
                        time = (new Date()).getTime(),
                        i;

                    for (i = -999; i <= 0; i += 1) {
                        data.push([
                            time + i * 1000,
                            0.0
                        ]);
                    }
                    return data;
                }()
                )
            },
            {
                name: 'Kamar 2',
                data: (
                    function () {
                    // generate an array of random data
                    var data = [],
                        time = (new Date()).getTime(),
                        i;

                    for (i = -999; i <= 0; i += 1) {
                        data.push([
                            time + i * 1000,
                            0
                        ]);
                    }
                    return data;
                }()
                )
            },
        ]
        });
        
        Highcharts.stockChart('daya-chart', {
            chart: {
                // backgroundColor: '#000000ad',
                events: {
                    load: function () {
                        // set up the updating of the chart each second
                        var series = this.series[0];
                        var series2 = this.series[1];
                        setInterval(function () {                                
                            var httpxml = new XMLHttpRequest();       
                            function stateck() {
                                if(httpxml.readyState == 4){
                                    const obj = JSON.parse(httpxml.responseText);                         
                                    var x = (new Date()).getTime(), // current time
                                    // y = Math.round(Math.random() * 100);
                                    y = parseFloat(obj.kamar1.daya),    
                                    y2 = parseFloat(obj.kamar2.daya);    
                                    series.addPoint([x, y], false, false);
                                    series2.addPoint([x, y2], true, true);
                                    
                                    document.getElementById("watt").innerHTML = obj.daya+" <span>W</span>";
                                    document.getElementById("wattPercent").style.setProperty('--num', (obj.daya/4800)*100);
                                }
                            }
                            httpxml.onreadystatechange = stateck;
                            httpxml.open("GET", "/api/kamar", true);
                            httpxml.send(null);

                        }, 1000);
                    }
                }
            },

            time: {
                useUTC: false
            },

            rangeSelector: {
                buttons: [{
                    count: 1,
                    type: 'minute',
                    text: '1M'
                }, 
                {
                    count: 5,
                    type: 'minute',
                    text: '5M'
                }, {
                    type: 'all',
                    text: 'All'
                }],
                inputEnabled: false,
                selected: 0
            },

            title: {
                text: '<b>DAYA</b>'
            },

            exporting: {
                enabled: false
            },

            tooltip: {
                valueSuffix: ' W'
            },
            series: [
            {
                name: 'Kamar 1',
                data: (
                    function () {
                    // generate an array of random data
                    var data = [],
                        time = (new Date()).getTime(),
                        i;

                    for (i = -999; i <= 0; i += 1) {
                        data.push([
                            time + i * 1000,
                            0
                        ]);
                    }
                    return data;
                }()
                )
            },
            {
                name: 'Kamar 2',
                data: (
                    function () {
                    // generate an array of random data
                    var data = [],
                        time = (new Date()).getTime(),
                        i;

                    for (i = -999; i <= 0; i += 1) {
                        data.push([
                            time + i * 1000,
                            0
                        ]);
                    }
                    return data;
                }()
                )
            },
        ]
        });
    </script>



@endsection
