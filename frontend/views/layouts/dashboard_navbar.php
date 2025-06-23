<!-- Sidenav Menu End  -->
<div class="app-menu">
    <!-- App Logo -->
    <a href="#" class="logo-box">
        <!-- Light Logo -->
        <strong>
            <h1>OptimizedStock</h1>
        </strong>
        <!-- Dark Logo -->
        <div class="logo-dark">
        <strong>
            <h1 style="color:white;">OptimizedStock</h1>
        </strong>
        </div>
    </a>
    <!-- Sidenav Menu Toggle Button -->
    <button id="button-hover-toggle" class="absolute top-5 end-2 rounded-full p-1.5 z-50">
        <span class="sr-only">Menu Toggle Button</span>
        <i class="ri-checkbox-blank-circle-line text-xl"></i>
    </button>
    <!--- Menu -->
    <div class="scrollbar" data-simplebar>
        <ul class="menu" data-fc-type="accordion">
            
            <li class="menu-item">
                <a href="<?= \yii\helpers\Url::to(['site/dashboard','view' => 'dashboard']) ?>" data-fc-type="collapse"
                    class="menu-link">
                    <span class="menu-icon">
                        <i class="ri-home-4-line"></i>
                    </span>
                    <span class="menu-text"> Home</span>
                </a>
            </li>
            <li class="menu-title">Navigation</li>
             <li class="menu-item">
                <a href="<?= \yii\helpers\Url::to(['site/dashboard', 'view' => 'sale']) ?>" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon">
                        <i class="ri-shopping-cart-2-line"></i>
                    </span>
                    <span class="menu-text"><b>POS</b> </span>
                    <span class=""></span>
                </a>
                
            </li>
            <li class="menu-title">Stock</li>
            <li class="menu-item">
                <a href="<?= \yii\helpers\Url::to(['site/index', 'showAddStock' => 1]) ?>" class="menu-link"><span class="menu-icon"><i class="ri-add-line"></i></span><span class="menu-text">Add Stock</span></a>
                
            </li>
            <li class="menu-item">
                <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon">
                        <i class="ri-database-2-line"></i>
                    </span>
                    <span class="menu-text"> Inventory </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="<?= \yii\helpers\Url::to(['site/dashboard','view' => 'current_stock']) ?>" class="menu-link">
                            <span class="menu-text">Current Stock</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="<?= \yii\helpers\Url::to(['site/dashboard', 'view' => 'manage_stock'])?>" class="menu-link">
                            <span class="menu-text">Manage Stock</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="<?= \yii\helpers\Url::to(['site/dashboard', 'view' => 'adjust_stock']) ?>" class="menu-link">
                            <span class="menu-text">Stock Adjustment</span>
                        </a>
                    </li>
                    
                </ul>
            </li>
             <li class="menu-title">Reports</li>
            <li class="menu-item">
                <a href="<?= \yii\helpers\Url::to(['site/dashboard','view'=> 'salesrpt'])?>" class="menu-link">
                    <span class="menu-icon">
                        <i class="ri-bar-chart-2-line"></i>
                    </span>
                    <span class="menu-text">Reports</span>
                    <span class="badge bg-success rounded-md">
                    <i class="ri-file-chart-line"></i>
                    </span>
                </a>

            <li class="menu-item">
                <a href="<?= \yii\helpers\Url::to(['site/dashboard','view'=> 'members'])?>" class="menu-link">
                    <span class="menu-icon">
                        <i class="ri-group-fill"></i>
                    </span>
                    <span class="menu-text">Team Members</span>
                    <span class="badge bg-success rounded-md">
                    <i class="ri-account-circle-fill"></i>
                    </span>
                </a>
            </li>
            <!-- <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link">
                    <span class="menu-icon">
                        <i class="ri-flag-2-line"></i>
                    </span>
                    <span class="menu-text">Team Members </span>
                    <span class="badge bg-danger rounded-md">5</span>
                </a>
            </li> -->

            <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link">
                    <span class="menu-icon">
                        <i class="ri-question-line"></i>
                    </span>
                    <span class="menu-text">Help </span>
                    <span class="badge bg-danger rounded-md">
                    <i class="ri-phone-line"></i>
                    </span>
                </a>
            </li>
        </ul>

    </div>
</div>
<!-- Sidenav Menu End  -->