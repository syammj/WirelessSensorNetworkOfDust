<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>AdminLTE | Flot Charts</title>

        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
     
        <!-- bootstrap 3.0.2 -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
    <!--disini header dan navbar dan side bar-->

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) disini -->
                

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- interactive chart -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title">Interactive Area Chart</h3>
                                    <div class="box-tools pull-right">
                                    <h5>Y Max:</h5>
                                    <input id="maxY"></input>
                                    <button id="update" type="button">update</button>
                                    </div>
                                    <div class="box-tools pull-right">
                                        Options
                                    <div class="btn-group" id="options" data-toggle="btn-toggle">
                                        <button type="button" class="btn btn-default btn-sm active" data-toggle="voltage">voltage</button>
                                        <button type="button" class="btn btn-default btn-sm" data-toggle="watt">watt</button>
                                        <button type="button" class="btn btn-default btn-sm" data-toggle="current">current</button>
                                        <button type="button" class="btn btn-default btn-sm" data-toggle="energy">energy</button>
                                        <button type="button" class="btn btn-default btn-sm" data-toggle="temperature">temperature</button>
                                        <button type="button" class="btn btn-default btn-sm" data-toggle="humidity">humidity</button>
                                        <button type="button" class="btn btn-default btn-sm" data-toggle="intensity">intensity</button>
                                    </div>
                                    </div>
                                    <div class="box-tools pull-right">
                                        Real time
                                        <div class="btn-group" id="realtime" data-toggle="btn-toggle">
                                            <button type="button" class="btn btn-default btn-xs active" data-toggle="on">On</button>
                                            <button type="button" class="btn btn-default btn-xs" data-toggle="off">Off</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div id="interactive" style="height: 300px;"></div>
                                </div><!-- /.box-body-->
                            </div><!-- /.box -->

                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    <!--row yg lain disini-->
                </section><!-- /.content -->

            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- jQuery 2.0.2 -->
        <script type="text/javascript" src="../../js/plugins/jquery/2.0.2/jquery.min.js"></script>
       
        <script type="text/javascript" src="../../js/plugins/jquery/1.8.3/jquery.min.js"> </script>
        <!-- Bootstrap -->
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../../js/AdminLTE/demo.js" type="text/javascript"></script>
        <!-- FLOT CHARTS -->
        <script src="../../js/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
        <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
        <script src="../../js/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
        <!-- FLOT PIE PLUGIN - also used to draw donut charts -->
        <script src="../../js/plugins/flot/jquery.flot.pie.min.js" type="text/javascript"></script>
        <!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
        <script src="../../js/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>

        <script src="../../js/plugins/flot/jquery.flot.time.js" type="text/javascript"></script>

        <script src="../../js/plugins/flot/jquery.flot.axislabels.js" type="text/javascript"></script>

        <script src="../../js/plugins/flot/curvedLines.js" type="text/javascript"></script>

        <script src="../../js/plugins/strftime/strftime.js" type="text/javascript"></script>

        <!-- Page script -->
       
        <script type="text/javascript">
              //penting 
                var dataLength ;
                var arr;
               
                function jsonData(){
                   $.ajax({
                        // have to use synchronous here, else returns before data is fetched
                        async: false,
                        url: 'dbchart.php',
                        dataType:'json',
                        success: function (data) {
                        arr = data;
                        }

                    }); return arr; 
               };
               
               //console.log(jsonData());   
                //console.log();
                // jika datetime dan voltage
                var dataw = [], datav = [], datad = [], res = [];
                //var dataLength = 
                var d = new Date();
                function getVoltageData(){  
                    var AutoRefresh = setInterval(
                        function(){
                            jsonData();                      
                        }, 5000
                    ); 
                    dataLength = jsonData().length;
                    for (var i = 0; i < dataLength; i++) {
                            datav[i] = jsonData()[i].voltage;
                            datad[i] = Date.parse(jsonData()[i].datetime);
                            res[i] = [datad[i], datav[i]];
                        };
                     return res;
                };
                function getWattData(){  
                    var AutoRefresh = setInterval(
                        function(){
                            jsonData();                      
                        }, 5000
                    ); 
                    dataLength = jsonData().length;
                    for (var i = 0; i < dataLength; i++) {
                            datav[i] = jsonData()[i].watt;
                            datad[i] = Date.parse(jsonData()[i].datetime);
                            res[i] = [datad[i], datav[i]];
                        };
                     return res;
                 };
                 function getCurrentData(){  
                    var AutoRefresh = setInterval(
                        function(){
                            jsonData();                      
                        }, 5000
                    ); 
                    dataLength = jsonData().length;
                    for (var i = 0; i < dataLength; i++) {
                            datav[i] = jsonData()[i].current;
                            datad[i] = Date.parse(jsonData()[i].datetime);
                            res[i] = [datad[i], datav[i]];
                        };
                     return res;
                 };
                 function getTemperatureData(){  
                    var AutoRefresh = setInterval(
                        function(){
                            jsonData();                      
                        }, 5000
                    ); 
                    dataLength = jsonData().length;
                    for (var i = 0; i < dataLength; i++) {
                            datav[i] = jsonData()[i].temperature;
                            datad[i] = Date.parse(jsonData()[i].datetime);
                            res[i] = [datad[i], datav[i]];
                        };
                     return res;
                 };
                   function getEnergyData(){  
                    var AutoRefresh = setInterval(
                        function(){
                            jsonData();                      
                        }, 5000
                    ); 
                    dataLength = jsonData().length;
                    for (var i = 0; i < dataLength; i++) {
                            datav[i] = jsonData()[i].energy;
                            datad[i] = Date.parse(jsonData()[i].datetime);
                            res[i] = [datad[i], datav[i]];
                        };
                     return res;
                 };
                 function getHumidityData(){  
                    var AutoRefresh = setInterval(
                        function(){
                            jsonData();                      
                        }, 5000
                    ); 
                    dataLength = jsonData().length;
                    for (var i = 0; i < dataLength; i++) {
                            datav[i] = jsonData()[i].humidity;
                            datad[i] = Date.parse(jsonData()[i].datetime);
                            res[i] = [datad[i], datav[i]];
                        };
                     return res;
                 };
                 function getIntensityData(){  
                    var AutoRefresh = setInterval(
                        function(){
                            jsonData();                      
                        }, 5000
                    ); 
                    dataLength = jsonData().length;
                    for (var i = 0; i < dataLength; i++) {
                            datav[i] = jsonData()[i].intensity;
                            datad[i] = Date.parse(jsonData()[i].datetime);
                            res[i] = [datad[i], datav[i]];
                        };
                     return res;
                 };
                var clabel="voltage";
                var plotData = getVoltageData();
                $("#options .btn").click(function(){
                    if ($(this).data("toggle") === "voltage"){
                        clabel = 'voltage';
                        plotData = getVoltageData();
                        update();
                    }
                    else if ($(this).data("toggle") === "watt"){
                        clabel = 'watt';
                        plotData = getWattData();
                        update(); 
                    }
                    else if ($(this).data("toggle") === "temperature"){
                        clabel = 'temperature';
                        plotData = getTemperatureData();
                        update();
                    }
                    else if($(this).data("toggle") === "humidity"){
                        clabel = 'humidity';
                        plotData = getHumidityData();
                        update();
                    }
                    else if($(this).data("toggle") === "current"){
                        clabel = 'current';
                        plotData = getCurrentData();
                        update();
                    }
                    else if($(this).data("toggle") === "energy"){
                        clabel = 'energy';
                        plotData = getEnergyData();
                        update();
                    }
                    else {
                        clabel = 'intensity';
                        plotData = getIntensityData();
                        update();
                        }
                });
                var options = {
                  grid: {
                        hoverable: true,
                        borderColor: "#f3f3f3",
                        borderWidth: 1,
                        tickColor: "#f3f3f3"
                    },
                   series: {
                        shadowSize: 0,
                        lines: {
                            show: true
                        },
                        // curvedLines: {
                        //     active: true
                        //},
                        points: {
                            show: true
                        },
                        label: clabel
                    },
                    lines: {
                        fill: false,
                        color: ["#3c8dbc", "#f56954"]
                    },
                    
                    yaxis: {
                        min: 0,
                        max: 300,
                        axisLabel: clabel,
                        show: true
                    },
                    xaxis: {
                    mode: 'time',
                    timeformat: '%Y/%m/%d %H:%M:%S',
                    tickSize: [2, "minute"],
                    // min: 0,
                    // max: 300,
                    show: true,
                    axisLabel: 'time'
                    },
                };

                $("<div class='tooltip-inner' id='line-chart-tooltip'></div>").css({
                    position: "absolute",
                    display: "none",
                    opacity: 0.8
                }).appendTo("body");
                  $("#interactive").bind("plothover", function(event, pos, item) {

                    if (item) {
                        var d = new Date(item.datapoint[0]), x = d.strftime('%Y/%m/%d %H:%M:%S'),
                            y = item.datapoint[1].toFixed(2);

                        $("#line-chart-tooltip").html(item.series.label + " of " + x + " = " + y + " Volt")
                                .css({top: item.pageY + 5, left: item.pageX + 5})
                                .fadeIn(200);
                    } else {
                        $("#line-chart-tooltip").hide();
                    }

                });
                var interactive_plot = $.plot("#interactive", [plotData], options);
                var maxY ;
                $('#maxY').change(function(){
                        maxY = parseInt(this.value);
                });
                
                $('#update').click(function(){
                        interactive_plot.getAxes().yaxis.options.max = maxY;
                        update();
                });
                var updateInterval = 500; //Fetch data ever x milliseconds
                var realtime = "on"; //If == to on then fetch data every x seconds. else stop fetching
                function update() {

                    interactive_plot.setData([plotData]);
                    interactive_plot.setupGrid();
                    interactive_plot.getOptions().series.label = clabel;
                    interactive_plot.getOptions().yaxes[0].axisLabel = clabel;
                    
                    //interactive_plot.setSeries({label: clabel});
                    // Since the axes don't change, we don't need to call plot.setupGrid()
                    interactive_plot.draw();
                    if (realtime === "on")
                        setTimeout(update, updateInterval);
                }

                //INITIALIZE REALTIME DATA FETCHING
                if (realtime === "on") {
                    update();
                }
                //REALTIME TOGGLE
                $("#realtime .btn").click(function() {
                    if ($(this).data("toggle") === "on") {
                        realtime = "on";
                    }
                    else {
                        realtime = "off";
                    }
                    update();
                });
                /*
                 * END INTERACTIVE CHART
                 */

            /*
             * Custom Label formatter
             * ----------------------
             */
            // function labelFormatter(label, series) {
            //     return "<div style='font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;'>"
            //             + label
            //             + "<br/>"
            //             + Math.round(series.percent) + "%</div>";
            // }
            
            
        
        </script>

    </body>

</html>
