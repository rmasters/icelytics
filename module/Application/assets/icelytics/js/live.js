$(function () {
    $(document).ready(function() {
        /**
         * A non-realtime (yet) listener chart
         */

        Highcharts.setOptions({
            global: { useUTC: false }
        });

        var chart;
        var options = {
            chart: {
                renderTo: 'live-listeners',
                type: 'spline',
                events: {
                    load: function() {

                    }
                }
            },
            title: {
                text: 'Total listeners'
            },
            xAxis: {
                type: 'datetime',
                tickPixelInterval: 150
            },
            yAxis: {
                title: { text: 'Listeners' },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function() {
                    return this.y;
                }
            },
            legend: { enabled: true },
            exporting: { enabled: false },
            series: [
                { name: 'Peak listeners' },
                { name: 'Base listeners' },
                { name: 'Average listeners' }
            ]
        };

        var url = "/listeners/data/today.json";
        $.getJSON(url, function(data, textStatus, jqXHR) {
            var snaps = [];

            var max_listens = [],
                min_listens = [],
                avg_listens = [];

            $.each(data, function (i, d) {
                var date = Date.parse(d['timestamp']);

                max_listens.push([date, d['max_listeners']]);
                min_listens.push([date, d['min_listeners']]);
                avg_listens.push([date, d['avg_listeners']]);
            });

            options.series[0].data = max_listens;
            options.series[1].data = min_listens;
            options.series[2].data = avg_listens;

            chart = new Highcharts.Chart(options);
        });
    });
});
