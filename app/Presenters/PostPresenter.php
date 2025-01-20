<?php
namespace App\Presenters;

use Nette;
use App\Model\PostFacade;

final class PostPresenter extends Nette\Application\UI\Presenter
{
	public function __construct(
		private PostFacade $postFacade,
	) {
		$this->postFacade = $postFacade;
	}

	public function renderShow(int $postId):void
{
	$post = $this->postFacade->getPostById($postId);
	if (!$post) {
		$this->error('Stránka nebyla nalezena');
	}
	
	//bdump($post);
	$this->template->post = $post;
	
}










				
}