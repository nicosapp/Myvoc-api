<?php

namespace App\Models;

use App\Models\User;
use App\Models\Term;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'order', 'parent_id', 'user_id'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function children()
  {
    return $this->hasMany(Category::class, 'parent_id', 'id'); //foreign key, primary key
  }

  public function terms()
  {
    return $this->belongsToMany(
      Term::class,
      'category_term',
      'category_id',
      'term_id',
    );
  }

  public function scopeParents(Builder $builder)
  {
    $builder->whereNull('parent_id');
  }

  public function scopeOrdered(Builder $builder, $direction = 'asc')
  {
    $builder->orderBy('order', $direction);
  }
}

// INSERT INTO categories(user_id, id, `order`, name, dep) SELECT 8, id, ordre, nom, dep FROM categorie

// INSERT INTO temp_categories(id, parent_id) SELECT a.id, b.id FROM categories a, categories b where FIND_IN_SET(a.id, b.dep)>0 group by a.id

// UPDATE categories a, temp_categories b SET a.parent_id = b.parent_id WHERE a.id = b.id
