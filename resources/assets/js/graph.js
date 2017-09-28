
Highcharts.setOptions({
    lang: {
        loading: 'chart.loading',
        months: [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ],
        weekdays: [
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday'
        ],
        shortMonths: [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ],
        exportButtonTitle: 'export',
        downloadPNG: 'Download PNG image',
        downloadJPEG: 'Download JPEG image',
        downloadPDF: 'Download PDF document',
        downloadSVG: 'Download SVG vector image',
        printChart: 'Print chart',
    }
});

cwgraph = new Highcharts.Chart({
    chart: {
        renderTo: "cwgraph",
        defaultSeriesType: "spline",
        spacingTop: 20,
        spacingLeft: 50,
        spacingRight: 0,
        zoomType: 'x',
        resetZoomButton: {
            position: {
                // align: 'right', // by default
                // verticalAlign: 'top', // by default
                x: -20,
                y: 0
            },
            theme: {
                fill: '#fcfcfc',
                stroke: '#999999',
                r: '2px',
                style: {
                    color: '#666666',
                    fontSize: '11px',
                    fontWeight: 'bold'
                },
                states: {
                    hover: {
                        fill: '#ffffff',
                        stroke: '#999999',
                        style: {
                            color: '#000000'
                        }
                    }
                },
            },
            relativeTo: 'chart'
        }
    },
    title: { text: null },
    plotOptions: {
        series: {
            animation: true,
            fillOpacity: 0.2,
            lineWidth: 3,
            shadow: false,
            states: {
                hover: {
                    lineWidth: 4
                }
            },
            marker: {
                enabled: true,
                radius: 3,
                lineWidth: 1,
                states: {
                    hover: {
                        shadow: true,
                        lineWidthPlus: 1
                    }
                }
            }
        }
    },
    series: [{"name":"Cost per conversion","step":24,"date_format":"%B %e, %Y","color":"#0338F2","unit":"$","vtype":"mon","prec":3,"enabled":"true","opposite":"false","labelalign":"left","ylabeloffset":10,"xlabeloffset":-40,"yAxis":0,"data":[[1503964800000,40.002],[1504051200000,37.693],[1504137600000,34.17],[1504224000000,35.235],[1504310400000,51.559],[1504396800000,51.854],[1504483200000,29.745],[1504569600000,31.302],[1504656000000,31.179],[1504742400000,30.487],[1504828800000,32.011],[1504915200000,28.822],[1505001600000,21.38],[1505088000000,0],[1505174400000,26.03],[1505260800000,33.094],[1505347200000,35.188],[1505433600000,40.581],[1505520000000,21.516],[1505606400000,41.039],[1505692800000,35.3],[1505779200000,29.66],[1505865600000,26.528],[1505952000000,25.264],[1506038400000,24.874],[1506124800000,18.682],[1506211200000,27.349],[1506297600000,25.415],[1506384000000,21.404],[1506470400000,22.328]]}],
    yAxis: [
        {
            title: { text: null },
            gridLineColor: "#e7e7e7",
            gridLineWidth: 1,
            showFirstLabel: true,
            startOnTick: true,
            minPadding: 0,
            minRange: 0.001,
            min: 0,
            labels: {
                align: 'left',
                x: -40,
                y: 10,
                style: {
                    color: "\x230338F2",
                    //fontWeight: "bold",
                    fontSize: "10px"
                },
                formatter: function() { return Highcharts.numberFormat(this.value, 3, '.', ',') + ' \x24'; },
                enabled: true
            },
            opposite: false
        }        ],
    xAxis: {
        type: 'datetime',
        gridLineColor: "#e7e7e7",
        maxZoom: 24 * 3600000,
        showFirstLabel: true,
        showLastLabel: true,
        labels: {
            x: 15,
            y: 20,
            style: {
                color: "#666666",
                fontSize: "10px"
            },
            overflow: "justify"
        }
    },
    tooltip: {
        backgroundColor: null,
        borderWidth: 0,
        shadow: false,
        useHTML: true,
        shared: true,
        formatter: stat_graph_tooltip,
        hideDelay: 0,
        padding: 0,
        crosshairs: {
            width: 1,
            color: '#5a5f68',
            dashStyle: 'shortdot'
        }
    },
    credits: false,
    legend: {
        borderWidth: 0
    }
});
