<?php
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var array|\frontend\models\Stock[] $stocks */
?>

<div class="max-w-7xl mx-auto p-6 bg-gray-50 min-h-screen">

  <h1 class="text-3xl font-extrabold text-gray-900 mb-8 text-center">Point of Sale (POS)</h1>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-8 h-[80vh]">

    <!-- LEFT PANEL: Stock Items -->
    <div class="bg-white rounded-lg shadow-lg p-4 flex flex-col h-full">
      <h2 class="text-xl font-semibold mb-2 border-b pb-1">Available Stock Items</h2>

      <div class="mb-3 flex space-x-2">
        <input id="search-box" type="text" placeholder="Search item or scan barcode..."
          class="flex-grow border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" oninput="filterStock()" />
      </div>

      <div id="stock-list" class="overflow-y-auto flex-grow space-y-2">
    <?php $first = true; foreach ($stocks as $stock): ?>
        <div 
            data-name="<?= strtolower(Html::encode($stock->item_name)) ?>"
            onclick="<?= $stock->quantity > 0 ? "addToSale({$stock->id}, '" . Html::encode($stock->item_name) . "', {$stock->selling_price})" : '' ?>"
            class="cursor-pointer border border-gray-300 rounded p-3 flex items-center <?= $stock->quantity > 0 ? 'hover:bg-indigo-50' : 'opacity-50 cursor-not-allowed' ?> transition"
            style="<?= $first ? '' : 'display: none;' ?>"
        >
            <div class="flex-grow">
                <h3 class="font-medium text-gray-900"><?= Html::encode($stock->item_name) ?></h3>
                <p class="text-sm text-gray-500">Barcode: <?= Html::encode($stock->barcode ?? 'N/A') ?></p>
                <p class="text-indigo-600 font-bold">Tzs <?= number_format($stock->selling_price, 0, '.', ',') ?></p>
                <p class="<?= $stock->quantity > 0 ? 'text-green-600' : 'text-red-600' ?> text-xs font-semibold">
                    Stock: <?= $stock->quantity ?>
                </p>
            </div>
        </div>
    <?php $first = false; endforeach; ?>
</div>

    </div>

    <!-- RIGHT PANEL: Sales Details -->
    <div class="md:col-span-2 bg-white rounded-lg shadow-lg p-4 flex flex-col h-full">

      <h2 class="text-xl font-semibold mb-2 border-b pb-1">Sales Details</h2>

      <form id="sales-form" method="post" action="<?= Url::to(['site/sale']) ?>" class="flex flex-col h-full">
        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>

        <input id="customer-name" name="customer_name" type="text" placeholder="Customer Name"
          class="border border-gray-300 rounded px-3 py-2 mb-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" />

        <div class="overflow-y-auto flex-grow mb-3 border rounded p-2">
          <table id="sales-details" class="w-full text-xs border-collapse">
            <thead class="bg-indigo-100 text-indigo-800 uppercase sticky top-0 text-xs">
              <tr>
                <th class="p-2 border">Item</th>
                <th class="p-2 border">Qty</th>
                <th class="p-2 border">Price</th>
                <th class="p-2 border">Discount</th>
                <th class="p-2 border">Amount</th>
                <th class="p-2 border">Action</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>

        <div class="flex justify-between items-center mb-3">
          <div class="text-sm font-medium">Items: <span id="total-count">0</span></div>
          <div class="text-lg font-bold text-indigo-800">Total: Tzs <span id="total-amount">0</span></div>
        </div>

        <input type="hidden" name="items" id="items-input" />

        <!-- Payment Buttons -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-2 bg-gray-900 p-2 rounded shadow-inner">
          
          <button type="submit" name="payment_method" value="cash"
            class="bg-green-600 active:bg-green-700 text-white font-semibold py-2 rounded transition">CASH</button>
          <button type="submit" name="payment_method" value="mpesa"
            class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 rounded transition">MPESA</button>
          <!-- <button type="submit" name="payment_method" value="card"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded transition">CARD</button>
          <button type="button" onclick="clearSales()"
            class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 rounded transition">Clear</button> -->
        </div>

      </form>
    </div>
  </div>
