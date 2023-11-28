<?php
namespace app\components;

use Yii;
use yii\base\ActionFilter;
use yii\web\ForbiddenHttpException;

class AccessControl extends ActionFilter
{
    public function beforeAction($action)
    {

        // Vérifie le rôle de l'utilisateur
        $user = Yii::$app->user->identity;
        
        if ($user && $user->role === 'stagiaire') {
            // Récupère l'ID de l'utilisateur dans l'URL
            $userIdInUrl = Yii::$app->request->get('id');
      
         
          

            // Vérifie si l'ID dans l'URL correspond à l'ID de l'utilisateur connecté
            if ($userIdInUrl !== null && $userIdInUrl != $user->id) {
                throw new ForbiddenHttpException('Accès interdit.');
            }
        }

        return parent::beforeAction($action);
    }
}