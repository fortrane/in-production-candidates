<?php

include_once __DIR__ . '/../Custom/Medoo/connect.php';
include_once __DIR__ . '/../Functions/utility.class.php';

@session_start();

$utilityClass = new UtilityClass();

// https://server:8080
$apiUrl = "YOUR_URL_HERE";
$secretKey = "SECRET_KEY_1";
$secretPythonKey = "SECRET_KEY_2";

if (isset($_GET['authUser'])) {

    if (!empty($_POST['login']) && !empty($_POST['password'])) {

        $login = $utilityClass->sanitizeParam($_POST['login']);
        $password = $utilityClass->sanitizeParam($_POST['password']);

        $databaseCallback = $database->get("gb_users", ["id", "login", "role"], ["login" => $login, "password" => md5($password)]);

        if (empty($databaseCallback['id'])) {
            $utilityClass->addJavaScript('addNotification("Ошибка авторизации", "Введенные данные неверны. Повторите попытку!", "Danger")');
            exit();
        }

        $_SESSION['id'] = $databaseCallback['id'];
        $_SESSION['login'] = $login;
        $_SESSION['role'] = $databaseCallback['role'];

        exit($utilityClass->changeLocationViaHTML('0', './start'));
    }
}

if (isset($_GET['saveNewPassword'])) {

    $utilityClass->checkSessions("dashboardAccess", $database);

    $oldPassword = $utilityClass->sanitizeParam($_POST['oldPassword']);
    $newPassword = $utilityClass->sanitizeParam($_POST['newPassword']);

    $databasePassword = $database->get("gb_users", "password", ["id" => $_SESSION["id"]]);

    if ($databasePassword != md5($oldPassword)) {
        $utilityClass->addJavaScript('addNotification("Ошибка сохранения", "Старый пароль не совпадает с введенным, повторите попытку!", "Danger")');
        exit();
    }

    $databaseCallback = $database->update("gb_users", [
        "password" => md5($newPassword)
    ], ["id" => $_SESSION["id"]]);

    $response = [
        "response" => "success"
    ];

    echo json_encode($response);
}

if (isset($_GET['getStatistics'])) {
    $utilityClass->checkSessions("dashboardAccess", $database);
    $utilityClass->checkSessions("adminAccess", $database);

    $currentMonth = date('d.m.Y 00:00:00', strtotime('first day of this month'));

    $totalCards = $database->count("in_prod_card");

    $cardsThisMonth = $database->count("in_prod_card", [
        "created_at[>=]" => $currentMonth
    ]);

    $totalUsers = $database->count("in_prod_card", [
        "GROUP" => "user_id"
    ]);

    $response = [
        "status" => "success",
        "data" => [
            "totalCards" => $totalCards,
            "monthlyCards" => $cardsThisMonth,
            "totalUsers" => $totalUsers,
            "currentDate" => date('d.m.Y H:i:s'),
            "monthStart" => $currentMonth
        ]
    ];

    echo json_encode($response);
    exit();
}

if (isset($_GET['getAllCards'])) {
    $utilityClass->checkSessions("dashboardAccess", $database);
    $utilityClass->checkSessions("adminAccess", $database);

    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $perPage = 20;
    $offset = ($page - 1) * $perPage;

    $totalRecords = $database->count("in_prod_card");

    $currentMonth = date('d.m.Y 00:00:00', strtotime('first day of this month'));
    $monthlyRecords = $database->count("in_prod_card", [
        "created_at[>=]" => $currentMonth
    ]);

    $cards = $database->select("in_prod_card", [
        "[>]in_prod_analytics" => ["id" => "card_id"],
        "[>]gb_users" => ["user_id" => "id"]
    ], [
        "in_prod_card.id",
        "in_prod_card.card_name",
        "in_prod_card.video_path",
        "in_prod_card.created_at",
        "gb_users.login",
        "in_prod_analytics.score"
    ], [
        "ORDER" => ["in_prod_card.created_at" => "DESC"],
        "LIMIT" => [$offset, $perPage]
    ]);

    $response = [
        "status" => "success",
        "data" => $cards,
        "stats" => [
            "total" => $totalRecords,
            "monthly" => $monthlyRecords
        ],
        "pagination" => [
            "current" => $page,
            "total" => ceil($totalRecords / $perPage),
            "perPage" => $perPage,
            "totalRecords" => $totalRecords
        ]
    ];

    echo json_encode($response);
    exit();
}

