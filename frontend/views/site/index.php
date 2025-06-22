<?php
use yii\bootstrap5\Html;

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

            <?php elseif (isset($view) && $view == 'dashboard'): ?>
            <!-- New Dashboard Design with Tanzania Map -->
            <div class="flex flex-col lg:flex-row gap-6 mb-8">
                <!-- Statistics Section -->
                <div class="w-full lg:w-1/2 space-y-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-xl font-bold mb-4 text-gray-800">Inventory Summary</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="p-4 border border-gray-200 rounded-lg">
                                <div class="text-gray-500 text-sm font-medium">Total Items</div>
                                <div class="text-2xl font-bold text-blue-600 mt-1">1,248</div>
                                <div class="text-xs text-gray-400 mt-1">+12% from last month</div>
                            </div>
                            <div class="p-4 border border-gray-200 rounded-lg">
                                <div class="text-gray-500 text-sm font-medium">Stock Value</div>
                                <div class="text-2xl font-bold text-green-600 mt-1">TZS 28.4M</div>
                                <div class="text-xs text-gray-400 mt-1">+8% from last month</div>
                            </div>
                            <div class="p-4 border border-gray-200 rounded-lg">
                                <div class="text-gray-500 text-sm font-medium">Low Stock</div>
                                <div class="text-2xl font-bold text-orange-600 mt-1">24</div>
                                <div class="text-xs text-gray-400 mt-1">Items need restocking</div>
                            </div>
                        </div>
                    </div>


                </div>


            </div>

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

            <?php endif; ?>

        </div>
        <?php require_once(__DIR__ . '/../layouts/footer.php'); ?>

    </div>
    
</div>
