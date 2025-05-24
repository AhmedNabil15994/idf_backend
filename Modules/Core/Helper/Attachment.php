<?php


namespace Helper;


use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


class Attachment
{

    static $imageExtensions = [
        'jpg',
        'jpeg',
        'png',
        'svgz',
        'rgb',
    ];

    /**
     * @param $key
     * @param $array
     * @param $value
     * @return mixed
     */
    static function inArray($key, $array, $value)
    {
        $return = array_key_exists($key, $array) ? $array[$key] : $value;
        return $return;
    }

    /**
     * @param $file
     * @param $folder_name
     * @param array $options
     * @return string
     */
    static function addAttachment($file, $folder_name, array $options = [])
    {

        //ser options
        // relation
        //usage
        //type
        //size

        $save = self::inArray('save', $options, 'original');
        $size = self::inArray('size', $options, 400);
        $quality = self::inArray('quality', $options, 100);
        $folder_name = $folder_name . '/' . Carbon::now()->toDateString();

        ///////////////////////////////

        $destinationPath = public_path() . '/uploads/' . $folder_name . '/';
        $extension = $file->getClientOriginalExtension(); // getting image extension

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755);
        }

        if ($extension == 'svg' || $save == 'original') {

            $name = $file->getFilename() . '.' . $extension; // renaming image
            $file->move($destinationPath, $name); // uploading file to given

            return 'uploads/' . $folder_name . '/' . $name;
        }else{

            $imageResize = self::resizePhoto($extension, $destinationPath, $file, $size, $quality);

            return 'uploads/' . $folder_name . '/' . $imageResize;
        }
    }

    /**
     * @param $file
     * @param $oldFiles
     * @param $folder_name
     * @param array $options
     * @return string
     */
    static function updateAttachment($file, $oldFiles , $folder_name, array $options = [])
    {
        //ser options
        // relation
        //usage
        //type
        //size

        $relation = self::inArray('relation', $options, 'attachmentRelation');
        $save = self::inArray('save', $options, 'original');
        $usage = self::inArray('usage', $options, null);
        $type = self::inArray('type', $options, 'image');
        $size = self::inArray('size', $options, 400);
        $quality = self::inArray('quality', $options, 100);
        $folder_name = $folder_name . '/' . Carbon::now()->toDateString();

        ///////////////////////////////

        if ($oldFiles) {
            File::delete(public_path() . '/' . $oldFiles->path);
        }
        $destinationPath = public_path() . '/uploads/' . $folder_name . '/';
        $extension = $file->getClientOriginalExtension(); // getting image extension
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755);
        }

        if ($extension == 'svg' || $save == 'original' || $type != 'image') {

            $name = $file->getFilename() . '.' . $extension; // renaming image
            $file->move($destinationPath, $name); // uploading file to given

            return 'uploads/' . $folder_name . '/' . $name;
        }

        $imageResize = self::resizePhoto($extension, $destinationPath, $file, $size);

        return 'uploads/' . $folder_name . '/' . $imageResize;
    }

    /**
     * @param $model
     * @param array $options
     * @return bool
     */
    static function deleteAttachment($model, $options = [])
    {

        $relation = self::inArray('relation', $options, 'attachmentRelation');
        $multiple = self::inArray('multi', $options, false);
        $type = self::inArray('type', $options, 'image');
        ////////////////////////////////////

        $photos = $model->$relation;

        if ($multiple == true) {
            foreach ($photos as $photo) {
                File::delete(public_path() . '/' . $photo->path);
                $photo->delete();
            }
            return true;
        } else {
            if($photos)
                File::delete(public_path() . '/' . $photos->path);
        }

        $model->$relation()->where('type', $type)->delete();

    }

    /**
     * @param $extension
     * @param string $destinationPath
     * @param mixed $file
     * @param int $size
     * @param int $quality
     * @return  string
     */
    public static function resizePhoto($extension, string $destinationPath, $file, $size = 400, $quality = 100)
    {
        $image = $size . '-' . time() . '' . rand(11111, 99999) . '.' . $extension;

        $resize_image = Image::make($file);
        $resize_image->resize($size, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath . $image, $quality);

        return $image;
    }

    /**
     * @param $code
     * @param $model
     * @param array $options
     */
    public static function setQrCode($code,$model,array $options = [])
    {
        $relation = self::inArray('relation', $options, 'attachmentRelation');
        $usage = self::inArray('usage', $options, 'qr-code');
        $type = self::inArray('type', $options, 'image');
        $size = self::inArray('size', $options, 4); //pixel size in 1 to 10
        $margin = self::inArray('size', $options, 4); // in 1 to 10
        $extension = self::inArray('ext', $options, 'png'); // in 1 to 10

        $folder_name = 'qr-codes/' . Carbon::now()->toDateString();
        $name = $size . '-' . time() . '' . rand(11111, 99999) . '.' . $extension;

        $destinationPath = public_path() . '/uploads/' . $folder_name . '/';

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755);
        }

        \QRCode::text($code)->setSize($size)->setMargin($margin)->setOutfile($destinationPath . $name)->$extension();

        $model->$relation()->create(
            [
                'path' => 'uploads/' . $folder_name . '/' . $name,
                'type' => $type,
                'usage' => $usage
            ]
        );
    }

}
