<?php
Route::get('pagenotfound', ['as' => 'notfound', 'uses' => 'AdminController@pagenotfound']);
Route::get('admin/login', 'AdminController@login')->name('admin.login');
Route::post('admin/dang-nhap', 'AdminController@dangnhap')->name('admin.loginpost');
Route::group(['prefix' => 'admin', 'middleware' => 'Admin'], function () {
  //User
  Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard.index');
  //Category

      Route::get('category', 'CategoryController@index')->name('admin.categoryPro.index');
      Route::get('category-get', 'CategoryController@show')->name('admin.categoryGet.index');
      Route::post('add-category', 'CategoryController@add')->name('admin.categoryAdd.index');
  
  //Category-Pro

  //Category-Blog
});
?>
