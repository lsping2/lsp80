<script src="http://lsp80.cafe24.com/js/jquery-1.8.3.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<meta charset="utf-8">
<script>
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: '한글'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [
            '하나',
            '둘',
            '셋',
            '넷'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Rainfall (mm)'
        }
    },
    tooltip: {
      
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: '가',
        data: [49]

    }, {
        name: '나',
        data: [83]

    }, {
        name: '다',
        data: [48]

    }, {
        name: '라',
        data: [42]

    }]
});
</script>