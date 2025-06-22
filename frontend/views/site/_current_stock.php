<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var array $stocks */

// $totalCost = 0;
// $totalPrice = 0;
// $increment = 1;

// foreach ($stocks as $stock) {
//     $totalCost += $stock->buying_price * $stock->quantity;
//     $totalPrice += $stock->selling_price * $stock->quantity;
// }

// $expectingProfit = $totalPrice - $totalCost;

// // Format as TZS (Tanzanian Shillings)
// function formatTZS($amount) {
//     return 'TZS ' . number_format($amount, 0, '.', ',');
// }

$totalCost = 0;
$totalPrice = 0;
$increment = 1;

foreach ($stocks as $stock) {
    $totalCost += $stock->buying_price * $stock->quantity;
    $totalPrice += $stock->selling_price * $stock->quantity;
}

$expectingProfit = $totalPrice - $totalCost;
$totalItems = count($stocks);

// Format as TZS (Tanzanian Shillings)
function formatTZS($amount) {
    return number_format($amount, 0) . ' TZS';
}

?>

<div class="container mx-auto px-4 py-6">
    <h3 class="text-2xl font-bold mb-6 text-gray-800">Current Stock List</h3>

    <!-- SUMMARY CARD  -->
     <div class="grid xl:grid-cols-3 grid-cols-1 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-lg p-6 text-center border-l-4 border-blue-500 hover:shadow-xl transition-shadow">
        <div class="text-4xl text-green-600 mb-3">
                <i class="ri-store-2-line"></i>
            </div>    
        <h6 class="text-sm font-semibold text-blue-600 mb-2">STOCK VALUES PER COST</h6>
            <h3 class="text-2xl font-bold text-gray-800"><?= formatTZS($totalCost) ?></h3>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-6 text-center border-l-4 border-purple-500 hover:shadow-xl transition-shadow">
        <div class="text-4xl text-blue-600 mb-3">
                <i class="ri-price-tag-3-line"></i>
            </div>    
        <h6 class="text-sm font-semibold text-purple-600 mb-2">STOCK VALUES PER PRICE</h6>
            <h3 class="text-2xl font-bold text-gray-800"><?= formatTZS($totalPrice) ?></h3>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-6 text-center border-l-4 <?= $expectingProfit >= 0 ? 'border-green-500' : 'border-red-500' ?> hover:shadow-xl transition-shadow">
        <div class="text-4xl <?= $expectingProfit >= 0 ? 'text-teal-600' : 'text-red-600' ?> mb-3">
                <i class="ri-line-chart-line"></i>
            </div>    
        <h6 class="text-sm font-semibold <?= $expectingProfit >= 0 ? 'text-green-600' : 'text-red-600' ?> mb-2">
                EXPECTING PROFIT
            </h6>
            <h3 class="text-2xl font-bold text-gray-800"><?= formatTZS($expectingProfit) ?></h3>
        </div>
    </div>
     <!-- END SUMMARY CARD  -->

    

    <!-- Summary Cards -->
    

    <!-- Stock Table -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                Stock Items
            </h3>

            <?php if (!empty($stocks)): ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buying Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Selling Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Value</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($stocks as $stock): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $increment++ ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <?= Html::encode($stock->item_name) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        <?= Html::encode($stock->quantity) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        <?= formatTZS($stock->buying_price) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        <?= formatTZS($stock->selling_price) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600">
                                        <?= formatTZS($stock->selling_price * $stock->quantity) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot class="bg-gray-50 font-semibold">
                            <tr>
                                <td colspan="2" class="px-6 py-4 text-sm text-gray-900">TOTAL</td>
                                <td class="px-6 py-4 text-sm text-gray-700"><?= array_sum(array_column($stocks, 'quantity')) ?></td>
                                <td class="px-6 py-4 text-sm text-gray-700"><?= formatTZS($totalCost) ?></td>
                                <td class="px-6 py-4 text-sm text-gray-700"><?= formatTZS($totalPrice) ?></td>
                                <td class="px-6 py-4 text-sm <?= $expectingProfit >= 0 ? 'text-green-600' : 'text-red-600' ?>">
                                    <?= formatTZS($expectingProfit) ?>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <?php else: ?>
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-yellow-400 mr-3" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <p class="text-yellow-700">No stock items found in OptimizedStock.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>