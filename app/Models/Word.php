<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Traits\CanBeScoped;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Word extends Model
{
  use HasFactory, CanBeScoped;

  protected $guarded = [];

  public static $pagination = 100;

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function categories()
  {
    return $this->belongsToMany(
      Category::class,
      'category_word',
      'word_id',
      'category_id'
    );
  }

  public function translations()
  {
    return $this->belongsToMany(
      Word::class,
      'translations',
      'native_id',
      'translation_id'
    );
  }

  public function natives()
  {
    return $this->belongsToMany(
      Word::class,
      'translations',
      'translation_id',
      'native_id'
    );
  }
}
  //Words
  //INSERT INTO words(user_id,id,old_id,langue,forme,pre,cross_dico,lang,suf,genre,nbr,fra,pronon,def,def_json,ex_json,web_def,conj,dep,gram,level,date,modif,note,imp,mode,temps,freq)
  // SELECT 8,id,old_id,langue,forme,pre,cross_dico,lang,suf,genre,nbr,fra,pronon,def,def_json,ex_json,web_def,conj,dep,gram,level,date,modif,note,imp,mode,temps,freq from lang

  //Translations : INSERT INTO translations(langue, type, native_id, translation_id, position_native, position, translation) SELECT langue,type,id_fra,id_lang,pos_fra,pos_lang from lang_link


//   DELETE FROM words WHERE id IN (
//     SELECT * FROM (
//         SELECT id FROM words GROUP BY id HAVING ( COUNT(id) > 1 )
//     ) AS p
// )

//Categories
//INSERT INTO category_word(word_id, category_id) SELECT b.id as word_id, a.id as category_id FROM words b, categories a where FIND_IN_SET(a.id, b.dep)>0
