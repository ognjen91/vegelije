<?php
namespace App\Traits;
use Illuminate\Foundation\Http\FormRequest;


trait ImageWizzard {



 protected static function storeImage(FormRequest $request, string $nameInRequest, string $subdirectory = null){
   if ($request->hasfile($nameInRequest)) {
       $name = rand(1, 10000).$request->file($nameInRequest)->getClientOriginalName() ;
       $location = !$subdirectory? public_path().'/images/' : public_path().'/images/' . $subdirectory . "/";

       $request->file($nameInRequest)->move($location, $name);
       return $name;
   }

   return false;  //vracam ime da bih ga ubacio u bazu, ili false ako nema slike
 }




 private static function updateImage(FormRequest $request, string $nameInRequest, $oldImageToDelete, string $subdirectory = null)
 {

     //ako je uploadovana nova slika, izbrisati staru (sem ako je placeholder) i ubaciti novu

     if ($request->hasfile($nameInRequest)) {
         if (\File::exists(public_path('images/'.$oldImageToDelete)) && $oldImageToDelete !== "placeholder.png") {
             \File::delete(public_path('images/'.$oldImageToDelete));
         }
         $name = rand(1, 10000).$request->file($nameInRequest)->getClientOriginalName() ;
         $location = !$subdirectory? public_path().'/images/' : public_path().'/images/' . $subdirectory . "/";
         $request->file($nameInRequest)->move($location, $name);
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
