<?php




function imageupload($path, $file){
    if ($file){
        $time = time();
        $db_path = $path.$time.$file->getClientOriginalName();
        $ImageUpload = \Image::make($file);
        $thumbnailPath = public_path('/thumbnail/'.$path);
        $originalPath = public_path( $path);

        if(!\File::isDirectory($originalPath)){
            \File::makeDirectory($originalPath, 0777, true, true);
        }

        $ImageUpload->save($originalPath.$time.$file->getClientOriginalName());

        // for save thumnail image
        if(!\File::isDirectory($thumbnailPath)){

            \File::makeDirectory($thumbnailPath, 0777, true, true);

        }
        $ImageUpload->resize(350, 250, function ($constraint){
            $constraint->aspectRatio();
        });
        $ImageUpload->resizeCanvas(350, 250, 'center', false, 'fff');
        $ImageUpload = $ImageUpload->save($thumbnailPath.$time.$file->getClientOriginalName());
        return $db_path;
    }else{
        return null;
    }
}










?>