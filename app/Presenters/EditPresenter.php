<?php
namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use App\Model\PostFacade;


final class EditPresenter extends Nette\Application\UI\Presenter
{
	public function __construct(
		private PostFacade $postFacade,
	) {
		$this->postFacade = $postFacade;
	}

	public function actionEdit(int $postId): void
{
    $post = $this->postFacade->getPostById($postId);
    if (!$post) {
        $this->error('Post not found');
        return;
    }

    $userId = $this->getUser()->getId();
    $userRole = $this->getUser()->getRoles();

    if (!$this->getUser()->isLoggedIn() || $post->user_id !== $userId && !in_array('admin', $userRole)) {
        $this->flashMessage('Nemáš oprávnění upravovat tento příspěvek.');
        $this->redirect('Home:');
        return;
    }

    // If the user is authorized, set the form defaults and continue with the edit
    $this->getComponent('postForm')->setDefaults($post->toArray());
}

public function actionCreate(): void
{

    if (!$this->getUser()->isLoggedIn()) {
        $this->flashMessage('Nemáš oprávnění vytvářet příspěvky.');
        $this->redirect('Home:');
        return;
    }
}



protected function createComponentPostForm(): Form
{	$form = new Form;
	$form->addUpload('image', 'Soubor')
            ->setRequired()
            ->addRule(Form::IMAGE, 'Obrázek musí být JPEG, PNG nebo GIF');

	$form->addText('title', 'Titulek:')
		->setRequired();
		
		$form->addTextArea('content', 'Obsah:')
		->setRequired();

	$statuses = [
        'OPEN' => 'OTEVŘENÝ',
        'CLOSED' => 'UZAVŘENÝ',
        'ARCHIVED' => 'ARCHIVOVANÝ'
    ];
    $form->addSelect('status', 'Stav:', $statuses)
        ->setDefaultValue('OPEN');

	$form->addSubmit('send', 'Uložit a publikovat');
	$form->onSuccess[] = $this->postFormSucceeded(...);

	return $form;
}


private function postFormSucceeded($form, $data): void
{
    $postId = $this->getParameter('postId');
	$userId = $this->getUser()->getId();

		if ($data['image']->isOk()) {
			$data['image']->move('upload/' . $data['image']->getSanitizedName());
			$data['image'] = ('upload/' . $data['image']->getSanitizedName());
		}
	 else {
		$this->flashMessage('Soubor nebyl přidán', 'failed');
	}

    if ($postId) {
        $post = $this->postFacade->editPost($postId, (array) $data);
		$this->flashMessage('Příspěvek byl úspěšně upraven.', 'success');
        $this->redirect('Post:show', ['postId' => $postId]);
    } else {
        $this->postFacade->insertPost((array) $data, $userId);
		$this->flashMessage('Příspěvek byl úspěšně publikován.', 'success');
    }
    $this->redirect('Home:');
}

public function renderEdit(int $postId): void
{
    $post = $this->postFacade->getPostById($postId);
    $this->template->post = $post;

    if (!$post) {
        $this->error('Post not found');
    }

$this->getComponent('postForm')->setDefaults($post->toArray());
}

}