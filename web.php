<?php 
use ValahIvanMaulana\App\Controller\admin\AdminAuthController;
use ValahIvanMaulana\App\Controller\admin\DashboardController;
use ValahIvanMaulana\App\Controller\admin\GroupController;
use ValahIvanMaulana\App\Controller\admin\JawabanController;
use ValahIvanMaulana\App\Controller\admin\ResultController;
use ValahIvanMaulana\App\Controller\admin\SetQuisController;
use ValahIvanMaulana\App\Controller\admin\SoalController;
use ValahIvanMaulana\App\Controller\admin\SoalJawabanController;
use ValahIvanMaulana\App\Controller\admin\TokenController;
use ValahIvanMaulana\App\Controller\admin\TopikController;
use ValahIvanMaulana\App\Controller\admin\UploadController;
use ValahIvanMaulana\App\Controller\admin\UserController;
use ValahIvanMaulana\App\Controller\user\AuthController;
use ValahIvanMaulana\App\Controller\user\QuizController;
use ValahIvanMaulana\App\Controller\user\StartQuizController;
use ValahIvanMaulana\Core\Router;

Router::get('/login-page', [AuthController::class, 'loginPage']);
Router::post('/login', [AuthController::class, 'loginData']);
Router::get('/register-page',[ AuthController::class, 'registerPage']);
Router::post('/register', [AuthController::class, 'registerData']);
Router::post('/logout', [AuthController::class, 'logingOut']);

Router::get('/list-quis-page', [QuizController::class, 'listQuisPage']);
Router::get('/list-quis?params', [QuizController::class, 'listQuis']);
Router::post('/check-token', [QuizController::class, 'checkToken']);

Router::get('/start-quis-page?params', [StartQuizController::class, 'startQuisPage']);
Router::get('/start-quis?params', [StartQuizController::class, 'startQuis']);
Router::post('/check-option?params', [StartQuizController::class, 'checkOption']);
Router::post('/stop-quis?params', [StartQuizController::class, 'stopQuis']);
Router::get('/update-time?params', [StartQuizController::class, 'updateTime']);

Router::get('/admin/login-admin-page', [AdminAuthController::class, 'loginAdminPage']);
Router::post('/admin/login-admin', [AdminAuthController::class, 'loginAdmin']);
Router::put('/admin/change-password?id', [AdminAuthController::class, 'changePassword']);
Router::post('/admin/logout-admin', [AdminAuthController::class, 'logoutAdmin']);
Router::get('/admin/dashboard', [DashboardController::class, 'dashboard']);
Router::get('/admin/count-tables', [DashboardController::class, 'countDataTables']);

Router::get('/admin/user-page', [UserController::class, 'userPage']);
Router::get('/admin/list-user', [UserController::class, 'listUser']);
Router::get('/admin/print-card-page', [UserController::class, 'printCardPage']);
Router::post('/admin/preview-card', [UserController::class, 'previewCard']);
Router::post('/admin/destroys-user', [UserController::class, 'destroysUser']);
Router::post('/admin/store-user', [UserController::class, 'storeUser']);

Router::get('/admin/group-page', [GroupController::class, 'groupPage']);
Router::get('/admin/list-group', [GroupController::class, 'listGroup']);
Router::post('/admin/store-group', [GroupController::class, 'storeGroup']);
Router::put('/admin/update-group?id', [GroupController::class, 'updateGroup']);
Router::delete('/admin/destroy-group?id', [GroupController::class, 'destroyGroup']);

Router::get('/admin/topik-page', [TopikController::class, 'topikPage']);
Router::get('/admin/list-topik', [TopikController::class, 'listTopik']);
Router::post('/admin/add-topik', [TopikController::class, 'addTopik']);
Router::put('/admin/update-topik?id', [TopikController::class, 'updateTopik']);
Router::delete('/admin/destroy-topik?id', [TopikController::class, 'destroyTopik']);

Router::get('/admin/result-page', [ResultController::class, 'resultPage']);
Router::get('/admin/list-result', [ResultController::class, 'listResult']);
Router::get('/admin/detail-page?params', [ResultController::class, 'detailPage']);
Router::get('/admin/print-page?params', [ResultController::class, 'printPage']);
Router::get('/admin/detail-chart?params', [ResultController::class, 'detailChart']);
Router::get('/admin/export-pdf?params', [ResultController::class, 'exportPDF']);
Router::post('/admin/destroys-result', [ResultController::class, 'destroysResult']);

Router::get('/admin/setquis-page', [SetQuisController::class, 'setQuisPage']);
Router::get('/admin/list-setquis', [SetQuisController::class, 'listSetQuis']);
Router::get('/admin/add-quis-page', [SetQuisController::class, 'addQuisPage']);
Router::post('/admin/store-quis', [SetQuisController::class, 'storeQuis']);
Router::get('/admin/edit-quis-page?id=', [SetQuisController::class, 'editQuisPage']);
Router::put('/admin/update-quis?id=', [SetQuisController::class, 'updateQuis']);
Router::delete('/admin/destroy-quis?id=', [SetQuisController::class, 'destroyQuis']);

Router::get('/admin/token-page', [TokenController::class, 'tokenPage']);
Router::post('/admin/store-token', [TokenController::class, 'storeToken']);
Router::get('/admin/list-token', [TokenController::class, 'listToken']);

Router::get('/admin/soal-page', [SoalController::class, 'soalPage']);
Router::get('/admin/list-soal', [SoalController::class, 'listSoal']);
Router::post('/admin/store-soal', [SoalController::class, 'storeSoal']);
Router::get('/admin/edit-soal?id=', [SoalController::class, 'editSoal']);
Router::put('/admin/update-soal?id=', [SoalController::class, 'updateSoal']);
Router::delete('/admin/destroy-soal?id=', [SoalController::class, 'destroySoal']);

Router::get('/admin/import-soal-page', [SoalJawabanController::class, 'importSoalPage']);
Router::get('/admin/download-file-word?params', [SoalJawabanController::class, 'downloadFormWord']);
Router::post('/admin/import-soal', [SoalJawabanController::class, 'importSoal']);

Router::get('/admin/jawaban-page?id=', [JawabanController::class, 'jawabanPage']);
Router::get('/admin/list-jawaban?id=', [JawabanController::class, 'listJawaban']);
Router::post('/admin/store-jawaban', [JawabanController::class, 'storeJawaban']);
Router::get('/admin/edit-jawaban?params', [JawabanController::class, 'editJawaban']);
Router::put('/admin/update-jawaban?id=', [JawabanController::class, 'updateJawaban']);
Router::delete('/admin/destroy-jawaban?id=', [JawabanController::class, 'destroyJawaban']);

Router::post('/admin/upload-image', [UploadController::class, 'uploadImage']);
Router::post('/admin/upload-image-word', [UploadController::class, 'uploadImageWord']);

// Running router
Router::run();