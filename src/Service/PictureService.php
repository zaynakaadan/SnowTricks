<?php
namespace App\Service;

use Exception;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PictureService
{
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function add(UploadedFile $picture, ?string $folder = '', ?int  $width = 250, ?int $height =  250)
    {
        // Donner un nouveau nom à l'image
        $fichier = md5(uniqid(rand(), true)) . '.webp';

        // Récupèrer les infos de l'image
        $pictureInfos = getimagesize($picture);
        if($pictureInfos === false){
            throw new Exception('Format d\'image incorrect');            
        }

        // Vérifier le format de l'image
        switch($pictureInfos['mime']){
            case'image/png':
                $sourcePicture = imagecreatefrompng($picture);
                break;
            case'image/jpeg':
                $sourcePicture = imagecreatefromjpeg($picture);
                break;   
            case'image/webp':
                $sourcePicture = imagecreatefromwebp($picture);
                break;
            default:              
                throw new Exception('Format d\'image incorrect');            

        }

        // Recadre l'image 
        // Récupèrer les dimensions
        $imageWidth = $pictureInfos[0];
        $imageHeight = $pictureInfos[1];

        // Vérifier l'orientation de l'image
        switch ($imageWidth <=> $imageHeight){
            case -1: // portrait
                $squareSize = $imageWidth;
                $src_x = 0;
                $src_y = ($imageHeight - $squareSize) / 2;
                break;
            case 0: // carré
                $squareSize = $imageWidth;
                $src_x = 0;
                $src_y = 0;
                break;
            case 1: // paysage
                $squareSize = $imageHeight;
                $src_x = ($imageWidth - $squareSize) / 2;
                $src_y = 0 ;
                break;        
        }

        // Créer une nouvelle image "vierge"
        $resizedPicture = imagecreatetruecolor($width, $height);
        imagecopyresampled($resizedPicture,$sourcePicture, 0, 0, $src_x, $src_y,
        $width, $height, $squareSize, $squareSize );

        $path = $this->params->get('images_directory') . $folder;

        // Créer le dossier de destination s'il n'existe pas
        if(!file_exists($path . '/mini/')){
            mkdir($path . '/mini/', 0755, true);
        }

         // Stocker l'image recadrée
         imagewebp($resizedPicture, $path . '/mini/' . $width . 'x' . $height . '-' . $fichier);
         // Déplacer le fichier dans le path lequel je souhait  
         $picture->move($path . '/', $fichier);
 
         return $fichier;
    }

    public function delete(string $fichier, ?string $folder = '', ?int $width = 250, ?int $height = 250)
    {
        // Pas supprime le fichier par défaut 
        if($fichier !== 'default.webp'){
            $success = false;
            $path = $this->params->get('images_directory') . $folder;

            $mini = $path . '/mini/' . $width . 'x' . $height . '-' . $fichier;
            // Vérifier tout le fichier existe
            if(file_exists($mini)){
                unlink($mini);
                $success = true;
            }
            // Suprrimer le fichier original
            $original = $path . '/' . $fichier;

            if(file_exists($original)){
                unlink($original);
                $success = true;
            }
            return $success;
        }
        return false;
    }
}