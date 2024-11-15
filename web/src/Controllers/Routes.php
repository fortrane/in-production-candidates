<?php

class Routes {

    public $database;

    public function __construct($database) {
        $request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $this->database = $database;
        $this->routeUserTo($request);

    }

    public function routeUserTo($request) {

        $viewDir = __DIR__ . '/../../views/';

        $utilityClass = new UtilityClass();

        switch ($request) {
            case '':
            case '/':
            case '/login':
                $utilityClass->checkSessions("defaultAccess", $this->database);
                require $viewDir . 'Auth/Login.php';
                break;

            case '/start':
                $utilityClass->checkSessions("dashboardAccess", $this->database);
                require $viewDir . 'Dashboard/Start.php';
                break;

            case '/users':
                $utilityClass->checkSessions("dashboardAccess", $this->database);
                $utilityClass->checkSessions("adminAccess", $this->database);
                require $viewDir . 'Admin/Users.php';
                break;

            case '/all-cards':
                $utilityClass->checkSessions("dashboardAccess", $this->database);
                $utilityClass->checkSessions("adminAccess", $this->database);
                require $viewDir . 'Admin/AllCards.php';
                break;

            case '/find-candidate':
                $utilityClass->checkSessions("dashboardAccess", $this->database);
                $utilityClass->checkSessions("adminAccess", $this->database);
                require $viewDir . 'Admin/FindCandidate.php';
                break;

            case '/my-cards':
                $utilityClass->checkSessions("dashboardAccess", $this->database);
                require $viewDir . 'Dashboard/MyCards.php';
                break;

            case '/settings':
                $utilityClass->checkSessions("dashboardAccess", $this->database);
                require $viewDir . 'Profile/Settings.php';
                break;

            case '/users':
                $utilityClass->checkSessions("dashboardAccess", $this->database);
                $utilityClass->checkSessions("adminAccess", $this->database);
                require $viewDir . 'Admin/Users.php';
                break;

            case '/logout':
                require $viewDir . 'Logout/exit.php';
                break;
        
            default:
                http_response_code(404);
                break;
        }
    }

}




