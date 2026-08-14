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
    $twitter_share_link = 'https://twitter.com/intent/tweet?text=' . $post_title . '&amp;url=' . $encoded_url;
    $pinterest_share_link = 'https://pinterest.com/pin/create/button/?url=' . $encoded_url . '&amp;media=' . $img_url . '&amp;description=' . $post_title;
    $whatsapp_share_link = 'https://api.whatsapp.com/send?text=' . $post_title . '%20' . $encoded_url;
    $linkedin_share_link = 'https://www.linkedin.com/sharing/share-offsite/?url=' . $encoded_url;
    $reddit_share_link = 'https://reddit.com/submit?url=' . $encoded_url . '&title=' . $post_title;

    $output .= '<li><a target="_blank" href="' . $facebook_share_link . '" title="Share on Facebook"><i class="fab fa-facebook-f"></i></a></li>';
    $output .= '<li><a target="_blank" href="' . $twitter_share_link . '" title="Share on Twitter"><i class="fab fa-twitter"></i></a></li>';
    $output .= '<li><a target="_blank" href="' . $whatsapp_share_link . '" title="Share on WhatsApp"><i class="fab fa-whatsapp"></i></a></li>';
    $output .= '<li><a target="_blank" href="' . $linkedin_share_link . '" title="Share on LinkedIn"><i class="fab fa-linkedin-in"></i></a></li>';
    $output .= '<li><a target="_blank" href="' . $reddit_share_link . '" title="Share on Reddit"><i class="fab fa-reddit-alien"></i></a></li>';
    $output .= '<li><a target="_blank" href="' . $pinterest_share_link . '" title="Share on Pinterest"><i class="fab fa-pinterest-p"></i></a></li>';
    
    // Copy link feature with a professional tooltip message
    $output .= '<li style="position:relative;"><a href="javascript:void(0);" onclick="var tempInput = document.createElement(\'input\'); tempInput.value = \''.$url.'\'; document.body.appendChild(tempInput); tempInput.select(); document.execCommand(\'copy\'); document.body.removeChild(tempInput); var msg = document.getElementById(\'copy-msg-tooltip\'); if(!msg) { msg = document.createElement(\'span\'); msg.id = \'copy-msg-tooltip\'; msg.style.position = \'absolute\'; msg.style.top = \'-35px\'; msg.style.left = \'50%\'; msg.style.transform = \'translateX(-50%)\'; msg.style.background = \'#183c7d\'; msg.style.color = \'#fff\'; msg.style.padding = \'5px 10px\'; msg.style.borderRadius = \'4px\'; msg.style.fontSize = \'12px\'; msg.style.fontWeight = \'bold\'; msg.style.whiteSpace = \'nowrap\'; msg.style.boxShadow = \'0 2px 5px rgba(0,0,0,0.2)\'; msg.style.zIndex = \'10\'; msg.innerText = \'Copied!\'; this.parentElement.appendChild(msg); } msg.style.display = \'block\'; setTimeout(() => { msg.style.display = \'none\'; }, 2000);" title="Copy Link"><i class="fas fa-copy"></i></a></li>';

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


