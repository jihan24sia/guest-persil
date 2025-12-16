<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sengketa extends Model
{
    use HasFactory;

    protected $primaryKey = 'sengketa_id';
    protected $table = 'sengketa';
    protected $fillable = [
        'persil_id',
        'pihak_1',
        'pihak_2',
        'kronologi',
        'status',
        'penyelesaian',
    ];

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
        return $this->hasMany(Media::class, 'ref_id', 'sengketa_id')
            ->where('ref_table', 'sengketa')
            ->orderBy('sort_order');
    }
}
