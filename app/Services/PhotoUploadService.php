<?php

namespace App\Services;

use App\Models\Picture;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PhotoUploadService
{
    /**
     * Store the uploaded photo and associate it with the given entity.
     *
     * @param UploadedFile $file
     * @param mixed $entity
     */
    public function upload($file, $entity, $path)
    {
        try {
            if ($file) {
                $this->deleteExistingFile($entity->picture); // Supprimez l'ancien fichier s'il existe
                $path = $this->storeFile($file, $entity, $path);

                // Mettez à jour l'enregistrement de l'image existante
                if ($entity->picture) {
                    $entity->picture->update(['url' => $path]);
                } else {
                    // Créez un nouvel enregistrement s'il n'existe pas
                    $picture = new Picture([
                        'url' => $path,
                        'imageable_id' => $entity->id,
                        'imageable_type' => get_class($entity),
                    ]);
                    $entity->picture()->save($picture);
                }

                return $path;
            }
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Store the uploaded file in the storage.
     *
     * @return string|null
     */
    private function storeFile($file, $entity, $path)
    {
        try {
            if ($file) {
                $imageName = $file->getClientOriginalName(); // Vous pouvez personnaliser le nom du fichier si nécessaire
                $file->storeAs('public/' . $path.$entity->id, $imageName);
                return 'storage/' . $path.$entity->id.'/'.$imageName;
            }
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Delete old File.
     *
     * @param Picture|null $picture
     */
    private function deleteExistingFile($picture)
    {
        try {
            if ($picture) {
                Storage::delete(str_replace('storage/', '', $picture->url));
            }
        } catch (\Exception $e) {
            return null;
        }
    }

}