if (isset($_GET['deleteCard'])) {
    $utilityClass->checkSessions("dashboardAccess", $database);
    $utilityClass->checkSessions("adminAccess", $database);

    $cardId = $utilityClass->sanitizeParam($_POST['cardId']);

    $database->delete("in_prod_analytics", [
        "card_id" => $cardId
    ]);

    $database->delete("in_prod_card", [
        "id" => $cardId
    ]);

    echo json_encode(["status" => "success"]);
    exit();
}

if (isset($_GET['getAllUsers'])) {
    $utilityClass->checkSessions("dashboardAccess", $database);
    $utilityClass->checkSessions("adminAccess", $database);

    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $perPage = 20;
    $offset = ($page - 1) * $perPage;

    $totalRecords = $database->count("gb_users");

    $totalCards = $database->count("in_prod_card");

    $users = $database->select("gb_users", [
        "id",
        "login",
        "full_name",
        "telegram",
        "role",
        "created_at"
    ], [
        "ORDER" => ["created_at" => "DESC"],
        "LIMIT" => [$offset, $perPage]
    ]);

    foreach ($users as &$user) {
        $user['cards_count'] = $database->count("in_prod_card", [
            "user_id" => $user['id']
        ]);
    }

    $response = [
        "status" => "success",
        "data" => $users,
        "stats" => [
            "total" => $totalRecords,
            "totalCards" => $totalCards
        ],
        "pagination" => [
            "current" => $page,
            "total" => ceil($totalRecords / $perPage),
            "perPage" => $perPage,
            "totalRecords" => $totalRecords
        ]
    ];

    echo json_encode($response);
    exit();
}

if (isset($_GET['deleteUser'])) {
    $utilityClass->checkSessions("dashboardAccess", $database);
    $utilityClass->checkSessions("adminAccess", $database);

    $userId = $utilityClass->sanitizeParam($_POST['userId']);

    $database->delete("in_prod_analytics", [
        "card_id" => $database->select("in_prod_card", "id", [
            "user_id" => $userId
        ])
    ]);

    $database->delete("in_prod_card", [
        "user_id" => $userId
    ]);

    $database->delete("gb_users", [
        "id" => $userId
    ]);

    echo json_encode(["status" => "success"]);
    exit();
}

if (isset($_GET['editUser'])) {
    $utilityClass->checkSessions("dashboardAccess", $database);
    $utilityClass->checkSessions("adminAccess", $database);

    $userId = $utilityClass->sanitizeParam($_POST['userId']);
    $login = $utilityClass->sanitizeParam($_POST['login']);
    $fullName = !empty($_POST['fullName']) ? $_POST['fullName'] : null;
    $telegram = !empty($_POST['telegram']) ? $_POST['telegram'] : null;
    $role = $utilityClass->sanitizeParam($_POST['role']);
    $password = !empty($_POST['password']) ? md5($_POST['password']) : null;

    $updateData = [
        "login" => $login,
        "role" => $role
    ];

    if ($password) {
        $updateData["password"] = $password;
    }

    if ($fullName) {
        $updateData["full_name"] = $fullName;
    }

    if ($telegram) {
        $updateData["telegram"] = $telegram;
    }

    $database->update(
        "gb_users",
        $updateData,
        ["id" => $userId]
    );

    echo json_encode(["status" => "success"]);
    exit();
}

if (isset($_GET['addUser'])) {
    $utilityClass->checkSessions("dashboardAccess", $database);
    $utilityClass->checkSessions("adminAccess", $database);

    $login = $utilityClass->sanitizeParam($_POST['login']);
    $password = $utilityClass->sanitizeParam($_POST['password']);
    $fullName = !empty($_POST['fullName']) ? $_POST['fullName'] : null;
    $telegram = !empty($_POST['telegram']) ? $_POST['telegram'] : null;
    $role = $utilityClass->sanitizeParam($_POST['role']);

    $existingUser = $database->count("gb_users", ["login" => $login]);

    if ($existingUser > 0) {
        echo json_encode([
            "status" => "error",
            "message" => "Пользователь с таким логином уже существует"
        ]);
        exit();
    }

    $addData = [
        "login" => $login,
        "password" => md5($password),
        "role" => $role,
        "created_at" => date("d.m.Y H:i:s")
    ];

    if ($fullName) {
        $updateData["full_name"] = $fullName;
    }

    if ($telegram) {
        $updateData["telegram"] = $telegram;
    }

    $database->insert("gb_users", $addData);

    echo json_encode(["status" => "success"]);
    exit();
}

