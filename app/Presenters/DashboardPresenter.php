<?php

namespace App\Presenters;

use Nette;
use App\Forms\SignUpFormFactory;
use App\Model\UserFacade;
use Nette\Application\UI\Form;

class DashboardPresenter extends Nette\Application\UI\Presenter
{
    private UserFacade $userFacade;
    private SignUpFormFactory $signUpFormFactory;

    // Inject both UserFacade and SignUpFormFactory
    public function __construct(UserFacade $userFacade, SignUpFormFactory $signUpFormFactory) {
        parent::__construct();
        $this->userFacade = $userFacade;
        $this->signUpFormFactory = $signUpFormFactory;
    }

    protected function startup() {
        parent::startup();
        if (!$this->getUser()->isInRole('admin')) {
            $this->flashMessage('Nemáš oprávnění', 'error');
            $this->redirect('Home:');

        }
    }

    public function renderDefault() {
        $this->template->users = $this->userFacade->getAllUsers();
    }

    // Method to create the sign-up form component
    protected function createComponentSignUpForm(): Form {
        $form = $this->signUpFormFactory->create(function () {
            $this->flashMessage("Uživatel úspěšně registrován", "success");
            $this->redirect("Default");  // Redirect to the default view after registration
        });
        return $form;
    }

    public function handleChangeRole($userId, $newRole) {
        if (!$this->getUser()->isInRole('admin')) {
            $this->error('Neoprávněný přístup');
            $this->redirect('Home:');
        }
        $this->userFacade->changeUserRole($userId, $newRole);
        $this->redirect('this');
    }

    public function handleDeleteUser($userId) {
        if (!$this->getUser()->isInRole('admin')) {
            $this->error('Neoprávněný přístup');
            $this->redirect('Home:');
        }
        $this->userFacade->deleteUser($userId);
        $this->redirect('this');
    }
    
    public function handleChangePassword($userId, $newPassword) {
        if (!$this->getUser()->isInRole('admin')) {
            $this->error('Neoprávněný přístup');
            $this->redirect('Home:');
        }
        $this->userFacade->changePassword($userId, $newPassword);
        $this->flashMessage("Heslo bylo úspěšně změněno.", "success");
        $this->redirect('Dashboard:');
    }

    protected function createComponentChangePasswordForm(): Form {
        $form = new Form;
        $user = $this->getUser();
        
        $form->addText('userId', 'ID usera:')
             ->setRequired('Prosím zadejte userovo ID,');

        $form->addPassword('newPassword', 'Nové heslo:')
             ->setRequired('Prosím zadejte nové heslo')
             ->addRule($form::MIN_LENGTH, 'Heslo musí mít alespoň %d znaků', $this->userFacade::PasswordMinLength);

        $form->addSubmit('submit', 'Změnit heslo');

        $form->onSuccess[] = function (Form $form, $values): void {
            $this->handleChangePassword($values->userId, $values->newPassword);
        };

        return $form;
    }

}
