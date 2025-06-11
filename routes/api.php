<?php

Route::post('/send-verification-code', [SmsController::class, 'send']);
