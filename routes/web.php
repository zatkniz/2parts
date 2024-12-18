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

Route::group(['middleware' => ['auth']], function() {
    Route::get('/', 'HomeController@index')->middleware('checkIfAdmin');
    Route::get('/home', 'HomeController@index')->name('home');
    
    //Tameia
    //Hmeras
    Route::get('/daily-fundss', 'FundsController@index');
    Route::get('/funds', 'FundsController@all');
    Route::get('/offers', 'FundsController@offers');
    Route::get('/get-province', 'FundsController@allProvince');
    Route::get('/province', 'FundsController@province');
    Route::get('/all-outfunds', 'OutcomesController@all');
    Route::get('/summaries', 'FundsController@summaries');
    Route::post('/new-customer', 'FundsController@createNewCustomer');
    Route::post('/new-part', 'FundsController@createNewPart');
    Route::post('/new-outcome', 'OutcomesController@saveNewOutcome');
    Route::post('/save-fund', 'FundsController@saveFund');
    Route::post('/save-outcome', 'OutcomesController@saveOutcome');
    Route::post('/update-fund/{fund}', 'FundsController@updateFund');
    Route::post('/update-outfund/{outfund}', 'OutcomesController@updateOutfund');
    Route::post('/delete-fund/{fund}', 'FundsController@deleteFund');
    Route::post('/delete-outfund/{outfund}', 'OutcomesController@deleteOutfund');
    Route::post('/send-pdf/{fund}', 'FundsController@sendMail');
    Route::get('/quick-find-customer/{customer}', 'FundsController@findCustomer');
    Route::get('/quick-find-part/{part}', 'FundsController@findPart');
    Route::get('/quick-find-outcome/{outcome}', 'OutcomesController@findOutcome');
    Route::get('/merge-funds/{startedCustomer}/{finishedCustomer}', 'FundsController@mergeFunds');
    Route::post('/quick-edit-outcome/{outcome}', 'OutcomesController@quickEditOutcome');
    Route::post('/quick-edit-customer/{customer}', 'FundsController@quickEditCustomer');
    Route::post('/quick-delete-customer/{customer}', 'FundsController@quickDeleteCustomer');
    Route::post('/quick-delete-outcome/{outcome}', 'OutcomesController@quickDeleteOutcome');
    Route::post('/quick-edit-part/{part}', 'FundsController@quickEditPart');
    Route::post('/quick-delete-part/{part}', 'FundsController@quickDeletePart');

    //Palia Tameia
    Route::get('/past-funds', 'FundsController@pastFunds');
    Route::get('/past-funds/{date}', 'FundsController@showPastFunds');
    Route::get('/past-funds-result/{date}', 'FundsController@showPastFundsResult');
    Route::get('/past-outfunds-result/{date}', 'FundsController@showPastOutFundsResult');

    Route::get('/email', 'FundsController@email');

    //Plates
    Route::get('/customers', 'CustomersController@index');
    Route::post('/fast-search', 'CustomersController@quickSearch');
    Route::get('single-customer/{id}', 'CustomersController@singleCustomer');
    Route::get('single-customer-result/{id}', 'CustomersController@singleCustomerResult');
    Route::get('single-customer/{id}/{date}', 'CustomersController@singleCustomerWithPastFunds');
    Route::get('single-customer-result/{id}/{date}', 'CustomersController@singleCustomerWithPastFundsResult');
    Route::post('save-single-customer/{customer}', 'CustomersController@saveSingleCustomer');
    Route::post('/fast-search-part', 'PartsController@quickSearch');
    Route::post('/fast-search-outcome', 'OutcomesController@quickSearch');

    Route::get('/all-customers', 'CustomersController@all');
    Route::get('/all-customers-detailed', 'CustomersController@detailed');

    //Ypoloipa
    Route::get('/balances', 'BalancesController@index');
    
    //Antallaktika
    Route::get('/all-parts', 'PartsController@all');

    //Exoda
    Route::get('/outcomes', 'OutcomesController@getOutfunds');
    
    //Misthodosia
    Route::get('/payroll', 'PayrollController@index')->middleware('checkIfAdmin');
    Route::get('/current-payroll', 'PayrollController@currentPayroll');
    Route::get('/payroll/{employee}', 'PayrollController@singlePayroll');
    Route::post('/save-payroll', 'PayrollController@savePayroll');
    Route::post('/update-payroll', 'PayrollController@updatePayroll');
    
    //Upalliloi
    Route::get('/employees', 'EmployeesController@index')->middleware('checkIfAdmin');
    Route::get('/get-sellers', 'EmployeesController@sellers')->middleware('checkIfAdmin');
    Route::get('single-employee/{employee}', 'EmployeesController@singleEmployee')->middleware('checkIfAdmin');
    Route::get('/new-employee', 'EmployeesController@create');
    Route::post('/save-new-employee', 'EmployeesController@newEmployee');
    Route::get('/all-employees', 'EmployeesController@all');
    Route::get('/active-employees', 'EmployeesController@activeEmployees');
    Route::get('/employee/customers/{employee}/{month}/{year}', 'EmployeesController@employeesCustomers');
    Route::get('/employee/get-one/{employee}', 'EmployeesController@getOneEmployee');

    //adeies
    Route::post('/save-allowance', 'AllowanceController@save');
    Route::post('/delete-allowance/{allowance}', 'AllowanceController@delete');
    Route::get('/allowance/{employeeId}', 'AllowanceController@all');
    
    // Users
    Route::get('/users', 'UsersController@index')->middleware('checkIfAdmin');
    Route::get('/register-user', 'UsersController@registerUserView')->middleware('checkIfAdmin');
    Route::get('/get-online-users', 'UsersController@onlineUsers');
    Route::get('/get-all-users', 'UsersController@allUsers');
    Route::get('/single-user/{user}', 'UsersController@getUser')->middleware('checkIfAdmin');
    Route::get('/auth-user', 'UsersController@getAuthUser');
    Route::post('/update-user/{user}', 'UsersController@saveUser')->middleware('checkIfAdmin');
    Route::post('/register-new-user', 'UsersController@registerUser')->middleware('checkIfAdmin');

    //Orders
    Route::get('/orders', 'OrderController@index');
    Route::post('/orders', 'OrderController@store');
    Route::get('/get-all-orders', 'OrderController@getAll');

    //Statistika
    Route::get('/statistics', 'Statistics@index')->middleware('checkIfAdmin');
    Route::get('/month-statistics', 'Statistics@monthly')->middleware('checkIfAdmin');
    Route::get('/month-statistics/{month}/{year}', 'Statistics@monthlyOtherMonth')->middleware('checkIfAdmin');
    Route::get('/month-statistics/{month}/{year}/{user}', 'Statistics@monthlyOtherMonthUser')->middleware('checkIfAdmin');
    Route::get('/month-statistics/{month}/{year}/{monthTo}/{yearTo}', 'Statistics@monthlyOtherMonthRanged')->middleware('checkIfAdmin');
    Route::get('/month-statistics/{month}/{year}/{monthTo}/{yearTo}/{user}', 'Statistics@monthlyOtherMonthRangedUser')->middleware('checkIfAdmin');
    Route::get('/month-statistics-outcome/{month}/{year}/{user}', 'Statistics@monthlyOtherMonthOutcome')->middleware('checkIfAdmin');
    Route::get('/month-statistics-outcome/{month}/{year}/{monthTo}/{yearTo}/{user}', 'Statistics@monthlyOtherMonthRangedUser')->middleware('checkIfAdmin');
    Route::get('/year-statistics/{year}', 'Statistics@yearStatistics')->middleware('checkIfAdmin');
    Route::get('/year-statistics/{year}/{user}', 'Statistics@yearStatisticsUser')->middleware('checkIfAdmin');
    Route::get('/year-statistics-outcome/{year}/{user}', 'Statistics@yearStatisticsOutcome')->middleware('checkIfAdmin');
    Route::get('/all-statistics', 'Statistics@allStatistics')->middleware('checkIfAdmin');
    Route::get('/all-statistics/{user}', 'Statistics@allStatisticsUser')->middleware('checkIfAdmin');
    Route::get('/all-statistics-outcome/{user}', 'Statistics@allStatisticsOutcome')->middleware('checkIfAdmin');

    //Search
    Route::get('/single-fund/{searchQuery}', 'FundsController@single');
    Route::get('/single-fund-result/{searchQuery}', 'FundsController@singleResult');

    //Chat
    Route::post('/send-message/{user}', 'NotificationController@send');
    Route::get('/chat-logs/{user}/{receiver}', 'NotificationController@chatLogs');

    //ektupwseis
    Route::get('/print', 'FundsController@prints');
    Route::get('/weekly-print', 'FundsController@weeklyPrints');
    Route::post('/monthly-customers', 'FundsController@weeklyPrintsWithMonth');

    Route::get('/seller-print/{id}', 'FundsController@sellerPrints');
    Route::get('/employers-statistics', 'FundsController@employersStatistics');
    Route::get('/employers-sells', 'StatisticsController@employersStatistics');
    Route::get('/employees-bar/{year}', 'StatisticsController@employersStatisticsBar');
    
    //ekremmotites
    Route::get('/duties', 'DutyController@index');
    Route::get('/all-duties', 'DutyController@all');
    Route::get('/count-duties', 'DutyController@count');
    Route::post('/save-duty', 'DutyController@save');
    Route::post('/complete-duty/{duty}', 'DutyController@complete');
    
});



Auth::routes();

Route::get('/backup-update', 'BackupController@backup');