if (isset($_GET['uploadVideo'])) {
    $utilityClass->checkSessions("dashboardAccess", $database);

    if (!isset($_FILES['file'])) {
        echo json_encode([
            "status" => "error",
            "message" => "Файл не был загружен"
        ]);
        exit();
    }

    $file = $_FILES['file'];
    $fileName = uniqid() . '.mp4';

    $cardName = $utilityClass->sanitizeParam($_POST['cardName']);

    if (empty($cardName)) {
        echo json_encode([
            "status" => "error",
            "message" => "Название визитки не может быть пустым"
        ]);
        exit();
    }

    $uploadDir = dirname(dirname(dirname(__FILE__))) . '/temp/';
    $uploadPath = $uploadDir . $fileName;

    if (!file_exists($uploadDir)) {
        if (!mkdir($uploadDir, 0777, true)) {
            echo json_encode([
                "status" => "error",
                "message" => "Невозможно создать директорию для загрузки"
            ]);
            exit();
        }
    }

    if (!is_writable($uploadDir)) {
        echo json_encode([
            "status" => "error",
            "message" => "Нет прав на запись в директорию"
        ]);
        exit();
    }

    error_log("Uploading file: " . print_r($file, true));
    error_log("Upload path: " . $uploadPath);

    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
        chmod($uploadPath, 0644);

        try {

            $fileUrl = $utilityClass->getFullServerUrl() . "/temp/" . $fileName;

            $database->insert("in_prod_card", [
                "card_name" => $cardName,
                "video_path" => $fileUrl,
                "user_id" => $_SESSION['id'],
                "created_at" => date("d.m.Y H:i:s")
            ]);

            $cardId = $database->id();

            $sendData = $utilityClass->sendDataToExternalServer($apiUrl . "/create-ocean", [
                "fileUrl" => $fileUrl,
                "identity" => $cardId,
                "secret_key" => $secretPythonKey
            ]);

            echo json_encode([
                "status" => "success",
                "cardId" => $cardId
            ]);
        } catch (Exception $e) {
            error_log("Database error: " . $e->getMessage());
            echo json_encode([
                "status" => "error",
                "message" => "Ошибка при сохранении данных в базу"
            ]);
        }
    } else {
        $phpFileUploadErrors = [
            0 => 'There is no error, the file uploaded with success',
            1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
            2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
            3 => 'The uploaded file was only partially uploaded',
            4 => 'No file was uploaded',
            6 => 'Missing a temporary folder',
            7 => 'Failed to write file to disk.',
            8 => 'A PHP extension stopped the file upload.',
        ];

        $errorMessage = isset($file['error']) && isset($phpFileUploadErrors[$file['error']])
            ? $phpFileUploadErrors[$file['error']]
            : 'Неизвестная ошибка при загрузке файла';

        error_log("Upload error: " . $errorMessage);
        error_log("File details: " . print_r($file, true));

        echo json_encode([
            "status" => "error",
            "message" => $errorMessage
        ]);
    }
    exit();
}

if (isset($_GET['checkProcessing'])) {
    $utilityClass->checkSessions("dashboardAccess", $database);

    $cardId = $utilityClass->sanitizeParam($_POST['cardId']);

    $analytics = $database->get("in_prod_analytics", "*", [
        "card_id" => $cardId
    ]);

    echo json_encode([
        "status" => $analytics ? "completed" : "processing"
    ]);
    exit();
}

if (isset($_GET['getMyCards'])) {
    $utilityClass->checkSessions("dashboardAccess", $database);

    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $perPage = 20;
    $offset = ($page - 1) * $perPage;

    $userId = $_SESSION['id'];

    $totalRecords = $database->count("in_prod_card", [
        "user_id" => $userId
    ]);

    $processingRecords = $database->count("in_prod_card", [
        "user_id" => $userId,
        "id[!]" => $database->select("in_prod_analytics", "card_id")
    ]);

    $cards = $database->select("in_prod_card", [
        "[>]in_prod_analytics" => ["id" => "card_id"]
    ], [
        "in_prod_card.id",
        "in_prod_card.card_name",
        "in_prod_card.video_path",
        "in_prod_card.created_at",
        "in_prod_analytics.score",
        "in_prod_analytics.created_at(analytics_created_at)"
    ], [
        "user_id" => $userId,
        "ORDER" => ["in_prod_card.created_at" => "DESC"],
        "LIMIT" => [$offset, $perPage]
    ]);

    echo json_encode([
        "status" => "success",
        "data" => $cards,
        "stats" => [
            "total" => $totalRecords,
            "processing" => $processingRecords
        ],
        "pagination" => [
            "current" => $page,
            "total" => ceil($totalRecords / $perPage),
            "perPage" => $perPage,
            "totalRecords" => $totalRecords
        ]
    ]);
    exit();
}

