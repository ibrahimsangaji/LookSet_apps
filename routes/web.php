<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\RackController;
use App\Http\Controllers\SoftwareController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware(['guest'])->group(function() {
    Route::get('/', [SesiController::class, 'index'])->name('login');
    Route::post('/', [SesiController::class, 'login']);
});

Route::get('home',function() {
    return redirect('/welcome');
    Route::get('/error',[SesiController::class, 'error'])->name('error');
});

Route::middleware(['auth'])->group(function() {
    Route::get('welcome',[AdminController::class, 'index']);
    Route::get('logout',[SesiController::class, 'logout']);
    Route::get('error',[SesiController::class, 'error'])->name('error');
    Route::post('/mark-all-as-read', [AdminController::class, 'markAllAsRead'])->name('mark-all-as-read');

    Route::get('welcome/admin',[AdminController::class, 'admin'])->middleware('userAccess:admin');
    Route::get('welcome/staff',[AdminController::class, 'staff'])->middleware('userAccess:staff');
    Route::get('welcome/supervisor',[AdminController::class, 'supervisor'])->middleware('userAccess:supervisor');

    Route::get('catalog',[AdminController::class, 'catalog']);
    // User
    Route::get('catalog/user', [UserController::class, 'index'])->name('user.index');
    Route::get('user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('user', [UserController::class, 'store'])->name('user.store');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('user.delete');

    // Device
    Route::get('catalog/device', [DeviceController::class, 'index'])->name('device.index');
    Route::get('device/create', [DeviceController::class, 'create'])->name('device.create');
    Route::post('device', [DeviceController::class, 'store'])->name('device.store');
    Route::get('devices/{device}/edit', [DeviceController::class, 'edit'])->name('device.edit');
    Route::put('devices/{device}', [DeviceController::class, 'update'])->name('device.update');
    Route::delete('devices/{device}', [DeviceController::class, 'destroy'])->name('device.delete');

    // Location
    Route::get('catalog/location', [LocationController::class, 'index'])->name('location.index');
    Route::get('location/create', [LocationController::class, 'create'])->name('location.create');
    Route::post('location', [LocationController::class, 'store'])->name('location.store');
    Route::get('locations/{location}/edit', [LocationController::class, 'edit'])->name('location.edit');
    Route::put('locations/{location}', [LocationController::class, 'update'])->name('location.update');
    Route::delete('locations/{location}', [LocationController::class, 'destroy'])->name('location.delete');

    // Rack
    Route::get('catalog/rack', [RackController::class, 'index'])->name('rack.index');
    Route::get('rack/create', [RackController::class, 'create'])->name('rack.create');
    Route::post('rack', [RackController::class, 'store'])->name('rack.store');
    Route::get('racks/{rack}/edit', [RackController::class, 'edit'])->name('rack.edit');
    Route::put('racks/{rack}', [RackController::class, 'update'])->name('rack.update');
    Route::delete('racks/{rack}', [RackController::class, 'destroy'])->name('rack.delete');

    // Software
    Route::get('catalog/software', [SoftwareController::class, 'index'])->name('software.index');
    Route::get('software/create', [SoftwareController::class, 'create'])->name('software.create');
    Route::post('software', [SoftwareController::class, 'store'])->name('software.store');
    Route::get('softwares/{software}/edit', [SoftwareController::class, 'edit'])->name('software.edit');
    Route::put('softwares/{software}', [SoftwareController::class, 'update'])->name('software.update');
    Route::delete('softwares/{software}', [SoftwareController::class, 'destroy'])->name('software.delete');

    Route::get('assets',[AdminController::class, 'assets']);
    Route::get('assets/delete',[AdminController::class, 'deleteAssets'])->name('asset.deleteView');
    Route::get('assets/{id}/edit',[AdminController::class, 'editAssets'])->name('asset.edit');
    Route::put('assets/{id}',[AdminController::class, 'editAsset'])->name('asset.update');
    Route::delete('assets/{asset}', [AdminController::class, 'delete'])->name('asset.delete');

    Route::get('inventorys',[AdminController::class, 'inventorys']);

    Route::get('locations',[AdminController::class, 'locations']);
    Route::get('locations/{location}/detail',[AdminController::class, 'detailLocations'])->name('locations.index');
    Route::get('locations/{location}/update',[AdminController::class, 'updateLocations'])->name('locations.detail');
    Route::get('locations/{location}/{id}/edit',[AdminController::class, 'editLocations'])->name('locations.edit');
    Route::put('locations/{location}/{id}',[AdminController::class, 'editLocation'])->name('locations.update');
    Route::get('locations/{location}/{id}/information',[AdminController::class, 'detailInformation'])->name('locations.view');

    Route::get('inbounds', [AdminController::class, 'inbound'])->name('inbound.index');
    Route::post('inbound', [AsetController::class, 'inbound'])->name('inbound.process');
    Route::get('returns', [AdminController::class, 'return'])->name('return.index');
    Route::post('return', [AsetController::class, 'return'])->name('return.process');
    Route::post('getDetailsReturn', [AsetController::class, 'getDetailsReturn'])->name('getDetailsReturn');

    Route::get('documents', [DocumentController::class, 'showDocuments'])->name('documents.index');
    Route::get('documents/{document}/detail', [DocumentController::class, 'detailDocuments'])->name('documents.detail');
    Route::get('print', [DocumentController::class, 'printPDF']);
    Route::get('download/{id}', [DocumentController::class, 'downloadPDF'])->name('download');

    Route::get('approvals', [ApprovalController::class, 'index'])->name('approval.index');
    Route::post('approval/process/{type}/{id}', [ApprovalController::class, 'process'])->name('approval.process');
    Route::get('approval/{id}/detailInbound', [ApprovalController::class, 'inboundDocumentDetails'])->name('approval.detailInbound');
    Route::get('approval/{id}/detailOutbound', [ApprovalController::class, 'outboundDocumentDetails'])->name('approval.detailOutbound');

    Route::get('outbounds', [AdminController::class, 'outbound'])->name('outbound.index');
    Route::post('outbound', [AsetController::class, 'outbound'])->name('outbound.process');
    Route::post('getDetailsOutbound', [AsetController::class, 'getDetailsOutbound'])->name('getDetailsOutbound');
});

