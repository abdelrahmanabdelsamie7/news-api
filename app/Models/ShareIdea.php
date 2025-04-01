<?php
namespace App\Models;
use App\Models\Report;
use App\traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShareIdea extends Model
{
    use HasFactory,UsesUuid;
    protected $table = 'share_ideas';
    protected $fillable = ['name' ,'email' , 'message' , 'report_id' , 'reply'];
    public function report(){
        return $this->belongsTo(Report::class);
    }
}