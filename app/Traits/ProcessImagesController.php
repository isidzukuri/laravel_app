<?php

namespace App\Traits;

use File;
use Image;

trait ProcessImagesController{

	protected function process_images($item, $input)
    {
        $item_path = public_path("images/{$this->controller_route_path}/{$item->id}/");
        if(isset($input['cropped_images']) && isset($input['cropped_images'][0])) {
            $image = $input['cropped_images'][0];
            $temp_path = public_path("images/{$this->controller_route_path}/temp/{$image}");
            $ext = File::extension($temp_path);
            $img_name = 'original.'.$ext;
            $this->add_directory_if_not_exist($item_path);
            File::move($temp_path, $item_path.$img_name);
            $item_fields = ['img_ext' => $ext];
        }
        if(isset($item_fields)) $item->update($item_fields);
        if(isset($input['cropped_coords']) && isset($input['cropped_coords'][0])) {
            $coords = json_decode($input['cropped_coords'][0]);
            $img_name = 'original.'.$item->img_ext;
            Image::make($item_path.$img_name)->crop((int) $coords->w, (int) $coords->h, (int) $coords->x, (int) $coords->y)->save($item_path.'cropped_'.$img_name);
        }
        return $item;
    }

}