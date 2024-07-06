<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RewardNotificationController;
use App\Http\Controllers\DisbursementNotificationController;
use App\Http\Controllers\AdvanceRequestNotificationController;
use App\Http\Controllers\PaymentNotificationController;

Log::info('API routes loaded');


// Route::get('/notification', [NotificationController::class, 'index']);
// routes/api.php
// Route::post('/notifications/reward', [RewardNotificationController::class, 'send']);
Route::get('/notification', [NotificationController::class, 'index']);


Route::group(['prefix' => 'v1'], function(){
    Route::middleware(['api'])->group(function () {
        Route::get('/notifications', [NotificationController::class, 'index']);
        Route::get('/notification', [NotificationController::class, 'index']);
    
    });
Route::group(['middleware' => ['jwt.verify', 'api']], function() {
// Route::get('/notification', [NotificationController::class, 'index']);
Route::get('/notification', [NotificationController::class, 'index']);

Route::post('/notifications/reward', [RewardNotificationController::class, 'send']);
Route::post('/notifications/disbursement', [DisbursementNotificationController::class, 'send']);
Route::post('/notifications/advance-request', [AdvanceRequestNotificationController::class, 'send']);
Route::post('/notifications/payment', [PaymentNotificationController::class, 'send']);
});

});