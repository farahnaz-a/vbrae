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
function consoles()
{
    return \App\Models\gamingConsole::all();
}
function firstRows()
{
    return \App\Models\FooterFirstRow::first();
}
function footersells()
{
    return \App\Models\FooterSell::all();
}
function footerbuys()
{
    return \App\Models\FooterBuy::all();
}
function footerresources()
{
    return \App\Models\FooterResource::all();
}
function footermenus()
{
    return \App\Models\FooterMenu::all();
}

function facebook()
{
    return \App\Models\CommunityIcon::where('icon', 'Facebook')->first();
}
function twitter()
{
    return \App\Models\CommunityIcon::where('icon', 'Twitter')->first();
}
function instagram()
{
    return \App\Models\CommunityIcon::where('icon', 'Instagram')->first();
}
function discord()
{
    return \App\Models\CommunityIcon::where('icon', 'Discord')->first();
}
function gateway()
{
    return \App\Models\PaymentGateway::first();
}

function positive($id)
{
    return \App\Models\UserRating::where('user_id', $id)->where('rating', 'good')->get();
}

function negative($id)
{
    return \App\Models\UserRating::where('user_id', $id)->where('rating', 'bad')->get();
}

function totalrating($id)
{
    return \App\Models\UserRating::where('user_id', $id)->get();
}