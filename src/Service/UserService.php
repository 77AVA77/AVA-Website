<?php

namespace App\Service;

use App\Definitions\AbstractDefinitions;
use App\Entity\User;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    public EntityManagerInterface $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    /**
     * @throws Exception
     */
    public function setUser($requestParams): int
    {
        $sql = "INSERT INTO public.user (name, surname, email, password, role) VALUES 
                ('{$requestParams['name']}',
                 '{$requestParams['surname']}',
                 '{$requestParams['email']}',
                 '" . md5($requestParams["password"]) . "',
                 " . AbstractDefinitions::ROLE_USER . ")
                RETURNING id";
        $userId = $this->em->getConnection()->executeQuery($sql)->fetchAllAssociative();
        return $userId;
    }

    public function securityCheck(array $user, string $page): array
    {
        $error = '';
        $email = $user['email'] ?? '';
        $password = $user['password'] ?? '';

        $userData = $this->em->createQueryBuilder()
            ->select('u')
            ->from(User::class, 'u')
            ->where('u.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getArrayResult();
        $userData = !empty($userData[0])?$userData[0]:$userData;

        if ($page === 'login') {
            if (empty($userData)) {
                return ['error' => 'Invalid email or password. Please try again or go to register.'];
            }
            if (md5($password) !== $userData['password']) {
                return ['error' => "Password is not correct. Please try again or click on 'Forgot password'"];
            }

            return ['userId' => $userData['id']];
        }

        if ($page === 'register') {
            if (!empty($userData)) {
                return ['error' => "This user already exists. Please <a href='/login'>Sign in</a>"];
            }

            foreach (['email', 'password'] as $field) {
                $value = $user[$field] ?? '';
                if (empty($value)) {
                    $error = ucfirst($field) . " is empty.";
                    break;
                }
                $length = strlen($value);
                if ($length < 8) {
                    $error = ucfirst($field) . " characters must be more than 8.";
                    break;
                } elseif ($length > 25) {
                    $error = ucfirst($field) . " characters must be less than 25.";
                    break;
                }
            }
        }

        if (empty($email) || empty($password)) {
            $error = 'Empty Email or Password.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Invalid Email address.';
        } elseif (strlen($password) < 8) {
            $error = 'Password characters must be more than 8.';
        } elseif (strlen($password) > 25) {
            $error = 'Password characters must be less than 25.';
        }

        return empty($error) && !empty($userData) ? ['userId' => $userData['id']] : ['error' => $error];
    }

}