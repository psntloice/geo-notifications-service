<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RewardNotificationController;
use App\Http\Controllers\DisbursementNotificationController;
use App\Http\Controllers\AdvanceRequestNotificationController;
use App\Http\Controllers\PaymentNotificationController;
use App\Http\Controllers\DynamoController;

Log::info('API routes loaded');


// Route::get('/notification', [NotificationController::class, 'index']);
// routes/api.php
// Route::post('/notifications/reward', [RewardNotificationController::class, 'send']);
Route::get('/notification', [NotificationController::class, 'index']);
Route::post('/notifications/reward', [RewardNotificationController::class, 'send']);
Route::post('/notifications/disbursement', [DisbursementNotificationController::class, 'send']);
Route::post('/notifications/advance-request', [AdvanceRequestNotificationController::class, 'send']);
Route::post('/notifications/payment', [PaymentNotificationController::class, 'send']);




Route::group(['prefix' => 'v1'], function(){
            Route::get('/notification', [NotificationController::class, 'index']);
            Route::post('/notifications/reward', [RewardNotificationController::class, 'send']);
            Route::post('/notifications/disbursement', [DisbursementNotificationController::class, 'send']);
            Route::post('/notifications/advance-request', [AdvanceRequestNotificationController::class, 'send']);
            Route::post('/notifications/payment', [PaymentNotificationController::class, 'send']);

            Route::group(['middleware' => ['jwt.verify']], function() {
// Route::get('/notification', [NotificationController::class, 'index']);
Route::post('/notifications', [DynamoController::class, 'index']);

Route::get('/notification', [NotificationController::class, 'index']);

Route::post('/notifications/reward', [RewardNotificationController::class, 'send']);
Route::post('/notifications/disbursement', [DisbursementNotificationController::class, 'send']);
Route::post('/notifications/advance-request', [AdvanceRequestNotificationController::class, 'send']);
Route::post('/notifications/payment', [PaymentNotificationController::class, 'send']);

});

});