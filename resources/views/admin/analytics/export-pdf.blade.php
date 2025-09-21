<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Analytics Report - {{ ucfirst($reportType) }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #3b82f6;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #1f2937;
            margin: 0;
            font-size: 28px;
        }
        .header p {
            color: #6b7280;
            margin: 5px 0 0 0;
        }
        .report-info {
            background: #f8fafc;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 30px;
        }
        .report-info h3 {
            margin: 0 0 10px 0;
            color: #374151;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        .info-item {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
        }
        .info-label {
            font-weight: 600;
            color: #4b5563;
        }
        .info-value {
            color: #1f2937;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .data-table th,
        .data-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        .data-table th {
            background-color: #f3f4f6;
            font-weight: 600;
            color: #374151;
        }
        .data-table tr:hover {
            background-color: #f9fafb;
        }
        .no-data {
            text-align: center;
            padding: 40px;
            color: #6b7280;
            font-style: italic;
        }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .metric-card {
            background: #f8fafc;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            border-left: 4px solid #3b82f6;
        }
        .metric-value {
            font-size: 24px;
            font-weight: bold;
            color: #1f2937;
            margin: 0;
        }
        .metric-label {
            font-size: 14px;
            color: #6b7280;
            margin: 5px 0 0 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Analytics Report</h1>
            <p>{{ ucfirst($reportType) }} Report for {{ $startDate }} to {{ $endDate }}</p>
        </div>

        <div class="report-info">
            <h3>Report Details</h3>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Report Type:</span>
                    <span class="info-value">{{ ucfirst($reportType) }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Date Range:</span>
                    <span class="info-value">{{ $startDate }} to {{ $endDate }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Generated:</span>
                    <span class="info-value">{{ now()->format('M d, Y H:i:s') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Total Records:</span>
                    <span class="info-value">{{ count($data) }}</span>
                </div>
            </div>
        </div>

        @if(!empty($data))
            <div class="metrics-grid">
                @php
                    $totalRevenue = collect($data)->sum('Total Revenue') ?? 0;
                    $totalRides = collect($data)->sum('Total Rides') ?? 0;
                    $totalUsers = collect($data)->sum('New Users') ?? 0;
                    $avgFare = collect($data)->avg('Average Ride Fare') ?? 0;
                @endphp
                
                <div class="metric-card">
                    <p class="metric-value">PKR {{ number_format($totalRevenue, 2) }}</p>
                    <p class="metric-label">Total Revenue</p>
                </div>
                
                <div class="metric-card">
                    <p class="metric-value">{{ number_format($totalRides) }}</p>
                    <p class="metric-label">Total Rides</p>
                </div>
                
                <div class="metric-card">
                    <p class="metric-value">{{ number_format($totalUsers) }}</p>
                    <p class="metric-label">New Users</p>
                </div>
                
                <div class="metric-card">
                    <p class="metric-value">PKR {{ number_format($avgFare, 2) }}</p>
                    <p class="metric-label">Average Fare</p>
                </div>
            </div>

            <h3>Detailed Data</h3>
            <table class="data-table">
                <thead>
                    <tr>
                        @if(!empty($data))
                            @foreach(array_keys($data[0]) as $header)
                                <th>{{ $header }}</th>
                            @endforeach
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $row)
                        <tr>
                            @foreach($row as $value)
                                <td>{{ $value }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-data">
                <h3>No Data Available</h3>
                <p>No analytics data found for the selected period.</p>
            </div>
        @endif

        <div class="footer">
            <p>Generated by Raah-e-Haq Admin Panel on {{ now()->format('F d, Y \a\t H:i:s') }}</p>
            <p>This report contains confidential information and should be handled securely.</p>
        </div>
    </div>
</body>
</html>
