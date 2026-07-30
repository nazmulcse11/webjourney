<?php

use App\Models\StaticOption;

function toastr_info($success){
    Toastr::info($success,'Success!',
        [
            "positionClass" => "toast-top-right",
            "closeButton" => "true",
            "progressBar" => "true",
        ]);
}

function toastr_success($success){
    Toastr::success($success,'Success!',
        [
            "positionClass" => "toast-top-right",
            "closeButton" => "true",
            "progressBar" => "true",
        ]);
}

function toastr_warning($success){
    Toastr::warning($success,'Warning!',
        [
            "positionClass" => "toast-top-right",
            "closeButton" => "true",
            "progressBar" => "true",
        ]);
}

function toastr_error($error){
    Toastr::error($error,'Error!',
        [
            "positionClass" => "toast-top-right",
            "closeButton" => "true",
            "progressBar" => "true",
        ]);
}

function single_post_share($url, $title, $img_url)
{
    $output = '';
    //get current page url
    $encoded_url = urlencode($url);
    //get current page title
    $post_title = str_replace(' ', '%20', $title);

    //all social share link generate
    $facebook_share_link = 'https://www.facebook.com/sharer/sharer.php?u=' . $encoded_url; //have to change this url
    $twitter_share_link = 'https://twitter.com/intent/tweet?text=' . $post_title . '&amp;url=' . $encoded_url . '&amp;';
    $pinterest_share_link = 'https://pinterest.com/intent/tweet?text=' . $post_title . '&amp;url=' . $encoded_url . '&amp;';
    $instagram_share_link = 'https://instagram.com/pin/create/button/?url=' . $encoded_url . '&amp;media=' . $img_url . '&amp;description=' . $post_title;

    $output .= '<li><a href="' . $facebook_share_link . '"><i class="fab fa-facebook-f"></i></a></li>';
    $output .= '<li><a href="' . $twitter_share_link . '"><i class="fab fa-twitter"></i></a></li>';
    $output .= '<li><a href="' . $pinterest_share_link . '"><i class="fab fa-pinterest-p"></i></a></li>';
    $output .= '<li><a href="' . $instagram_share_link . '"><i class="fab fa-instagram"></i></a></li>';

    return $output;
}

function update_static_option($key, $value)
{
    if (!StaticOption::where('option_name', $key)->first()) {
        StaticOption::create([
            'option_name' => $key,
            'option_value' => $value
        ]);
        return true;
    } else {
        StaticOption::where('option_name', $key)->update([
            'option_name' => $key,
            'option_value' => $value
        ]);
        \Illuminate\Support\Facades\Cache::forget($key);
        return true;
    }
    return false;
}

function get_static_option($key,$default = null)
{
    $option_name = $key;
    $value = \Illuminate\Support\Facades\Cache::remember($option_name, 600, function () use($option_name) {
        return StaticOption::where('option_name', $option_name)->first();
    });

    return $value->option_value ?? $default;
}


