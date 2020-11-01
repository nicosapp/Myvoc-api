<?php

namespace App\Http\Controllers\Tags;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Tags\TagResource;

class TagController extends Controller
{
  public function index(Request $request)
  {
    return TagResource::collection(
      $request->user()->tags()->orderBy('name', 'asc')->get()
    );
  }

  public function show(Tag $tag)
  {
    //authorize

    return new TagResource($tag);
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'name' => 'string|min:2',
    ]);

    $tag = $request->user()->tags()->create($request->only('name'));
    return new TagResource($tag);
  }

  public function update(Request $request, Tag $tag)
  {
    //authorize

    $this->validate($request, [
      'name' => 'string|min:2',
    ]);

    $tag->update($request->only('name'));
    return new TagResource($tag);
  }

  public function destroy(Tag $tag)
  {
    //authorize

    $tag->delete();
  }
}
