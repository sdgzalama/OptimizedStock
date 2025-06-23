<?php
use yii\bootstrap5\Html;

use yii\helpers\Url;
/** @var yii\web\View $this */
/** @var array|\frontend\models\Stock[] $stocks */

$this->title = 'Dashboard';

?>

<div class="flex wrapper">
    <?= $this->render('//layouts/dashboard_navbar') ?>

    <div class="page-content">

        <?= $this->render('//layouts/dashboard_topbar') ?>

        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">
                    <?= Html::encode(Yii::$app->params['appName']) ?>
                </h4>
                <div class="md:flex hidden items-center gap-2.5 font-semibold">
                    <a href="#" class="text-sm font-medium text-slate-700 dark:text-slate-400">
                        <?= Html::encode($this->title) ?>
                    </a>
                </div>
            </div>

            <?php if (isset($showAddStock) && $showAddStock == 1): ?>
            <div class="card mt-6">
                <div class="p-6">
                    <?= $this->render('_add_stock', ['model' => $model]) ?>
                </div>
            </div>

            <?php elseif ($view == 'dashboard'): ?>
            <!-- Dash Home -->
            <div>
                <div class="grid dark:bg-gray-900 grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="p-4 bg-white border border-gray-200 dark:border-gray-700 rounded-lg">
                        <div class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Items</div>
                        <div class="text-2xl font-bold text-blue-600 mt-1"><?= $totalItems ?></div>
                        <div class="text-xs text-gray-400 mt-1">
                            as of <?= date("l, F j, Y", strtotime("TODAY")) ?>
                        </div>
                    </div>
                    <div class="p-4 bg-white border border-gray-200 dark:border-gray-700 rounded-lg">
                        <div class="text-gray-500 dark:text-gray-400 text-sm font-medium">Stock Value</div>
                        <div class="text-2xl font-bold text-green-600 mt-1">TZS
                            <?= number_format($totalStockValue, 0, '.', ',') ?></div>
                        <div class="text-xs text-gray-400 mt-1">
                            as of <?= date("l, F j, Y", strtotime("TODAY")) ?>
                        </div>
                    </div>
                    <div class="p-4 bg-white border border-gray-200 dark:border-gray-700 rounded-lg">
                        <div class="text-gray-500 dark:text-gray-400 text-sm font-medium">Low Stock</div>
                        <div class="text-2xl font-bold text-orange-600 mt-1"><?= $lowStockCount ?></div>
                        <div class="text-xs text-gray-400 mt-1">Items need restocking</div>
                    </div>
                </div>
                <div class="mt-8 p-4 bg-white dark:bg-gray-900 rounded-lg shadow max-w-5xl mx-auto">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Sales vs Stock Chart</h3>
                    <canvas id="salesStockChart" height="120"></canvas>
                </div>


            </div>
            <?php if ($view == 'dashboard'): ?>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
            const ctx = document.getElementById('salesStockChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Total Items', 'Low Stock', 'Stock Value'],
                    datasets: [{
                        label: 'Stock Summary',
                        data: [<?= $totalItems ?>, <?= $lowStockCount ?>, <?= $totalStockValue/100 ?>],

                        backgroundColor: [
                            'rgba(59, 130, 246, 0.8)', // Blue
                            'rgba(249, 115, 22, 0.8)', // Orange
                            'rgba(22, 163, 74, 0.8)' // Green
                        ],
                        borderRadius: 8,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    if (context.dataIndex === 2) {
                                        return 'TZS ' + Number(context.raw).toLocaleString();
                                    }
                                    return context.raw;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            </script>
            <?php endif; ?>




            <?php elseif ($view == 'current_stock'): ?>
            <?= $this->render('_current_stock', ['stocks' => $stocks]) ?>

            <?php elseif($view == 'members'):?>
            <?= $this->render('_members')?>

            <?php elseif ($view == 'manage_stock'): ?>
            <?= $this->render('_manage_stock', ['stocks' => $stocks]) ?>

            <?php elseif ($view == 'edit_stock' && isset($stock) && isset($model)): ?>
            <?= $this->render('_edit_stock', [
            'stock' => $stock,
            'model' => $model,
            'id' => $id,
            ]) ?>
            <?php elseif ($view == 'adjust_stock'):?>
            <?= $this->render('_adjust_stock') ?>

            <?php elseif ($view == 'sale'): ?>
            <?= $this->render('_sale',['stocks'=>$stocks]) ?>

            <?php elseif ($view == 'salesrpt'): ?>
            <?= $this->render('_salesrpt', ['sales' => $sales]) ?>

            <?php endif; ?>

        </div>
        <?php require_once(__DIR__ . '/../layouts/footer.php'); ?>

    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>