if (isset($_GET['findBestProfession'])) {
    $utilityClass->checkSessions("dashboardAccess", $database);

    $cardId = $utilityClass->sanitizeParam($_POST['cardId']);

    $analytics = $database->get("in_prod_analytics", ["score"], [
        "card_id" => $cardId
    ]);

    if (!$analytics) {
        echo json_encode([
            "status" => "error",
            "message" => "Аналитика не найдена"
        ]);
        exit();
    }

    $userMetrics = json_decode($analytics['score'], true);

    $professions = $database->select("in_prod_professions", "*");

    $bestMatch = null;
    $bestScore = 0;

    $allfd = "";

    foreach ($professions as $profession) {
        $profMetrics = json_decode($profession['ocean_json'], true);

        $score =
            $userMetrics['openness'] * $profMetrics['openness'] +
            $userMetrics['conscientiousness'] * $profMetrics['conscientiousness'] +
            $userMetrics['extraversion'] * $profMetrics['extraversion'] +
            $userMetrics['agreeableness'] * $profMetrics['agreeableness'] +
            $userMetrics['neuroticism'] * $profMetrics['neuroticism'];


        if ($score > $bestScore) {
            $bestScore = $score;
            $bestMatch = $profession;
        }
    }

    echo json_encode([
        "status" => "success",
        "profession" => [
            "name" => $bestMatch['profession_name']
        ],
        "matchScore" => $bestScore,
    ]);
    exit();
}

if (isset($_GET['deleteMyCard'])) {
    $utilityClass->checkSessions("dashboardAccess", $database);

    $cardId = $utilityClass->sanitizeParam($_POST['cardId']);

    $card = $database->get("in_prod_card", [
        "id",
        "video_path",
        "user_id"
    ], [
        "id" => $cardId
    ]);

    if (!$card || $card['user_id'] != $_SESSION['id']) {
        echo json_encode([
            "status" => "error",
            "message" => "Карточка не найдена или у вас нет прав на её удаление"
        ]);
        exit();
    }

    try {
        $videoPath = str_replace($utilityClass->getFullServerUrl(), dirname(dirname(dirname(__FILE__))), $card['video_path']);
        if (file_exists($videoPath)) {
            unlink($videoPath);
        }

        $database->delete("in_prod_analytics", [
            "card_id" => $cardId
        ]);

        $database->delete("in_prod_card", [
            "id" => $cardId,
            "user_id" => $_SESSION['id'] 
        ]);

        echo json_encode([
            "status" => "success",
            "message" => "Визитка успешно удалена"
        ]);
    } catch (Exception $e) {
        error_log("Error deleting card: " . $e->getMessage());
        echo json_encode([
            "status" => "error",
            "message" => "Не удалось удалить визитку"
        ]);
    }
    exit();
}

if (isset($_GET['getRecruitmentStats'])) {
    $utilityClass->checkSessions("dashboardAccess", $database);

    $totalUsers = $database->count("gb_users");
    $totalCards = $database->count("in_prod_card");

    echo json_encode([
        "status" => "success",
        "stats" => [
            "totalUsers" => $totalUsers,
            "totalCards" => $totalCards
        ]
    ]);
    exit();
}

if (isset($_GET['getProfessions'])) {
    $utilityClass->checkSessions("dashboardAccess", $database);

    $professions = $database->select("in_prod_professions", "*");

    echo json_encode([
        "status" => "success",
        "data" => $professions
    ]);
    exit();
}

if(isset($_GET['addProfession'])) {
    $utilityClass->checkSessions("dashboardAccess", $database);
    
    $name = $utilityClass->sanitizeParam($_POST['name']);
    $metrics = $_POST['metrics'];
    
    try {
        $database->insert("in_prod_professions", [
            "profession_name" => $name,
            "ocean_json" => $metrics,
            "created_at" => date("d.m.Y H:i:s")
        ]);
        
        echo json_encode(["status" => "success"]);
    } catch (Exception $e) {
        echo json_encode([
            "status" => "error",
            "message" => "Ошибка при добавлении профессии"
        ]);
    }
    exit();
}

