<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Casts\WorkorderCast;
//use App\Casts\WorkorderCast;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class workorder extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'jobname',
        'files',
        'no_small_format',
        'jobnumber',
        'lg1orig',
        'lg1copy',
        'lg1size',
        'lg1colorsides',
        'lg1scale',
        'lg1binding',
        'lg1description',
        'lg2orig',
        'lg2copy',
        'lg2size',
        'lg2colorsides',
        'lg2scale',
        'lg2binding',
        'lg2description',
        'sm1orig',
        'sm1copy',
        'sm1size',
        'sm1paper',
        'sm1color',
        'sm1sides',
        'sm1scale',
        'sm1binding',
        'sm1description',
        'sm2orig',
        'sm2copy',
        'sm2size',
        'sm2paper',
        'sm2color',
        'sm2sides',
        'sm2scale',
        'sm2binding',
        'sm2description',
        'turnaround',
        'delivery',
        "alt_address",
        'specialinstructions',
        //'turnaround1hr',
        //'turnaround2hr',
        //'turnaround3hr',
        //'turnaround4hr',
        //'deliverywillcall',
        //'deliveryroute',
        //'deliveryroundtrip',
        //'deliveryroundtrip',*/
    ];


    /*protected $casts = [
        'sm1size' => WorkorderCast::class,
    ];*/

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFilesTitlesandURLS(){
        $files = json_decode($this->files);
        $filesArray = [];
        foreach($files as $file){
            $filesArray[] = [
                'title' => Str::after($file, 'public/uploads/' . $this->user->name . '_' . $this->user->id . '/' . $this->id . '/'),
                'url' => asset('storage/' . $file)
            ];
        }
        return $filesArray;
    }
}