</div>

<script>
  let sales = [];

  function addToSale(itemId, itemName, sellingPrice) {
    let existing = sales.find(item => item.stock_id === itemId);
    if (existing) {
      existing.quantity += 1;
    } else {
      sales.push({
        stock_id: itemId,
        name: itemName,
        price: sellingPrice,
        quantity: 1,
        discount: 0,
      });
    }
    updateAmounts();
    renderSalesTable();
  }

  function removeFromSale(itemId) {
    sales = sales.filter(item => item.stock_id !== itemId);
    updateAmounts();
    renderSalesTable();
  }

  function updateAmounts() {
    sales.forEach(item => {
      item.amount = (item.price * item.quantity) - (item.discount ?? 0);
      if (item.amount < 0) item.amount = 0;
    });
  }

  function renderSalesTable() {
    const tbody = document.querySelector('#sales-details tbody');
    tbody.innerHTML = '';
    let totalAmount = 0;
    let totalCount = 0;

    sales.forEach(item => {
      totalAmount += item.amount;
      totalCount += item.quantity;

      tbody.innerHTML += `
        <tr>
          <td class="border p-1">${item.name}</td>
          <td class="border p-1 text-center">
            <input type="number" min="1" value="${item.quantity}" data-id="${item.stock_id}" class="qty-input w-14 border rounded px-1" />
          </td>
          <td class="border p-1 text-right">${item.price.toLocaleString()}</td>
          <td class="border p-1 text-center">
            <input type="number" min="0" value="${item.discount}" data-id="${item.stock_id}" class="discount-input w-16 border rounded px-1" />
          </td>
          <td class="border p-1 text-right">${item.amount.toLocaleString()}</td>
          <td class="border p-1 text-center">
            <button type="button" onclick="removeFromSale(${item.stock_id})" class="text-red-600 font-bold hover:text-red-800">Remove</button>
          </td>
        </tr>`;
    });

    document.getElementById('total-count').innerText = totalCount;
    document.getElementById('total-amount').innerText = totalAmount.toLocaleString();
    document.getElementById('items-input').value = JSON.stringify(sales);

    attachInputListeners();
  }

  function attachInputListeners() {
    document.querySelectorAll('.qty-input').forEach(input => {
      input.onchange = e => {
        const id = parseInt(e.target.dataset.id);
        let val = parseInt(e.target.value);
        if (isNaN(val) || val < 1) val = 1;
        e.target.value = val;

        const item = sales.find(i => i.stock_id === id);
        if (item) {
          item.quantity = val;
          updateAmounts();
          renderSalesTable();
        }
      };
    });

    document.querySelectorAll('.discount-input').forEach(input => {
      input.onchange = e => {
        const id = parseInt(e.target.dataset.id);
        let val = parseFloat(e.target.value);
        if (isNaN(val) || val < 0) val = 0;
        e.target.value = val.toFixed(2);

        const item = sales.find(i => i.stock_id === id);
        if (item) {
          item.discount = val;
          updateAmounts();
          renderSalesTable();
        }
      };
    });
  }

  function clearSales() {
    sales = [];
    renderSalesTable();
  }

  // Live search filter for stock items
  function filterStock() {
  const search = document.getElementById('search-box').value.toLowerCase();
  document.querySelectorAll('#stock-list > div').forEach((div, index) => {
    const name = div.getAttribute('data-name');
    if (search) {
      div.style.display = name.includes(search) ? 'flex' : 'none';
    } else {
      // Show ONLY the first item if search is empty
      div.style.display = index === 0 ? 'flex' : 'none';
    }
  });
}


  renderSalesTable();
</script>
