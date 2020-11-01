<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Http\Resources\Categories\CategoryLightResource;
use App\Http\Resources\Categories\CategoryResource;
use App\Models\Category;
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


  public function show(Category $category)
  {
    //authorize

    return new CategoryResource($category);
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'name' => 'string|min:2',
    ]);

    $tag = $request->user()->categories()->create($request->only('name'));
    return new CategoryResource($tag);
  }

  public function update(Request $request, Category $category)
  {
    //authorize

    $this->validate($request, [
      'name' => 'string|min:2',
    ]);

    $category->update($request->only('name'));
    return new CategoryResource($category);
  }

  public function bulkUpdate(Request $request)
  {
    $categories = $request->input('categories');
    // dd($categories);
    $this->validate($request, [
      'categories.*.name' => 'required|max:255',
      'categories.*.order' => 'integer|nullable',
      'categories.*.parent_id' => 'integer|nullable'
    ]);

    foreach ($categories as $d) {
      extract($d);
      $category = Category::where('id', $id)->first();

      // $this->authorize('update', $category);

      $category->update([
        'order' => $order,
        'parent_id' => $parent_id,
        'name' => $name
      ]);
    }
  }

  public function destroy(Category $category)
  {
    //authorize

    $category->delete();
  }
}
