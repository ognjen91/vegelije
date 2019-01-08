<?php
namespace App\Traits;
use Illuminate\Foundation\Http\FormRequest;
use App\Image as ImageClass;
use Image;



trait ImageWizzard {


 // ============STORE ZA VISE KOMADA============
 protected static function storeMultipleImages($request, string $nameInRequest, $model, string $subdirectory=null){
   $names = [];
   foreach($request->$nameInRequest as $image) {

        $name = rand(1, 10000).$image->getClientOriginalName();
        $location = !$subdirectory? public_path().'/images/' : public_path().'/images/' . $subdirectory . "/";

        $img = Image::make($image);
        $width = $img->width();
        $height = $img->height();
        // resize image : provjerim da li je veca sirina ili duzina i max dimenziju ogranicim na 900px
        if($width>$height){
          $width > 900? $img->resize(900, null, function ($constraint) {
            $constraint->aspectRatio();
          }) : null;
        } else {
          $height> 900? $img->resize(null, 900, function ($constraint) {
            $constraint->aspectRatio();
          }) : null;
        }


        // save image... laganica
        $img->save($location.$name);
        $imageObject = ImageClass::create(['name'=>$name, 'imageable_type'=>get_class($model), 'imageable_id'=>$model->id]);
        if(!$model->images()->save($imageObject)) return false;
        $names[] = $name;
    }
    return $names; //dakle, ako nije prazan racuna se kao true
 }



// ============STORE ZA POJEDINACNU SLIKU==================
 protected static function storeImage($request, string $nameInRequest, $model, string $subdirectory = null){
   if ($request->hasfile($nameInRequest)) {
       $name = rand(1, 10000).$request->file($nameInRequest)->getClientOriginalName() ;
       $location = !$subdirectory? public_path().'/images/' : public_path().'/images/' . $subdirectory . "/";

       // read image from temporary file
       $img = Image::make($_FILES[$nameInRequest]['tmp_name']);
       $width = $img->width();
       $height = $img->height();
       // resize image : provjerim da li je veca sirina ili duzina i max dimenziju ogranicim na 900px
       if($width>$height){
         $width > 900? $img->resize(900, null, function ($constraint) {
           $constraint->aspectRatio();
         }) : null;
       } else {
         $height> 900? $img->resize(null, 900, function ($constraint) {
           $constraint->aspectRatio();
         }) : null;
       }

       // save image
       $img->save($location.$name);
       $imageObject = ImageClass::create(['name'=>$name, 'imageable_type'=>get_class($model), 'imageable_id'=>$model->id]);
       if(!$model->images()->save($imageObject)) return false;

       return $name;
   }

   return false;  //vracam ime da bih ga ubacio u bazu, ili false ako nema slike
 }



// ==============UPDATE====================
 private static function updateImage(FormRequest $request, string $nameInRequest, $oldImageToDelete, string $subdirectory = null)
 {

     //ako je uploadovana nova slika, izbrisati staru (sem ako je placeholder) i ubaciti novu

     if ($request->hasfile($nameInRequest)) {
         if (\File::exists(public_path('images/'.$oldImageToDelete)) && $oldImageToDelete !== "placeholder.png") {
             \File::delete(public_path('images/'.$oldImageToDelete));
         }
         $name = rand(1, 10000).$request->file($nameInRequest)->getClientOriginalName() ;
         $location = !$subdirectory? public_path().'/images/' : public_path().'/images/' . $subdirectory . "/";
         $img = Image::make($_FILES[$nameInRequest]['tmp_name']);
         $width = $img->width();
         $height = $img->height();
         // resize image : provjerim da li je veca sirina ili duzina i max dimenziju ogranicim na 900px
         if($width>$height){
           $width > 900? $img->resize(900, null, function ($constraint) {
             $constraint->aspectRatio();
           }) : null;
         } else {
           $height> 900? $img->resize(null, 900, function ($constraint) {
             $constraint->aspectRatio();
           }) : null;
         }
         // save image
         $img->save($location.$name);
         return $name;
     }
     return false;  //vracam ime da bih ga ubacio u bazu, ili false ako nema izmjena
 }




 private static function moveImage(string $imageName,  string $newSubDirInImgDir=null, string $oldSubDirInImgDir = null){
   $imgDir = 'images';
   $oldPath = $oldSubDirInImgDir? $imgDir . '/' . $oldSubDirInImgDir . '/' . $imageName : $imgDir . '/' . $imageName;
   $newPath = $newSubDirInImgDir? $imgDir . '/' . $newSubDirInImgDir . '/' . $imageName : $imgDir . '/' . $imageName;
   if (\File::exists(public_path($oldPath))){
     $isMoved = \File::move(public_path($oldPath), public_path($newPath));
     return $isMoved;
   }

   return false;
 }




 private static function copyImage(string $imageName,  string $newSubDirInImgDir=null, string $oldSubDirInImgDir = null){
   $imgDir = 'images';
   $oldPath = $oldSubDirInImgDir? $imgDir . '/' . $oldSubDirInImgDir . '/' . $imageName : $imgDir . '/' . $imageName;
   $newPath = $newSubDirInImgDir? $imgDir . '/' . $newSubDirInImgDir . '/' . $imageName : $imgDir . '/' . $imageName;
   if (\File::exists(public_path($oldPath))){
     $isMoved = \File::copy(public_path($oldPath), public_path($newPath));
     return $isMoved;
   }

   return false;
 }




 private static function deleteImage(string $imageName,  string $subDirInImgDir = null){
   $imgDir = 'images';
   $path = $subDirInImgDir? $imgDir . '/' . $oldSubDirInImgDir . '/' . $imageName : $imgDir . '/' . $imageName;
   if (\File::exists(public_path($path))){
     $isDeleted = \File::delete(public_path($path));
     return $isDeleted;
   }

   return false;
 }




}








 ?>
