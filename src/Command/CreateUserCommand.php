<?php


namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateUserCommand extends Command
{
    protected static $defaultName = 'app:create-user';
    private UserPasswordHasherInterface $passwordHasher;
    private EntityManagerInterface $entityManager;

    public function __construct(UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager)
    {
        $this->passwordHasher = $passwordHasher;
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Creates a new user.')
            ->addArgument('email', InputArgument::OPTIONAL, 'The email of the user')
            ->addArgument('username', InputArgument::OPTIONAL, 'The username of the user')
            ->addArgument('password', InputArgument::OPTIONAL, 'The password of the user');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');

        $email = $input->getArgument('email');
        if (!$email) {
            $question = new Question('Please enter the email of the user: ');
            $email = $helper->ask($input, $output, $question);
        }

        $username = $input->getArgument('username');
        if (!$username) {
            $question = new Question('Please enter the username of the user: ');
            $username = $helper->ask($input, $output, $question);
        }


        $password = $input->getArgument('password');
        if (!$password) {
            $question = new Question('Please enter the password of the user: ');
            $password = $helper->ask($input, $output, $question);
        }

        $user = new User();
        $user->setEmail($email);
        $user->setusername($username);
        $user->setPassword($this->passwordHasher->hashPassword($user, $password));

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $output->writeln('<info>User created successfully!</info>');

        return Command::SUCCESS;
    }
}