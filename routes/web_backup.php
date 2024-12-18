<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth:api']], function() {
    Route::get('banks' , [App\Http\Controllers\BankController::class, 'index']);
    Route::get('/home-data', [App\Http\Controllers\HomeController::class, 'index'])->middleware('checkIfAdmin');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('checkIfAdmin');    
    //Tameia
    //Hmeras
    Route::get('/daily-funds', [App\Http\Controllers\FundsController::class, 'index']);
    Route::get('/funds', [App\Http\Controllers\FundsController::class, 'all']);

    Route::get('/offers', [App\Http\Controllers\FundsController::class, 'offers']);
    Route::get('/daily-cash', [App\Http\Controllers\FundsController::class, 'dailyCash']);
    Route::get('/get-province', [App\Http\Controllers\FundsController::class, 'allProvince']);
    Route::get('/province', [App\Http\Controllers\FundsController::class, 'province']);
    Route::get('/all-outfunds', [App\Http\Controllers\OutcomesController::class, 'all']);
    Route::get('/all-outfunds', [App\Http\Controllers\OutcomesController::class, 'all']);
    Route::get('/summaries', [App\Http\Controllers\FundsController::class, 'summaries']);
    Route::get('/summaries/{customer}', [App\Http\Controllers\FundsController::class, 'customerSummaries']);
    Route::post('/new-customer', [App\Http\Controllers\FundsController::class, 'createNewCustomer']);
    Route::post('/new-part', [App\Http\Controllers\FundsController::class, 'createNewPart']);
    Route::post('/new-outcome', [App\Http\Controllers\OutcomesController::class, 'saveNewOutcome']);
    Route::post('/save-fund', [App\Http\Controllers\FundsController::class, 'saveFund']);
    Route::post('/save-outcome', [App\Http\Controllers\OutcomesController::class, 'saveOutcome']);
    Route::post('/update-fund/{fund}', [App\Http\Controllers\FundsController::class, 'updateFund']);
    Route::post('/update-outfund/{outfund}', [App\Http\Controllers\OutcomesController::class, 'updateOutfund']);
    Route::post('/delete-fund/{fund}', [App\Http\Controllers\FundsController::class, 'deleteFund']);
    Route::post('/delete-outfund/{outfund}', [App\Http\Controllers\OutcomesController::class, 'deleteOutfund']);
    Route::post('/send-pdf/{fund}', [App\Http\Controllers\FundsController::class, 'sendMail']);
    Route::get('/quick-find-customer/{customer}', [App\Http\Controllers\FundsController::class, 'findCustomer']);
    Route::get('/quick-find-part/{part}', [App\Http\Controllers\FundsController::class, 'findPart']);
    Route::get('/quick-find-outcome/{outcome}', [App\Http\Controllers\OutcomesController::class, 'findOutcome']);
    Route::get('/merge-funds/{startedCustomer}/{finishedCustomer}', [App\Http\Controllers\FundsController::class, 'mergeFunds']);
    Route::post('/quick-edit-outcome/{outcome}', [App\Http\Controllers\OutcomesController::class, 'quickEditOutcome']);
    Route::post('/quick-edit-customer/{customer}', [App\Http\Controllers\FundsController::class, 'quickEditCustomer']);
    Route::post('/quick-delete-customer/{customer}', [App\Http\Controllers\FundsController::class, 'quickDeleteCustomer']);
    Route::post('/quick-delete-outcome/{outcome}', [App\Http\Controllers\OutcomesController::class, 'quickDeleteOutcome']);
    Route::post('/quick-edit-part/{part}', [App\Http\Controllers\FundsController::class, 'quickEditPart']);
    Route::post('/quick-delete-part/{part}', [App\Http\Controllers\FundsController::class, 'quickDeletePart']);

    Route::post('/cash', [App\Http\Controllers\CashController::class, 'store']);
    Route::get('/cash', [App\Http\Controllers\CashController::class, 'index']);

    //Palia Tameia
    Route::get('/past-funds', [App\Http\Controllers\FundsController::class, 'pastFunds']);
    Route::get('/past-funds/{date}', [App\Http\Controllers\FundsController::class, 'showPastFunds']);
    Route::get('/past-funds-result/{date}', [App\Http\Controllers\FundsController::class, 'showPastFundsResult']);
    Route::get('/past-outfunds-result/{date}', [App\Http\Controllers\FundsController::class, 'showPastOutFundsResult']);

    Route::get('/email', [App\Http\Controllers\FundsController::class, 'email']);

    //Plates
    Route::get('/customers', [App\Http\Controllers\CustomersController::class, 'index']);
    Route::post('/fast-search', [App\Http\Controllers\CustomersController::class, 'quickSearch']);
    Route::get('single-customer/{id}', [App\Http\Controllers\CustomersController::class, 'singleCustomer']);
    Route::post('get-last-price/{customer}', [App\Http\Controllers\CustomersController::class, 'getLastPrice']);
    Route::get('single-customer-result/{id}', [App\Http\Controllers\CustomersController::class, 'singleCustomerResult']);
    Route::get('single-customer/{id}/{date}', [App\Http\Controllers\CustomersController::class, 'singleCustomerWithPastFunds']);
    Route::get('single-customer-result/{id}/{date}', [App\Http\Controllers\CustomersController::class, 'singleCustomerWithPastFundsResult']);
    Route::post('save-single-customer/{customer}', [App\Http\Controllers\CustomersController::class, 'saveSingleCustomer']);
    Route::post('/fast-search-part', [App\Http\Controllers\PartsController::class, 'quickSearch']);
    Route::post('/fast-search-outcome', [App\Http\Controllers\OutcomesController::class, 'quickSearch']);
    Route::post('/customer-frames', [App\Http\Controllers\FrameController::class, 'customerFrames']);

    Route::get('/all-customers', [App\Http\Controllers\CustomersController::class, 'all']);
    Route::get('/all-customers-detailed', [App\Http\Controllers\CustomersController::class, 'detailed']);

    //Ypoloipa
    Route::get('/balances', [App\Http\Controllers\BalancesController::class, 'index']);
    
    //Antallaktika
    Route::get('/all-parts', [App\Http\Controllers\PartsController::class, 'all']);

    //Exoda
    Route::get('/outcomes', [App\Http\Controllers\OutcomesController::class, 'getOutfunds']);
    
    //Misthodosia
    Route::get('/payroll', [App\Http\Controllers\PayrollController::class, 'index'])->middleware('checkIfAdmin');
    Route::get('/current-payroll', [App\Http\Controllers\PayrollController::class, 'currentPayroll']);
    Route::get('/payroll/{employee}', [App\Http\Controllers\PayrollController::class, 'singlePayroll']);
    Route::post('/save-payroll', [App\Http\Controllers\PayrollController::class, 'savePayroll']);
    Route::post('/update-payroll', [App\Http\Controllers\PayrollController::class, 'updatePayroll']);
    
    //Upalliloi
    Route::get('/employees', [App\Http\Controllers\EmployeesController::class, 'index'])->middleware('checkIfAdmin');
    Route::get('/get-sellers', [App\Http\Controllers\EmployeesController::class, 'sellers'])->middleware('checkIfAdmin');
    Route::get('single-employee/{employee}', [App\Http\Controllers\EmployeesController::class, 'singleEmployee'])->middleware('checkIfAdmin');
    Route::get('/new-employee', [App\Http\Controllers\EmployeesController::class, 'create']);
    Route::post('/save-new-employee', [App\Http\Controllers\EmployeesController::class, 'newEmployee']);
    Route::get('/all-employees', [App\Http\Controllers\EmployeesController::class, 'all']);
    Route::get('/active-employees', [App\Http\Controllers\EmployeesController::class, 'activeEmployees']);
    Route::get('/active-users', [App\Http\Controllers\EmployeesController::class, 'employees']);
    Route::get('/employee/customers/{employee}/{month}/{year}', [App\Http\Controllers\EmployeesController::class, 'employeesCustomers']);
    Route::get('/employee/get-one/{employee}', [App\Http\Controllers\EmployeesController::class, 'getOneEmployee']);

    //adeies
    Route::post('/save-allowance', [App\Http\Controllers\AllowanceController::class, 'save']);
    Route::post('/delete-allowance/{allowance}', [App\Http\Controllers\AllowanceController::class, 'delete']);
    Route::get('/allowance/{employeeId}', [App\Http\Controllers\AllowanceController::class, 'all']);
    
    // Users
    Route::get('/users', [App\Http\Controllers\UsersController::class, 'index'])->middleware('checkIfAdmin');
    Route::get('/register-user', [App\Http\Controllers\UsersController::class, 'registerUserView'])->middleware('checkIfAdmin');
    Route::get('/get-online-users', [App\Http\Controllers\UsersController::class, 'onlineUsers']);
    Route::get('/get-all-users', [App\Http\Controllers\UsersController::class, 'allUsers']);
    Route::get('/single-user/{user}', [App\Http\Controllers\UsersController::class, 'getUser'])->middleware('checkIfAdmin');
    Route::get('/auth-user', [App\Http\Controllers\UsersController::class, 'getAuthUser']);

    Route::post('/update-user/{user}', [App\Http\Controllers\UsersController::class, 'saveUser'])->middleware('checkIfAdmin');
    Route::post('/register-new-user', [App\Http\Controllers\UsersController::class, 'registerUser'])->middleware('checkIfAdmin');

    //Orders
    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index']);
    Route::post('/orders', [App\Http\Controllers\OrderController::class, 'store']);
    Route::get('/get-all-orders', [App\Http\Controllers\OrderController::class, 'getAll']);

    //Statistika
    Route::get('/statistics', [App\Http\Controllers\StatisticsController::class, 'index'])->middleware('checkIfAdmin');
    Route::get('/month-statistics', [App\Http\Controllers\StatisticsController::class, 'monthly'])->middleware('checkIfAdmin');
    Route::get('/month-statistics/{month}/{year}', [App\Http\Controllers\StatisticsController::class, 'monthlyOtherMonth'])->middleware('checkIfAdmin');
    Route::get('/month-statistics/{month}/{year}/{user}', [App\Http\Controllers\StatisticsController::class, 'monthlyOtherMonthUser'])->middleware('checkIfAdmin');
    Route::get('/month-statistics/{month}/{year}/{monthTo}/{yearTo}', [App\Http\Controllers\StatisticsController::class, 'monthlyOtherMonthRanged'])->middleware('checkIfAdmin');
    Route::get('/month-statistics/{month}/{year}/{monthTo}/{yearTo}/{user}', [App\Http\Controllers\StatisticsController::class, 'monthlyOtherMonthRangedUser'])->middleware('checkIfAdmin');
    Route::get('/month-statistics-outcome/{month}/{year}/{user}', [App\Http\Controllers\StatisticsController::class, 'monthlyOtherMonthOutcome'])->middleware('checkIfAdmin');
    Route::get('/month-statistics-outcome/{month}/{year}/{monthTo}/{yearTo}/{user}', [App\Http\Controllers\StatisticsController::class, 'monthlyOtherMonthRangedUser'])->middleware('checkIfAdmin');
    Route::get('/year-statistics/{year}', [App\Http\Controllers\StatisticsController::class, 'yearStatistics'])->middleware('checkIfAdmin');
    Route::get('/year-statistics/{year}/{user}', [App\Http\Controllers\StatisticsController::class, 'yearStatisticsUser'])->middleware('checkIfAdmin');
    Route::get('/year-statistics-outcome/{year}/{user}', [App\Http\Controllers\StatisticsController::class, 'yearStatisticsOutcome'])->middleware('checkIfAdmin');
    Route::get('/all-statistics', [App\Http\Controllers\StatisticsController::class, 'allStatistics'])->middleware('checkIfAdmin');
    Route::get('/all-statistics/{user}', [App\Http\Controllers\StatisticsController::class, 'allStatisticsUser'])->middleware('checkIfAdmin');
    Route::get('/all-statistics-outcome/{user}', [App\Http\Controllers\StatisticsController::class, 'allStatisticsOutcome'])->middleware('checkIfAdmin');

    //Search
    Route::get('/single-fund/{searchQuery}', [App\Http\Controllers\FundsController::class, 'single']);
    Route::get('/single-fund-result/{searchQuery}', [App\Http\Controllers\FundsController::class, 'singleResult']);

    //Chat
    Route::post('/send-message/{user}', [App\Http\Controllers\NotificationController::class, 'send']);
    Route::get('/chat-logs/{user}/{receiver}', [App\Http\Controllers\NotificationController::class, 'chatLogs']);

    //ektupwseis
    Route::get('/print', [App\Http\Controllers\FundsController::class, 'prints']);
    Route::get('/weekly-print', [App\Http\Controllers\FundsController::class, 'weeklyPrints']);
    Route::post('/monthly-customers', [App\Http\Controllers\FundsController::class, 'weeklyPrintsWithMonth']);

    Route::get('/seller-print/{id}', [App\Http\Controllers\FundsController::class, 'sellerPrints']);
    Route::get('/employers-statistics', [App\Http\Controllers\FundsController::class, 'employersStatistics']);
    Route::get('/employers-sells', [App\Http\Controllers\StatisticsController::class, 'employersStatistics']);
    Route::get('/employees-bar/{year}', [App\Http\Controllers\StatisticsController::class, 'employersStatisticsBar']);
    
    //ekremmotites
    Route::get('/duties', [App\Http\Controllers\DutyController::class, 'index']);
    Route::get('/all-duties', [App\Http\Controllers\DutyController::class, 'all']);
    Route::get('/count-duties', [App\Http\Controllers\DutyController::class, 'count']);
    Route::post('/save-duty', [App\Http\Controllers\DutyController::class, 'save']);
    Route::post('/complete-duty/{duty}', [App\Http\Controllers\DutyController::class, 'complete']);
    
});



Auth::routes();

Route::get('/backup-update', [App\Http\Controllers\BackupController::class, 'backup']);









