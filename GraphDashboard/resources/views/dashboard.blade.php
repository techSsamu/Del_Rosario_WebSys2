<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Analytics Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 20px;
        }
        
        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .dashboard-header {
            color: white;
            margin-bottom: 40px;
            text-align: center;
        }
        
        .dashboard-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .dashboard-header p {
            font-size: 1.1rem;
            opacity: 0.95;
        }
        
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .metric-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-left: 5px solid #667eea;
        }
        
        .metric-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }
        
        .metric-card.revenue {
            border-left-color: #10b981;
        }
        
        .metric-card.expenses {
            border-left-color: #ef4444;
        }
        
        .metric-card.units {
            border-left-color: #f59e0b;
        }
        
        .metric-card.profit {
            border-left-color: #8b5cf6;
        }
        
        .metric-label {
            font-size: 0.9rem;
            color: #6b7280;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }
        
        .metric-value {
            font-size: 2rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 5px;
        }
        
        .metric-change {
            font-size: 0.85rem;
            color: #6b7280;
        }
        
        .charts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }
        
        .chart-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }
        
        .chart-card:hover {
            transform: translateY(-3px);
        }
        
        .chart-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f3f4f6;
        }
        
        .chart-container {
            position: relative;
            height: 350px;
            margin-bottom: 10px;
        }
        
        .full-width-chart {
            grid-column: 1 / -1;
        }
        
        .chart-card.full-width-chart {
            padding: 35px;
        }
        
        .chart-container.full-height {
            height: 450px;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #667eea;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #764ba2;
        }
        
        @media (max-width: 768px) {
            .charts-grid {
                grid-template-columns: 1fr;
            }
            
            .dashboard-header h1 {
                font-size: 1.8rem;
            }
            
            .metrics-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Header -->
        <div class="dashboard-header">
            <h1>📊 Sales Analytics Dashboard</h1>
            <p>Real-time business performance metrics</p>
        </div>
        
        <!-- Key Metrics -->
        <div class="metrics-grid">
            <div class="metric-card revenue">
                <div class="metric-label">💰 Total Revenue</div>
                <div class="metric-value">₱{{ number_format($totalRevenue, 2) }}</div>
                <div class="metric-change">↑ Performance indicator</div>
            </div>
            
            <div class="metric-card profit">
                <div class="metric-label">📈 Total Profit</div>
                <div class="metric-value">₱{{ number_format($totalProfit, 2) }}</div>
                <div class="metric-change">{{ $totalProfit >= 0 ? '↑ Profitable' : '↓ Loss' }}</div>
            </div>
            
            <div class="metric-card expenses">
                <div class="metric-label">💸 Total Expenses</div>
                <div class="metric-value">₱{{ number_format($totalExpenses, 2) }}</div>
                <div class="metric-change">Cost allocation</div>
            </div>
            
            <div class="metric-card units">
                <div class="metric-label">📦 Units Sold</div>
                <div class="metric-value">{{ number_format($totalUnitsSold) }}</div>
                <div class="metric-change">Total volume</div>
            </div>
        </div>
        
        <!-- Charts Section -->
        <div class="charts-grid">
            <!-- Monthly Revenue Chart -->
            <div class="chart-card">
                <h3 class="chart-title">Monthly Revenue Trend</h3>
                <div class="chart-container">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
            
            <!-- Units Sold Chart -->
            <div class="chart-card">
                <h3 class="chart-title">Units Sold Trend</h3>
                <div class="chart-container">
                    <canvas id="unitsChart"></canvas>
                </div>
            </div>
            
            <!-- Revenue vs Expenses Chart -->
            <div class="chart-card full-width-chart">
                <h3 class="chart-title">Revenue vs Expenses Comparison</h3>
                <div class="chart-container full-height">
                    <canvas id="revenueExpensesChart"></canvas>
                </div>
            </div>
            
            <!-- Category Breakdown Chart -->
            <div class="chart-card">
                <h3 class="chart-title">Revenue by Category</h3>
                <div class="chart-container">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Chart.js default font settings
        Chart.defaults.font.family = "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif";
        Chart.defaults.color = '#6b7280';
        
        // Monthly Revenue Chart (Line Chart)
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: @json($salesByMonth['labels']),
                datasets: [{
                    label: 'Monthly Revenue',
                    data: @json($salesByMonth['revenues']),
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 5,
                    pointBackgroundColor: '#667eea',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointHoverRadius: 7,
                    pointHoverBackgroundColor: '#764ba2'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            padding: 20,
                            font: { size: 12, weight: '600' }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0, 0, 0, 0.05)' },
                        ticks: {
                            callback: function(value) {
                                return '₱' + value.toLocaleString();
                            }
                        }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
        
        // Units Sold Chart (Bar Chart)
        const unitsCtx = document.getElementById('unitsChart').getContext('2d');
        new Chart(unitsCtx, {
            type: 'bar',
            data: {
                labels: @json($unitsTrend['labels']),
                datasets: [{
                    label: 'Units Sold',
                    data: @json($unitsTrend['units']),
                    backgroundColor: 'rgba(245, 158, 11, 0.8)',
                    borderColor: '#f59e0b',
                    borderWidth: 2,
                    borderRadius: 8,
                    hoverBackgroundColor: 'rgba(245, 158, 11, 1)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            padding: 20,
                            font: { size: 12, weight: '600' }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0, 0, 0, 0.05)' },
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString();
                            }
                        }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
        
        // Revenue vs Expenses Chart (Bar Chart)
        const revenueExpensesCtx = document.getElementById('revenueExpensesChart').getContext('2d');
        new Chart(revenueExpensesCtx, {
            type: 'bar',
            data: {
                labels: @json($revenueExpenses['labels']),
                datasets: [
                    {
                        label: 'Revenue',
                        data: @json($revenueExpenses['revenues']),
                        backgroundColor: 'rgba(16, 185, 129, 0.8)',
                        borderColor: '#10b981',
                        borderWidth: 2,
                        borderRadius: 8,
                        hoverBackgroundColor: 'rgba(16, 185, 129, 1)'
                    },
                    {
                        label: 'Expenses',
                        data: @json($revenueExpenses['expenses']),
                        backgroundColor: 'rgba(239, 68, 68, 0.8)',
                        borderColor: '#ef4444',
                        borderWidth: 2,
                        borderRadius: 8,
                        hoverBackgroundColor: 'rgba(239, 68, 68, 1)'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            padding: 20,
                            font: { size: 12, weight: '600' }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0, 0, 0, 0.05)' },
                        ticks: {
                            callback: function(value) {
                                return '₱' + value.toLocaleString();
                            }
                        }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
        
        // Category Breakdown Chart (Doughnut Chart)
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        const categoryLabels = @json($categoryBreakdown['labels']);
        const categoryData = @json($categoryBreakdown['revenues']);
        
        const categoryColors = [
            'rgba(102, 126, 234, 0.8)',
            'rgba(118, 75, 162, 0.8)',
            'rgba(16, 185, 129, 0.8)',
            'rgba(59, 130, 246, 0.8)',
            'rgba(245, 158, 11, 0.8)',
            'rgba(139, 92, 246, 0.8)',
            'rgba(236, 72, 153, 0.8)',
            'rgba(14, 165, 233, 0.8)'
        ];
        
        const categoryBorderColors = [
            'rgba(102, 126, 234, 1)',
            'rgba(118, 75, 162, 1)',
            'rgba(16, 185, 129, 1)',
            'rgba(59, 130, 246, 1)',
            'rgba(245, 158, 11, 1)',
            'rgba(139, 92, 246, 1)',
            'rgba(236, 72, 153, 1)',
            'rgba(14, 165, 233, 1)'
        ];
        
        new Chart(categoryCtx, {
            type: 'doughnut',
            data: {
                labels: categoryLabels,
                datasets: [{
                    data: categoryData,
                    backgroundColor: categoryColors.slice(0, categoryLabels.length),
                    borderColor: categoryBorderColors.slice(0, categoryLabels.length),
                    borderWidth: 2,
                    hoverBorderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            font: { size: 12, weight: '600' }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
