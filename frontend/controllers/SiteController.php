<?php

namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\authclient\ClientInterface;
use common\models\User;
use yii\web\Response;
use yii\authclient\AuthAction;
use frontend\models\AddStockForm;
use yii\web\ErrorAction;
use yii\widgets\ActiveForm;
use frontend\models\Stock;
use frontend\models\Sale;
use frontend\models\SaleItem;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup', 'index'], // include protected actions
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'], // guests only
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'], // authenticated users only
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
        ];
    }
    public function onAuthSuccess($client)
    {
        $attributes = $client->getUserAttributes();
        $email = $attributes['email'];
    
        $user = User::find()->where(['email' => $email])->one();
    
        if ($user) {
            if ($user->status != User::STATUS_ACTIVE) {
                $user->status = User::STATUS_ACTIVE;
                $user->save(false); // No need for validation
            }
            Yii::$app->user->login($user);
        } else {
            $user = new \common\models\User();
            $user->email = $email;
            $user->username = $attributes['name'] ?? $email;
            $user->setPassword(Yii::$app->security->generateRandomString(8)); // dummy password
            $user->generateAuthKey();
            $user->generateEmailVerificationToken();
    
            //  Add this line:
            $user->status = \common\models\User::STATUS_ACTIVE;
    
            if ($user->save()) {
                Yii::$app->user->login($user);
            } else {
                Yii::$app->session->setFlash('error', 'Failed to create user via Google login.');
            }
        }
    }
    

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
{
    if (Yii::$app->user->isGuest) {
        return $this->redirect(['site/login']);
    }

    $model = new \frontend\models\AddStockForm();
    $showAddStock = (bool) Yii::$app->request->get('showAddStock', false);
    $view = Yii::$app->request->get('view', 'dashboard');

    $stocks = \frontend\models\Stock::find()->orderBy(['id' => SORT_DESC])->all();
    $sales = \frontend\models\Sale::find()->orderBy(['created_at' => SORT_DESC])->all();

    // this block to define totals for dashboard
    $totalItems = count($stocks);
    $totalStockValue = 0;
    $lowStockCount = 0;

    foreach ($stocks as $stock) {
        $totalStockValue += ($stock->quantity * $stock->selling_price);
        if ($stock->quantity <= 5) {
            $lowStockCount++;
        }
    }

    return $this->render('index', [
        'model' => $model,
        'view' => $view,
        'sales' => $sales,
        'showAddStock' => $showAddStock,
        'stocks' => $stocks,
        'totalItems' => $totalItems,
        'totalStockValue' => $totalStockValue,
        'lowStockCount' => $lowStockCount,
    ]);
}

   public function actionSale()
{
    if (Yii::$app->request->isPost) {
        $post = Yii::$app->request->post();

        $customerName = $post['customer_name'] ?? 'Walk-in';
        $paymentMethod = $post['payment_method'] ?? 'CASH';
        $items = $post['items'] ?? [];
        if (!is_array($items)) {
    // If $items is a JSON string, decode it:
    $items = json_decode($items, true);

    if (!is_array($items)) {
        // If still not an array, set empty array to avoid errors
        $items = [];
    }
}

        // if (empty($items)) {
        //     Yii::$app->session->setFlash('error', 'No items selected for sale.');
        //     return $this->redirect(['site/sale']);
        // }

        $totalAmount = 0;
foreach ($items as $item) {
    $quantity = (int)($item['quantity'] ?? 0);
    $price = (float)($item['price'] ?? 0);
    $totalAmount += $quantity * $price;
}


        $transaction = Yii::$app->db->beginTransaction();
        try {
            $sale = new \frontend\models\Sale();
            $sale->customer_name = $customerName;
            $sale->payment_method = $paymentMethod;
            $sale->total_amount = $totalAmount;
            $sale->save(false);

            foreach ($items as $item) {
    $stock = \frontend\models\Stock::findOne($item['stock_id']);
    if (!$stock) {
        throw new \yii\web\NotFoundHttpException("Stock ID {$item['stock_id']} not found.");
    }
    if ($stock->quantity < $item['quantity']) {
        throw new \Exception("Not enough stock for item: {$stock->item_name}");
    }

    $stock->quantity -= $item['quantity'];
    $stock->save(false);

    $saleItem = new \frontend\models\SaleItem();
    $saleItem->sale_id = $sale->id;
    $saleItem->stock_id = $item['stock_id'];
    $saleItem->quantity = $item['quantity'];
    $saleItem->price = $item['price'];
    $saleItem->discount = $item['discount'] ?? 0;
    $saleItem->amount = $item['amount'];
    $saleItem->save(false);
}


            $transaction->commit();
            Yii::$app->session->setFlash('success', 'Sale saved successfully.');
            return $this->redirect(['site/sale']);
        } catch (\Exception $e) {
            $transaction->rollBack();
            Yii::$app->session->setFlash('error', 'Failed to save sale: ' . $e->getMessage());
            return $this->redirect(['site/sale']);
        }
    }

    // GET request part (unchanged)
    $stocks = \frontend\models\Stock::find()->orderBy(['id' => SORT_DESC])->all();

    if (empty($stocks)) {
        Yii::error('No stock items available for sale.');
    }

    return $this->render('index', [
        'view' => 'sale',
        'stocks' => $stocks,
    ]);
}

public function actionSalesReport(){
    $sales = \frontend\models\Sale::find()->orderBy(['id' => SORT_DESC])->all();
    if (empty($sales)) {
        Yii::$app->session->setFlash('info', 'No sales records found.');
    }
    return $this->render('index', [
        'view' => 'salesrpt',
        'sales' => $sales,
    ]);
}




