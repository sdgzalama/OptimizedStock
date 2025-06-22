<?php
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var array $stocks */

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
    <!-- Summary Cards -->
    <div class="grid xl:grid-cols-3 grid-cols-1 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-lg p-6 text-center border-l-4 border-blue-500 hover:shadow-xl transition-shadow">
            <h6 class="text-sm font-semibold text-blue-600 mb-2">STOCK VALUES PER COST</h6>
            <h3 class="text-2xl font-bold text-gray-800"><?= formatTZS($totalCost) ?></h3>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-6 text-center border-l-4 border-purple-500 hover:shadow-xl transition-shadow">
            <h6 class="text-sm font-semibold text-purple-600 mb-2">STOCK VALUES PER PRICE</h6>
            <h3 class="text-2xl font-bold text-gray-800"><?= formatTZS($totalPrice) ?></h3>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-6 text-center border-l-4 <?= $expectingProfit >= 0 ? 'border-green-500' : 'border-red-500' ?> hover:shadow-xl transition-shadow">
            <h6 class="text-sm font-semibold <?= $expectingProfit >= 0 ? 'text-green-600' : 'text-red-600' ?> mb-2">
                EXPECTING PROFIT
            </h6>
            <h3 class="text-2xl font-bold text-gray-800"><?= formatTZS($expectingProfit) ?></h3>
        </div>
    </div>

    <!-- Stock Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-700 flex items-center">
                    <i class="ri-archive-line mr-2 text-blue-500"></i>
                    Stock Inventory
                </h3>
                <?= Html::a('<i class="ri-add-line mr-1"></i> Add New Stock', ['site/index', 'showAddStock'=>1], [
                    'class' => 'btn btn-success py-2 px-4 rounded-md text-sm font-medium'
                ]) ?>
            </div>

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
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
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
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <?= Html::a('<i class="ri-edit-2-line"></i>', ['site/edit-stock', 'id' => $stock->id], [
                                            'class' => 'text-blue-600 hover:text-blue-800',
                                            'title' => 'Edit',
                                            'aria-label' => 'Edit',
                                            'data-pjax' => '0',
                                        ]) ?>
                                        <?= Html::a('<i class="ri-delete-bin-line"></i>', ['site/delete-stock', 'id' => $stock->id], [
                                            'class' => 'text-red-600 hover:text-red-800',
                                            'title' => 'Delete',
                                            'aria-label' => 'Delete',
                                            'data' => [
                                                'confirm' => 'Are you sure you want to delete this stock item?',
                                                'method' => 'post',
                                            ],
                                            'data-pjax' => '0',
                                        ]) ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded">
                    <div class="flex items-center">
                        <i class="ri-error-warning-line text-yellow-500 mr-3"></i>
                        <p class="text-yellow-700">No stock items found in OptimizedStock</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>