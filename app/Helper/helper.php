<?php 

function platforms()
{
    return App\Models\Platform::orderBy('name', 'asc')->get();
}
function countries()
{
    return App\Models\Country::orderBy('name', 'asc')->get();
}
function wishListCount($id)
{
    return App\Models\WishList::where('game_id', $id)->get()->count();
}
function notification($id)
{
    return \App\Models\Notification::where('user_id', $id)->where('seen', 'no')->get();
}