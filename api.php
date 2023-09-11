<?php
header("Content-Type: application/json");

$request_method = $_SERVER["REQUEST_METHOD"];

$slack = $_GET['slack_name'];
$track = $_GET['track'];

if(empty($slack) || empty($track)) {
    json_encode(["error" => 'slack_name and track are required']);
}

$response = [
    "slack_name" => $slack,
    "current_day" => date('D'),
    "utc_time" => gmdate('Y-m-d\TH:i:s\Z'),
    "track" => $track,
    "github_file_url" => "https://github.com/username/repo/blob/main/file_name.ext",
    "github_repo_url" => "https://github.com/mp-learning-journey/stage-one-hng",
    "status_code" => 200
];

switch ($request_method) {
    case 'GET':
        // Handle GET request (Read)
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            get_book($id);
        } else {
            get_books();
        }
        break;
    default:
        // Invalid request method
        header("HTTP/1.0 405 Method Not Allowed");
        json_encode(["message" => "Invalid request"], 405);
        break;
}