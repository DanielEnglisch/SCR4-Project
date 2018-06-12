<?php

namespace Controllers;

class Ratings extends \Framework\Controller
{
    private $dataLayer;
    private $authManager;

    public function __construct(\BusinessLogic\DataLayer $dataLayer, \BusinessLogic\AuthManager $authManager)
    {
        $this->dataLayer = $dataLayer;
        $this->authManager = $authManager;
    }

    public function GET_addRating(){
         /* Access check */
         if (!$this->authManager->isLoggedIn()) {
            $this->redirect('Login', 'User');
        }

        $this->renderView('addRating',[
            'pid' => $this->getParam('pid')
        ]);
    }

    public function POST_addRating(){
        /* Access check */
        if (!$this->authManager->isLoggedIn()) {
           $this->redirect('Login', 'User');
       }

       $comment = $this->getParam('comment');
       $value = $this->getParam('value');
       $pid = $this->getParam('pid');

       //$this->notEmpty($comment);
       $this->validGrade($value);

       if($this->hasErrors()){
           $this->renderView('addRating', [
               'pid' => $this->getParam('pid'),
               'comment' => $comment,
               'value' => $value,
               'errors' => $this->getErrors(),
           ]);
       }else{
           $this->dataLayer->addRating($pid, $this->authManager->getLoggedInUser()->getId(), $value, $comment);
           $this->redirect('Detail', 'Products', ['pid' => $pid]);
       }
    }

    public function GET_deleteRating()
    {

        /* Access check */
        if (!$this->authManager->isLoggedIn()) {
            $this->redirect('Login', 'User');
        }

        $rid = $this->getParam('rid');
        $username = $this->authManager->getLoggedInUser()->getUsername();
        $rating = $this->dataLayer->getRatingWithId($rid);

        /* If the rating isn't his */
        if ($username !== $rating->getAuthor()) {
            $this->redirect('Index', 'Products');
        }

        $this->dataLayer->deleteRating($rid);
        $this->redirect('Detail', 'Products', ['pid' => $rating->getProductId()]);
    }

    public function GET_editRating()
    {
        /* Access check */
        if (!$this->authManager->isLoggedIn()) {
            $this->redirect('Login', 'User');
        }

        $rid = $this->getParam('rid');
        $username = $this->authManager->getLoggedInUser()->getUsername();
        $rating = $this->dataLayer->getRatingWithId($rid);

        /* If the rating isn't his */
        if ($username !== $rating->getAuthor()) {
            $this->redirect('Index', 'Products');
        }

        $this->renderView('editRating', [
            'comment' => $rating->getComment(),
            'value' => $rating->getValue(),
            'rid' => $rid
        ]);
    }

    public function POST_editRating()
    {
        /* Access check */
        if (!$this->authManager->isLoggedIn()) {
            $this->redirect('Login', 'User');
        }

        $rid = $this->getParam('rid');
        $username = $this->authManager->getLoggedInUser()->getUsername();
        $rating = $this->dataLayer->getRatingWithId($rid);

        /* If the rating isn't his */
        if ($username !== $rating->getAuthor()) {
            $this->redirect('Index', 'Products');
        }

        $value = $this->getParam('value');
        $comment = $this->getParam('comment');

        //$this->notEmpty($comment);
        $this->validGrade($value);

        if($this->hasErrors()){
            $this->renderView('editRating', [
                'comment' => $comment,
                'value' => $value,
                'errors' => $this->getErrors(),
                'rid' => $rid
            ]);
        }else{
            $this->dataLayer->editRating($rid, $value, $comment);
            $this->redirect('Detail', 'Products', ['pid' => $rating->getProductId()]);
        }

    }

}
