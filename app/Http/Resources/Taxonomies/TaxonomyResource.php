<?php

namespace App\Http\Resources\Taxonomies;

use Illuminate\Http\Resources\Json\JsonResource;

class TaxonomyResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'taxonomy' => $this->taxonomy,
      'name' => $this->name,
      'order' => $this->order,
      'user_id' => $this->user_id,
      'terms_count' => $this->terms()->count(),
    ];
  }
}
