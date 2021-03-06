<?php
namespace App\Traits;

use App\Friendship;
use App\User;

trait Friendable{

    public function add_friend($user_requested_id){

        if($this->id === $user_requested_id){
            return 0;
        }

        if($this->is_friends_with($user_requested_id) === 1){
            return 'Já são amigos.';
        }

        if($this->has_pending_friend_request_sent_to($user_requested_id) === 1){
            return 'Já enviou convite';
        }

        if($this->has_pending_friend_request_from($user_requested_id) === 1){
            return $this->accept_friend($user_requested_id);
        }

        $friendship = Friendship::create([
            'requester' => $this->id,
            'user_requested' =>$user_requested_id
        ]);

        if($friendship){
            return response()->json($friendship, 200);
        }else{
            return response()->json('fail', 501);
        }

    }

    public function accept_friend($requester){

        if($this->has_pending_friend_request_from($requester) === 0){
            return 0;
        }

        $friendship = Friendship::where('requester', $requester)
            ->where('user_requested', $this->id)
            ->first();

        if($friendship){
            $friendship->update([
                'status' => 1
            ]);

            return response()->json('ok', 200);
        }else{
            return response()->json('fail', 200);
        }
    }

    public function friends(){
        $friends = array();

        $f1 = Friendship::where('status', 1)
            ->where('requester', $this->id)
            ->get();

        foreach ($f1 as $friendship) {
            array_push($friends, User::find($friendship->user_requested));
        }

        $friends2 = array();

        $f2 = Friendship::where('status', 1)
            ->where('user_requested', $this->id)
            ->get();

        foreach ($f2 as $friendship) {
            array_push($friends, User::find($friendship->requester));
        }

        return array_merge($friends, $friends2);
    }

    public function pending_friend_requests(){
        $users = array();

        $friendships = Friendship::where('status', 0)
            ->where('user_requested', $this->id)
            ->get();

        foreach ($friendships as $friendship) {
            array_push($users, User::find($friendship->requester));
        }

        return $users;
    }

    public function friends_id(){
        return collect($this->friends())->pluck('id')->toArray();
    }

    public function is_friends_with($user_id){
        if(in_array($user_id, $this->friends_id())){
            return 1;
        }else{
            return 0;
        }
    }

    public function pending_friend_requests_ids(){
        return collect($this->pending_friend_requests())->pluck('id')->toArray();
    }

    public function pending_friend_requests_sent(){
        $users = array();

        $friendships = Friendship::where('status', 0)
            ->where('requester', $this->id)
            ->get();

        foreach ($friendships as $friendship){
            array_push($users, User::find($friendship->user_requested));
        }

        return $users;
    }

    public function pending_friend_requests_sents_ids(){
        return collect($this->pending_friend_requests_sent())->pluck('id')->toArray();
    }

    public function has_pending_friend_request_from($user_id){
        if(in_array($user_id, $this->pending_friend_requests_ids())){
            return 1;
        }else{
            return 0;
        }
    }

    public function has_pending_friend_request_sent_to($user_id){
        if(in_array($user_id, $this->pending_friend_requests_sents_ids())){
            return 1;
        }else{
            return 0;
        }
    }

}