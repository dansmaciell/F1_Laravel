<?php

namespace App\Models;

use Illuminate\Container\Attributes\Storage as AttributesStorage;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Laravel\Scout\Searchable;  


class Noticias extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'titulo',
        'descricao',
        'url',
    ];

    public function scopeSearch(Builder $query, array $filters)
    {
        if ($title = $filters['title'] ?? false) {
        $query->where('title','like','%'. $title .'%');
    }
        if ($description = $filters['description'] ?? false) {
        $query->where('descricao','like','%'. $description .'%');
    }
}
    public function storeArquivo($arquivo)
{ 
    if ($arquivo){
        $path = $arquivo->store('arquivos', 'public');
        $this->url = Storage::url($path);
        $this->save();
    }
  }
  public function toSearchableArray(){
    return [
        'id'=>$this->id,
        'titulo'=>$this->titulo,
        'descricao'=>$this->descricao 
    ];      
  }
}