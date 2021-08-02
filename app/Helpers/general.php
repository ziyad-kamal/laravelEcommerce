<?php
use Illuminate\Support\Facades\Config;


function show_language(){
    return App\Models\Language::selection()->where('active',1)->get();
}

function defaultLang(){
    return config::get('app.locale');
}

function lang_rtl(){
    $lang=App\Models\Language::select('abbr')->where('direction','rtl')->pluck('abbr')->toArray();
    return $lang;
}

function lang_prefix(){
    return LaravelLocalization::setLocale();
}

function diff_date($date){
    $date_diff=$date->diffInMinutes(date('y-m-d H:i:s'));
    if($date_diff == 0){
        return 'less than one minute ago';

    }elseif($date_diff > 0     && $date_diff < 60 ){
        return $date_diff . ' minutes ago';

    }elseif($date_diff > 60    && $date_diff < 1400 ){
        return number_format($date_diff/60) . ' hours ago';

    }elseif($date_diff > 1440  && $date_diff < 10080 ){
        return $date->diffInDays(date('y-m-d H:i:s')) . ' days ago';

    }elseif($date_diff > 10080 && $date_diff < 40320 ){
        return $date->diffInWeeks(date('y-m-d H:i:s'))  . ' weeks ago';
    }
}
