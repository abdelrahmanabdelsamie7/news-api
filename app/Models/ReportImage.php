<?php
namespace App\Models;
use App\Models\Report;
use App\traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ReportImage extends Model
{
    use HasFactory,UsesUuid;
    protected $table = 'report_images';
    protected $fillable = ['image','report_id'];
    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
