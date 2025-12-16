<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Peta extends Model
{
    protected $table = 'peta'; // <- wajib, agar Laravel tidak mencari peta_persils
    protected $primaryKey = 'peta_id';
    protected $fillable = ['persil_id', 'geojson', 'panjang_m', 'lebar_m', 'keterangan'];

    public function persil()
    {
        return $this->belongsTo(Persil::class, 'persil_id');
    }
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }
    public function scopeSearch($query, $request, array $columns)
    {
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }
    }
    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id')->where('ref_table', 'peta');
    }
}
