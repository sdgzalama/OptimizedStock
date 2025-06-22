<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var array|\frontend\models\Sale[] $sales */

// Calculate totals
$totalSales = 0;
$increment = 1;

foreach ($sales as $sale) {
    $totalSales += $sale->total_amount;
}

// Format as TZS (Tanzanian Shillings)
function formatTZS($amount) {
    return number_format($amount, 0) . ' TZS';
}

?>

<div class="container mx-auto px-4 py-6">
    <h3 class="text-2xl font-bold mb-6 text-gray-800">Sales Datials</h3>

    <!-- SUMMARY CARD  -->
    <div class="grid xl:grid-cols-2 grid-cols-1 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-lg p-6 text-center border-l-4 border-blue-500 hover:shadow-xl transition-shadow">
            <div class="text-4xl text-blue-600 mb-3">
                <i class="ri-cash-line"></i>
            </div>    
            <h6 class="text-sm font-semibold text-blue-600 mb-2">TOTAL SALES AMOUNT</h6>
            <h3 class="text-2xl font-bold text-gray-800"><?= formatTZS($totalSales) ?></h3>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 text-center border-l-4 border-green-500 hover:shadow-xl transition-shadow">
            <div class="text-4xl text-green-600 mb-3">
                <i class="ri-shopping-cart-2-line"></i>
            </div>    
            <h6 class="text-sm font-semibold text-green-600 mb-2">TOTAL SALES COUNT</h6>
            <h3 class="text-2xl font-bold text-gray-800"><?= count($sales) ?> Records</h3>
        </div>
    </div>
    <!-- END SUMMARY CARD -->

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                All Sales
            </h3>

            <?php if (!empty($sales)): ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment Method</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($sales as $sale): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $increment++ ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= Html::encode($sale->customer_name) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 font-semibold"><?= formatTZS($sale->total_amount) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?= Html::encode($sale->payment_method) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?= Yii::$app->formatter->asDatetime($sale->created_at) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot class="bg-gray-50 font-semibold">
                            <tr>
                                <td colspan="2" class="px-6 py-4 text-sm text-gray-900">Sub Total</td>
                                <td class="px-6 py-4 text-sm text-blue-700"><?= formatTZS($totalSales) ?></td>
                                <td colspan="2"></td>
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
                        <p class="text-yellow-700">No sales records found.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
