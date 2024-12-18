<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;
use GuzzleHttp\Client;
use Request;
use AUth;

class Company extends Model
{
    protected static function boot()
    {
        parent::boot();
  
        static::addGlobalScope(new ActiveScope);
    }
    
    protected $fillable = [
        'address', 'location' , 'status', 'po_box', 'state', 'tel', 'country_id', 'logo', 'pdf', 'showPdf', 'email', 'wifi_password', 'wifi', 'active', 'responsible', 'admin_active', 'has_pay', 'facebook', 'website', 'instagram', 'company_kind_id'
    ];

    protected $appends = ['company_type_ids', 'available_languages', 'is_liked', 'ratings_avg', 'active_subscription'];

    protected $with = [
        'translations',
        'companyAddress'
    ];
    
    public function companyTypes()
    {
        return $this->belongsToMany('App\CompanyType');
    }

    public function getDistanceAttribute()
    {
        if(!$this->companyAddress()->exists() || !isset(request()->headers->all()['coords']))
            return false;
        
        $address = $this->companyAddress->location;
        
        $location = json_decode($address);
        $userLocation = json_decode(collect(request()->headers->all()['coords'])->first());

        $distance = \DB::select(\DB::raw("select st_distance_sphere('SRID=4326;POINT(" . $userLocation->lat . " " . $userLocation->lng . ")'::geometry,'SRID=4326;POINT(" . $location->lat . " " . $location->lng . ")'::geometry)"));
        $meters = collect($distance)->first()->st_distance_sphere;
        return (int) $meters;
    }

    public function translations()
    {
        return $this->morphMany('App\Translation', 'translation')->orderBy('language_id', 'ASC');
    }

    public function subscriptions()
    {
        return $this->hasMany('App\Subscription')->orderBy('start_date', 'DESC');
    }

    public function getAvailableLanguagesAttribute()
    {
        return $this->translations->pluck('language_id');
    }

    public function getActiveSubscriptionAttribute()
    {
        return $this->subscriptions->first();
    }

    public function user()
    {
        return $this->belongsToMany('App\User');
    }

    public function getIsLikedAttribute()
    {
        if(!Auth::check())
            return false;

        return Favorite::where('user_id', Auth::id())->where('company_id' , $this->attributes['id'])->count();
    }

    public function translate($translations)
    {
        $this->translations()->delete();
        return  collect($translations)->map(function ($translation) {
            $t = new Translation([
                'language_id' => $translation['language_id'],
                'name' => isset($translation['name']) ? $translation['name'] : ' ',
                'description' => $translation['description'],
            ]);

            $this->translations()->save($t);
        });
    }

    public function savePlace ($address, $po_box, $state) 
    {
        $client = new Client([
            'base_uri' => 'https://maps.googleapis.com/maps/api/geocode/json'
        ]);
        $response = $client->get('', [
                'query' => [
                    'address' => $address . ' ' .$po_box . ' ' . $state,
                    'key' => 'AIzaSyBE7wQxX9WNoEDG3NZtmx4duujwM7YJoBc',
                ]
            ]
        );
        $data = json_decode($response->getBody()->getContents());

        if($data->status == 'OK') {
            $this->companyAddress()->delete();
            $t = new CompanyAddress([
                'route' => $data->results[0]->address_components[1]->long_name,
                'locality' => $data->results[0]->address_components[2]->long_name,
                'administrative_area' => $data->results[0]->address_components[3]->long_name,
                'country' => $data->results[0]->address_components[4]->long_name,
                'postal_code' => $data->results[0]->address_components[5]->long_name,
                'location' => json_encode($data->results[0]->geometry->location),
            ]);
    
            $this->companyAddress()->save($t);
        }
    }

    public function saveMedia($media)
    {
        $this->media()->delete();
        return  collect($media)->map(function ($media, $index) {
            $t = new Media([
                'url' => $media['url'],
                'order' => $index,
            ]);

            $this->media()->save($t);
        });
    }

    public function companyAddress() {
        return $this->hasOne('App\CompanyAddress');
    }

    public function media()
    {
        return $this->morphMany('App\Media', 'media');
    }

    public function getCompanyTypeIdsAttribute()
    {
        return $this->companyTypes->pluck('id');
    }

    public function companyCategory()
    {
       return $this->hasMany('App\CompanyCategory');
    }

    public function ratings()
    {
       return $this->hasMany('App\Rating');
    }

    public function getRatingsAvgAttribute()
    {
       return $this->ratings->avg('average');
    }
}
