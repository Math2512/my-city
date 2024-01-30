<?php

namespace App\Services;

use App\Models\Picture;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PhotoUploadService
{
    /**
     * Store the uploaded photo and associate it with the given entity.
     *
     * @param UploadedFile $file
     * @param mixed $entity
     */
    public function upload($file, $entity)
    {
        try {
            $path = $this->storeFile($file, $entity);

            $picture = new Picture([
                'url' => $path,
                'imageable_id' => $entity->id,
                'imageable_type' => get_class($entity),
            ]);

            $entity->picture()->save($picture);

            return $picture;
        } catch (\Exception $e) {
            // Handle the exception, log, and return null or throw it again as per your needs
            dd($e);
            return null;
        }
    }

    /**
     * Store the uploaded file in the storage.
     *
     * @return string|null
     */
    private function storeFile($file, $entity): ?string
    {
        try {
            $ancienChemin = $file;
            $nomFichier = basename($ancienChemin);
            $dossierDestination = storage_path('group/avatar/');
            File::makeDirectory($dossierDestination, 0777, true, true);
            // Utilisez pathinfo pour obtenir des informations sur le fichier, y compris l'extension
            $infoFichier = pathinfo($ancienChemin);

            // Obtenez l'extension du fichier
            $extensionFichier = $infoFichier['extension'];

            // Stockez le fichier avec le nouveau nom dans le dossier de destination
            Storage::putFileAs($dossierDestination, $ancienChemin, $nomFichier);
            dd($dossierDestination.$nomFichier);
            return $dossierDestination.$nomFichier.$extensionFichier;
        } catch (\Exception $e) {
            dd('eeee'.$e);
            // Handle the exception, log, and return null or throw it again as per your needs
            return null;
        }
    }

}
