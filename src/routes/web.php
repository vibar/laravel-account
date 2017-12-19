<?php

Route::group([
    'prefix' => 'activation',
    'namespace' => 'Vibar\Account\Controllers',
    'middleware' => 'web',
], function() {
    Route::get('notify/{token}', 'ActivationController@notify')->name('activation.notify');
    Route::get('process/{token}', 'ActivationController@process')->name('activation.process');
});

?>
