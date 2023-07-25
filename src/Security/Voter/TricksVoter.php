<?php

namespace App\Security\Voter;

use App\Entity\Tricks;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class TricksVoter extends Voter
{
    const EDIT = 'TRICK_EDIT';
    const DELETE = 'TRICK_DELETE';

    //accéder à certain nombre d'information sur la sécurité de la role
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, $trick): bool
    {
        //je pas envoyé le bon attribute (edit ou delete trick)
        if(!in_array($attribute, [self::EDIT, self::DELETE])){
            return false;
        }
        if(!$trick instanceof Tricks){
            return false;
        }
        return true;
    }
    protected function voteOnAttribute($attribute, $trick, TokenInterface $token): bool
    {
        // Récupère l'utilisateur à partir du token
        $user = $token->getUser();
        // Vérifie si l'utilisateur est une instance de user interface (s'il est pas connecté)
        if(!$user instanceof UserInterface)
            return false;
        
        // Vérifie si l'utilisateur est admin
        if($this->security->isGranted('ROLE_ADMIN'))
            return true;
        // Vérifie les permissions
        switch($attribute){
            case self::EDIT:
                // Vérifie si l'utilisateur peut éditer
                return $this->canEdit();
                break;
            case self::DELETE:
                 // Vérifie si l'utilisateur peut supprimer
                 return $this->canDelete();
                 break;    
        } 
    }
    private function canEdit(){
        return $this->security->isGranted('ROLE_TRICK_ADMIN');
    }
    private function canDelete(){
        return $this->security->isGranted('ROLE_TRICK_ADMIN');
    }
}