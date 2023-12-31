<?php

namespace App\Service;

use App\Entity\User;
use App\Exception\AlreadyExistsException;
use App\Repository\UserRepository;
use App\Utility\SecureHasher;

class UserService
{
    private UserRepository $userRepository;
    private SecureHasher $secureHasher;

    public function __construct(UserRepository $userRepository, SecureHasher $secureHasher)
    {
        $this->userRepository = $userRepository;
        $this->secureHasher = $secureHasher;
    }

    /**
     * @param User $user
     * @return null|User
     * @throws AlreadyExistsException
     */
    public function registration(User $user): ?User
    {
        $unHashedPassword = $user->getPassword();

        $existUser = $this->userRepository->findByEmail($user->getEmail());

        if ($existUser != null){
            throw new AlreadyExistsException("User exist with this email!");
        }

        $user->setPassword($this->secureHasher->hash($user->getPassword()));

        $savedUser = $this->userRepository->saveUser($user);
        $savedUser->setPassword($unHashedPassword);

        return $savedUser;
    }

    /**
     * @return array<User>
     */
    public function getAllUser(): array {
        return$this->userRepository->getAllUser();
    }
}