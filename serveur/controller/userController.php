<?php
require_once '../manager/userManager.php';
require_once '../model/user.php';

class UserController
{
    private UserManager $userManager;

    public function __construct()
    {
        $this->userManager = new UserManager();
    }

    public function createUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['user'])) {
                $userArray = $data['user'];
                $user = new User(
                    0,
                    $userArray['userLevel'],
                    $userArray['userFirstName'],
                    $userArray['userLastName'],
                    $userArray['username'],
                    $userArray['userEmail'],
                    $userArray['userPasswordHash'],
                    $userArray['userGender'],
                    $userArray['userHeadline'],
                    $userArray['userBio'],
                    $userArray['userImage']
                );
                $result = $this->userManager->createUser($user);

                if ($result) {
                    echo json_encode(['status' => 'success', 'message' => 'User created successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to create user']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid user data']);
            }
        }
    }

    public function getUserById($userId)
    {
        $user = $this->userManager->getUserById($userId);
        if ($user) {
            echo json_encode($user->toArray());
        } else {
            echo json_encode(['status' => 'error', 'message' => 'User not found']);
        }
    }

    public function updateUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['user'])) {
                $userArray = $data['user'];
                $user = new User(
                    $userArray['userId'],
                    $userArray['userLevel'],
                    $userArray['userFirstName'],
                    $userArray['userLastName'],
                    $userArray['username'],
                    $userArray['userEmail'],
                    $userArray['userPasswordHash'],
                    $userArray['userGender'],
                    $userArray['userHeadline'],
                    $userArray['userBio'],
                    $userArray['userImage']
                );

                $result = $this->userManager->updateUser($user);

                if ($result) {
                    echo json_encode(['status' => 'success', 'message' => 'User updated successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to update user']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid user data']);
            }
        }
    }

    public function deleteUser($userId)
    {
        $result = $this->userManager->deleteUser($userId);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'User deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete user']);
        }
    }

    public function getAllUsers()
    {
        $users = $this->userManager->getAllUsers();
        $userArray = [];
        foreach ($users as $user) {
            $userArray[] = $user->toArray();
        }
        echo json_encode($userArray);
    }
}

// Example of routing mechanism
if (isset($_GET['action'])) {
    $controller = new UserController();
    $action = $_GET['action'];

    switch ($action) {
        case 'create':
            $controller->createUser();
            break;
        case 'read':
            if (isset($_GET['userId'])) {
                $controller->getUserById(intval($_GET['userId']));
            }
            break;
        case 'update':
            $controller->updateUser();
            break;
        case 'delete':
            if (isset($_GET['userId'])) {
                $controller->deleteUser(intval($_GET['userId']));
            }
            break;
        case 'all':
            $controller->getAllUsers();
            break;
        default:
            echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
            break;
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No action specified']);
}
