<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\Grammar;
use App\Models\Category;
use App\Models\Traits\CanBeScoped;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Term extends Model
{
  use HasFactory, CanBeScoped;

  protected $guarded = [];

  public static $pagination = 100;

  public static $longTerms = ['example'];


  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function termLength()
  {
    return in_array($this->forme, self::$longTerms) ? 'long' : 'short';
  }

  public function isNative()
  {
    return $this->langue === $this->user->infos->native;
  }

  public function categories()
  {
    return $this->belongsToMany(
      Category::class,
      'category_term',
      'term_id',
      'category_id'
    );
  }

  public function grammars()
  {
    return $this->belongsToMany(
      Taxonomy::class,
      'taxonomy_term',
      'term_id',
      'taxonomy_id'
    )->where('taxonomy', 'grammar');
  }

  public function tags()
  {
    return $this->belongsToMany(
      Taxonomy::class,
      'tag_term',
      'term_id',
      'tag_id'
    )->where('taxonomy', 'tag');
  }

  public function translations()
  {
    return $this->belongsToMany(
      Term::class,
      'translations',
      'native_id',
      'translation_id'
    );
  }

  public function natives()
  {
    return $this->belongsToMany(
      Term::class,
      'translations',
      'translation_id',
      'native_id'
    );
  }
}
  //Terms
  //INSERT INTO terms(user_id,id,old_id,langue,forme,pre,cross_dico,lang,suf,genre,nbr,fra,pronon,def,def_json,ex_json,web_def,conj,dep,gram,level,date,modif,note,imp,mode,temps,freq)
  // SELECT 8,id,old_id,langue,forme,pre,cross_dico,lang,suf,genre,nbr,fra,pronon,def,def_json,ex_json,web_def,conj,dep,gram,level,date,modif,note,imp,mode,temps,freq from lang

  //Translations : INSERT INTO translations(langue, type, native_id, translation_id, position_native, position, translation) SELECT langue,type,id_fra,id_lang,pos_fra,pos_lang from lang_link


//   DELETE FROM terms WHERE id IN (
//     SELECT * FROM (
//         SELECT id FROM terms GROUP BY id HAVING ( COUNT(id) > 1 )
//     ) AS p
// )

//Categories
//INSERT INTO category_term(term_id, category_id) SELECT b.id as term_id, a.id as category_id FROM terms b, categories a where FIND_IN_SET(a.id, b.dep)>0

//grammars
// Entrer manuellement toutes les grammaire puis
// INSERT into grammar_term(term_id, grammar_id) SELECT b.id as term_id, a.id as grammar_id FROM terms b, grammars a where FIND_IN_SET(a.name, b.gram)>0
