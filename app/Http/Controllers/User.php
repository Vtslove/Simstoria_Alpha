<?php

namespace App\Http\Controllers;

use App\Campaign;;
use App\Country;
use App\Http\Controllers\CampaignsController;
use App\Payment;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use function asset;
use function get_option;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function my_campaigns(){
        return $this->hasMany(Campaign::class);
    }

    public function myCampaigns()
    {
        $title = trans('app.my_campaigns');
        $user = request()->user();

        $my_campaigns = $user->my_campaigns;

        $my_campaigns = Campaign::whereUserId($user->id)->orderBy('id', 'desc')->get();

        return view('admin.my_campaigns', compact('title', 'my_campaigns'));
    }

    public function get_gravatar( $s = 40, $d = 'blank', $r = 'g', $img = false, $atts = array() ) {
        $email = $this->email;
        $url = 'http://www.gravatar.com/avatar/';
        $url .= md5( strtolower( trim( $email ) ) );
        $url .= "?s=$s&d=$d&r=$r";

        if( ! empty($this->photo)) {
            $url = asset('uploads/avatar/'.$this->photo);
        }

        if ( $img ) {
            $url = '<img src="' . $url . '"';
            foreach ( $atts as $key => $val )
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }

        return $url;
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function signed_up_datetime(){
        $created_date_time = $this->created_at->timezone(get_option('default_timezone'))->format(get_option('date_format_custom').' '.get_option('time_format_custom'));
        return $created_date_time;
    }

    public function status_context(){
        $status = $this->active_status;

        $context = '';
        switch ($status){
            case '0':
                $context = 'Pending';
                break;
            case '1':
                $context = 'Active';
                break;
            case '2':
                $context = 'Block';
                break;
        }
        return $context;
    }

    public function is_admin(){
        if ($this->user_type == 'admin'){
            return true;
        }
        return false;
    }

    public function contributed_amount(){
        $payments = Payment::whereUserId($this->id)->whereStatus('success')->sum('amount');
        return $payments;
    }

    public function getAvatarUrl()
    {
        return "https://www.gravatar.com/avatar/{{ md5($this->email) }}?d=mm&s=50";
    }

    public function friendsOfMine()
    {
        return $this->belongsToMany('App\Http\Controllers\User', 'friends', 'user_id', 'friend_id');
    }

    public function friendOf()
    {
        return $this->belongsToMany('App\Http\Controllers\User', 'friends', 'friend_id', 'user_id');
    }

    public function friends()
    {
        return $this->friendsOfMine()->wherePivot('accepted', true)->get()->merge($this->friendOf()->wherePivot('accepted', true)->get());
    }

    public function friendRequests()
    {
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }

    public function friendRequestsPending()
    {
        return $this->friendOf()->wherePivot('accepted', false)->get();
    }

    public function hasFriendRequestPending(User $user)
    {
        return (bool) $this->friendRequestsPending()->where('id', $user->id)->
        count();
    }

    public function hasFriendRequestReceived(User $user)
    {
        return (bool) $this->friendRequests()->where('id', $user->id)->count();
    }

    public function addFriend(User $user)
    {
        $this->friendOf()->attach($user->id);
    }

    public function deleteFriend(User $user)
    {
        $this->friendOf()->detach($user->id);
        $this->friendsOfMine()->detach($user->id);
    }

    public function acceptFriendRequest(User $user)
    {
        $this->friendRequests()->where('id', $user->id)->first()->pivot->
        update([
            'accepted' => true,
        ]);
    }

    public function isFriendsWith(User $user)
    {
        return (bool) $this->friends()->where('id', $user->id)->count();
    }
}
