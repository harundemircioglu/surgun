@extends('dashboard::layouts.master')

@section('content')
    <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
        <a href="#">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-700">Aksesyon Defteri Grafiği</h5>
        </a>

        <label for="accession_notebook_period" class="block mb-2 text-sm font-medium text-gray-700">Period Seçiniz</label>
        <select id="accession_notebook_period"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <option value="1">Dün</option>
            <option value="2">Bugün</option>
            <option value="3" selected>Son 1 hafta</option>
            <option value="4">Son 1 ay</option>
            <option value="5">Son 3 ay</option>
        </select>

        <div class="w-full h-full mt-4" id="chart">
        </div>
    </div>
@endsection

@push('javascripts')
    <script>
        let chart;

        function initChart(labels, data) {
            const options = {
                chart: {
                    type: 'area',
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    name: 'Yeni Bitki',
                    data: data
                }],
                xaxis: {
                    categories: labels
                }
            };

            chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        }

        function updateChart(period = 3) {
            $.ajax({
                type: "GET",
                url: "{{ route('dashboard.getAccessionNotebookData') }}",
                data: {
                    period: period
                },
                success: function(response) {
                    if (!chart) {
                        initChart(response.labels, response.data);
                    } else {
                        chart.updateOptions({
                            series: [{
                                name: 'Yeni Bitki',
                                data: response.data
                            }],
                            xaxis: {
                                categories: response.labels
                            }
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Veri alınamadı:", error);
                }
            });
        }

        $(document).ready(function() {
            updateChart(3);
        });

        $('#accession_notebook_period').on('change', function() {
            const selectedPeriod = $(this).val();
            updateChart(selectedPeriod);
        });
    </script>
@endpush
