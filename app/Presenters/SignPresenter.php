<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Forms;
use Nette;
use Nette\Application\Attributes\Persistent;
use Nette\Application\UI\Form;


/**
 * Presenter for sign-in and sign-up actions.
 */
final class SignPresenter extends Nette\Application\UI\Presenter
{
	/**
	 * Stores the previous page hash to redirect back after successful login.
	 */
	#[Persistent]
	public string $backlink = '';


	public function __construct(
		private Forms\SignInFormFactory $signInFactory,
		private Forms\SignUpFormFactory $signUpFactory,
	) {
	}


	/**
	 * Creates the sign-in form component.
	 * On successful submission, the user is redirected to the Home or back to the previous page.
	 */
	protected function createComponentSignInForm(): Form
	{
		return $this->signInFactory->create(function (): void {
			$this->restoreRequest($this->backlink); // redirects the user to the previous page if any
			$this->redirect('Home:'); // or redirects the user to the home
		});
	}


	/**
	 * Creates the sign-up form component.
	 * On successful submission, the user is redirected to the home.
	 */
	protected function createComponentSignUpForm(): Form
	{
		return $this->signUpFactory->create(function (): void {
			$this->redirect('Sign:in');
		});
	}


	/**
	 * Logs out the currently authenticated user.
	 */
	public function actionOut(): void
	{
		$this->getUser()->logout();
	}
}