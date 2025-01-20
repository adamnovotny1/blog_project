<?php
namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use App\Model\PostFacade;

final class PostPresenter extends Nette\Application\UI\Presenter
{
	public function __construct(
		private PostFacade $postFacade,
	) {
		$this->postFacade = $postFacade;
	}
	
	public function actionShow(int $postId): void 
{
    $post = $this->postFacade->getPostById($postId);
	$user = $this->getUser();

    if ($post->status == "ARCHIVED" && !$this->isLoggedIn()) {
        $this->flashMessage('Nemáš právo vidět archived příspěvky.');
		$this->redirect('Home:');
    }
}

	public function renderShow(int $postId):void
{
	$post = $this->postFacade->getPostById($postId);
	if (!$post) {
		$this->error('Stránka nebyla nalezena');
	}
	
	bdump($post);
	$this->template->post = $post;
	$this->template->comments = $this->postFacade->getComments($postId);
	$this->template->view = $this->postFacade->addView($postId);
}

public function actionEditComment(int $commentId): void
{
    $comment = $this->postFacade->getCommentById($commentId);
    if (!$comment) {
        $this->error('Comment not found');
        return;
    }

	$userId = $this->getUser()->getId();
    $userRole = $this->getUser()->getRoles();
	
    if (!$this->getUser()->isLoggedIn() || $comment->user_id !== $userId && !in_array('admin', $userRole)) {
        $this->flashMessage('Nemáš oprávnění upravovat tento komentář.');
        $this->redirect('Home:');
        return;
    }

    // Set default values for form if user is authorized
    $this['commentForm']->setDefaults($comment->toArray());
    $this->template->comment = $comment;
}


protected function createComponentCommentForm(): Form
{
	$form = new Form; // means Nette\Application\UI\Form
	$user = $this->getUser();

	$form->addHidden('name')
		->setDefaultValue($user->getIdentity()->username);
	$form->addHidden('email')
		->setDefaultValue($user->getIdentity()->email);

	$form->addTextArea('content', 'Komentář:')
		->setRequired();

	$form->addSubmit('send', 'Publikovat komentář');
	$form->onSuccess[] = $this->commentFormSucceeded(...);

	return $form;
}
private function commentFormSucceeded(\stdClass $data): void
{
    $postId = $this->getParameter('postId');
    $name = $data->name;
    $email = $data->email;
    $content = $data->content;
    $userId = $this->getUser()->getId();
    $commentId = $this->getParameter('commentId');

    if ($commentId) {
        $comment = $this->postFacade->getCommentById($commentId);
        $postId = $comment->post_id;
        $this->postFacade->editComment($commentId, (array) $data);

        $this->flashMessage('Komentář upraven', 'success');
        $this->redirect('Post:show', ['postId' => $postId]);

    } else {
        $postId = $this->getParameter('postId');
        $this->postFacade->addComment($postId, $data, $userId);

        $this->flashMessage('Děkuji za komentář', 'success');
        $this->redirect('Post:show', ['postId' => $postId]);
    }
}


public function handleDeleteImage(int $postId) {
        
	$post = $this->postFacade->getPostById($postId);
	
			if($post) {
				unlink($post['image']);
			  
	$data['image'] = null;
			   $this->postFacade->editPost($postId, $data);
			   $this->flashMessage('Obrázek k příspěvku byl smazán');
		   } 
		}


public function handleDeletePost(int $id) {
        
	$post = $this->postFacade->getPostById($id);
		
	$this->postFacade->deletePost($id);
	$this->redirect("Home:default");
	$this->flashMessage("Příspěvek byl úspěšně smazán!");

}

public function handleDeleteComment(int $commentId): void {
	$postId = $this->getParameter('postId');
	
	$this->postFacade->deleteComment($commentId);
	$this->flashMessage("Komentář byl úspěšně smazán!");
	$this->redirect("Post:show", $postId);
}
				
}