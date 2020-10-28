<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Http\Resources\Categories\CategoryLightResource;
use App\Http\Resources\Categories\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  public function index(Request $request)
  {
    if ($request->get('nested', null)) {
      return CategoryResource::collection(
        $request->user()->categories()->parents()->ordered()->get()
      );
    }
    return CategoryLightResource::collection(
      $request->user()->categories()->get()
    );
  }


  public function show()
  {
    dd('show');
  }

  public function store()
  {
    dd('store');
  }

  public function update()
  {
    dd('update');
  }

  public function destroy()
  {
    dd('destroy');
  }
}
