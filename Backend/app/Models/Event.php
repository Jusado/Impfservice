<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;

    /*
     * Falls Tabellenname nicht EZ ist sondern zb MZ und das Mapping verwendet werden kann
     * protected $table='event';
     *
     * Falls Primary Key anders heißt
     * protected $primaryKey ="name_der_spalte";
     *
     * Whiteliste definieren (die Attribute, die auch von außen schreibbar sein sollen zB wenn man neues Buch anlegen will)
     * (the attributes that are mass assignable)
     * protected $fillable
     *
     * Blacklist definieren (dieses Feld nicht von außen beschreibbar machen)
     * protected $guarded
    */

    protected $fillable = ['location_id', 'vaccine', 'appointment', 'people','current_amount','id'];


    // freier Termin
    public function isFree() : bool {
        return $this->people >0;
    }


    public function images() : HasMany {
        return $this->hasMany(Image::class);
    }

    public function user() : HasMany {
        return $this->hasMany(User::class);
    }

    public function location() : BelongsTo {
        return $this->belongsTo (Location::class);
    }
}
