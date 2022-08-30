<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\PartiesController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\WarehouseTransferController;
use App\Http\Controllers\Product\ProductUnitController;
use App\Http\Controllers\Product\ProductBrandController;
use App\Http\Controllers\Product\ProductCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!

*/

Route::get('/', function () {
    return view('auth.login');
});
Route::group(['middleware' => 'auth'],function(){
    Route::get('/user-dashboard', [AdminController::class, 'userDashboard'])->name('user.dashboard');
});
Route::group(['middleware' =>'admin.redirect'],function(){
Route::get('/admin/login',[LoginController::class,'showLoginForm'])->name('admin.login.view');
Route::Post('/admin/login/submit',[LoginController::class,'login'])->name('admin.login.submit');
});
// Route::view('/dashboard','home')->middleware('auth');
Route::group(['middleware' => 'admin'],function(){



Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard.view');
Route::post('/logout/submit',[LoginController::class,'logout'])->name('admin.logout.submit');
Route::get('/profiles', [AdminController::class, 'Profile'])->name('profile');
//party route

Route::get('/party-type',[PartyController::class,'partyTypeIndex'])->name('partytype.index');
Route::post('partytype-create',[PartyController::class,'partyTypeCreate'])->name('party.type.create');
Route::get('partytype-edit/{id}',[PartyController::class,'partyTypeEdit'])->name('partytype.edit');
Route::post('partytype-update/{id}',[PartyController::class,'partyTypeUpdate'])->name('partytype.update');
Route::get('parttype-inactive',[PartyController::class,'partyTypeInactive'])->name('partytype.inactive');
Route::get('reactive/{id}',[PartyController::class,'partyTypeReactive'])->name('partytype.reactive');
Route::get('temporary-delete/{id}',[PartyController::class,'partyTypeTemporaryDelete'])->name('partytype.temporary.delete');
Route::get('partytype-trash',[PartyController::class,'partyTypeTrash'])->name('partytype.trash');
Route::get('partytype-restore/{id}',[PartyController::class,'partyTypeRestore'])->name('partytype.restore');
Route::get('partytype-permanently-delete/{id}',[PartyController::class,'PartyTypePermanentlyDelete'])->name('partytype.permanently.delete');

//Party Route
Route::get('parties/view/{type}',[PartiesController::class,'index'])->name('parties.index');
Route::post('/parties-create',[PartiesController::class,'store'])->name('parties.store');
Route::get('/parties-singleview/{id}',[PartiesController::class,'show'])->name('parties.show');
Route::get('/parties-edit/{id}',[PartiesController::class,'edit'])->name('parties.edit');
Route::post('/parties-update/{id}',[PartiesController::class,'update'])->name('parties.update');
Route::get('/parties-temporary-delete/{id}',[PartiesController::class,'delete'])->name('parties.temporary.delete');
Route::get('/parties-restore/{id}',[PartiesController::class,'restore'])->name('parties.restore');




// Route::get('party-edit/{id}',[PartyController::class,'partyEdit'])->name('party.edit');
// Route::post('party-update/{id}',[PartyController::class,'partyUpdate'])->name('party.update');
// Route::get('party-inactive',[PartyController::class,'partyInactive'])->name('party.inactive');
// Route::get('party-reactive/{id}',[PartyController::class,'partyReactive'])->name('party.reactive');
// Route::get('party-temporary-delete/{id}',[PartyController::class,'partyTemporaryDelete'])->name('party.temporary.delete');
// Route::get('party-trash',[PartyController::class,'partyTrash'])->name('party.trash');
// Route::get('party-restore/{id}',[PartyController::class,'partyRestore'])->name('party.restore');
// Route::get('party-permanently-delete/{id}',[PartyController::class,'PartyPermanentlyDelete'])->name('party.permanently.delete');
//Recycle Bin route
Route::get('recycle-bin',[PartyController::class,'recycleBin'])->name('recycle.bin');

//roles controller
Route::resource('roles', RolesController::class);
//admins route
Route::resource('admins',AdminsController::class);

//permissions route
Route::get('permissions',[RolesController::class,'permissionIndex'])->name('permission.index');
Route::get('permissions/create',[RolesController::class,'permissionCreate'])->name('permission.create');

Route::post('permission/store',[RolesController::class,'permissionStore'])->name('permission.store');
Route::get('permissions/edit/{id}',[RolesController::class,'permissionEdit'])->name('permission.edit');
Route::post('permissions/update/{id}',[RolesController::class,'permissionUpdate'])->name('permission.update');
Route::delete('permission/delete/{id}',[RolesController::class,'permissionDestroy'])->name('permission.destroy');

//product unit
Route::get('product-unit',[ProductUnitController::class,'index'])->name('product.unit.index');
Route::post('product-unit/create',[ProductUnitController::class,'store'])->name('product.unit.store');
Route::get('product-unit/edit/{id}',[ProductUnitController::class,'edit'])->name('product.unit.edit');
Route::post('product-unit/update/{id}',[ProductUnitController::class,'update'])->name('product.unit.update');
Route::get('product-unit-temporary-delete/{id}',[ProductUnitController::class,'destroy'])->name('product.unit.temporaryDelete');

//product category
Route::get('product-category',[ProductCategoryController::class,'index'])->name('product.category.index');
Route::post('product-category/create',[ProductCategoryController::class,'store'])->name('product.category.store');
Route::get('product-category/edit/{id}',[ProductCategoryController::class,'edit'])->name('product.category.edit');
Route::post('product-category/update/{id}',[ProductCategoryController::class,'update'])->name('product.category.update');
Route::get('product-category-temporary-delete/{id}',[ProductCategoryController::class,'destroy'])->name('product.category.temporaryDelete');
//product brand
Route::get('product-brand',[ProductBrandController::class,'index'])->name('product.brand.index');
Route::post('product-brand/create',[ProductBrandController::class,'store'])->name('product.brand.store');
Route::get('product-brand/edit/{id}',[ProductBrandController::class,'edit'])->name('product.brand.edit');
Route::post('product-brand/update/{id}',[ProductBrandController::class,'update'])->name('product.brand.update');
Route::get('product-brand-temporary-delete/{id}',[ProductBrandController::class,'destroy'])->name('product.brand.temporaryDelete');

//product route
Route::get('product',[ProductController::class,'index'])->name('product.index');
Route::post('product/create',[ProductController::class,'store'])->name('product.store');
Route::get('product/edit/{id}',[ProductController::class,'edit'])->name('product.edit');
Route::post('product/update/{id}',[ProductController::class,'update'])->name('product.update');
Route::get('product-temporary-delete/{id}',[ProductController::class,'destroy'])->name('product.temporaryDelete');
Route::get('product-restore/{id}',[ProductController::class,'productRestore'])->name('product.restore');
Route::get('product-permanently-delete/{id}',[ProductController::class,'productPermanentlyDelete'])->name('product.permanently.delete');

//warehouse route
Route::get('warehouse',[WarehouseController::class,'index'])->name('warehouse.index');
Route::post('warehouse/create',[WarehouseController::class,'store'])->name('warehouse.store');
Route::get('warehouse/edit/{id}',[WarehouseController::class,'edit'])->name('warehouse.edit');
Route::post('warehouse/update/{id}',[WarehouseController::class,'update'])->name('warehouse.update');
Route::get('warehouse-temporary-delete/{id}',[WarehouseController::class,'destroy'])->name('warehouse.temporaryDelete');
//warehouse transfer route
Route::get('warehouse-transfer',[WarehouseTransferController::class,'index'])->name('warehouse.transfer.index');
Route::post('warehouse-transfer/create',[WarehouseTransferController::class,'store'])->name('warehouse.transfer.store');
// Route::post('warehouse-transfer/create',[WarehouseTransferController::class,'store'])->name('warehouse.store');
Route::get('findcurrentstock',[WarehouseTransferController::class,'findCurrentStock'])->name('find.product.current.stock');
Route::get('currentwarehouse',[WarehouseTransferController::class,'currentWarehouse'])->name('current.warehouse');

Route::get('warehouse-transfer/edit/{id}',[WarehouseTransferController::class,'edit'])->name('warehouse.transfer.edit');
Route::post('warehouse-transfer/update/{id}',[WarehouseTransferController::class,'update'])->name('warehouse.transfer.update');



});
