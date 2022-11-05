<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\FarmerController;
use App\Http\Controllers\Admin\GlobalController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\DippingController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ParasiteController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\CommunityController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DewormingController;
use App\Http\Controllers\Admin\AnimalInfoController;
use App\Http\Controllers\Admin\BodyWeightController;
use App\Http\Controllers\Admin\DeadCulledController;
use App\Http\Controllers\Admin\VaccinationController;
use App\Http\Controllers\Admin\DistributionController;
use App\Http\Controllers\Admin\MorphometricController;
use App\Http\Controllers\Admin\Report\BirthController;
use App\Http\Controllers\Admin\Report\DeathController;
use App\Http\Controllers\Admin\ReproductionController;
use App\Http\Controllers\Admin\ResearchFarmController;
use App\Http\Controllers\Admin\DiseaseHealthController;
use App\Http\Controllers\Admin\ResearchStockController;
use App\Http\Controllers\Admin\SemenAnalysisController;
use App\Http\Controllers\Admin\CommunityStockController;
use App\Http\Controllers\Admin\MilkProductionController;
use App\Http\Controllers\Admin\MilkCompositionController;
use App\Http\Controllers\Admin\CastrationRecordController;
use App\Http\Controllers\Admin\Category\DiseaseController;
use App\Http\Controllers\Admin\DiseaseTreatmentController;
use App\Http\Controllers\Admin\Report\BlriBirthController;
use App\Http\Controllers\Admin\Report\BlriDeathController;
use App\Http\Controllers\Admin\Category\AnimalCatController;
use App\Http\Controllers\Admin\Report\KidMortalityController;
use App\Http\Controllers\Admin\Report\ServiceReportController;
use App\Http\Controllers\Admin\Category\CommunityCatController;
use App\Http\Controllers\Admin\Report\DewormingReportController;
use App\Http\Controllers\Admin\Report\AnimalInfoReportController;
use App\Http\Controllers\Admin\Report\BlriKidMortalityController;
use App\Http\Controllers\Admin\Report\BodyWeightReportController;
use App\Http\Controllers\Admin\Report\DeadCulledReportController;
use App\Http\Controllers\Admin\Report\DiseaseIncidenceController;
use App\Http\Controllers\Admin\Report\VaccinationReportController;
use App\Http\Controllers\Admin\Report\DistributionReportController;
use App\Http\Controllers\Admin\Report\MorphometricReportController;
use App\Http\Controllers\Admin\Report\ReproductionReportController;
use App\Http\Controllers\Admin\Report\SemenAnalysisReportController;
use App\Http\Controllers\Admin\Report\BlriDiseaseIncidenceController;
use App\Http\Controllers\Admin\Report\MilkProductionReportController;
use App\Http\Controllers\Admin\Report\MilkCompositionReportController;
use App\Http\Controllers\Admin\Report\DiseaseTreatmentReportController;

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

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login-process', [AuthController::class, 'loginProcess'])->name('loginProcess');
// Route::get('/register', [AuthController::class, 'register'])->name('register');
// Route::post('/register-store', [AuthController::class, 'registerStore'])->name('registerStore');
Route::get('/register-verify/{token}', [AuthController::class, 'registerVerify'])->name('registerVerify');
Route::get('/verify-notification', [AuthController::class, 'verifyNotification'])->name('verifyNotification');

Route::post('/verify-resend', [AuthController::class, 'verifyResend'])->name('verifyResend');

