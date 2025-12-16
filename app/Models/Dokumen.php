<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dokumen extends Model
{
    use HasFactory;

    protected $primaryKey = 'dokumen_id';
    protected $table = 'dokumen';
    protected $fillable = [
        'persil_id',
        'jenis_dokumen',
        'nomor',
        'keterangan'
    ];

    // Relasi ke persil
    public function persil()
    {
        return $this->belongsTo(Persil::class, 'persil_id');
    }

    // Relasi ke media
    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'dokumen_id')
                    ->where('ref_table', 'dokumen')
                    ->orderBy('sort_order');
    }

    // Scope filter dinamis
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    // Scope search global
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
}
