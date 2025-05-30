<?php

use Spatie\Valuestore\Valuestore;


if (!function_exists('base64')) {
    function base64($imgUrl){

        $folder = 'uploads/api';

        $path   = $imgUrl;
        $type   = '.jpg';
        $imgname = md5(rand() * time()) . '.' . $type;

        // Get new name of image Url & Path of folder to save in it
        $fname = $folder.'/'.$imgname;
        $img = Image::make($path);

        // End of this proccess
        $img->save($fname);

        return $fname;
    }

}
// Get Setting Values
if (!function_exists('setting')) {

    function setting($key,$index = null) {
        $value = null;
        $setting = Valuestore::make(storage_path('app/settings.json'));

        if (!is_null($index)){

          if ($setting->get($key)) {
            $value = array_key_exists($index,$setting->get($key)) ? $setting->get($key)[$index] : null;
          }

        }else{

          $value = $setting->has($key) ? $setting->get($key) : null;

        }


        return $value ? $value : null;
    }
}

if (!function_exists('pluckModelsCols')) {

    function pluckModelsCols($records, $col1, $col2, $is_trans1 = false, $is_trans2 = false)
    {
        $response = [];

        if ($records && count($records)) :
            foreach ($records as $record) :
                $first = $is_trans1 ? optional($record->translateOrDefault(locale()))->$col1 : $record->$col1;
                $second = $is_trans2 ? optional($record->translateOrDefault(locale()))->$col2 : $record->$col2;
                $response[$second] = $first;
            endforeach;
        endif;
        return $response;
    }
}

if (! function_exists('color_theme')) {

    function color_theme($category){
        return $category ? $category->color : '';
    }

}

// Active Dashboard Menu
if (! function_exists('active_menu')) {
    function active_menu($routeNames){
      $routeNames = (array) $routeNames;
      foreach ($routeNames as $routeName) {
        return (strpos(Route::currentRouteName(), $routeName) == 0) ? '' : 'active';
      }
    }
}
if (! function_exists('active_slide_menu')) {
    function active_slide_menu($routeNames){
        $response = [];
        foreach ((array)$routeNames as $name){
            array_push($response , active_menu($name));
        }

      return in_array('active' , $response) ? 'active open' : '';
    }
}

if (! function_exists('active_profile')) {

    function active_profile($route){
        return (Route::currentRouteName() == $route) ? 'active' : '';
    }
}

if (! function_exists('canAnyPermission')) {

    function canAnyPermission($permissions){
        foreach ((array)$permissions as $permission) {

            if(auth()->user()->can($permission))
                return true;
        }
        return false;
    }
}

// GET THE CURRENT LOCALE
if (! function_exists('locale')) {

    function locale() {
        return app()->getLocale();
    }

}

// CHECK IF CURRENT LOCALE IS RTL
if (! function_exists('is_rtl')) {

    function is_rtl($locale = null) {

        $locale = ($locale == null) ? locale() : $locale;

        if (in_array($locale, config('rtl_locales'))) {
          return 'rtl';
        }

        return 'ltr';
    }

}


if (! function_exists('slugfy')) {
    /**
     * @param $string
     * @param string $separator
     * @param null $model
     * @param int $counter
     * @return mixed|string|string[]|null
     */
     function slugfy($string, $separator = '-',$model = null,$counter = 0)
     {
         $url = trim($string);
         $url = strtolower($url);
         $url = preg_replace('|[^a-z-A-Z\p{Arabic}0-9 _]|iu', '', $url);
         $url = preg_replace('/\s+/', ' ', $url);
         $url = str_replace(' ', $separator, $url);
         $response = $counter != 0 ? $url.$separator.$counter : $url;

         if($model && method_exists($model, 'scopeBuildSlugQuery')){
             $record = $model->BuildSlugQuery($response)->latest()->first();
             if($record){
                 $counter = explode($separator,$record->slug);
                 $counter = $counter[count($counter) - 1];
                 $counter = is_integer($counter) ? $counter + 1 : 1;
                return slugfy($string , $separator , $model , $counter);
             }
         }
         return $response;
     }
}


// if (! function_exists('path_without_domain')) {
//     /**
//      * Get Path Of File Without Domain URL
//      *
//      * @param string $locale
//      */
//     function path_without_domain($path)
//     {
//         return parse_url($path, PHP_URL_PATH);
//     }
// }


if (! function_exists('path_without_domain')) {
    /**
     * Get Path Of File Without Domain URL
     *
     * @param string $locale
     */
    function path_without_domain($path)
    {
        $url = $path;
        $parts = explode("/",$url);
        array_shift($parts);
        array_shift($parts);
        array_shift($parts);
        $newurl = implode("/",$parts);

        return $newurl;
    }
}

if (! function_exists('int_to_array')) {
    /**
     * convert a comma separated string of numbers to an array
     *
     * @param string $integers
     */
    function int_to_array($integers)
    {
        return array_map("intval", explode(",", $integers));
    }
}


if (!function_exists('combinations')) {

    function combinations($arrays, $i = 0) {

        if (!isset($arrays[$i])) {
            return array();
        }

        if ($i == count($arrays) - 1) {
            return $arrays[$i];
        }

        // get combinations from subsequent arrays
        $tmp = combinations($arrays, $i + 1);

        $result = array();

        // concat each array from tmp with each element from $arrays[$i]
        foreach ($arrays[$i] as $v) {
            foreach ($tmp as $t) {
                $result[] = is_array($t) ?
                    array_merge(array($v), $t) :
                    array($v, $t);
            }
        }

        return $result;
    }

}


if (!function_exists('htmlView')) {
    /**
     * Access the OrderStatus helper.
     */
     function htmlView($content)
     {
         return
         '<!DOCTYPE html>
           <html lang="en">
             <head>
               <meta charset="utf-8">
               <meta http-equiv="X-UA-Compatible" content="IE=edge">
               <meta name="viewport" content="width=device-width, initial-scale=1">
               <link href="css/bootstrap.min.css" rel="stylesheet">
               <!--[if lt IE 9]>
                 <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
                 <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
               <![endif]-->
             </head>
             <body>
               '.$content.'
               <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
               <script src="js/bootstrap.min.js"></script>
             </body>
           </html>';
     }
}


if (! function_exists('currency')) {
    /**
     * The Current currency
     *
     * @param string $currency
     */
    function currency($price)
    {
        if (session()->get('currency'))
            return convertCurrency($price) .' '. currentCurrency();

        return convertCurrency($price) . ' ' . currentCurrency();
    }
}

if (! function_exists('convertCurrency')) {
    /**
     * The Convert Price
     *
     * @param string $price
     */
    function convertCurrency($price)
    {
        if (session()->get('currency'))
            return ( round( ($price * session()->get('currency')['rate']) /5 ) * 5 );

        if (Request::header('Currency-Rate'))
            return ( round( ($price * \Request::header('Currency-Rate') ) /5 ) * 5 );

        return round($price);
    }
}

if (! function_exists('currentCurrency')) {
    /**
     * The Current currentCurrency
     *
     * @param string $currentCurrency
     */
    function currentCurrency()
    {
        if (session()->get('currency'))
            return session()->get('currency')['code'];

        if ( Request::header('Currency-Rate') )
            return \Request::header('Currency-Code');

        return setting('default_currency');
    }
}