Route::get('/forget-password', [AuthController::class, 'forgetPassword'])->name('forgetPassword');
Route::post('/forget-password-process', [AuthController::class, 'forgetPasswordProcess'])->name('forgetPasswordProcess');
Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('resetPassword');
Route::post('/reset-password-process', [AuthController::class, 'resetPasswordProcess'])->name('resetPasswordProcess');
Route::get('/reset-verify-notification', [AuthController::class, 'resetVerifyNotification'])->name('resetVerifyNotification');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth','admin'])->prefix('app')->group(function () {
    // Route::post('/logged_in', [LoginController::class, 'authenticate']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/visitor_info', [DashboardController::class, 'VisitorInfo'])->name('VisitorInfo');

    // Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    // Route::get('/laraDashboard', [AuthController::class, 'laraDashboard'])->name('laraDashboard');

    Route::get('/get-upazila', [GlobalController::class, 'upazila'])->name('get.upazila');
    Route::get('/get-animal-info', [GlobalController::class, 'getAnimalInfo'])->name('get.getAnimalInfo');

    Route::prefix('category')->group(function () {
        Route::resource('/disease', DiseaseController::class);
        Route::post('/clinical-sign', [DiseaseController::class, 'subCatStore'])->name('admin.clinicalSign.subCatStore');
        Route::post('/clinical-sign/update/{id}', [DiseaseController::class, 'subCatUpdate'])->name('admin.clinicalSign.subCatUpdate');
        Route::get('/clinical-sign/delete/{id}', [DiseaseController::class, 'destroyClinicalSign'])->name('admin.clinicalSign.destroyClinicalSign');
    });

    Route::resource('/slider', SliderController::class);
    Route::resource('/about', AboutController::class);
    Route::resource('/notice', NoticeController::class);

    // User Start________________________________________________________________________________________________________________
    Route::resource('/admin-user', AdminUserController::class);
    // Route::post('/admin-user/destroy/{id}', [AdminUserController::class, 'destroy'])->name('admin.destroy');
    Route::post('/admin-user/user-file-store', [AdminUserController::class, 'userFileStore'])->name('admin.userFileStore');
    Route::post('/admin-user/file/destroy/{id}', [AdminUserController::class, 'userFileDestroy'])->name('admin.userFileDestroy');

    Route::resource('/farmer', FarmerController::class);
    Route::post('/farmer/user-file-store', [AdminUserController::class, 'userFileStore'])->name('farmer.userFileStore');
    Route::post('/farmer/file/destroy/{id}', [AdminUserController::class, 'userFileDestroy'])->name('farmer.userFileDestroy');

    Route::resource('/research-farm', ResearchFarmController::class);
    Route::resource('/community-cat', CommunityCatController::class);
    Route::resource('/community', CommunityController::class);

    // Animal Info
    Route::resource('/animal-info', AnimalInfoController::class)->except(['show']);
    Route::controller(AnimalInfoController::class)->prefix('animal_info')->group(function () {
        Route::get('/area', 'area')->name('animalInfo.area');
        Route::get('/index', 'index')->name('animalInfo.index');
        // Route::any('/index', 'index')->name('animalInfo.index');
        Route::get('/get-community', 'getCommunity')->name('animalInfo.getCommunity');
        Route::get('/get-animal-sub-cat', 'getAnimalCat')->name('animalInfo.getAnimalCat');
        Route::get('/download-select', 'downloadSelect')->name('animalInfo.downloadSelect');
        Route::get('/animal-info-excel', 'exportIntoExcel')->name('animalInfo.exportIntoExcel');
        Route::get('/animal-info-pdf', 'exportIntoPdf')->name('animalInfo.exportIntoPdf');
        Route::get('/getAnimalFarm', 'getAnimalFarm')->name('getAnimalFarm');
        Route::get('/getAnimalCommunity', 'getAnimalCommunity')->name('getAnimalCommunity');

        Route::get('/get_animal_farm', 'getFarm')->name('get.animal.farm');
        Route::get('/get_animal_community', 'getCommunity')->name('get.animal.community');
        Route::get('/get_identificationNoFarm', 'identificationNoFarm')->name('get.animal.identificationNoFarm');
        Route::get('/get_identificationNoCom', 'identificationNoCom')->name('get.animal.identificationNoCom');
        Route::get('/get_buffaloIdResearch', 'buffaloIdResearch')->name('get.animal.buffaloIdResearch');
        Route::get('/get_buffaloId', 'buffaloId')->name('get.animal.buffaloId');
        Route::get('/get_buffaloIdUser', 'buffaloIdUser')->name('get.animal.buffaloIdUser');
    });

    // Morphometric
    Route::resource('/morphometric', MorphometricController::class);
    Route::get('/morphometric-excel', [MorphometricController::class, 'exportIntoExcel'])->name('morphometric.exportIntoExcel');
    Route::get('/morphometric-pdf', [MorphometricController::class, 'exportIntoPdf'])->name('morphometric.exportIntoPdf');

    // Milk Production
    Route::resource('/milk-production', MilkProductionController::class);
    Route::delete('/milk-production-destroy-group/{id}', [MilkProductionController::class, 'destroyGroup'])->name('milkProduction.destroyGroup');
    Route::get('/milk-production-excel', [MilkProductionController::class, 'exportIntoExcel'])->name('milkProduction.exportIntoExcel');
    Route::get('/milk-production-pdf', [MilkProductionController::class, 'exportIntoPdf'])->name('milkProduction.exportIntoPdf');

    // Route::get('/get-animal-info-f', [MilkProductionController::class, 'getAnimalInfo'])->name('get.getAnimalInfoF');

    // Route::get('/milk-composition-select', [MilkCompositionController::class, 'select'])->name('milkComposition.select');
    // Route::get('/milk-composition-select/{id}', [MilkCompositionController::class, 'create'])->name('milkComposition.create');
    Route::resource('/milk-composition', MilkCompositionController::class);
    Route::delete('/milk-composition-destroy-group/{id}', [MilkCompositionController::class, 'destroyGroup'])->name('milkComposition.destroyGroup');
    Route::get('/milk-composition-excel', [MilkCompositionController::class, 'exportIntoExcel'])->name('milkComposition.exportIntoExcel');
    Route::get('/milk-composition-pdf', [MilkCompositionController::class, 'exportIntoPdf'])->name('milkComposition.exportIntoPdf');


    Route::get('/get-milk-composition', [MilkCompositionController::class, 'getMilkComposition'])->name('get.getMilkComposition');

    // Semen Analysis
    Route::resource('/semen-analysis', SemenAnalysisController::class);
    Route::get('/semen-analysis-excel', [SemenAnalysisController::class, 'exportIntoExcel'])->name('semenAnalysis.exportIntoExcel');
    Route::get('/semen-analysis-pdf', [SemenAnalysisController::class, 'exportIntoPdf'])->name('semenAnalysis.exportIntoPdf');

    // Distribution
    Route::resource('/distribution', DistributionController::class);
    Route::get('/distribution-excel', [DistributionController::class, 'exportIntoExcel'])->name('distribution.exportIntoExcel');
    Route::get('/distribution-pdf', [DistributionController::class, 'exportIntoPdf'])->name('distribution.exportIntoPdf');


    // Disease Treatment
    Route::resource('/disease-and-treatment', DiseaseTreatmentController::class);
    Route::get('/clinical-sign', [DiseaseTreatmentController::class, 'clinicalSign'])->name('get.clinicalSign');
    Route::get('/disease-and-treatment-excel', [DiseaseTreatmentController::class, 'exportIntoExcel'])->name('diseaseTreatment.exportIntoExcel');
    Route::get('/disease-and-treatment-pdf', [DiseaseTreatmentController::class, 'exportIntoPdf'])->name('diseaseTreatment.exportIntoPdf');

    // Vaccination
    Route::resource('/vaccination', VaccinationController::class);
    Route::get('/vaccination-excel', [VaccinationController::class, 'exportIntoExcel'])->name('vaccination.exportIntoExcel');
    Route::get('/vaccination-pdf', [VaccinationController::class, 'exportIntoPdf'])->name('vaccination.exportIntoPdf');

    // Deworming
    Route::resource('/deworming', DewormingController::class);
    Route::get('/deworming-excel', [DewormingController::class, 'exportIntoExcel'])->name('deworming.exportIntoExcel');
    Route::get('/deworming-pdf', [DewormingController::class, 'exportIntoPdf'])->name('deworming.exportIntoPdf');

    // Dipping
    Route::resource('/dipping', DippingController::class);

    // Parasite
    Route::resource('/parasite', ParasiteController::class);
    Route::get('/parasite-excel', [ParasiteController::class, 'exportIntoExcel'])->name('parasite.exportIntoExcel');
    Route::get('/parasite-pdf', [ParasiteController::class, 'exportIntoPdf'])->name('parasite.exportIntoPdf');


    // Dead Culled
    Route::resource('/dead-culled', DeadCulledController::class);
    Route::get('/dead-culled-excel', [DeadCulledController::class, 'exportIntoExcel'])->name('deadCulled.exportIntoExcel');
    Route::get('/dead-culled-pdf', [DeadCulledController::class, 'exportIntoPdf'])->name('deadCulled.exportIntoPdf');

    // Castration Record
    Route::resource('/castration-record', CastrationRecordController::class);

    // Report
    Route::get('/research/selectDate', [ResearchStockController::class, 'selectDate'])->name('researchStock.selectDate');
    Route::get('/research-stock', [ResearchStockController::class, 'researchStock'])->name('researchStock.report');

    Route::get('/community-stock/selectDate', [CommunityStockController::class, 'selectDate'])->name('communityStock.selectDate');
    Route::get('/community-stock/report', [CommunityStockController::class, 'researchStock'])->name('communityStock.report');


    Route::resource('/animal-cat', AnimalCatController::class);
    Route::get('/get-animal-cat', [AnimalCatController::class, 'getAnimalCat'])->name('getAnimalCat');
    Route::post('animal-sub-cat/store', [AnimalCatController::class, 'SubCatStore'])->name('animalCat.SubCatStore');
    Route::get('animal-sub-sub-cat/{id}', [AnimalCatController::class, 'subEdit'])->name('animalCat.subEdit');
    Route::post('animal-sub-sub-cat/{id}', [AnimalCatController::class, 'subUpdate'])->name('animalCat.subUpdate');

    Route::resource('/body-weight', BodyWeightController::class);
    Route::get('/get-body-weight', [BodyWeightController::class, 'getBodyWeight'])->name('get.bodyWeight');
    Route::get('/body-weight-excel', [BodyWeightController::class, 'exportIntoExcel'])->name('bodyWeight.exportIntoExcel');
    Route::get('/body-weight-pdf', [BodyWeightController::class, 'exportIntoPdf'])->name('bodyWeight.exportIntoPdf');


    Route::resource('/reproduction-record', ReproductionController::class);
    Route::get('/reproduction-excel', [ReproductionController::class, 'exportIntoExcel'])->name('reproduction.exportIntoExcel');
    Route::get('/reproduction-pdf', [ReproductionController::class, 'exportIntoPdf'])->name('reproduction.exportIntoPdf');

    Route::resource('/service', ServiceController::class);
    Route::get('/service-excel', [ServiceController::class, 'exportIntoExcel'])->name('service.exportIntoExcel');
    Route::get('/service-pdf', [ServiceController::class, 'exportIntoPdf'])->name('service.exportIntoPdf');

    Route::resource('/disease-and-health', DiseaseHealthController::class);

    Route::prefix('report')->group(function () {
        Route::controller(AnimalInfoReportController::class)->prefix('animal-info')->name('report.animalInfo.')->group(function () {
            Route::get('select', 'select')->name('select');
            Route::get('report', 'report')->name('report');
            Route::get('excel-export/{farmId}/{community_cat_id}', 'excel')->name('excel');
            Route::get('pdf-export/{farmId}/{community_cat_id}', 'pdf')->name('pdf');
        });
        Route::controller(MorphometricReportController::class)->prefix('morphometric')->name('report.morphometric.')->group(function () {
            Route::get('select', 'select')->name('select');
            Route::get('report', 'report')->name('report');
            Route::get('excel-export/{farmId}/{community_cat_id}', 'excel')->name('excel');
            Route::get('pdf-export/{farmId}/{community_cat_id}', 'pdf')->name('pdf');
        });
        Route::controller(BodyWeightReportController::class)->prefix('body-weight')->name('report.bodyWeight.')->group(function () {
            Route::get('select', 'select')->name('select');
            Route::get('report', 'report')->name('report');
            Route::get('excel-export/{farmId}/{community_cat_id}', 'excel')->name('excel');
            Route::get('pdf-export/{farmId}/{community_cat_id}', 'pdf')->name('pdf');
        });
        Route::controller(ReproductionReportController::class)->prefix('reproduction')->name('report.reproduction.')->group(function () {
            Route::get('select', 'select')->name('select');
            Route::get('report', 'report')->name('report');
            Route::get('excel-export/{farmId}/{community_cat_id}', 'excel')->name('excel');
            Route::get('pdf-export/{farmId}/{community_cat_id}', 'pdf')->name('pdf');
        });
        Route::controller(MilkProductionReportController::class)->prefix('milk-production')->name('report.milkProduction.')->group(function () {
            Route::get('select', 'select')->name('select');
            Route::get('report', 'report')->name('report');
            Route::get('excel-export/{farmId}/{community_cat_id}', 'excel')->name('excel');
            Route::get('pdf-export/{farmId}/{community_cat_id}', 'pdf')->name('pdf');
        });
        Route::controller(MilkCompositionReportController::class)->prefix('milk-composition')->name('report.milkComposition.')->group(function () {
            Route::get('select', 'select')->name('select');
            Route::get('report', 'report')->name('report');
            Route::get('excel-export/{farmId}/{community_cat_id}', 'excel')->name('excel');
            Route::get('pdf-export/{farmId}/{community_cat_id}', 'pdf')->name('pdf');
        });
        Route::controller(SemenAnalysisReportController::class)->prefix('semen-analysis')->name('report.semenAnalysis.')->group(function () {
            Route::get('select', 'select')->name('select');
            Route::get('report', 'report')->name('report');
            Route::get('excel-export/{farmId}/{community_cat_id}', 'excel')->name('excel');
            Route::get('pdf-export/{farmId}/{community_cat_id}', 'pdf')->name('pdf');
        });
        Route::controller(ServiceReportController::class)->prefix('service')->name('report.service.')->group(function () {
            Route::get('select', 'select')->name('select');
            Route::get('report', 'report')->name('report');
            Route::get('excel-export/{farmId}/{community_cat_id}', 'excel')->name('excel');
            Route::get('pdf-export/{farmId}/{community_cat_id}', 'pdf')->name('pdf');
        });
        Route::controller(DistributionReportController::class)->prefix('distribution')->name('report.distribution.')->group(function () {
            Route::get('select', 'select')->name('select');
            Route::get('report', 'report')->name('report');
            Route::get('excel-export/{farmId}/{community_cat_id}', 'excel')->name('excel');
            Route::get('pdf-export/{farmId}/{community_cat_id}', 'pdf')->name('pdf');
        });
        Route::controller(DeadCulledReportController::class)->prefix('dead-culled')->name('report.deadCulled.')->group(function () {
            Route::get('select', 'select')->name('select');
            Route::get('report', 'report')->name('report');
            Route::get('excel-export/{farmId}/{community_cat_id}', 'excel')->name('excel');
            Route::get('pdf-export/{farmId}/{community_cat_id}', 'pdf')->name('pdf');
        });
        Route::controller(DiseaseTreatmentReportController::class)->prefix('disease-treatment')->name('report.diseaseTreatment.')->group(function () {
            Route::get('select', 'select')->name('select');
            Route::get('report', 'report')->name('report');
            Route::get('excel-export/{farmId}/{community_cat_id}', 'excel')->name('excel');
            Route::get('pdf-export/{farmId}/{community_cat_id}', 'pdf')->name('pdf');
        });
        Route::controller(VaccinationReportController::class)->prefix('vaccination')->name('report.vaccination.')->group(function () {
            Route::get('select', 'select')->name('select');
            Route::get('report', 'report')->name('report');
            Route::get('excel-export/{farmId}/{community_cat_id}', 'excel')->name('excel');
            Route::get('pdf-export/{farmId}/{community_cat_id}', 'pdf')->name('pdf');
        });
        Route::controller(DewormingReportController::class)->prefix('deworming')->name('report.deworming.')->group(function () {
            Route::get('select', 'select')->name('select');
            Route::get('report', 'report')->name('report');
            Route::get('excel-export/{farmId}/{community_cat_id}', 'excel')->name('excel');
            Route::get('pdf-export/{farmId}/{community_cat_id}', 'pdf')->name('pdf');
        });


        Route::prefix('blri')->group(function () {
            Route::prefix('disease-incidence')->group(function () {
                Route::get('/select', [BlriDiseaseIncidenceController::class, 'selectDate'])->name('report.blri.disease.selectDate');
                Route::post('/report', [BlriDiseaseIncidenceController::class, 'report'])->name('report.blri.disease.report');
            });
            Route::prefix('birth')->group(function () {
                Route::get('/select', [BlriBirthController::class, 'selectDate'])->name('report.blri.bitrh.selectDate');
                Route::post('/report', [BlriBirthController::class, 'report'])->name('report.blri.bitrh.report');
            });

            Route::prefix('death')->group(function () {
                Route::get('/select', [BlriDeathController::class, 'selectDate'])->name('report.blri.death.selectDate');
                Route::post('/report', [BlriDeathController::class, 'report'])->name('report.blri.death.report');
            });

            Route::prefix('kid-mortality')->group(function () {
                Route::get('/select', [BlriKidMortalityController::class, 'selectDate'])->name('report.blri.kidMortality.selectDate');
                Route::post('/report', [BlriKidMortalityController::class, 'report'])->name('report.blri.kidMortality.report');
            });
        });

        Route::prefix('community')->group(function () {
            Route::prefix('disease-incidence')->group(function () {
                Route::get('/select', [DiseaseIncidenceController::class, 'selectDate'])->name('report.disease.selectDate');
                Route::post('/report', [DiseaseIncidenceController::class, 'report'])->name('report.disease.report');
            });
            Route::prefix('birth')->group(function () {
                Route::get('/select', [BirthController::class, 'selectDate'])->name('report.bitrh.selectDate');
                Route::post('/report', [BirthController::class, 'report'])->name('report.bitrh.report');
            });

            Route::prefix('death')->group(function () {
                Route::get('/select', [DeathController::class, 'selectDate'])->name('report.death.selectDate');
                Route::post('/report', [DeathController::class, 'report'])->name('report.death.report');
            });

            Route::prefix('kid-mortality')->group(function () {
                Route::get('/select', [KidMortalityController::class, 'selectDate'])->name('report.kidMortality.selectDate');
                Route::post('/report', [KidMortalityController::class, 'report'])->name('report.kidMortality.report');
            });
        });
    });

    Route::get('/tag-no-research', [GlobalController::class, 'tagNoResearch'])->name('get.tagNoResearch');
    Route::get('/tattoo-no-research', [GlobalController::class, 'tattooNoResearch'])->name('get.tattooNoResearch');

    Route::get('/tag-no', [GlobalController::class, 'tagNo'])->name('get.tagNo');
    Route::get('/tattoo-no', [GlobalController::class, 'tattooNo'])->name('get.tattooNo');
    Route::get('/animal-male', [GlobalController::class, 'animalMale'])->name('get.animalM');
    Route::get('/animal-female', [GlobalController::class, 'animalFemale'])->name('get.animalF');
    Route::get('/animal-sub-cat', [GlobalController::class, 'animalSubCat'])->name('animalSubCat');
    Route::get('/get-community', [GlobalController::class, 'community'])->name('get.community');
    Route::get('/get-subFarm', [GlobalController::class, 'subFarm'])->name('get.subFarm');
});


Route::get('/', 'App\Http\Controllers\Frontend\IndexController@index')->name('index');
Route::get('/notice/{id}', 'App\Http\Controllers\Frontend\IndexController@notice')->name('notice');

?>
