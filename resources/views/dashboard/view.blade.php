@extends('layouts.main')

@section('title', 'Dashboard')
    
@section('content')
  <div class="col-lg-4 mb-4 order-0">
      <div class="card">
      <div class="d-flex align-items-end row">
          <div class="card-body">
            <p>Deskripsi Smart Trash</p>
            <span>{{ $deskripsi }}</span>
          </div>
      </div>
      </div>
  </div>
  <div class="col-4 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
              <div class="card-title">
                <h5 class="text-nowrap mb-2">Status Kepenuhan Sampah</h5>
              </div>
              <div id="growthChartku"></div>
              <br>
              <span class="badge bg-label-warning rounded-pill">{{ $today }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  <div class="col-lg-4 mb-4 order-0">
      <div class="card">
      <div class="d-flex align-items-end row">
          <div class="card-body">
            <p>Grafik kepenuhan sampah Mingguan </p>
            <div id="weeklyBarChart"></div>
          </div>
      </div>
      </div>
  </div>

<!-- Vendors JS -->
<script src="{{ asset('admin/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
<script>
  /**
 * Dashboard Analytics
 */

'use strict';

(function () {
  let cardColor, headingColor, axisColor, shadeColor, borderColor;

  cardColor = config.colors.white;
  headingColor = config.colors.headingColor;
  axisColor = config.colors.axisColor;
  borderColor = config.colors.borderColor;

  // Ambil data dari PHP
  var weeklyLabels = {!! json_encode(array_keys($weeklyAverages)) !!}; // Label minggu
  var weeklyValues = {!! json_encode(array_values($weeklyAverages)) !!}; // Rata-rata kepenuhan
  var currentPercentage = {{ $percentage }}; // Persentase kepenuhan saat ini

  // Growth Chart - Radial Bar Chart
  // --------------------------------------------------------------------
  const growthChartEl = document.querySelector('#growthChartku'),
    growthChartOptions = {
      series: [{{ $percentage }}],
      labels: ['Penuh'],
      chart: {
        height: 240,
        type: 'radialBar'
      },
      plotOptions: {
        radialBar: {
          size: 150,
          offsetY: 10,
          startAngle: -150,
          endAngle: 150,
          hollow: {
            size: '55%'
          },
          track: {
            background: cardColor,
            strokeWidth: '100%'
          },
          dataLabels: {
            name: {
              offsetY: 15,
              color: headingColor,
              fontSize: '15px',
              fontWeight: '600',
              fontFamily: 'Public Sans'
            },
            value: {
              offsetY: -25,
              color: headingColor,
              fontSize: '22px',
              fontWeight: '500',
              fontFamily: 'Public Sans'
            }
          }
        }
      },
      colors: [config.colors.primary],
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'dark',
          shadeIntensity: 0.5,
          gradientToColors: [config.colors.primary],
          inverseColors: true,
          opacityFrom: 1,
          opacityTo: 0.6,
          stops: [30, 70, 100]
        }
      },
      stroke: {
        dashArray: 5
      },
      grid: {
        padding: {
          top: -35,
          bottom: -10
        }
      },
      states: {
        hover: {
          filter: {
            type: 'none'
          }
        },
        active: {
          filter: {
            type: 'none'
          }
        }
      }
    };
  if (typeof growthChartEl !== undefined && growthChartEl !== null) {
    const growthChart = new ApexCharts(growthChartEl, growthChartOptions);
    growthChart.render();
  }

  // ===========================
  // 📊 Bar Chart (Rata-rata Mingguan)
  // ===========================
  const barChartEl = document.querySelector('#weeklyBarChart'),
    barChartOptions = {
      series: [{
        name: 'Kepenuhan Sampah (%)',
        data: weeklyValues
      }],
      chart: {
        type: 'bar',
        height: 300
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '50%',
          endingShape: 'rounded'
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
      },
      xaxis: {
        categories: weeklyLabels,
        labels: {
          style: {
            colors: axisColor
          }
        }
      },
      yaxis: {
        title: {
          text: 'Persentase (%)'
        }
      },
      fill: {
        opacity: 1
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return val + " %";
          }
        }
      }
    };

  if (barChartEl !== null) {
    const barChart = new ApexCharts(barChartEl, barChartOptions);
    barChart.render();
  }
})();

</script>
@endsection