public function actionDashboard()
{
    $model = new \frontend\models\AddStockForm();
    $view = Yii::$app->request->get('view', 'dashboard');
    $showAddStock = 0;
    $showStock = Yii::$app->request->get('showStock', 0);

    $stocks = [];
    $sales = [];
    $totalItems = 0;
    $totalStockValue = 0;
    $lowStockCount = 0;

    // Always calculate totalItems, totalStockValue, and lowStockCount for dashboard
    if ($view == 'dashboard') {
        $stocks = \frontend\models\Stock::find()->all();

        foreach ($stocks as $stock) {
            $totalItems += $stock->quantity;
        }

        foreach ($stocks as $stock) {
            $totalStockValue += ($stock->quantity * $stock->selling_price);
            if ($stock->quantity <= 5) { // Change '5' to any threshold you define as low
                $lowStockCount++;
            }
        }
    }

    // Only load these if requested view requires them
    if ($view == 'current_stock') {
        $stocks = \frontend\models\ShowStock::find()->orderBy(['id' => SORT_DESC])->all();
    } elseif ($view == 'manage_stock' || $view == 'sale') {
        $stocks = \frontend\models\Stock::find()->orderBy(['id' => SORT_DESC])->all();
    } elseif ($view == 'salesrpt') {
        $sales = \frontend\models\Sale::find()->orderBy(['id' => SORT_DESC])->all();
    }

    return $this->render('index', [
        'sales' => $sales,
        'model' => $model,
        'view' => $view,
        'showAddStock' => $showAddStock,
        'stocks' => $stocks,
        'showStock' => $showStock,
        'totalItems' => $totalItems,
        'totalStockValue' => $totalStockValue,
        'lowStockCount' => $lowStockCount,
    ]);
}

// SALE 





    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        // return $this->goHome();
        return $this->redirect(['site/bye']);
    }

    public function actionBye()
    {
        return $this->render('bye');
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
    if ($model->load(Yii::$app->request->post()) && $model->signup()) {
        // Set the flash message before redirecting
        Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for the verification email.');
        
        // Redirect after setting the flash message
        return $this->redirect(['site/login']);
    }

        // else{
        //     Yii::$app->session->setFlash('success','An error has occurred');
        // }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->redirect(['site/index']);
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->redirect(['site/signup']);
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }


public function actionAddStock()
{
    if (Yii::$app->user->isGuest) {
        return $this->redirect(['site/login']);
    }

    // $model = new \frontend\models\AddStockForm();
    $model = new AddStockForm();

    if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ActiveForm::validate($model);
    }

    if ($model->load(Yii::$app->request->post())) {
        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Stock item added successfully.');
            
        } else {
            Yii::$app->session->setFlash('error', 'There was an error saving the stock item.');
        }
        return $this->redirect(['site/index', 'showAddStock' => true]);
    }

    return $this->redirect(['site/index']);
}

public function actionStock(){
    if (Yii::$app->user->isGuest) {
        return $this->redirect(['site/login']);

    }

    $searchModel = new \frontend\models\StockSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('stock', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]);
} 


public function actionEditStock($id)
{
    $stock = \frontend\models\Stock::findOne($id);
    if (!$stock) {
        throw new \yii\web\NotFoundHttpException("Stock not found.");
    }

    $model = new \frontend\models\AddStockForm();
    $model->setAttributes($stock->attributes, false); // populate form model from AR

    return $this->render('index', [
        'view' => 'edit_stock',
        'stock' => $stock,
        'model' => $model,
        'showAddStock' => false,
        'stocks' => [], 
        'id' => $id,
    ]);
}

//ACTION UPDATE THE STOCK

public function actionUpdateStock($id)
{
    if (Yii::$app->user->isGuest) {
        return $this->redirect(['site/login']);
    }

    $stock = Stock::findOne($id);
    if (!$stock) {
        throw new NotFoundHttpException('The requested stock item does not exist.');
    }

    Yii::info(Yii::$app->request->post(),'postData');
    if ($stock->load(Yii::$app->request->post()) && $stock->save()) {
        Yii::$app->session->setFlash('success', 'Stock updated successfully.');
        // return $this->redirect(['site/index']);
        return $this->redirect(['site/index', 'view' => 'manage_stock']);
    }

    return $this->render('index', [
        'view' => 'edit_stock',
        'stock' => $stock,
        'id' => $id,
        'model' => null,
        'showAddStock' => false,
        'stocks' => [],
    ]);
}

public function actionAdjustStock($id = null)
{
    // Fetch all stocks (not just one)
    $stocks = \frontend\models\Stock::find()->orderBy(['id' => SORT_DESC])->all();

    // Optional: find the selected stock by id if provided
    $selectedStock = null;
    if ($id !== null) {
        $selectedStock = \frontend\models\Stock::findOne($id);
        if (!$selectedStock) {
            throw new \yii\web\NotFoundHttpException("Stock with ID $id not found.");
        }
    }

    return $this->render('adjust_stock', [
        'stocks' => $stocks,
        'selectedStock' => $selectedStock,
    ]);
}


public function actionDeleteStock($id)
{
    $stock = \frontend\models\Stock::findOne($id);
    if ($stock) {
        $stock->delete();
        Yii::$app->session->setFlash('success', 'Stock item deleted successfully.');
    } else {
        Yii::$app->session->setFlash('error', 'Stock item not found.');
    }

    return $this->redirect(['site/index', 'view' => 'manage_stock']);
}




}