<?php

namespace App\Models;

use App\Models\TaxonomyMeta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Taxonomy extends Model
{
  use HasFactory;

  protected $fillable = ['taxonomy', 'name', 'order'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function terms()
  {
    return $this->belongsToMany(
      Term::class,
      'taxonomy_term',
      'taxonomy_id',
      'term_id',
    );
  }
  public function meta()
  {
    return $this->hasMany(TaxonomyMeta::class);
  }
}

//INSERT into taxonomies(user_id, taxonomy, name, updated_at, created_at) select user_id, 'grammar', name, updated_at, created_at from grammars;
// INSERT into taxonomies(user_id, taxonomy, name, updated_at, created_at) select user_id, 'tag', name, updated_at, created_at from tags;

// INSERT into taxonomies(user_id, taxonomy, name) values(8, 'level', 'litteraire');
// INSERT into taxonomies(user_id, taxonomy, name) values(8, 'level', 'soutenu');
// INSERT into taxonomies(user_id, taxonomy, name) values(8, 'level', 'courant');
// INSERT into taxonomies(user_id, taxonomy, name) values(8, 'level', 'familier');
// INSERT into taxonomies(user_id, taxonomy, name) values(8, 'level', 'argot');
// INSERT into taxonomies(user_id, taxonomy, name) values(8, 'level', 'vielli');

// INSERT into taxonomies(user_id, taxonomy, name) values(8, 'type', 'word');
// INSERT into taxonomies(user_id, taxonomy, name) values(8, 'type', 'locution');
// INSERT into taxonomies(user_id, taxonomy, name) values(8, 'type', 'expression');
// INSERT into taxonomies(user_id, taxonomy, name) values(8, 'type', 'example');
// INSERT into taxonomies(user_id, taxonomy, name) values(8, 'type', 'definition');
// INSERT into taxonomies(user_id, taxonomy, name) values(8, 'type', 'quote');
// INSERT into taxonomies(user_id, taxonomy, name) values(8, 'type', 'note');
// INSERT into taxonomies(user_id, taxonomy, name) values(8, 'type', 'grammar');
// INSERT into taxonomies(user_id, taxonomy, name) values(8, 'type', 'acronym');

// INSERT into taxonomies(user_id, taxonomy, name) values(8, 'rating', '0');
// INSERT into taxonomies(user_id, taxonomy, name) values(8, 'rating', '1');
// INSERT into taxonomies(user_id, taxonomy, name) values(8, 'rating', '2');
// INSERT into taxonomies(user_id, taxonomy, name) values(8, 'rating', '3');
// INSERT into taxonomies(user_id, taxonomy, name) values(8, 'rating', '4');
// INSERT into taxonomies(user_id, taxonomy, name) values(8, 'rating', '5');

// INSERT into taxonomies(user_id, taxonomy, name) values(8, 'highlight', '0');
// INSERT into taxonomies(user_id, taxonomy, name) values(8, 'highlight', '1');
// INSERT into taxonomies(user_id, taxonomy, name) values(8, 'highlight', '2');
// INSERT into taxonomies(user_id, taxonomy, name) values(8, 'highlight', '3');

// INSERT INTO taxonomy_term(term_id, taxonomy_id) select a.term_id, b.id from grammar_term a, taxonomies b, grammars c where a.grammar_id = c.id and c.name = b.name

//
// INSERT INTO `taxonomies` (`id`, `taxonomy`, `name`, `order`, `user_id`, `created_at`, `updated_at`) VALUES (NULL, 'color', 'cross_dico', NULL, '8', NULL, NULL);
// INSERT INTO `taxonomies` (`id`, `taxonomy`, `name`, `order`, `user_id`, `created_at`, `updated_at`) VALUES (NULL, 'color', 'rating_1', NULL, '8', NULL, NULL);
// INSERT INTO `taxonomies` (`id`, `taxonomy`, `name`, `order`, `user_id`, `created_at`, `updated_at`) VALUES (NULL, 'color', 'rating_2', NULL, '8', NULL, NULL);
// INSERT INTO `taxonomies` (`id`, `taxonomy`, `name`, `order`, `user_id`, `created_at`, `updated_at`) VALUES (NULL, 'color', 'rating_3', NULL, '8', NULL, NULL);
// INSERT INTO `taxonomies` (`id`, `taxonomy`, `name`, `order`, `user_id`, `created_at`, `updated_at`) VALUES (NULL, 'color', 'rating_4', NULL, '8', NULL, NULL);
// INSERT INTO `taxonomies` (`id`, `taxonomy`, `name`, `order`, `user_id`, `created_at`, `updated_at`) VALUES (NULL, 'color', 'rating_5', NULL, '8', NULL, NULL);

// INSERT INTO `taxonomies` (`id`, `taxonomy`, `name`, `order`, `user_id`, `created_at`, `updated_at`) VALUES (NULL, 'color', 'highlight_1', NULL, '8', NULL, NULL);
// INSERT INTO `taxonomies` (`id`, `taxonomy`, `name`, `order`, `user_id`, `created_at`, `updated_at`) VALUES (NULL, 'color', 'highlight_2', NULL, '8', NULL, NULL);
// INSERT INTO `taxonomies` (`id`, `taxonomy`, `name`, `order`, `user_id`, `created_at`, `updated_at`) VALUES (NULL, 'color', 'highlight_3', NULL, '8', NULL, NULL);
