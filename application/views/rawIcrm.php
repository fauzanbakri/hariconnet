        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">RAW ICRM</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                        <li class="breadcrumb-item active">NOC</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row">
                        <div class="card card-height-100">
                                        <div class="card-header border-0 align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Total Penangangan Gangguan  </h4>
                                        </div><!-- end card header -->
                                        <div class="card-body p-0 pb-2">
                                            <div class="w-100">
                                                <div id="chartaging" data-colors='["--vz-success", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                        </div>
                     </div>
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © Velzon.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by Themesbrand
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    

    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    
    <!-- <script src="assets/js/plugins.js"></script> -->

    <!-- apexcharts -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="assets/js/pages/apexcharts-line.init.js"></script>


    <!-- Vector map-->
    <script src="assets/libs/jsvectormap/jsvectormap.min.js"></script>
    <script src="assets/libs/jsvectormap/maps/world-merc.js"></script>

    <!-- Dashboard init -->
    <script src="assets/js/pages/dashboard-analytics.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
    <script>
        window.onload = function() {
        var kabupatenData = <?php echo json_encode($data); ?>;
        var kabupaten = kabupatenData.map(function(item) {
        return item.kabupaten;
        }).filter(function(item) {
            return item !== null;
        });
        var count = kabupatenData.map(function(item) {
            return item.count;
        }).filter(function(item, index) {
            return kabupaten[index] !== null; 
        });
        // console.log(kabupaten); 
        // console.log(count);   
        var options = {
            series: [{
                name: "Jumlah Tiket",
                data: count 
            }],
            chart: {
                type: "bar",
                height: 700,
                toolbar: {
                    show: true
                }
            },
            plotOptions: {
                bar: {
                    borderRadius: 3,
                    horizontal: true, 
                    distributed: true,
                    dataLabels: {
                        position: "top"
                    }
                }
            },
            colors: ['#405189'],
            dataLabels: {
                enabled: true,
                offsetX: 32,
                style: {
                    fontSize: "12px",
                    fontWeight: 400,
                    colors: ["#adb5bd"]
                }
            },
            legend: {
                show: false
            },
            grid: {
                show: false
            },
            xaxis: {
                categories: kabupaten,
            }
        };
        var chart = new ApexCharts(document.querySelector("#kabupaten_chart"), options);
        chart.render();

        var timData = <?php echo json_encode($tim); ?>;
        var tim = timData.map(function(item) {
        return item.tim;
        }).filter(function(item) {
            return item !== null;
        });
        var count = timData.map(function(item) {
            return item.count;
        }).filter(function(item, index) {
            return tim[index] !== null; 
        });
        // console.log(tim); 
        // console.log(count);   
        var options = {
            series: [{
                name: "Jumlah Tiket",
                data: count 
            }],
            chart: {
                type: "bar",
                height: 700,
                toolbar: {
                    show: true
                }
            },
            plotOptions: {
                bar: {
                    borderRadius: 3,
                    horizontal: true, 
                    distributed: true,
                    dataLabels: {
                        position: "top"
                    }
                }
            },
            colors: ['#405189'],
            dataLabels: {
                enabled: true,
                offsetX: 32,
                style: {
                    fontSize: "12px",
                    fontWeight: 400,
                    colors: ["#adb5bd"]
                }
            },
            legend: {
                show: false
            },
            grid: {
                show: false
            },
            xaxis: {
                categories: tim,
            }
        };
        var chart = new ApexCharts(document.querySelector("#tim_chart"), options);
        chart.render();

        };      
    </script>
    <script>
        var queryResult = <?php echo json_encode($month); ?>;
        var ticketsData = queryResult.map(function(record) {
            var date = new Date(record.year, record.month - 1, 1).getTime();
            return { x: date, y: record.total_tiket };
        });
        var linechartBasicColors = getChartColorsArray("tiketmonth"),
            linechartZoomColors = (linechartBasicColors && (options = {
                series: [{
                    name: "Total Tiket",
                    data: ticketsData
                }],
                chart: {
                    height: 400,
                    type: "line",
                    zoom: {
                        enabled: true
                    },
                    toolbar: {
                        show: true
                    }
                },
                markers: {
                    size: 4
                },
                dataLabels: {
                    enabled: true
                },
                stroke: {
                    curve: "straight"
                },
                colors: linechartBasicColors,
                title: {
                    text: "Total Tiket by Month",
                    align: "left",
                    style: {
                        fontWeight: 500
                    }
                },
                xaxis: {
                    type: "datetime",
                    labels: {
                        formatter: function (value) {
                            return new Date(value).toLocaleString("default", { month: "short", year: "numeric" });
                        }
                    }
                }
            }, 
            (chart = new ApexCharts(document.querySelector("#tiketmonth"), options)).render()));
    </script>
    <script>
    // Data
    const target = 64;
    const data1 = <?php echo $datapercent; ?>; // Pastikan menggunakan json_encode
    const options2 = {
      series: [
        {
          name: "Less than 1 Day (%)",
          data: data1.percent_more_than_1_day
        },
        {
          name: "More than 3 Days (%)",
          data: data1.percent_more_than_3_days
        }
      ],
      chart: {
        type: 'bar',
        height: 350
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '20%',
          endingShape: 'rounded'
        },
      },
      colors: ['#4CAF50', '#F44336'], // Warna bar: Hijau untuk Less than 1 Day, Merah untuk More than 3 Days
      dataLabels: {
        enabled: false
      },
      stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
      },
      xaxis: {
        categories: data1.categories
      },
      yaxis: {
        title: {
          text: 'Persentase (%)'
        }
      },
      fill: {
        opacity: 1
      },
      annotations: {
        yaxis: [
          {
            y: target,
            borderColor: '#FF0000',
            label: {
              borderColor: '#FF0000',
              style: {
                color: '#fff',
                background: '#FF0000'
              },
              text: `Target: ${target}%`
            }
          }
        ]
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return val + "%";
          }
        }
      }
    };

    const chart2 = new ApexCharts(document.querySelector("#chartaging"), options2);
    chart2.render();
</script>
</body>
</html>