if (isset($_GET['updateProfession'])) {
    $utilityClass->checkSessions("dashboardAccess", $database);

    $id = $utilityClass->sanitizeParam($_POST['id']);
    $metrics = $_POST['metrics'];

    try {
        $database->update(
            "in_prod_professions",
            ["ocean_json" => $metrics],
            ["id" => $id]
        );

        echo json_encode(["status" => "success"]);
    } catch (Exception $e) {
        echo json_encode([
            "status" => "error",
            "message" => "Ошибка при обновлении профессии"
        ]);
    }
    exit();
}

if (isset($_GET['deleteProfession'])) {
    $utilityClass->checkSessions("dashboardAccess", $database);

    $id = $utilityClass->sanitizeParam($_POST['id']);

    try {
        $database->delete("in_prod_professions", ["id" => $id]);
        echo json_encode(["status" => "success"]);
    } catch (Exception $e) {
        echo json_encode([
            "status" => "error",
            "message" => "Ошибка при удалении профессии"
        ]);
    }
    exit();
}

if(isset($_GET['findCandidates'])) {
    $utilityClass->checkSessions("dashboardAccess", $database);
    
    $professionId = $utilityClass->sanitizeParam($_POST['professionId']);
    
    $profession = $database->get("in_prod_professions", "*", ["id" => $professionId]);
    $profMetrics = json_decode($profession['ocean_json'], true);
    
    $candidates = $database->select("in_prod_card", [
        "[>]in_prod_analytics" => ["id" => "card_id"],
        "[>]gb_users" => ["user_id" => "id"]
    ], [
        "in_prod_card.id",
        "in_prod_card.card_name",
        "gb_users.id(user_id)",
        "gb_users.login",
        "gb_users.full_name",
        "gb_users.telegram",
        "in_prod_analytics.score"
    ]);
    
    $userBestScores = [];
    foreach($candidates as $candidate) {
        if(!$candidate['score']) continue;
        
        $candidateMetrics = json_decode($candidate['score'], true);
        $matchScore = 
            $candidateMetrics['openness'] * $profMetrics['openness'] +
            $candidateMetrics['conscientiousness'] * $profMetrics['conscientiousness'] +
            $candidateMetrics['extraversion'] * $profMetrics['extraversion'] +
            $candidateMetrics['agreeableness'] * $profMetrics['agreeableness'] +
            $candidateMetrics['neuroticism'] * $profMetrics['neuroticism'];
        
        if (!isset($userBestScores[$candidate['user_id']]) || 
            $matchScore > $userBestScores[$candidate['user_id']]['match_score']) {
            $userBestScores[$candidate['user_id']] = [
                "id" => $candidate['id'],
                "name" => $candidate['login'],
                "fullName" => $candidate['full_name'],
                "telegram" => $candidate['telegram'],
                "match_score" => $matchScore
            ];
        }
    }
    
    $results = array_values($userBestScores);
    
    usort($results, function($a, $b) {
        return $b['match_score'] <=> $a['match_score'];
    });
    
    echo json_encode([
        "status" => "success",
        "candidates" => $results
    ]);
    exit();
}

