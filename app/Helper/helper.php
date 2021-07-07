<?php 

function platforms()
{
    return App\Models\Platform::orderBy('name', 'asc')->get();
}
function countries()
{
    return App\Models\Country::orderBy('name', 'asc')->get();
}

?>