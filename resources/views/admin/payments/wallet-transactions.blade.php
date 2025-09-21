<div class="h-full flex flex-col">
    @if($transactions->count() > 0)
        <!-- Table Container with Fixed Height and Scroll -->
        <div class="flex-1 overflow-y-auto border border-gray-200 rounded-lg">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 sticky top-0 z-10">
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Transaction ID</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Type</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Amount</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Status</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Date</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach($transactions as $transaction)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                            <td class="py-3 px-4">
                                <div class="font-mono text-xs text-gray-900">{{ $transaction->transaction_id }}</div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $transaction->getTypeLabel() }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <div class="font-semibold {{ $transaction->type === 'wallet_topup' || $transaction->type === 'driver_earning' ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $transaction->type === 'wallet_topup' || $transaction->type === 'driver_earning' ? '+' : '-' }}PKR {{ number_format($transaction->amount, 2) }}
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                    @if($transaction->status === 'completed') bg-green-100 text-green-800
                                    @elseif($transaction->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($transaction->status === 'failed') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <div class="text-xs text-gray-900 font-medium">{{ $transaction->created_at->format('M d, Y') }}</div>
                                <div class="text-xs text-gray-500">{{ $transaction->created_at->format('H:i') }}</div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="text-center text-sm text-gray-500 mt-4">
            @if(isset($transactions->total))
                Showing {{ $transactions->firstItem() }} to {{ $transactions->lastItem() }} of {{ $transactions->total() }} transactions
            @else
                Showing {{ $transactions->count() }} transactions
            @endif
        </div>
    @else
        <div class="text-center py-8 text-gray-500">
            <i class="fas fa-receipt text-2xl mb-2"></i>
            <p>No transactions found for this wallet</p>
        </div>
    @endif
</div>