if (isset($_GET['findTeam'])) {
    $utilityClass->checkSessions("dashboardAccess", $database);
   
   $professionIds = $_POST['professions'];
   
   $uniqueCards = $database->select("in_prod_card", [
       "id",
       "user_id"
   ], [
       "GROUP" => "user_id"
   ]);

   $availableUsers = $database->count("in_prod_analytics", [
       "card_id" => array_column($uniqueCards, "id"),
       "score[!]" => null
   ]);

   error_log("Available users: " . $availableUsers);
   error_log("Required professions: " . count($professionIds));
   
   if (count($professionIds) > $availableUsers) {
       echo json_encode([
           "status" => "error",
           "message" => "Недостаточно сотрудников для формирования команды. Доступно сотрудников: " . $availableUsers . ", требуется: " . count($professionIds)
       ]);
       exit();
   }

    $professions = $database->select("in_prod_professions", "*", [
        "id" => $professionIds
    ]);

    $candidates = $database->select("in_prod_card", [
        "[>]in_prod_analytics" => ["id" => "card_id"],
        "[>]gb_users" => ["user_id" => "id"]
    ], [
        "in_prod_card.id",
        "in_prod_card.card_name",
        "gb_users.id(user_id)",
        "gb_users.login",
        "gb_users.full_name",
        "gb_users.telegram",
        "in_prod_analytics.score"
    ], [
        "in_prod_analytics.score[!]" => null
    ]);

    $team = [];
    $usedUsers = [];

    foreach ($professions as $profession) {
        $profMetrics = json_decode($profession['ocean_json'], true);
        $bestMatch = null;
        $bestScore = -1;

        foreach ($candidates as $candidate) {
            if (in_array($candidate['user_id'], $usedUsers)) continue;

            $candidateMetrics = json_decode($candidate['score'], true);
            $matchScore =
                $candidateMetrics['openness'] * $profMetrics['openness'] +
                $candidateMetrics['conscientiousness'] * $profMetrics['conscientiousness'] +
                $candidateMetrics['extraversion'] * $profMetrics['extraversion'] +
                $candidateMetrics['agreeableness'] * $profMetrics['agreeableness'] +
                $candidateMetrics['neuroticism'] * $profMetrics['neuroticism'];

            if ($matchScore > $bestScore) {
                $bestScore = $matchScore;
                $bestMatch = [
                    "id" => $candidate['id'],
                    "user_id" => $candidate['user_id'],
                    "name" => $candidate['login'],
                    "fullName" => $candidate['full_name'],
                    "telegram" => $candidate['telegram'],
                    "profession" => $profession['profession_name'],
                    "match_score" => $matchScore
                ];
            }
        }

        if ($bestMatch) {
            $team[] = $bestMatch;
            $usedUsers[] = $bestMatch['user_id'];
        }
    }

    echo json_encode([
        "status" => "success",
        "team" => $team
    ]);
    exit();
}

if (isset($_GET['getCandidateDetails'])) {
    $utilityClass->checkSessions("dashboardAccess", $database);

    $candidateId = $utilityClass->sanitizeParam($_POST['candidateId']);

    $candidate = $database->get("in_prod_card", [
        "[>]in_prod_analytics" => ["id" => "card_id"],
        "[>]gb_users" => ["user_id" => "id"]
    ], [
        "in_prod_card.id",
        "in_prod_card.card_name",
        "in_prod_card.video_path",
        "gb_users.login",
        "gb_users.full_name",
        "gb_users.telegram",
        "in_prod_analytics.score"
    ], [
        "in_prod_card.id" => $candidateId
    ]);

    if ($candidate) {
        $metrics = json_decode($candidate['score'], true);

        echo json_encode([
            "status" => "success",
            "candidate" => [
                "id" => $candidate['id'],
                "name" => $candidate['login'],
                "fullName" => $candidate['full_name'],
                "telegram" => $candidate['telegram'],
                "metrics" => $metrics,
                "video_url" => $candidate['video_path']
            ]
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Кандидат не найден"
        ]);
    }
    exit();
}


if (isset($_GET['receiveOcean'])) {
    if (empty($_POST["secretKey"]) || $_POST["secretKey"] != $secretKey) {
        exit(json_encode(["status" => "error", "message" => "Invalid secret key"]));
    }

    if (empty($_POST["identity"])) {
        exit(json_encode(["status" => "error", "message" => "Invalid identity"]));
    }

    if (empty($_POST["oceanJson"])) {
        exit(json_encode(["status" => "error", "message" => "Invalid OCEAN json"]));
    }

    $oceanData = json_decode($_POST["oceanJson"], true);
    if ($oceanData === null && json_last_error() !== JSON_ERROR_NONE) {
        exit(json_encode(["status" => "error", "message" => "Invalid JSON format"]));
    }

    try {
        $insertResult = $database->insert("in_prod_analytics", [
            "card_id" => $_POST["identity"],
            "score" => $_POST["oceanJson"],
            "created_at" => date("d.m.Y H:i:s")
        ]);

        if ($database->id()) {
            echo json_encode([
                "status" => "success",
                "message" => "OCEAN data successfully received",
                "id" => $database->id()
            ]);
        } else {
            throw new Exception("Error inserting data");
        }
    } catch (Exception $e) {
        error_log("Error inserting OCEAN data: " . $e->getMessage());
        exit(json_encode([
            "status" => "error",
            "message" => "Database error occurred",
            "details" => $e->getMessage()
        ]));
    }
}
