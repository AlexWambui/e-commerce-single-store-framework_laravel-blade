<x-authenticated-layout class="Dashboard">
    <x-slot name="head">
        <title>Dashboard</title>
        @vite(['resources/css/compiled/dashboard.css'])
    </x-slot>

    <section class="Hero">
        <p>Hi, {{ Auth::user()->full_name }}</p>
    </section>

    @if (Auth::user()->isAdmin())
        @include('dashboards.admin')
    @else
        @include('dashboards.user')
    @endif

    <x-slot name="scripts">
        <script src="{{ asset('assets/js/chart.js') }}"></script>
        <script>
            const ctx = document.getElementById('salesChart');

            new Chart(ctx, {
                type: 'bar',
                data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Amount',
                    data: {!! json_encode($sales_data) !!},
                    borderWidth: 1
                }]
                },
                options: {
                    responsive: true,
                }
            });

            const cities = document.getElementById('citiesChart');

                new Chart(cities, {
                    type: 'doughnut',
                    data: {
                        labels: {!! json_encode($locations_labels) !!},
                        datasets: [{
                            label: 'Orders',
                            data: {!! json_encode($locations_orders) !!},
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'right',
                            }
                        }
                }
            });
        </script>
    </x-slot>
</x-authenticated-layout>
