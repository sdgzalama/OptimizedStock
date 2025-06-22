<?php
use yii\helpers\Html;
/** @var yii\web\View $this */
/** @var array $stocks */
$increment = 1;
?>

<div class="container mx-auto px-4 py-10">

    <h3 class="text-3xl font-extrabold text-center text-gray-800 mb-10">
        Group Members
    </h3>

    <!-- Card Wrapper -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
        <!-- <div class="p-6"  style="background-color:red;"> -->
        <div class="p-6">
            <h3 class="text-xl font-bold text-gray-700 mb-6 flex items-center gap-2">
                <i class="ri-folder-info-line text-success text-2xl"></i> Student Information
            </h3>

            <div class="overflow-x-auto" >
                <table class="min-w-full border-collapse text-sm text-left text-gray-800">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-bold border-b-2 border-gray-300">
                        <tr>
                            <th class="px-4 py-3 border border-gray-300">#</th>
                            <th class="px-4 py-3 border border-gray-300">Full Name</th>
                            <th class="px-4 py-3 border border-gray-300">Registration Number</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 border border-gray-300"><?= $increment++ ?></td>
                            <td class="px-4 py-3 border border-gray-300 font-medium">MONICA WILLIAM ANTONY</td>
                            <td class="px-4 py-3 border border-gray-300">EASTC/BDTS/24/01357</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 border border-gray-300"><?= $increment++ ?></td>
                            <td class="px-4 py-3 border border-gray-300 font-medium">SIDAGA WAZIRI</td>
                            <td class="px-4 py-3 border border-gray-300">EASTC/BDTS/24/01357</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 border border-gray-300"><?= $increment++ ?></td>
                            <td class="px-4 py-3 border border-gray-300 font-medium">TAJI FILBERT KIKOTI</td>
                            <td class="px-4 py-3 border border-gray-300">EASTC/BDTS/24/01357</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 border border-gray-300"><?= $increment++ ?></td>
                            <td class="px-4 py-3 border border-gray-300 font-medium">AZIZ IDDI MOHAMMED</td>
                            <td class="px-4 py-3 border border-gray-300">EASTC/BDTS/24/01357</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 border border-gray-300"><?= $increment++ ?></td>
                            <td class="px-4 py-3 border border-gray-300 font-medium">JOHN B MANGASALA</td>
                            <td class="px-4 py-3 border border-gray-300">EASTC/BDTS/24/01357</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
