<?php

use Illuminate\Support\Facades\Route;

Route::post('login', 'CommonLaravel\AuthController@login');
Route::post('logout', 'CommonLaravel\AuthController@logout');

// Password Reset
Route::post('/password-reset/send-verification-code',
	'CommonLaravel\PasswordResetController@sendVerificationCode'
);
Route::post('/password-reset/check-verification-code',
	'CommonLaravel\PasswordResetController@checkVerificationCode'
);
Route::post('/password-reset/update-password',
	'CommonLaravel\PasswordResetController@updatePassword'
);

Route::post('siniestro', 'SiniestroController@store');


// PDF
Route::get('/pdf/{siniestro_id}/{name}',
	'PdfController@pdf'
);


// Excel
Route::get('/excel/metricas/{inicio}/{fin}/{aseguradora_id}/{gestores_id}',
	'ExcelController@metricas'
);

Route::get('helpers/{method}', 'HelperController@callMethod');
