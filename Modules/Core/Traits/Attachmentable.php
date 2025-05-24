<?php

namespace Modules\Core\Traits;

use Illuminate\Support\Facades\File;
use Modules\Apps\Entities\Attachment;

trait Attachmentable
{
    public $multiple_attachment = false;


    public function attachmentRelation()
    {
        $relation = $this->multiple_attachment ? 'morphMany' : 'morphOne';
        return $this->$relation(Attachment::class, 'attachmentable');
    }

    public function getAttachmentAttribute()
    {
        if ($this->multiple_attachment) {
            if ($this->attachmentRelation()->count()) {
                $return = [];

                foreach ($this->attachmentRelation()->get() as $photo) {
                    array_push($return, asset($photo->path));
                }

            } else {
                $return = null;
            }

        } else {

            $return = $this->attachmentRelation()->count() ?
                asset($this->attachmentRelation()->first()->path) : null;
        }

        return $return;
    }

    public function setAttachment($path, $name = null, $usage = null, $type = 'image')
    {
        $inputs = [
            'path' => $path,
            'name' => $name,
            'type' => $type,
            'usage' => $usage,
        ];
        $exploded_path = explode('.', $path);
        $inputs['mime_type'] = $exploded_path[count($exploded_path) - 1];
        $this->attachmentRelation()->create($inputs);
    }

    public function updateAttachment($old_file, $path, $name = null, $usage = null, $type = 'image')
    {
        $inputs = [
            'path' => $path,
            'name' => $name,
            'type' => $type,
            'usage' => $usage,
        ];
        $exploded_path = explode('.', $path);
        $inputs['mime_type'] = $exploded_path[count($exploded_path) - 1];

        if ($old_file)
            $old_file->update($inputs);
        else
            $this->attachmentRelation()->create($inputs);
    }

    public function deleteAttachment($old_file)
    {
        $old_file->delete();
    }
}