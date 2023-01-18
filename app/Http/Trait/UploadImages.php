<?php


namespace App\Http\Trait;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

trait UploadImages
{


    public function UpdateAccountImage($model, $image)
    {

        File::delete($model->AccountImage->src);


        $path = $image->store('accountImages','public');


        $model->AccountImage->update([
            'src' =>'public/'.$path,
        ]);

        return response()->json(['message' => 'updated image  successfully']);
    }
}
