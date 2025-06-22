<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Byeeee';
?>

<div class="flex items-stretch h-screen bg-cover bg-center relative bg-no-repeat"
     style="background-image: url('https://images.unsplash.com/photo-1506748686214-e9df14d4d9d0');">

    <div class="bg-white lg:max-w-[480px] z-10 p-12 relative w-full h-full border-t-[3px] border-primary">
        <div class="flex flex-col h-full gap-4">
            <div class="mb-8 text-center lg:text-start">
                <b><h1><a href="<?= Yii::$app->homeUrl ?>"><?= Html::encode(Yii::$app->params['appName']) ?></a></h1></b>
            </div>
            
            <div class="my-auto text-center">
                    <!-- title-->
                    <h4 class="text-dark/70 text-lg font-semibold dark:text-light/80 mb-2">See You Again !</h4>
                    <p class="text-gray-400 mb-9">You are now successfully logged out.</p>

                   <div class="w-36 mx-auto">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 161.2 161.2" enable-background="new 0 0 161.2 161.2" xml:space="preserve">
                        <path class="path" fill="none" stroke="#0acf97" stroke-miterlimit="10" d="M425.9,52.1L425.9,52.1c-2.2-2.6-6-2.6-8.3-0.1l-42.7,46.2l-14.3-16.4
                                c-2.3-2.7-6.2-2.7-8.6-0.1c-1.9,2.1-2,5.6-0.1,7.7l17.6,20.3c0.2,0.3,0.4,0.6,0.6,0.9c1.8,2,4.4,2.5,6.6,1.4c0.7-0.3,1.4-0.8,2-1.5
                                c0.3-0.3,0.5-0.6,0.7-0.9l46.3-50.1C427.7,57.5,427.7,54.2,425.9,52.1z"></path>
                        <circle class="path" fill="none" stroke="#0acf97" stroke-width="4" stroke-miterlimit="10" cx="80.6" cy="80.6" r="62.1"></circle>
                        <polyline class="path" fill="none" stroke="#0acf97" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="113,52.8
                                74.1,108.4 48.2,86.4 "></polyline>

                        <circle class="spin" fill="none" stroke="#0acf97" stroke-width="4" stroke-miterlimit="10" stroke-dasharray="12.2175,12.2175" cx="80.6" cy="80.6" r="73.9"></circle>
                    </svg>
                   </div>

                   
                </div>
                <h1 class="text-center"> <a href="<?= Yii::$app->urlManager->createUrl(['/site/login']) ?>" class="text-gray-600 hover:text-primary"  style="color:red;">Login Again</a>
                   </h1>

        </div>
    </div>
</div>
