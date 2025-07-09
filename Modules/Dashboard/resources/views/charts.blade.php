@extends('dashboard::layouts.master')

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-700">Aksesyon Defteri Grafiği</h5>

            <label for="accession_notebook_period" class="block mb-2 text-sm font-medium text-gray-700">Period
                Seçiniz</label>
            <select id="accession_notebook_period"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="1">Dün</option>
                <option value="2">Bugün</option>
                <option value="3" selected>Son 1 hafta</option>
                <option value="4">Son 1 ay</option>
                <option value="5">Son 3 ay</option>
            </select>

            <div class="w-full h-64 mt-4" id="accessionNotebookChart"></div>
        </div>

        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-700">Tohum Bankası Grafiği</h5>
            <div class="w-full h-64 mt-4" id="seedBankChart"></div>
        </div>
    </div>
@endsection

@push('javascripts')
    <script>
        const charts = {
            accessionNotebookChart: null,
            seedBankChart: null,
        };

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

            charts.accessionNotebookChart = new ApexCharts(document.querySelector("#accessionNotebookChart"), options);
            charts.accessionNotebookChart.render();
        }

        function updateChart(period = 3) {
            $.ajax({
                type: "GET",
                url: "{{ route('dashboard.getAccessionNotebookData') }}",
                data: {
                    period: period
                },
                success: function(response) {
                    if (!charts.accessionNotebookChart) {
                        initChart(response.labels, response.data);
                    } else {
                        charts.accessionNotebookChart.updateOptions({
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

        $('#accession_notebook_period').on('change', function() {
            const selectedPeriod = $(this).val();
            updateChart(selectedPeriod);
        });

        function getSeedBankData() {
            $.ajax({
                type: "GET",
                url: "{{ route('dashboard.getSeedBankData') }}",
                success: function(response) {
                    var options = {
                        series: response.data,
                        chart: {
                            type: 'pie',
                        },
                        labels: response.labels,
                    };

                    charts.seedBankChart = new ApexCharts(document.querySelector("#seedBankChart"),
                        options);

                    charts.seedBankChart.render();
                },
                error: function(xhr, status, error) {
                    console.error("Veri alınamadı:", error);
                }
            });
        }

        $(document).ready(function() {
            updateChart(3);
            getSeedBankData();
        });
    </script>
@endpush
